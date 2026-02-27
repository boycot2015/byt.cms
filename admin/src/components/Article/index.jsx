import React, { useState, useEffect, Fragment } from 'react';
import { 
  Layout, Table, Button, Modal, Form, Input, Typography, Space, 
  message, Card, Row, Col, Tabs, Switch, Select,
  Image, Drawer, Divider, ConfigProvider, Popconfirm
} from 'antd';
import axios from 'axios';
// 新增：引入富文本编辑器组件
import RichTextEditor from '../Editor';
import { 
  EditOutlined, DeleteOutlined, PlusOutlined, SyncOutlined, 
  ClockCircleOutlined, FolderAddOutlined, TagOutlined, PlayCircleOutlined,
  DownloadOutlined, SearchOutlined,
} from '@ant-design/icons';

// 替换为你的Workers地址
const API_BASE = import.meta.env.VITE_API_BASE;

function App() {
  // ========== 文章相关状态 ==========
  const [articles, setArticles] = useState([]);
  const [articleLoading, setArticleLoading] = useState(false);
  const [articleModalVisible, setArticleModalVisible] = useState(false);
  const [editingArticle, setEditingArticle] = useState(null);
  const [articleForm] = Form.useForm();
  // 搜索
  const [articleSearch, setArticleSearch] = useState('');
  const showArticleModal = (record = null) => {
    setEditingArticle(record);
    articleForm.setFieldsValue(record || { title: '', content: '' });
    setArticleModalVisible(true);
  };
  // 筛选分类列表
  const getFilteredArticles = () => {
      if (!articleSearch) return articles;
      return articles.filter(a => 
      a.title.toLowerCase().includes(articleSearch.toLowerCase())
      );
  };
  // ========== 初始化 ==========
  useEffect(() => {
    fetchArticles();
  }, [articleSearch]);

  // ========== 文章列配置 ==========
  const articleColumns = [
    {
      title: '标题',
      dataIndex: 'title',
      key: 'title',
    },
    {
      title: '内容预览',
      key: 'content',
      render: (_, record) => (
        <div 
          style={{ maxHeight: 100, overflow: 'hidden' }}
          dangerouslySetInnerHTML={{ __html: record.content || '' }}
        />
      ),
    },
    {
      title: '创建时间',
      dataIndex: 'createdAt',
      key: 'createdAt',
      render: (time) => new Date(time).toLocaleString(),
    },
    {
      title: '操作',
      key: 'action',
      render: (_, record) => (
        <Space size="middle">
          <Button 
            type="primary" 
            icon={<EditOutlined />} 
            onClick={() => showArticleModal(record)}
          >
            编辑
          </Button>
          <Popconfirm
            title="确定删除这篇文章吗？"
            onConfirm={() => handleDeleteArticle(record)}
            okText="确定"
            cancelText="取消"
          >
            <Button 
              danger 
              icon={<DeleteOutlined />} 
            >
              删除
            </Button>
          </Popconfirm>
        </Space>
      ),
    },
  ];
  // ========== 文章管理方法 ==========
  const fetchArticles = async () => {
    setArticleLoading(true);
    try {
      const res = await axios.get(`${API_BASE}/api/articles`);
      setArticles(res.data);
    } catch (err) {
      message.error('获取文章失败');
      console.error(err);
    } finally {
      setArticleLoading(false);
    }
  };
  const handleArticleSubmit = async () => {
    try {
      const values = await articleForm.validateFields();
      if (editingArticle) {
        // 编辑文章
        const id = editingArticle.id.replace('article:', '');
        await axios.put(`${API_BASE}/api/articles/${id}`, values);
        message.success('文章更新成功');        
      } else {
        // 新增文章
        await axios.post(`${API_BASE}/api/articles`, values);
        message.success('文章创建成功');
      }
      setArticleModalVisible(false);
      fetchArticles();
    } catch (err) {
      message.error('操作失败');
      console.error(err);
    }
  };

  return (
    <Fragment>
      <Row justify="space-between" style={{ marginBottom: 16 }}>
        <Col>
          <Button 
            type="primary" 
            icon={<PlusOutlined />} 
            onClick={() => showArticleModal()}
          >
            新增文章
          </Button>
        </Col>
        <Col flex="0 0 300px">
          <Input
              placeholder="搜索分类名称"
              value={articleSearch}
              allowClear
              onChange={(e) => setArticleSearch(e.target.value)}
              prefix={<SearchOutlined />}
          />
          </Col>
      </Row>
      <Table 
        columns={articleColumns} 
        dataSource={getFilteredArticles()} 
        rowKey="id" 
        style={{ width: '100%' }}
        loading={articleLoading}
        pagination={{ pageSize: 10 }}
      />
      {/* 文章编辑/新增弹窗 */}
      <Modal
        title={editingArticle ? '编辑文章' : '新增文章'}
        open={articleModalVisible}
        onOk={handleArticleSubmit}
        onCancel={() => setArticleModalVisible(false)}
        destroyOnHidden
        forceRender={true}
        width={800} // 加宽弹窗适配富文本
      >
        <Form form={articleForm} layout="vertical">
          <Form.Item
            name="title"
            label="文章标题"
            rules={[{ required: true, message: '请输入标题' }]}
          >
            <Input placeholder="请输入文章标题" />
          </Form.Item>
          <Form.Item
            label="文章内容"
            name="content"
            rules={[{ required: true, message: '请输入内容' }]}
          >
            <RichTextEditor />
          </Form.Item>
        </Form>
      </Modal>
    </Fragment>
  );
}

export default App;