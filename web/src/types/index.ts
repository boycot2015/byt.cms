export type Category = {name: string, id: string}
export type Tag = {name: string, id: string}
export type Source = {id: string, label: string, source?: string, urls: Source[]}
export type Video = {
    id: string,
    title: string,
    subTitle: string,
    cover: string,
    banner?: string,
    category?: string,
    desc?: string,
    categoryId?: string,
    releaseYear?: number,
    recommended?: boolean,
    country?: string,
    source: string,
    tags: Tag[],
    director?: string,
    actors: string,
    updateTime?: string,
    sources?: Source[]
}
