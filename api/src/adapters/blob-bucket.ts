import { getStore } from "@edgeone/pages-blob";

/**
 * R2Bucket 形状的 EdgeOne Blob 适配器。
 *
 * 代码里唯一用到 R2 的地方是 `src/routes/upload.ts` 的图片上传：
 *   await env.UPLOAD_BUCKET.put(fileName, file.stream(), { httpMetadata: { contentType } })
 * R2 与 Blob 的 API 并不一致（Blob 没有 `put`，也不接受 `httpMetadata`），
 * 所以用这层薄适配把既有调用原样接住。
 *
 * ⚠️ Blob 的读取需要绑定公网域名后通过 `FILE_URL` 访问，迁移后需把
 * `FILE_URL` 指向 Blob 的公网域名，原先的 R2 自定义域名不再托管新上传的文件。
 */

export interface BlobBucketConfig {
  storeName: string;
}

type PutValue = ArrayBuffer | ArrayBufferView | ReadableStream | string | null;

/** Blob 的 set() 只吃 string / ArrayBuffer / Blob / ReadableStream，这里统一转换。 */
async function toStorableValue(value: PutValue): Promise<string | ArrayBuffer> {
  if (value === null) return "";
  if (typeof value === "string") return value;
  if (value instanceof ArrayBuffer) return value;
  if (ArrayBuffer.isView(value)) {
    return value.buffer.slice(
      value.byteOffset,
      value.byteOffset + value.byteLength
    ) as ArrayBuffer;
  }
  // ReadableStream：函数请求体上限 6MB，这里直接读进内存交给 Blob。
  return new Response(value as ReadableStream).arrayBuffer();
}

export function createBlobBucket(config: BlobBucketConfig): R2Bucket {
  const { storeName } = config;
  // 强一致性：上传后立即可读，避免「刚上传就访问不到」。
  // SDK 把 projectId / token 声明为必填，但那只针对「函数外调用」模式；在
  // Makers Function 内运行时凭据由平台注入，只需 name + consistency。
  const store = getStore({ name: storeName, consistency: "strong" } as never);

  return {
    name: storeName,

    async put(key: string, value: PutValue) {
      await store.set(key, await toStorableValue(value));
      return { key };
    },

    async get(key: string): Promise<R2ObjectBody | null> {
      const result = await store.getWithHeaders(key);
      if (!result) return null;

      const bytes = new TextEncoder().encode(result.body);

      return {
        key,
        size: bytes.byteLength,
        httpMetadata: {
          contentType:
            result.headers["content-type"] ?? "application/octet-stream",
        },
        arrayBuffer: async () =>
          bytes.buffer.slice(
            bytes.byteOffset,
            bytes.byteOffset + bytes.byteLength
          ) as ArrayBuffer,
        text: async () => result.body,
        json: async <T>() => JSON.parse(result.body) as T,
      };
    },

    async delete(key: string) {
      await store.delete(key);
    },
  };
}
