import { useRef, useEffect, forwardRef,useImperativeHandle } from 'react';
import Player from 'xgplayer';
import 'xgplayer/dist/index.min.css';
const PlayerComponent = forwardRef(({ id = 'mse', url, poster, urlList = [] }, ref) => {
    const videoRef = useRef(null);
    let playerInstance = useRef(null);
    useImperativeHandle(ref, () => ({
        ...playerInstance.current
    }))
    useEffect(() => {
        if (ref) {
            if (playerInstance.current) {
                playerInstance.current?.setConfig({ url });
                return
            }
            const player = new Player({
                id,
                url,
                poster,
                pip: {
                    width: 200,
                    height: 100,
                },
                autoplay: true,
                miniplayer: true,
                videoInit: true,
                download: true,
                airplay: true,
                width: '100%',
                lang: 'zh-cn',
                playNext: {
                    urlList,
                },
                dynamicBg: {
                    disable: false
                },
                danmu: {
                    comments: [  //弹幕数组
                        {
                            duration: 15000, //弹幕持续显示时间,毫秒(最低为5000毫秒)
                            id: '1', //弹幕id，需唯一
                            start: 3000, //弹幕出现时间，毫秒
                            prior: true, //该条弹幕优先显示，默认false
                            color: true, //该条弹幕为彩色弹幕，默认false
                            txt: '长弹幕长弹幕长弹幕长弹幕长弹幕长弹幕长弹幕长弹幕长弹幕长弹幕', //弹幕文字内容
                            style: {  //弹幕自定义样式
                                color: '#ff9500',
                                fontSize: '20px',
                                border: 'solid 1px #ff9500',
                                borderRadius: '50px',
                                padding: '5px 11px',
                                backgroundColor: 'rgba(255, 255, 255, 0.1)'
                            },
                            mode: 'top' //显示模式，top顶部居中，bottom底部居中，scroll滚动，默认为scroll
                            // el: DOM //直接传入一个自定义的DOM元素作为弹幕，使用该项的话会忽略所提供的txt
                            // eventListeners: [{ //支持自定义DOM设置DOM监听事件
                            //   event: 'click',
                            //   listener: function (e) {
                            //     console.log('click')
                            //   },
                            //   useCapture: false,
                            // }]
                        }
                    ],
                    area: {  //弹幕显示区域
                        start: 0, //区域顶部到播放器顶部所占播放器高度的比例
                        end: 1 //区域底部到播放器顶部所占播放器高度的比例
                    },
                    closeDefaultBtn: true, //开启此项后不使用默认提供的弹幕开关，默认使用西瓜播放器提供的开关
                    defaultOff: false //开启此项后弹幕不会初始化，默认初始化弹幕
                },
                playbackRate: [0.5, 0.75, 1, 1.5, 2] //传入倍速可选数组
            });
            playerInstance.current = player
        }
    }, [id, poster, ref, url, urlList])
    return (
        <div id={id} style={{position: 'sticky', top: 0, zIndex: 1000}} ref={videoRef}></div>
        // <video 
        //     src={url}
        //     controls
        //     autoPlay
        //     id="video"
        //     style={{
        //         width:'100%',
        //         height:'100%',
        //         cursor: 'pointer',
        //     }}
        //     poster={poster||''}
        // >
        //     您的浏览器不支持HTML5视频播放
        // </video>
    );
})
export default PlayerComponent;