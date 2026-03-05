import React, { useState, useEffect, Fragment } from 'react';
import { 
  Layout, Table, Button, Modal, Form, Input, Typography, Space, 
  App, Card, Row, Col, Tabs, Switch, Select,
  Image, Drawer, Divider, ConfigProvider, Popconfirm
} from 'antd';
import axios from 'axios';
// 新增：引入富文本编辑器组件
import RichTextEditor from '../Editor';
import { 
  EditOutlined, DeleteOutlined, PlusOutlined, 
  LoadingOutlined, SearchOutlined,
} from '@ant-design/icons';

// 替换为你的Workers地址
const API_BASE = import.meta.env.VITE_API_BASE;

function Article() {
  const { message } = App.useApp();
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
    articleForm.setFieldsValue(record || { title: '', categoryId: null, tagIds: [], content: '' });
    setArticleModalVisible(true);
  };
  // ========== 分类/标签状态 ==========
  const [categories, setCategories] = useState([]);
  const [tags, setTags] = useState([]);
  const [selectedTag, setSelectedTag] = useState(null);
  const [categoryLoading, setCategoryLoading] = useState(false);
  const [tagLoading, setTagLoading] = useState(false);
  const [selectedCategory, setSelectedCategory] = useState(null);
  const fetchCategories = async (method) => {
    setCategoryLoading(true);
    try {
      const res = await axios.get(`${API_BASE}/api/categories`);
      setCategories(res.data);
    } catch (err) {
      message.error('获取分类失败');
      console.error(err);
    } finally {
      setCategoryLoading(false);
    }
  };
  const getFilteredArticles = () => {
      if (!articleSearch) return articles;
      return articles.filter(a => 
      a.title.toLowerCase().includes(articleSearch.toLowerCase())
      );
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
    setTagLoading(false);
    }
};
  // ========== 初始化 ==========
  useEffect(() => {
    fetchArticles();
    fetchCategories();
    fetchTags();
  }, [articleSearch, selectedCategory, selectedTag]);

  // ========== 文章列配置 ==========
  const articleColumns = [
    {
      title: '标题',
      dataIndex: 'title',
      key: 'title',
    },
    {
      title: '分类',
      key: 'category',
      render: (_, record) => (
        <div 
          style={{ maxHeight: 100, overflow: 'hidden' }}
          dangerouslySetInnerHTML={{ __html: record.category?.name || '' }}
        />
      ),
    },
      {
      title: '标签',
      key: 'tags',
      render: (_, record) => (
        <div 
          style={{ maxHeight: 100, overflow: 'hidden' }}
          dangerouslySetInnerHTML={{ __html: record.tags?.map(tag => tag.name).join(', ') || '' }}
        />
      ),
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
        <Space style={{marginLeft: -25}}>
          <Button 
            type="link"
            size="small"
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
              type="text" 
              danger
              size="small"
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
      setTimeout(() => {
        setArticleLoading(false);
      }, 500);
    }
  };
  const handleArticleSubmit = async () => {
    try {
      const values = await articleForm.validateFields();
      if (editingArticle) {
        // 编辑文章
        const id = editingArticle.id.replace('article:', '');
        await axios.post(`${API_BASE}/api/articles/${id}`, values);
        message.success('文章更新成功');        
      } else {
        // 新增文章
        await axios.put(`${API_BASE}/api/articles`, values);
        message.success('文章创建成功');
      }
      setArticleModalVisible(false);
      fetchArticles();
    } catch (err) {
      message.error(err.message);
      console.error(err);
    }
  };
  const handleDeleteArticle = async (record) => {
    try {
      const id = record.id.replace('article:', '');
      await axios.delete(`${API_BASE}/api/articles/${id}`);
      message.success('文章删除成功');
      fetchArticles();
    } catch (err) {
      message.error('删除失败');
      console.error(err);
    }
  };
  return (
    <Fragment>
      <Row justify="space-between" style={{ marginBottom: 16 }}>
        <Col span={8}>
          <Button 
            type="primary" 
            icon={<PlusOutlined />} 
            onClick={() => showArticleModal()}
          >
            新增文章
          </Button>
        </Col>
        <Col span={16}>
          <div style={{display: 'flex', justifyContent: 'flex-end', gap: '10px'}}>
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
            <Input
                placeholder="搜索标题"
                value={articleSearch}
                allowClear
                onChange={(e) => setArticleSearch(e.target.value)}
                style={{ width: 200 }}
                prefix={<SearchOutlined />}
            />
            <Button 
              type="primary" 
              loading={articleLoading && {
                  icon: <LoadingOutlined spin />,
              }} 
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
                  setArticleSearch('')
                  fetchArticles()
              }}
              >
              重置
              </Button>
          </div>
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
        <Form form={articleForm} labelCol={{span: 3}} wrapperCol={{span: 21}}>
          <Form.Item
            name="title"
            label="文章标题"
            rules={[{ required: true, message: '请输入标题' }]}
          >
            <Input placeholder="请输入文章标题" />
          </Form.Item>
          <Form.Item
            name="categoryId"
            label="关联分类"
            rules={[{ required: true, message: '请选择分类' }]}
          >
            <Select
              placeholder="选择分类"
              style={{ width: '100%' }}
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
          </Form.Item>
          <Form.Item
            name="tagIds"
            label="关联标签"
            rules={[{ required: false, message: '请选择标签' }]}
          >
            <Select
              placeholder="选择标签"
              style={{ width: '100%' }}
              value={selectedTag}
              maxTagCount={6}
              mode="multiple"
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
          </Form.Item>
          <Form.Item
            label="文章内容"
            name="content"
            labelCol={{span: 24}} 
            wrapperCol={{span: 24}}
            rules={[{ required: true, message: '请输入内容' }]}
          >
            <RichTextEditor height={220} />
          </Form.Item>
        </Form>
      </Modal>
    </Fragment>
  );
}

export default Article;