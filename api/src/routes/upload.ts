// import type { Request } from 'cloudflare-workers-types';

interface Env {
  UPLOAD_BUCKET: R2Bucket;
}

export async function handleUpload(request: Request, env: Env, corsHeaders: Record<string, string>) {
  const url = new URL(request.url);
  const path = url.pathname;

  // 上传图片
  if (path === "/api/upload/image" && request.method === "POST") {
    const formData = await request.formData();
    const file = formData.get("file") as File;
    
    if (!file) {
      return new Response(JSON.stringify({ error: "缺少文件" }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 400,
      });
    }
    
    // 生成唯一文件名
    const fileName = `images/${Date.now()}_${Math.random().toString(36).slice(2)}_${file.name}`;
    
    // 上传到R2存储桶
    await env.UPLOAD_BUCKET.put(fileName, file.stream(), {
      httpMetadata: {
        contentType: file.type
      }
    });
    
    // 生成访问URL（假设使用Cloudflare R2的公共访问URL）
    // 使用环境变量或硬编码的桶名称构建URL
    const bucketName = (env.UPLOAD_BUCKET as any).name || "your-bucket-name";
    const url = `https://${bucketName}.r2.cloudflarestorage.com/${fileName}`;
    
    return new Response(JSON.stringify({ success: true, data: { url } }), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
    });
  }
  return null;
}
