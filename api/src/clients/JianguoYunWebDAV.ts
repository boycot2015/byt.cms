// 坚果云 WebDAV 客户端
export class JianguoYunWebDAV {
  private username: string;
  private password: string;
  private baseUrl = "https://dav.jianguoyun.com/dav/";

  constructor(env: any) {
    this.username = env.JIANGUOYUN_USERNAME;
    this.password = env.JIANGUOYUN_APP_PASSWORD;
    if (!this.username || !this.password) {
      throw new Error("缺少坚果云环境变量：JIANGUOYUN_USERNAME / JIANGUOYUN_APP_PASSWORD");
    }
  }

  private getAuthHeader(): string {
    const auth = btoa(`${this.username}:${this.password}`);
    return `Basic ${auth}`;
  }

  private parseWebDAVResponse(xmlText: string): any[] {
    const files: any[] = [];
    
    // 正则匹配每个 <d:response> 块
    const responseRegex = /<d:response>([\s\S]*?)<\/d:response>/g;
    let responseMatch;
    
    while ((responseMatch = responseRegex.exec(xmlText)) !== null) {
      const responseBlock = responseMatch[1];
      
      // 提取各个字段（使用正则匹配）
      const hrefMatch = responseBlock.match(/<d:href>([\s\S]*?)<\/d:href>/);
      const href = hrefMatch ? hrefMatch[1].trim() : "";
      
      const displayNameMatch = responseBlock.match(/<d:displayname>([\s\S]*?)<\/d:displayname>/);
      const displayName = displayNameMatch ? displayNameMatch[1].trim() : "";
      
      // 判断是否是文件夹
      const isFolder = /<d:resourcetype>[\s\S]*?<d:collection>[\s\S]*?<\/d:collection>[\s\S]*?<\/d:resourcetype>/.test(responseBlock);
      
      const sizeMatch = responseBlock.match(/<d:getcontentlength>([\s\S]*?)<\/d:getcontentlength>/);
      const size = sizeMatch ? sizeMatch[1].trim() : "0";
      
      const contentTypeMatch = responseBlock.match(/<d:getcontenttype>([\s\S]*?)<\/d:getcontenttype>/);
      const contentType = contentTypeMatch ? contentTypeMatch[1].trim() : "";
      
      const lastModifiedMatch = responseBlock.match(/<d:getlastmodified>([\s\S]*?)<\/d:getlastmodified>/);
      const lastModified = lastModifiedMatch ? lastModifiedMatch[1].trim() : "";
      
      // 只处理文件（非文件夹）且有有效路径的条目
      if (!isFolder && href) {
        files.push({
          path: decodeURIComponent(href),
          name: displayName || href.split("/").pop() || "", // 兜底：从路径提取文件名
          size: parseInt(size, 10) || 0,
          contentType,
          lastModified,
          downloadUrl: `${this.baseUrl}${href.replace("/dav/", "")}`,
        });
      }
    }
    
    return files;
  }

  async listFiles(path: string = "/"): Promise<any[]> {
    const fullPath = path.startsWith("/") ? path.slice(1) : path;
    const url = `${this.baseUrl}${fullPath}`;
    const response = await fetch(url, {
      method: "PROPFIND",
      headers: {
        Authorization: this.getAuthHeader(),
        Depth: "1",
        "Content-Type": "application/xml",
      },
    });
    if (!response.ok) {
      throw new Error(`坚果云 PROPFIND 失败：${response.status} ${response.statusText}`);
    }
    const xmlText = await response.text();
    return this.parseWebDAVResponse(xmlText);
  }

  async listVideoFiles(path: string = "/"): Promise<any[]> {
    const files = await this.listFiles(path);
    return files.filter(file => file.contentType?.startsWith("video/"));
  }
}
