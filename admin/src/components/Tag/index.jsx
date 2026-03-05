import React, { useState, useEffect, Fragment, forwardRef } from 'react';
import { 
  Layout, Table, Button, Modal, Form, Input, Typography, Space, 
  App, Card, Row, Col, Tabs, Switch, Tag,
  Image, Drawer, Divider, ConfigProvider, Popconfirm
} from 'antd';
import axios from 'axios';
import { 
  EditOutlined, DeleteOutlined, PlusOutlined, SyncOutlined, 
  LoadingOutlined, FolderAddOutlined, TagOutlined, PlayCircleOutlined,
  DownloadOutlined, SearchOutlined,
} from '@ant-design/icons';
const { Title, Text, Paragraph } = Typography;
// 替换为你的Workers地址
const API_BASE = import.meta.env.VITE_API_BASE;

const TagComponent = forwardRef((props, ref) => {
    const { message } = App.useApp();
    const [selectedTags, setSelectedTags] = useState([]);
    const [tags, setTags] = useState([]);
    const [tagLoading, setTagLoading] = useState(false);
    const [tagSearch, setTagSearch] = useState('');
    const [editingTag, setEditingTag] = useState(null);
    // 批量操作状态
    const [selectedTag, setSelectedTag] = useState(null);
    // ========== 标签列配置 ==========
    const tagColumns = [
        {
            title: '标签名称',
            dataIndex: 'name',
            key: 'name',
        },
        {
        title: '创建时间',
        dataIndex: 'createTime',
        key: 'createTime',
        render: (time) => time ? new Date(time).toLocaleString() : '-'
        },
        {
        title: '操作',
        key: 'action',
        width: 200,
        fixed: 'right',
        render: (_, record) => (
            <Space style={{marginLeft: -25}}>
            <Button 
                type="link"
                size='small'
                icon={<EditOutlined />}
                onClick={() => showTagModal(record)}
            >
                编辑
            </Button>
            <Popconfirm
                title="确定删除这个标签吗？"
                onConfirm={() => handleDeleteTag(record)}
                okText="确定"
                cancelText="取消"
            >
                <Button 
                type="text"
                danger
                size='small'
                icon={<DeleteOutlined />}
                >
                删除
                </Button>
            </Popconfirm>
            </Space>
        ),
        },
    ];
    // ========== 分类管理方法 ==========
    const handleDeleteTag = async (tag, isMultiple = false) => {
        try {
            const id = tag.id.replace('tag:', '');
            setTags(tags.filter(t => t.id !== tag.id));
            await axios.delete(`${API_BASE}/api/tags/${id}`);
            if (!isMultiple) {
                message.success('标签删除成功');
                fetchTags();
            }
        } catch (err) {
            !isMultiple && message.error('删除失败');
            console.error(err);
        }
    };
    // 筛选标签列表
    const getFilteredTags = () => {
        if (!tagSearch) return tags;
        return tags.filter(t => 
        t.name.toLowerCase().includes(tagSearch.toLowerCase())
        );
    };
    // 批量删除标签
    const batchDeleteTags = async () => {
        if (selectedTags.length === 0) {
        message.warning('请选择要删除的标签');
        return;
        }
        
        try {
        // 批量删除
        for (const tag of selectedTags) {
            await handleDeleteTag(tag, true);
        }
        
        message.success(`成功删除 ${selectedTags.length} 个标签`);
        setSelectedTags([]);
        fetchTags();
        } catch (err) {
        message.error('批量删除失败');
        console.error(err);
        }
    };
    const fetchTags = async () => {
        setTagLoading(true);
        try {
            const res = await axios.get(`${API_BASE}/api/tags`);
            setTags(res.data);
        } catch (err) {
            message.error('获取标签失败');
            console.error(err);
        } finally {
            setTimeout(() => {
                setTagLoading(false);
            }, 500);
        }
    };

    const showTagModal = (tag = null) => {
        setEditingTag(tag);
        props.setTagModalVisible(tag);
    };

    // ========== 初始化 ==========
    useEffect(() => {
        fetchTags();
    }, [selectedTag]);
    React.useImperativeHandle(ref, () => ({
        fetchTags
    }));
    return (
        <Fragment>
            <Row gutter={16} style={{ marginBottom: 16, alignItems: 'center' }}>
                <Col flex="auto">
                <Button 
                    type="primary" 
                    icon={<PlusOutlined />} 
                    onClick={() => showTagModal()}
                >
                    新增标签
                </Button>
                <Button 
                    danger 
                    icon={<DeleteOutlined />} 
                    onClick={batchDeleteTags}
                    style={{ marginLeft: 8 }}
                    disabled={selectedTags.length === 0}
                >
                    批量删除
                </Button>
                </Col>
                <Col flex="0 0 300px">
                 <div style={{display: 'flex', justifyContent: 'flex-end', gap: '10px'}}>
                        <Input
                            placeholder="搜索标签名称"
                            value={tagSearch}
                            allowClear
                            onChange={(e) => setTagSearch(e.target.value)}
                            prefix={<SearchOutlined />}
                        />
                        <Button
                        type="primary"
                        loading={tagLoading && {
                            icon: <LoadingOutlined spin />,
                        }} 
                        onClick={fetchTags}
                        >刷新</Button>
                    </div>
                </Col>
            </Row>
            
            <Table
                columns={tagColumns}
                dataSource={getFilteredTags()}
                rowKey="id"
                loading={tagLoading}
                scroll={{ y: 'calc(100vh - 400px)' }}
                pagination={{ pageSize: 10 }}
                rowSelection={{
                type: 'checkbox',
                selectedRowKeys: selectedTags.map(t => t.id),
                onChange: (selectedKeys) => {
                    setSelectedTags(
                    tags.filter(t => selectedKeys.includes(t.id))
                    );
                }
                }}
            />
        </Fragment>
    );
})

export default TagComponent;