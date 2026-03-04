import React, { useState, useEffect } from 'react';
import { 
  Layout, Table, Button, Modal, Form, Input, Typography, Space, 
  message, Card, Row, Col, Tabs, Switch, Select,
  Image, Drawer, Divider, ConfigProvider, Popconfirm
} from 'antd';
import axios from 'axios';
import Video from './components/Video';
import Category from './components/Category';
import Article from './components/Article';
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
  return (
    <ConfigProvider
    locale={zhCN}
    componentSize="medium"
    theme={{
      token: {
        colorPrimary: '#ff9900',
      },
      Button: {
        colorPrimary: '#ff9900',
      }
    }}>
      <Layout style={{ height: '100vh', width: '100%', overflowY: 'hidden' }}>
        <Header style={{ background: '#fff', padding: '0 20px', boxShadow: '0 2px 8px rgba(0,0,0,0.1)' }}>
          <Row justify="space-between" align="middle">
            <Col>
              <Title level={3} style={{ margin: 0, lineHeight: '64px' }}>
                CMS 管理平台
              </Title>
            </Col>
          </Row>
        </Header>

        <Content style={{ padding: '24px 24px 0', width: '100%', minWidth: '1366px', overflow: 'hidden', overflowX: 'auto' }}>
          <Card style={{ width: '100%' }} styles={{ body: { padding: '0 10px' } }}>
            <Tabs defaultActiveKey="1" style={{ width: '100%' }} items={[{
              label: '视频资源管理',
              key: '1',
              children: <Video setCategoryModalVisible={setCategoryModalVisible} setTagModalVisible={setTagModalVisible} />
            },{
              label: '文章管理',
              key: '4',
              children:  <Article />
            },{
              label: '分类管理',
              key: '2',
              children:  <Category ref={categoryRef} setCategoryModalVisible={showCategoryModal} />
            },{
              label: '标签管理',
              key: '3',
              children:  <TagComponent ref={tagRef} setTagModalVisible={showTagModal} />
            }]}>
              {/* 视频资源管理标签页 */}
              {/* <TabPane tab="视频资源管理" key="1">
                <Video setCategoryModalVisible={setCategoryModalVisible} setTagModalVisible={setTagModalVisible} />
              </TabPane> */}
              
              {/* 分类管理标签页（新增） */}
              {/* <TabPane tab="分类管理" key="3">
                <Category ref={categoryRef} setCategoryModalVisible={showCategoryModal} />
              </TabPane> */}
              
              {/* 标签管理标签页（新增） */}
              {/* <TabPane tab="标签管理" key="4">
                <TagComponent ref={tagRef} setTagModalVisible={showTagModal} />
              </TabPane> */}
              
              {/* 文章管理标签页 */}
              {/* <TabPane tab="文章管理" key="2">
                <Article />
              </TabPane> */}
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
      </Layout>
    </ConfigProvider>
  );
}

export default App;