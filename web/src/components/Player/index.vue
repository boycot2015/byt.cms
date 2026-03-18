<template>
    <div :id="id" :style="{position: 'sticky', top: 0, zIndex: 1000}" ref="videoRef"></div>
</template>
<script setup lang="ts">
import { onMounted, ref, watch } from 'vue';
import Player from 'xgplayer';
// import 'xgplayer/dist/index.min.css';
import type { Comment } from '../../types'
const videoRef = ref(null);
// const colors = ['#ff9500', '#ff6600', '#cc3300', '#993300', '#663300']
const defaultComment = {
    style: {  //弹幕自定义样式
        // color: colors[Math.floor(Math.random() * colors.length)],
        // fontSize: '20px',
        // border: 'solid 1px #ff9500',
        // borderRadius: '50px',
        // padding: '5px 11px',
        // backgroundColor: 'rgba(255, 255, 255, 0.1)'
    },
    duration: 15000, //弹幕持续显示时间,毫秒(最低为5000毫秒)
    prior: false, //该条弹幕优先显示，默认false
    color: false, //该条弹幕为彩色弹幕，默认false
    mode: 'scroll', //显示模式，top顶部居中，bottom底部居中，scroll滚动，默认为scroll
}
const playerInstance = ref<Player>(null!);
const props = defineProps<{
    id?: string
    url: string
    poster?: string
    urlList?: string[],
    videoId?: string,
    episodeId?: string,
    comments?: Comment[]
    totalComments?: number
}>()
onMounted(() => {
    const { id, url, poster, urlList } = props
    if (videoRef.value) {
        if (playerInstance.value) {
            playerInstance.value.start(url);
            return
        }
        const player = new Player({
            id,
            url,
            poster,
            pip: true,
            autoplay: true,
            miniplayer: true,
            videoInit: true,
            download: true,
            airplay: true,
            width: '100%',
            height: '100%',
            lang: 'zh-cn',
            playNext: {
                urlList: urlList || [],
            },
            // dynamicBg: {
            //     disable: false
            // },
            danmu: {
                comments: [],
                area: {  //弹幕显示区域
                    start: 0, //区域顶部到播放器顶部所占播放器高度的比例
                    end: 0.2 //区域底部到播放器顶部所占播放器高度的比例
                },
                // closeDefaultBtn: true, //开启此项后不使用默认提供的弹幕开关，默认使用西瓜播放器提供的开关
                // defaultOff: false //开启此项后弹幕不会初始化，默认初始化弹幕
            },
            playbackRate: [0.5, 0.75, 1, 1.5, 2] //传入倍速可选数组
        });
        playerInstance.value = player
    }
})
defineExpose({
    player: playerInstance,
    getCurrentTime: () => playerInstance.value?.currentTime || 0,
    sendComment: (comment: any) => {
        debugger
        playerInstance.value.danmu.sendComment({
        ...comment,
        ...defaultComment,
        start: 0, //弹幕出现时间，毫秒
        txt: comment.content, //弹幕文字内容
    })
    },
})
watch(() => props.url, (newUrl) => {
    if (playerInstance.value) {
        playerInstance.value.src = newUrl;
    }
})
watch(() => props.comments?.length, () => {
    if (playerInstance.value) {
        const covert = (comment: Comment, prop = 'replies') => {
            playerInstance.value.danmu.sendComment({
                ...comment,
                ...defaultComment,
                start: comment.currentTime || 0, //弹幕出现时间，毫秒
                txt: comment.content, //弹幕文字内容
            })
            let children = (comment[prop as keyof Comment] || []) as Comment[]
            if (children.length > 0) {
                children.map((child) => covert(child))
            }
        }
        props.comments?.map((comment) => covert(comment)) || [];
    }
})
</script>