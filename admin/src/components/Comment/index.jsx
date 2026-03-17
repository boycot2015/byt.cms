import { useState, useEffect, Fragment, useRef, forwardRef, useImperativeHandle } from 'react';
import { useRequest, useGetState } from 'ahooks';
import { 
  Table, Button, message, Input, Typography, Space, 
  App, Row, Col, Select, Tag, Tabs, Spin,
  Image, Drawer, Divider, Popconfirm
} from 'antd';
import axios from 'axios';
import {
  LoadingOutlined, DeleteOutlined, SearchOutlined,
} from '@ant-design/icons';
import { usePermission } from '../../hooks/usePermission';
const { Text } = Typography;
// 替换为你的Workers地址
const API_BASE = import.meta.env.VITE_API_BASE;

// 远程筛选选择器组件
function DebounceSelect({ fetchOptions, debounceTimeout = 100, ...props }) {
  const [options, setOptions] = useState([]);
  const fetchRef = useRef(0);
  const [fetching, setFetching] = useState(false);
  const { run: debounceFetcher } = useRequest(value => {
      fetchRef.current += 1;
      const fetchId = fetchRef.current;
      setOptions([]);
      if(!value) return;
      setFetching(true);
      fetchOptions(value).then(newOptions => {
        if (fetchId !== fetchRef.current) {
          // for fetch callback order
          return;
        }
        setTimeout(() => {
            setOptions(newOptions);
            setFetching(false);
        }, 300);
      });
    }, {
        debounceWait: debounceTimeout
    })
  return (
    <Select
      showSearch={{ filterOption: false, onSearch: debounceFetcher }}
      notFoundContent={fetching ? <Spin size="small" style={{textAlign: 'center', width: '100%'}} /> : null}
      {...props}
      options={options}
    />
  );
}

// 获取视频列表的异步函数
async function fetchVideoList(keyword) {
    if(!keyword) return [];
  try {
    const res = await axios.get(`${API_BASE}/api/videos?page=1&pageSize=50&search=${encodeURIComponent(keyword || '')}`);
    const results = res.data?.list || [];
    return results.map(video => ({
      label: video.title,
      value: video.id
    }));
  } catch (error) {
    console.error('获取视频列表失败:', error);
    return [];
  }
}

