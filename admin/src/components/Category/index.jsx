import React, { useState, useEffect, Fragment, forwardRef } from 'react';
import { 
  message, Table, Button, Modal, Form, Input, Typography, Space, 
  App, Card, Row, Col, Tabs, Switch, Select, Tag,
  Image, Drawer, Divider, ConfigProvider, Popconfirm
} from 'antd';
import axios from 'axios';
import { 
  EditOutlined, DeleteOutlined, PlusOutlined, SyncOutlined, 
  ClockCircleOutlined, FolderAddOutlined, TagOutlined, PlayCircleOutlined,
  DownloadOutlined, SearchOutlined,
  LoadingOutlined,
} from '@ant-design/icons';
import { usePermission } from '../../hooks/usePermission';
const { Title, Text, Paragraph } = Typography;
// 替换为你的Workers地址
const API_BASE = import.meta.env.VITE_API_BASE;

const Category = forwardRef((props, ref) => {
   
    const { isAdmin } = usePermission();
    // ========== 分类/标签状态 ==========
    const [categories, setCategories] = useState([]);
    const [categoryLoading, setCategoryLoading] = useState(false);
    // 批量操作状态
    const [selectedCategories, setSelectedCategories] = useState([]);
    // 分类/标签搜索状态
    const [categorySearch, setCategorySearch] = useState('');

    // ========== 分类列配置 ==========
    const categoryColumns = [
    {
        title: '分类名称',
        dataIndex: 'name',
        key: 'name',
        render: (name) => <Text strong>{name}</Text>
    },
    {
        title: '描述',
        dataIndex: 'desc',
        key: 'desc',
        render: (desc) => (
        <Paragraph 
            ellipsis={{ rows: 1, expandable: true, symbol: '查看更多' }}
            style={{ margin: 0 }}
        >
            {desc || '无描述'}
        </Paragraph>
        )
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
        fixed: 'right',
        hidden: !isAdmin,
        width: 200,
        render: (_, record) => (
        <Space style={{marginLeft: -5}}>
                {isAdmin && (
                    <>
                        <Button 
                        type="link"
                        size="small"
                        icon={<EditOutlined />}
                        onClick={() => showCategoryModal(record)}
                        >
                        编辑
                        </Button>
                        <Popconfirm
                        title="确定删除这个分类吗？"
                        onConfirm={() => handleDeleteCategory(record)}
                        okText="确定"
                        cancelText="取消"
                        >
                        <Button 
                            type="text"
                            size="small" 
                            danger 
                            icon={<DeleteOutlined />}
                        >
                            删除
                        </Button>
                        </Popconfirm>
                    </>
                )}
            </Space>
        ),
    },
    ];
    // ========== 分类管理方法 ==========
    // 筛选分类列表
    const getFilteredCategories = () => {
        if (!categorySearch) return categories;
        return categories.filter(c => 
        c.name.toLowerCase().includes(categorySearch.toLowerCase())
        );
    };
    const fetchCategories = async () => {
        setCategoryLoading(true);
        try {
            const res = await axios.get(`${API_BASE}/api/categories`);
            setCategories(res.data);
        } catch (err) {
            message.error('获取分类失败');
            console.error(err);
        } finally {
            setTimeout(() => {
                setCategoryLoading(false);
            }, 500);
        }
    };

    const showCategoryModal = (category = null) => {
        props.setCategoryModalVisible(category);
    };

    const handleDeleteCategory = async (category, isMultiple = false) => {
        try {
            const id = category.id.replace('category:', '');
            await axios.delete(`${API_BASE}/api/categories/${id}`);
            setCategories(categories.filter(c => c.id !== category.id));
            if (!isMultiple) {
                message.success('分类删除成功');
                fetchCategories();
            }
        } catch (err) {
            !isMultiple && message.error('删除失败');
            console.error(err);
        }
    };

    // 批量删除分类
    const batchDeleteCategories = async () => {
        if (selectedCategories.length === 0) {
            message.warning('请选择要删除的分类');
            return;
        }
        
        try {
            // 批量删除
            for (const category of selectedCategories) {
                await handleDeleteCategory(category, true);
            }
            
            message.success(`成功删除 ${selectedCategories.length} 个分类`);
            setSelectedCategories([]);
            fetchCategories();
        } catch (err) {
            message.error('批量删除失败');
            console.error(err);
        }
    };

    // ========== 初始化 ==========
    useEffect(() => {
        fetchCategories();
    }, []);
    React.useImperativeHandle(ref, () => ({
        fetchCategories
    }));
    return (
        <Fragment>
            <Row gutter={16} style={{ marginBottom: 16, alignItems: 'center' }}>
                <Col flex="auto">
                    {isAdmin && (
                        <>
                            <Button 
                                type="primary" 
                                icon={<PlusOutlined />} 
                                onClick={() => showCategoryModal()}
                            >
                                新增分类
                            </Button>
                            <Button 
                                danger
                                type="primary"
                                icon={<DeleteOutlined />} 
                                onClick={batchDeleteCategories}
                                style={{ marginLeft: 8 }}
                                disabled={selectedCategories.length === 0}
                            >
                                批量删除
                            </Button>
                        </>
                    )}
                </Col>
                <Col flex="0 0 300px">
                    <div style={{display: 'flex', justifyContent: 'flex-end', gap: '10px'}}>
                        <Input
                            placeholder="搜索分类名称"
                            value={categorySearch}
                            allowClear
                            onChange={(e) => setCategorySearch(e.target.value)}
                            prefix={<SearchOutlined />}
                        />
                        <Button
                        type="primary"
                        loading={categoryLoading && {
                            icon: <LoadingOutlined spin />,
                        }} 
                        onClick={fetchCategories}
                        >刷新</Button>
                    </div>
                </Col>
            </Row>
            
            <Table
                columns={categoryColumns}
                dataSource={getFilteredCategories()}
                rowKey="id"
                loading={categoryLoading}
                scroll={{ y: 'calc(100vh - 400px)' }}
                pagination={{ pageSize: 10 }}
                rowSelection={{
                    type: 'checkbox',
                    selectedRowKeys: selectedCategories.map(c => c.id),
                    onChange: (selectedKeys) => {
                        setSelectedCategories(
                        categories.filter(c => selectedKeys.includes(c.id))
                        );
                    }
                }}
            />
        </Fragment>
    );
})

export default Category;