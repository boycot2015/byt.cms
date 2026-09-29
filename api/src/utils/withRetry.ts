export async function withRetry<T>(
  fn: () => Promise<T>,
  maxRetries = 3,
  initialDelay = 1000,
  label = "操作"
): Promise<T> {
  let retries = 0;
  let lastError: unknown = null;
  while (true) {
    try {
      return await fn();
    } catch (error) {
      lastError = error;
      retries++;
      if (retries >= maxRetries) {
        throw new Error(
          `[${label}] 重试${maxRetries}次后仍失败: ${(error as Error).message}`
        );
      }
      const delay = initialDelay * Math.pow(2, retries);
      console.warn(
        `[${label}] 第${retries}次重试，延迟${delay}ms，原因: ${(error as Error).message}`
      );
      await new Promise(resolve => setTimeout(resolve, delay));
    }
  }
}