const Comment = forwardRef((props, ref) => {
    const { isAdmin } = usePermission();
    
    // ========== 评论相关状态 ==========
    const [comments, setComments] = useState([]);
    const [commentSearch, setCommentSearch] = useState('');
    const [selectedVideo, setSelectedVideo] = useState(null);
    const [pageSize, setPageSize] = useState(10);
    const [currentPage, setCurrentPage] = useGetState(1);
    const [totalComments, setTotalComments] = useState(0);
    
    // ========== 评论管理方法 ==========
    const {loading: commentLoading, run: fetchComments} = useRequest(async () => {
        try {
            let url = `${API_BASE}/api/comments`;
            const params = [];
            if (selectedVideo) params.push(`videoId=${selectedVideo}`);
            if (commentSearch) params.push(`search=${encodeURIComponent(commentSearch)}`);
            params.push(`page=${currentPage}`);
            params.push(`pageSize=${pageSize}`);
            if (params.length) url += `?${params.join('&')}`;
            const res = await axios.get(url);
            setComments(res.data?.list || []);
            setTotalComments(res.data?.total || 0);
        } catch (err) {
            message.error('获取评论失败');
            console.error(err);
        }
    }, {
        refreshDeps: [currentPage, pageSize],
        loadingDelay: 1000,
        debounceWait: 300
    });
    
    // 删除评论
    const handleDeleteComment = async (record) => {
        try {
            await axios.delete(`${API_BASE}/api/comments/${record.id}`);
            message.success('评论删除成功');
            fetchComments();
        } catch (error) {
            message.error('删除失败' + error);
        }
    };
    
    // 点赞评论
    const handleLikeComment = async (record) => {
        try {
            const res = await axios.post(`${API_BASE}/api/comments/${record.id}/like`);
            if(res.data?.code === 0)
            message.success('点赞成功');
            fetchComments();
        } catch (error) {
            message.error('点赞失败' + error);
        }
    };
    
    useEffect(() => {
        setCurrentPage(1);
        fetchComments();
    // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [selectedVideo, commentSearch]);
    
    // 暴露方法给父组件
    useImperativeHandle(ref, () => ({
        fetchComments
    }));
    
    return (
        <Fragment>
            <Row gutter={16} style={{ marginBottom: 16 }}>
                <Col span={24}>
                    <div style={{display: 'flex', justifyContent: 'flex-end', gap: '10px'}}>
                        <Input
                            placeholder="搜索评论内容"
                            value={commentSearch}
                            allowClear
                            onChange={(e) => setCommentSearch(e.target.value)}
                            prefix={<SearchOutlined />}
                            style={{ width: 200 }}
                        />
                        <DebounceSelect
                            placeholder="选择视频"
                            style={{ width: 200 }}
                            value={selectedVideo}
                            onChange={setSelectedVideo}
                            allowClear
                            fetchOptions={fetchVideoList}
                        />
                        <Button
                            type="primary" 
                            loading={commentLoading && {icon: <LoadingOutlined spin />}} 
                            onClick={() => {
                                setCurrentPage(1)
                            }}
                        >
                            搜索
                        </Button>
                        <Button
                            danger
                            type="primary" 
                            onClick={() => {
                                setSelectedVideo(null)
                                setCommentSearch('')
                                setPageSize(10)
                                setCurrentPage(1)
                            }}
                        >
                            重置
                        </Button>
                    </div>
                </Col>
            </Row>

            {/* 评论列表 */}
            <Table
                scroll={{ y:'calc(100vh - 300px)' }}
                columns={[
                    {
                        title: '评论内容',
                        dataIndex: 'content',
                        key: 'content',
                        render: (content, record) => (
                            <div>
                                <Typography.Paragraph ellipsis={{ rows: 2, expandable: true, symbol: '展开' }}>
                                    {content}
                                </Typography.Paragraph>
                                <div style={{ marginTop: 8 }}>
                                    <Tag color="blue">{record.user?.nickname || record.user?.username}</Tag>
                                    <span style={{ marginLeft: 8, fontSize: 12, color: '#999' }}>
                                        {new Date(record.createTime).toLocaleString()}
                                    </span>
                                </div>
                                {record.replies && record.replies.length > 0 && (
                                    <div style={{ marginTop: 12, paddingLeft: 20, borderLeft: '2px solid #f0f0f0' }}>
                                        <Text type="secondary" style={{ fontSize: 12 }}>回复 ({record.replies.length})</Text>
                                        {record.replies.map(reply => (
                                            <div key={reply.id} style={{ marginTop: 8, padding: 8, backgroundColor: '#f9f9f9', borderRadius: 4 }}>
                                                <Typography.Paragraph ellipsis={{ rows: 2 }} style={{ marginBottom: 4 }}>
                                                    {reply.content}
                                                </Typography.Paragraph>
                                                <div style={{ fontSize: 12, color: '#999' }}>
                                                    <span>{reply.user?.nickname || reply.user?.username}</span>
                                                    <span style={{ marginLeft: 12 }}>{new Date(reply.createTime).toLocaleString()}</span>
                                                </div>
                                            </div>
                                        ))}
                                    </div>
                                )}
                            </div>
                        )
                    },
                    {
                        title: '视频',
                        dataIndex: 'videoId',
                        key: 'videoId',
                        render: (videoId) => {
                            return (
                                <Typography.Paragraph ellipsis={{ rows: 1 }}>
                                    {videoId}
                                </Typography.Paragraph>
                            );
                        }
                    },
                    {
                        title: '点赞数',
                        dataIndex: 'likes',
                        key: 'likes',
                        render: (likes, record) => (
                            <div>
                                <span>{likes || 0}</span>
                                {isAdmin && (
                                    <Button 
                                        type="link" 
                                        size="small" 
                                        onClick={() => handleLikeComment(record)}
                                        style={{ marginLeft: 8 }}
                                    >
                                        点赞
                                    </Button>
                                )}
                            </div>
                        )
                    },
                    {
                        title: '状态',
                        dataIndex: 'status',
                        key: 'status',
                        render: (status) => (
                            <Tag color={status === 'active' ? 'green' : 'red'}>
                                {status === 'active' ? '正常' : '已删除'}
                            </Tag>
                        )
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
                            <Space style={{marginLeft: -5}}>
                                {isAdmin && (
                                    <Popconfirm
                                        title="确定删除这个评论吗？"
                                        onConfirm={() => handleDeleteComment(record)}
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
                dataSource={comments}
                rowKey="id" 
                loading={commentLoading}
                pagination={{
                    pageSize: pageSize,
                    current: currentPage,
                    total: totalComments,
                    showTotal: () => `共 ${totalComments} 条`,
                    onChange (page, pageSize) {
                    setPageSize(pageSize)
                    setCurrentPage(page)
                } }}
            />
        </Fragment>
    );
});

export default Comment;