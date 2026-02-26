import React, { useState, useEffect } from 'react';
import { 
  Layout, Table, Button, Modal, Form, Input, Typography, Space, 
  message, Card, Row, Col, Tabs, Switch, Select,
  Image, Drawer, Divider, ConfigProvider, Popconfirm
} from 'antd';
import axios from 'axios';
import Video from './components/Video';
import Category from './components/Category';
import TagComponent from './components/Tag';
// 新增：引入富文本编辑器组件
import RichTextEditor from './components/Editor';
import { 
  EditOutlined, DeleteOutlined, PlusOutlined, SyncOutlined, 
  ClockCircleOutlined, FolderAddOutlined, TagOutlined, PlayCircleOutlined,
  DownloadOutlined, SearchOutlined,
} from '@ant-design/icons';
import zhCN from 'antd/locale/zh_CN';
const { Header, Content, Footer } = Layout;
const { Title, Text, Paragraph } = Typography;
const { TabPane } = Tabs;

// 替换为你的Workers地址
const API_BASE = import.meta.env.VITE_API_BASE;

function App() {
  const categoryRef = React.useRef(null);
  const tagRef = React.useRef(null);
  // ========== 文章相关状态 ==========
  const [articles, setArticles] = useState([]);
  const [articleLoading, setArticleLoading] = useState(false);
  const [articleModalVisible, setArticleModalVisible] = useState(false);
  const [editingArticle, setEditingArticle] = useState(null);
  const [articleForm] = Form.useForm();

  // ========== 分类/标签状态 ==========
  const [categories, setCategories] = useState([]);
  const [tags, setTags] = useState([]);
  const [categoryLoading, setCategoryLoading] = useState(false);
  const [tagLoading, setTagLoading] = useState(false);
  
  // 分类弹窗状态
  const [categoryModalVisible, setCategoryModalVisible] = useState(false);
  const [editingCategory, setEditingCategory] = useState(null);
  const [categoryForm] = Form.useForm();
  
  // 标签弹窗状态
  const [tagModalVisible, setTagModalVisible] = useState(false);
  const [editingTag, setEditingTag] = useState(null);
  const [tagForm] = Form.useForm();
  
  // 分类/标签搜索状态
  const [categorySearch, setCategorySearch] = useState('');
  const [tagSearch, setTagSearch] = useState('');
  
  // 批量操作状态
  const [selectedCategories, setSelectedCategories] = useState([]);
  const [selectedTags, setSelectedTags] = useState([]);

  // ========== 视频相关状态 ==========
  const [videos, setVideos] = useState([]);
  const [selectedCategory, setSelectedCategory] = useState(null);
  const [selectedTag, setSelectedTag] = useState(null);



  const showArticleModal = (record = null) => {
    setEditingArticle(record);
    articleForm.setFieldsValue(record || { title: '', content: '' });
    setArticleModalVisible(true);
  };

  // ========== 分类管理方法 ==========
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
    method && method.fetchCategories();
  };

  const showCategoryModal = (category = null) => {
    setEditingCategory(category);
    categoryForm.setFieldsValue({
      name: category?.name || '',
      desc: category?.desc || '',
    });
    setCategoryModalVisible(true);
  };

  const handleCategorySubmit = async () => {
    try {
      const values = await categoryForm.validateFields();
      if (editingCategory) {
        await axios.post(`${API_BASE}/api/categories`, {...editingCategory, ...values});
        message.success('分类更新成功');
      } else {
        // 新增分类
        await axios.post(`${API_BASE}/api/categories`, values);
        message.success('分类创建成功');
      }
      
      setCategoryModalVisible(false);
      fetchCategories();
      categoryRef.current?.fetchCategories();
    } catch (err) {
      message.error('操作失败');
      console.error(err);
    }
  };

  // ========== 标签管理方法 ==========
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


  const showTagModal = (tag = null) => {
    setEditingTag(tag);
    tagForm.setFieldsValue({
      name: tag?.name || ''
    });
    setTagModalVisible(true);
  };

  const handleTagSubmit = async () => {
    try {
      const values = await tagForm.validateFields();
      if (editingTag) {
        await axios.post(`${API_BASE}/api/tags`, {...editingTag, ...values});
        message.success('标签更新成功');
      } else {
        // 新增标签
        await axios.post(`${API_BASE}/api/tags`, values);
        message.success('标签创建成功');
      }
      
      setTagModalVisible(false);
      tagRef.current?.fetchTags();
      fetchTags();
    } catch (err) {
      message.error('操作失败');
      console.error(err);
    }
  };

  const handleDeleteTag = async (tag, isEdit = false) => {
    try {
      const id = tag.id.replace('tag:', '');
      setTags(tags.filter(t => t.id !== tag.id));
      await axios.delete(`${API_BASE}/api/tags/${id}`);
      if (!isEdit) {
        message.success('标签删除成功');
      }
    } catch (err) {
      message.error('删除失败');
      console.error(err);
    }
  };

  // ========== 初始化 ==========
  useEffect(() => {
    fetchArticles();
    fetchCategories();
    fetchTags();
  }, [selectedCategory, selectedTag]);

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
    <ConfigProvider
    locale={zhCN}
    componentSize="medium"
    theme={{
      token: {
        colorPrimary: '#ff9900',
      },
    }}>
      <Layout style={{ minHeight: '100vh', width: '100%' }}>
        <Header style={{ background: '#fff', padding: '0 20px', boxShadow: '0 2px 8px rgba(0,0,0,0.1)' }}>
          <Row justify="space-between" align="middle">
            <Col>
              <Title level={3} style={{ margin: 0, lineHeight: '64px' }}>
                CMS 管理平台
              </Title>
            </Col>
          </Row>
        </Header>

        <Content style={{ padding: '24px 24px 0', width: '100%' }}>
          <Card style={{ width: '100%' }} styles={{ body: { padding: '0 10px' } }}>
            <Tabs defaultActiveKey="1" style={{ width: '100%' }}>
              {/* 视频资源管理标签页 */}
              <TabPane tab="视频资源管理" key="1">
                <Video setCategoryModalVisible={setCategoryModalVisible} setTagModalVisible={setTagModalVisible} />
              </TabPane>
              
              {/* 分类管理标签页（新增） */}
              <TabPane tab="分类管理" key="3">
                <Category ref={categoryRef} setCategoryModalVisible={showCategoryModal} />
              </TabPane>
              
              {/* 标签管理标签页（新增） */}
              <TabPane tab="标签管理" key="4">
                <TagComponent ref={tagRef} setTagModalVisible={showTagModal} />
              </TabPane>
              
              {/* 文章管理标签页 */}
              <TabPane tab="文章管理" key="2">
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
                </Row>
                <Table 
                  columns={articleColumns} 
                  dataSource={articles} 
                  rowKey="id" 
                  style={{ width: '100%' }}
                  loading={articleLoading}
                  pagination={{ pageSize: 10 }}
                />
              </TabPane>
            </Tabs>
          </Card>
        </Content>

        <Footer style={{ textAlign: 'center' }}>
          Cloudflare + KV + Ant Design CMS ©{new Date().getFullYear()}
        </Footer>

        {/* 分类编辑/新增弹窗（优化） */}
        <Modal
          title={editingCategory ? '编辑分类' : '新增分类'}
          open={categoryModalVisible}
          onOk={handleCategorySubmit}
          onCancel={() => setCategoryModalVisible(false)}
          destroyOnHidden
        >
          <Form form={categoryForm} layout="vertical">
            <Form.Item
              name="name"
              label="分类名称"
              rules={[{ required: true, message: '请输入分类名称' }]}
            >
              <Input 
                placeholder="如：电影、短视频、动漫" 
              />
            </Form.Item>
            <Form.Item
              name="desc"
              label="分类描述（可选）"
            >
              <Input.TextArea 
                placeholder="输入分类的详细描述" 
                rows={3}
              />
            </Form.Item>
          </Form>
        </Modal>

        {/* 标签编辑/新增弹窗（优化） */}
        <Modal
          title={editingTag ? '编辑标签' : '新增标签'}
          open={tagModalVisible}
          onOk={handleTagSubmit}
          onCancel={() => setTagModalVisible(false)}
          destroyOnHidden
        >
          <Form form={tagForm} layout="vertical">
            <Form.Item
              name="name"
              label="标签名称"
              rules={[{ required: true, message: '请输入标签名称' }]}
            >
              <Input 
                placeholder="如：搞笑、科技、悬疑" 
              />
            </Form.Item>
          </Form>
        </Modal>

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
      </Layout>
    </ConfigProvider>
  );
}

export default App;