export type Category = {name: string, id: string}
export type Tag = {name: string, id: string}
export type Source = {id: string, label: string, source?: string,url?: string, urls: Source[]}
export type Video = {
    id: string,
    title?: string,
    subTitle?: string,
    cover?: string,
    banner?: string,
    category?: string,
    desc?: string,
    categoryId?: string,
    releaseYear?: number,
    recommended?: boolean,
    country?: string,
    source?: string,
    tags?: Tag[],
    director?: string,
    actors?: string[],
    updateTime?: string,
    sources?: Source[],
    loading?: boolean
}

export type User = {
    id: string,
    username: string,
    nickname: string,
    avatar?: string,
    role?: string,
    status?: string
}

export type Comment = {
    id: string,
    videoId: string,
    episodeId?: string,
    userId: string,
    content: string,
    parentId?: string,
    likes: number,
    status: string,
    createTime: string,
    updateTime: string,
    currentTime?: number,
    user?: User,
    replies?: Comment[]
}
