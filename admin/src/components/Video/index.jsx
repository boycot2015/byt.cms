import { useState, useEffect, Fragment, useRef, forwardRef, useImperativeHandle } from 'react';
import { useAsyncEffect } from 'ahooks';
import { 
  Table, Button, message, Form, Input, Typography, Space, 
  App, Row, Col, Switch, Select, Tag,
  Image, Drawer, Divider, Popconfirm
} from 'antd';
import sourceConfig from '../../sourceConfig';
import Player from '../Player';
import axios from 'axios';
import { 
  LoadingOutlined, DeleteOutlined, PlusOutlined, 
  ClockCircleOutlined, FolderAddOutlined, TagOutlined, PlayCircleOutlined,
  DownloadOutlined, SearchOutlined,
} from '@ant-design/icons';
import { usePermission } from '../../hooks/usePermission';
const { Text } = Typography;

// 替换为你的Workers地址
const API_BASE = import.meta.env.VITE_API_BASE;

const Video = forwardRef((props, ref) => {
    const playerRef = useRef(null);
   
    const { isAdmin } = usePermission();
    // ========== 分类/标签状态 ==========
    const [categories, setCategories] = useState([]);
    const [tags, setTags] = useState([]);
    // 分类弹窗状态
    const [categoryForm] = Form.useForm();
    
    const [tagForm] = Form.useForm();

    // ========== 视频相关状态 ==========
    const [videos, setVideos] = useState([]);
    const [videoSearch, setVideoSearch] = useState('');
    const [videoLoading, setVideoLoading] = useState(false);
    const [selectedCategory, setSelectedCategory] = useState(null);
    const [selectedTag, setSelectedTag] = useState(null);
    const [pageSize, setPageSize] = useState(10);
    const [currentPage, setCurrentPage] = useState(1);
    const [totalVideos, setTotalVideos] = useState(0);
    const [selectedSource, setSelectedSource] = useState(null);
    const [videoPlayDrawer, setVideoPlayDrawer] = useState({
        visible: false,
        video: null
    });
    const [sourceConfigDrawer, setSourceConfigDrawer] = useState({
        visible: false
    });
    const [videoSources, setVideoSources] = useState([]);
    const [videoSourceLoading, setVideoSourceLoading] = useState(false);
    // 新增：手动拉取视频的加载状态
    const [fetchingSource, setFetchingSource] = useState(-1); // -1表示没有拉取，index表示正在拉取第几个源
    // 批量操作状态
    const [selectedVideos, setSelectedVideos] = useState([]);

    // ========== 分类管理方法 ==========
    const fetchCategories = async () => {
        try {
            const res = await axios.get(`${API_BASE}/api/categories`);
            setCategories(res.data || []);
        } catch (err) {
            message.error('获取分类失败');
            console.error(err);
        }
    };

    const showCategoryModal = (category = null) => {
        categoryForm.setFieldsValue({
        name: category?.name || '',
        desc: category?.desc || ''
        });
        props.setCategoryModalVisible(true);
    };

    // ========== 标签管理方法 ==========
    const fetchTags = async () => {
        try {
            const res = await axios.get(`${API_BASE}/api/tags`);
            setTags(res.data);
        } catch (err) {
            message.error('获取标签失败');
            console.error(err);
        }
    };

    const showTagModal = (tag = null) => {
        tagForm.setFieldsValue({
        name: tag?.name || ''
        });
        props.setTagModalVisible(true);
    };

    // ========== 视频管理方法 ==========
    const fetchVideos = async () => {
        setVideoLoading(true);
        try {
            let url = `${API_BASE}/api/videos`;
            const params = [];
            if (selectedCategory) params.push(`category=${selectedCategory}`);
            if (selectedTag) params.push(`tag=${selectedTag}`);
            if (selectedSource) params.push(`source=${selectedSource}`);
            if (params.length) url += `?${params.join('&')}`;
            const res = await axios.get(url);
            setVideos(res.data || []);
            setTotalVideos(res.data?.length || 0);
        } catch (err) {
            message.error('获取视频失败');
            console.error(err);
        } finally {
            setTimeout(() => {
                setVideoLoading(false);
            }, 500);
        }
    };

    const fetchVideoSources = async () => {
        try {
            setVideoSourceLoading(true);
            const res = await axios.get(`${API_BASE}/api/video-sources`);
            let results = await Promise.all(res.data.map(async (item, index) => {
                item.categories = categories
                let data = await fetchVideoBySource(sourceConfig[item.type], index, true);
                if (data && data.categories && data.categories.length) {
                    item.categories = data.categories
                }
                return item;
            }));
            // console.log(results, 'results');
            setVideoSources(results || []);
            setVideoSourceLoading(false);
        } catch (err) {
            message.error('获取视频源配置失败');
            setVideoSourceLoading(false);
            console.error(err);
        }
    };

    const saveVideoSources = async () => {
        try {
        await axios.post(`${API_BASE}/api/video-sources`, videoSources);
        message.success('视频源配置保存成功');
        setSourceConfigDrawer({ visible: false });
        } catch (err) {
        message.error('保存配置失败');
        console.error(err);
        }
    };

    // 新增：根据源类型手动拉取视频数据
    const fetchVideoBySource = async (source, index, queryOnly = false) => {
        if (!source || !source.type) {
            message.warning('请先配置有效的视频源类型');
            return;
        }
        
        setFetchingSource(index);
        try {
        // 发送拉取视频请求，携带源类型等参数
        const res = await axios.get(`${API_BASE}/api/video-source-data/${source.type}?action=${queryOnly ? 'get' : 'put'}&cid=${source.path.match(/t=([^&]+)/)?.[1] || ''}`);
        
        if (res.data.success) {
            if (queryOnly) {
                return res.data.data
            }
            message.success(`成功拉取 ${res.data.data?.list.length || 0} 个视频`);
            // 拉取成功后刷新视频列表
            fetchVideos();
            // 刷新分类和标签
            fetchCategories();
            setCurrentPage(1);
            fetchTags();
        } else {
            message.error(`拉取失败：${res.data.message || '未知错误'}`);
        }
        } catch (err) {
            message.error(`拉取视频失败：${err.message || '网络错误'}`);
            console.error('手动拉取视频失败：', err);
        } finally {
            setFetchingSource(-1);
        }
    };

    // 新增：批量拉取所有启用的视频源
    const fetchAllEnabledSources = async () => {
        const enabledSources = videoSources.filter(s => s.enabled !== false);
        if (enabledSources.length === 0) {
        message.warning('没有启用的视频源');
        return;
        }
        
        message.info(`开始批量拉取 ${enabledSources.length} 个视频源的数据`);
        
        // 逐个拉取视频源
        for (let i = 0; i < enabledSources.length; i++) {
        await fetchVideoBySource(enabledSources[i], -1);
        }
        
        message.success('批量拉取完成');
    };

    const handleDeleteVideo = async (record, isMultiple = false) => {
        try {
        const id = record.id.replace('video:', '');
        await axios.delete(`${API_BASE}/api/videos/${id}`);
        if (!isMultiple) {
            message.success('视频删除成功');
            fetchVideos();
        }
        } catch (error) {
            !isMultiple && message.error('删除失败' + error);
        }
    };
    // 批量删除视频
    const batchDeleteVideos = async () => {
        if (selectedVideos.length === 0) {
            message.warning('请选择要删除的视频');
            return;
        }
        setVideoLoading(true)
        try {
            // 批量删除
            for (const video of selectedVideos) {
                await handleDeleteVideo(video, true);
            }
            
            message.success(`成功删除 ${selectedVideos.length} 个视频`);
            setSelectedVideos([]);
            fetchVideos();
        } catch (err) {
            message.error('批量删除失败');
            console.error(err);
        }
    };
    const playVideo = (video) => {
        setVideoPlayDrawer({
        visible: true,
        video: {...video, current: video?.urls?.[0] || {}}
        });
    };

    const updateVideoSource = async (index, key, value) => {
        const newSources = [...videoSources];
        newSources[index][key] = value;
        if (key === 'category' && value) {
            newSources[index].path = newSources[index].path.replace(/&t=[^&]*/, '');
            newSources[index].path+= `&t=${value}`;
        }
        if (key === 'type' && value) {
            newSources[index].path = sourceConfig[value].path;
            newSources[index].categories = categories
            let data = await fetchVideoBySource(sourceConfig[value], index, true);
            if (data.categories && data.categories.length) {
                newSources[index].categories = data.categories;
                // console.log(newSources[index], data, 'newSources');
                newSources[index].category = ''
            }
        }
        setVideoSources(newSources);
    };

    const addVideoSource = () => {
        setVideoSources([
        ...videoSources,
        {
            name: `新源${Date.now()}`,
            type: '',
            cron: '* * * * *',
            enabled: true,
            path: '',
            categoryId: '',
            category: '',
            categories,
            tags: []
        }
        ]);
    };

    const deleteVideoSource = (index) => {
        const newSources = [...videoSources];
        newSources.splice(index, 1);
        setVideoSources(newSources);
    };
     // 筛选标签列表
    const getFilteredVideos = () => {
        if (!videoSearch) return videos;
        return videos.filter(t => 
        t.title.toLowerCase().includes(videoSearch.toLowerCase())
        );
    };
    useEffect(() => {
        fetchVideos();
    }, [selectedCategory, selectedTag, selectedSource]);
    // ========== 初始化 ==========
    useAsyncEffect(async () => {
        await fetchCategories();
        fetchTags();
        fetchVideoSources();
    }, []);

    // 暴露方法给父组件
    useImperativeHandle(ref, () => ({
        fetchVideos
    }));
    return (
        <Fragment>
            <Row gutter={16} style={{ marginBottom: 16 }}>
                <Col span={8}>
                    <Space >
                        {isAdmin && (
                            <>
                                <Button
                                type="primary"
                                icon={<ClockCircleOutlined />}
                                onClick={() => setSourceConfigDrawer({ visible: true })}
                                >
                                视频源配置
                                </Button>
                                <Button 
                                icon={<FolderAddOutlined />} 
                                onClick={() => showCategoryModal()}
                                >
                                新增分类
                                </Button>
                                <Button 
                                icon={<TagOutlined />} 
                                onClick={() => showTagModal()}
                                >
                                新增标签
                                </Button>
                                <Button 
                                    danger
                                    type="primary"
                                    icon={<DeleteOutlined />} 
                                    onClick={batchDeleteVideos}
                                    style={{ marginLeft: 8 }}
                                    disabled={selectedVideos.length === 0}
                                >
                                    批量删除
                                </Button>
                            </>
                        )}
                    </Space>
                </Col>
                <Col span={16}>
                    <div style={{display: 'flex', justifyContent: 'flex-end', gap: '10px'}}>
                        <Input
                            placeholder="搜索名称"
                            value={videoSearch}
                            allowClear
                            onChange={(e) => setVideoSearch(e.target.value)}
                            prefix={<SearchOutlined />}
                            style={{ width: 200 }}
                        />
                        <Select
                        placeholder="选择分类"
                        style={{ width: 120 }}
                        value={selectedCategory}
                        onChange={setSelectedCategory}
                        allowClear
                        showSearch={{
                            optionFilterProp: 'label'
                        }}
                        options={categories?.map(c => ({
                            label: c.name,
                            value: c.id
                        }))}
                        />
                        <Select
                        placeholder="选择标签"
                        style={{ width: 120 }}
                        value={selectedTag}
                        showSearch={{
                            optionFilterProp: 'label'
                        }}
                        onChange={setSelectedTag}
                        allowClear
                        options={tags?.map(t => ({
                            label: t.name,
                            value: t.id
                        }))}
                        />
                        <Select
                        placeholder="选择视频源"
                        style={{ width: 120 }}
                        value={selectedSource}
                        onChange={setSelectedSource}
                        allowClear
                        showSearch={{
                            optionFilterProp: 'label'
                        }}
                        options={videoSources?.filter((el, index, self) => self.findIndex(t => t.type === el.type) === index)?.map(t => ({
                            label: sourceConfig[t.type]?.name || t.type,
                            value: t.type
                        }))}
                        />
                        <Button
                        type="primary" 
                        loading={videoLoading && {icon: <LoadingOutlined spin />}} 
                        onClick={() => fetchVideos()}
                        >
                        搜索
                        </Button>
                        <Button
                        danger
                        type="primary" 
                        onClick={() => {
                            setSelectedCategory(null)
                            setSelectedTag(null)
                            setSelectedSource(null)
                            setVideoSearch('')
                            fetchVideos()
                            setPageSize(10)
                            setCurrentPage(1)
                        }}
                        >
                        重置
                        </Button>
                    </div>
                </Col>
            </Row>

            {/* 视频列表（带预览） */}
            <Table
                scroll={{ x: 'auto', y:'calc(100vh - 400px)' }}
                columns={[
                    {
                        title: '封面',
                        key: 'cover',
                        width: 100,
                        render: (_, record) => (
                        record.cover ? (
                            <Image 
                            width={80} 
                            height={120} 
                            src={record.cover} 
                            fallback="https://via.placeholder.com/80x60?text=无封面"
                            preview={false}
                            onClick={() => playVideo(record)}
                            style={{ cursor: 'pointer' }}
                            />
                        ) : (
                            <div style={{ width:80, height:60, background:'#f5f5f5', display:'flex', alignItems:'center', justifyContent:'center' }}>
                            <PlayCircleOutlined onClick={() => playVideo(record)} style={{ cursor: 'pointer' }} />
                            </div>
                        )
                        )
                    },
                    {
                        title: '标题',
                        dataIndex: 'title',
                        key: 'title',
                        render: (title,record) => <div>
                            {title}
                            <p>{record.subTitle}</p>
                        </div>
                    },
                    {
                        title: '分类',
                        dataIndex: 'category',
                        key: 'category',
                    },
                    {
                        title: '标签',
                        dataIndex: 'tags',
                        key: 'tags',
                        render: (tags) => (
                        <div style={{display: 'flex', gap: '5px', flexWrap: 'wrap'}}>
                            {tags?.map(tag => (
                            <Tag key={tag.id} variant="outlined" color="blue">{tag.name||tag}</Tag>
                            ))}
                        </div>
                        )
                    },
                    {
                        title: '来源',
                        dataIndex: 'source',
                        key: 'source',
                        render: (source, row) => `${sourceConfig[source]?.name || source}(${row.source})`
                    },
                    {
                        title: '更新时间',
                        dataIndex: 'updateTime',
                        key: 'updateTime',
                        render: (time, row) => new Date(time || row.fetchTime || row.updateTime || new Date().toISOString()).toLocaleString()
                    },
                    {
                        title: '创建时间',
                        dataIndex: 'createTime',
                        key: 'createTime',
                        render: (time) => new Date(time).toLocaleString()
                    },
                    {
                        title: '操作',
                        key: 'action',
                        align: 'left',
                        fixed: 'right',
                        render: (_, record) => (
                        <Space style={{marginLeft: -25}}>
                            <Button 
                            type="link"
                            size="small"
                            icon={<PlayCircleOutlined />}
                            onClick={() => playVideo(record)}
                            >
                            播放
                            </Button>
                            {isAdmin && (
                                <Popconfirm
                                title="确定删除这个视频吗？"
                                onConfirm={() => handleDeleteVideo(record)}
                                okText="确定"
                                cancelText="取消"
                                >
                                <Button 
                                    type="text" 
                                    danger
                                    size="small"
                                    icon={<DeleteOutlined />}
                                >
                                    删除
                                </Button>
                                </Popconfirm>
                            )}
                        </Space>
                        )
                    }
                ]} 
                dataSource={getFilteredVideos()} 
                rowKey="id" 
                loading={videoLoading}
                rowSelection={{
                    type: 'checkbox',
                    selectedRowKeys: selectedVideos.map(v => v.id),
                    onChange: (selectedKeys) => {
                        setSelectedVideos(
                        videos.filter(v => selectedKeys.includes(v.id))
                        );
                    }
                }}
                pagination={{
                    pageSize: pageSize,
                    current: currentPage,
                    total: totalVideos,
                    showTotal: () => `共 ${totalVideos} 条`,
                    onChange (page, pageSize) {
                    setPageSize(pageSize)
                    setCurrentPage(page)
                } }}
            />
            {/* 视频播放抽屉 */}
            <Drawer
            title={(videoPlayDrawer.video?.title + ' - ' + (videoPlayDrawer.video?.current?.label || '')) || "视频播放"}
            open={videoPlayDrawer.visible}
            onClose={() => {
                setVideoPlayDrawer({...videoPlayDrawer, visible: false})
            }}
            afterOpenChange={async (val) => {
                try {
                    // 检查视频是否已经在画中画模式
                    if (val && document.pictureInPictureElement) {
                        // 退出画中画
                        await document.exitPictureInPicture();
                    } else if (!val && !document.pictureInPictureElement) {
                        // 进入画中画
                        // console.log(playerRef.current);
                        await playerRef.current?.root?.children?.[1].requestPictureInPicture();
                        // await playerRef.current?.emit('MINI_STATE_CHANGE', {
                        //     pip: true,
                        // });
                        
                        // await playerRef.current?.switchPIP()
                    }
                } catch (error) {
                    // 捕获异常（比如视频未加载、用户拒绝等）
                    console.error('画中画操作失败:', error);
                }
            }}
            size={800}
            >
            {videoPlayDrawer.video ? (
                <div>
                    <Player id="video" ref={playerRef} key={videoPlayDrawer.video.url} url={videoPlayDrawer.video.url} poster={videoPlayDrawer.video.cover||''} />
                    <Divider />
                    <Row gutter={16}>
                        <Col span={8}><Text strong>标题：</Text>{videoPlayDrawer.video.title}</Col>
                        <Col span={8}><Text strong>分类：</Text>{videoPlayDrawer.video.category}</Col>
                        <Col span={8}><Text strong>来源：</Text>{videoPlayDrawer.video.source}</Col>
                        <Col span={24} style={{ marginTop: 8 }}>
                        <Text strong>标签：</Text>
                        {videoPlayDrawer.video?.tags?.map(tag => (
                            <Tag key={tag.id}>{tag.name||tag}</Tag>
                        ))}
                        </Col>
                        <Col span={24} style={{ marginTop: 8 }}>
                            <Text strong>播放列表：</Text>
                            <div style={{display: 'flex', gap: '5px', flexWrap: 'wrap', marginTop: 5, maxHeight: 300, overflowY: 'auto'}}>
                                {videoPlayDrawer.video?.urls.map(url => (
                                    <Button type='primary' size='small' key={url.url} onClick={() => setVideoPlayDrawer({...videoPlayDrawer, video: {...videoPlayDrawer.video, current: url, url: url.url }})}>{url.label}</Button>
                                ))}
                            </div>
                        </Col>
                        <Col span={24} style={{ marginTop: 8 }}>
                            <Text strong>视频链接：</Text>
                            <Input 
                                value={videoPlayDrawer.video?.url || ''} 
                                readOnly 
                                style={{ marginTop: 8, width: 600 }}
                            />
                        </Col>
                    </Row>
                </div>
            ) : (
                <div style={{ textAlign: 'center', padding: 40 }}>
                <Text type="secondary">请选择一个视频播放</Text>
                </div>
            )}
            </Drawer>

            {/* 视频源配置抽屉 */}
            <Drawer
            title="视频源配置（苹果CMS资源）"
            placement="bottom"
            open={sourceConfigDrawer.visible}
            onClose={() => setSourceConfigDrawer({ visible: false })}
            size={'80%'}
            styles={{
                body: {
                    padding: '20px 0'
                },
                close: {
                    position: 'absolute',
                    top: 16,
                    right: 16
                },
                footer: {
                    textAlign: 'right'
                }
            }}
            footer={isAdmin ? [
                // 新增：批量拉取按钮
                <Button 
                key="fetchAll"
                disabled={videoSourceLoading}
                icon={<DownloadOutlined />} 
                onClick={fetchAllEnabledSources}
                style={{ marginRight: 8 }}
                >
                批量拉取所有启用源
                </Button>,
                <Button key="save" disabled={videoSourceLoading} type="primary" onClick={saveVideoSources}>
                保存配置
                </Button>
            ] : null}
            >
                <div style={{ padding: '0 20px' }}>
                    <Table 
                        dataSource={videoSources}
                        loading={videoSourceLoading}
                        rowKey={(record) => `source_${record.name}`}
                        pagination={false}
                        columns={[
                        {
                            title: '源名称',
                            minWidth: 200,
                            render: (_, record, index) => (
                            <Input 
                                placeholder="如：苹果CMS-电影库"
                                value={record.name}
                                onChange={(e) => updateVideoSource(index, 'name', e.target.value)}
                            />
                            )
                        },
                        {
                            title: '源类型',
                            render: (_, record, index) => (
                            <Select
                                value={record.type}
                                onChange={(value) => updateVideoSource(index, 'type', value)}
                                style={{ width: 130 }}
                                showSearch={{
                                    optionFilterProp: 'label'
                                }}
                                options={Object.keys(sourceConfig)?.map(key => ({
                                label: sourceConfig[key].name,
                                value: key
                                }))}
                            />
                            )
                        },
                        {
                            title: '抓取频率（Cron）',
                            render: (_, record, index) => (
                            <Input 
                                placeholder="如 0 */2 * * * 每2小时"
                                value={record.cron || "* * * * *"}
                                onChange={(e) => updateVideoSource(index, 'cron', e.target.value)}
                                style={{ width: 150 }}
                            />
                            )
                        },
                        {
                            title: '获取路径',
                            render: (_, record, index) => (
                            <Input
                                placeholder="/ 表示根目录，可以是API接口路径，也可以是其他路径"
                                value={record.path || ""}
                                onChange={(e) => updateVideoSource(index, 'path', e.target.value)}
                                style={{ width: 260 }}
                            />
                            )
                        },
                        {
                            title: '获取分类',
                            render: (_, record, index) => (
                            <Select
                                placeholder="选择获取分类"
                                value={record.category||null}
                                onChange={(value) => updateVideoSource(index, 'category', value)}
                                style={{ width: 120 }}
                                allowClear
                                showSearch={{
                                    optionFilterProp: 'label'
                                }}
                                options={record.categories?.map(c => ({
                                label: c.name,
                                value: c.id
                                }))}
                            />
                            )
                        },
                        {
                            title: '启用',
                            render: (_, record, index) => (
                            <Switch
                                checked={record.enabled !== false}
                                onChange={(checked) => updateVideoSource(index, 'enabled', checked)}
                            />
                            )
                        },
                        {
                            title: '操作',
                            fixed: 'right',
                            render: (_, record, index) => (
                            <Space>
                                {isAdmin && (
                                    <>
                                        {/* 新增：手动拉取按钮 */}
                                        <Button 
                                        type="primary" 
                                        size="small"
                                        icon={<DownloadOutlined />}
                                        loading={fetchingSource === index}
                                        onClick={() => fetchVideoBySource(record, index)}
                                        disabled={!record.type}
                                        >
                                        手动拉取
                                        </Button>
                                        <Popconfirm
                                        title="确定删除这个视频源吗？"
                                        onConfirm={() => deleteVideoSource(index)}
                                        okText="确定"
                                        cancelText="取消"
                                        >
                                        <Button 
                                            danger 
                                            size="small"
                                        >
                                            删除
                                        </Button>
                                        </Popconfirm>
                                    </>
                                )}
                            </Space>
                            )
                        }
                        ]}
                    />
                    {isAdmin && (
                        <Button 
                            type="dashed"
                            disabled={videoSourceLoading}
                            icon={<PlusOutlined />}
                            style={{ marginTop: 16, width: '100%' }}
                            onClick={addVideoSource}
                        >
                            添加视频源
                        </Button>
                    )}
                    <Divider />
                    <Text type="secondary">
                        Cron表达式格式：分 时 日 月 周<br/>
                        示例：<br/>
                        * * * * * - 每分钟<br/>
                        0 */2 * * * - 每2小时<br/>
                        0 9 * * * - 每天9点<br/>
                        */30 * * * * - 每30分钟
                    </Text>
                </div>
            </Drawer>
        </Fragment>
    );
});

export default Video;