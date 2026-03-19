// 阿里云盘工具类
export class AliyunDriveClient {
  private refreshToken: string;
  private clientId: string;
  private clientSecret: string;
  private accessToken: string | null = null;
  private tokenExpireTime: number = 0;

  constructor(env: any) {
    this.refreshToken = env.ALIYUN_REFRESH_TOKEN;
    this.clientId = env.ALIYUN_CLIENT_ID || "";
    this.clientSecret = env.ALIYUN_CLIENT_SECRET || "";
  }

  private async refreshAccessToken(): Promise<string|null> {
    if (this.accessToken && Date.now() < this.tokenExpireTime) {
      return this.accessToken;
    }
    const response = await fetch("https://openapi.aliyundrive.com/oauth/access_token", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        client_id: this.clientId,
        client_secret: this.clientSecret,
        grant_type: "refresh_token",
        refresh_token: this.refreshToken
      })
    });
    if (!response.ok) throw new Error(`刷新令牌失败: ${response.status}`);
    const data:any = await response.json();
    this.accessToken = data.access_token;
    this.tokenExpireTime = Date.now() + (data.expires_in - 300) * 1000;
    if (data.refresh_token) this.refreshToken = data.refresh_token;
    return this.accessToken;
  }

  private async getHeaders(): Promise<HeadersInit> {
    const token = await this.refreshAccessToken();
    return {
      "Content-Type": "application/json",
      "Authorization": `Bearer ${token}`
    };
  }

  private async getFileIdByPath(driveId: string, path: string, parentFileId = "root"): Promise<string> {
    if (path === "/" || path === "") return parentFileId;
    const pathParts = path.split("/").filter(part => part);
    const currentFolder = pathParts[0];
    const response = await fetch("https://api.aliyundrive.com/v2/file/list", {
      method: "POST",
      headers: await this.getHeaders(),
      body: JSON.stringify({
        drive_id: driveId,
        parent_file_id: parentFileId,
        limit: 100,
        fields: "file_id,name,type"
      })
    });
    if (!response.ok) throw new Error(`获取目录列表失败: ${response.status}`);
    const data:any = await response.json();
    const folder = data.items?.find((item: any) => item.type === "folder" && item.name === currentFolder);
    if (!folder) throw new Error(`路径不存在: ${path}`);
    const remainingPath = pathParts.slice(1).join("/");
    return this.getFileIdByPath(driveId, remainingPath, folder.file_id);
  }

  private async getDefaultDriveId(): Promise<string> {
    const response = await fetch("https://api.aliyundrive.com/v2/user/get", {
      method: "POST",
      headers: await this.getHeaders()
    });
    if (!response.ok) throw new Error(`获取drive_id失败: ${response.status}`);
    const data:any = await response.json();
    return data.default_drive_id;
  }

  async listVideoFiles(path: string = "/"): Promise<any[]> {
    const driveId = await this.getDefaultDriveId();
    const parentFileId = await this.getFileIdByPath(driveId, path);
    let allFiles: any[] = [];
    let marker = "";
    do {
      const response = await fetch("https://api.aliyundrive.com/v3/file/list", {
        method: "POST",
        headers: await this.getHeaders(),
        body: JSON.stringify({
          drive_id: driveId,
          parent_file_id: parentFileId,
          limit: 100,
          marker: marker,
          image_thumbnail_process: "image/resize,w_400/format,jpeg",
          video_thumbnail_process: "video/snapshot,t_1000,f_jpg,ar_auto,w_400",
          fields: "file_id,name,size,mime_type,thumbnail,video_media_info,download_url,web_content_link"
        })
      });
      if (!response.ok) throw new Error(`获取文件列表失败: ${response.status}`);
      const data:any = await response.json();
      allFiles = allFiles.concat(data.items || []);
      marker = data.next_marker || "";
    } while (marker);
    return allFiles.filter((file: any) => file.mime_type?.startsWith("video/"));
  }
}
