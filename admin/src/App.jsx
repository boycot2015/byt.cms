import React, { useState } from 'react';
import { 
  Layout, message, Button, Modal, Form, Input, Typography, Space, 
  Card, Row, Col, Tabs, Switch, Select, Dropdown, Menu, Badge,
  theme, Drawer, Divider, ConfigProvider, App
} from 'antd';
import axios from 'axios';
import Video from './components/Video';
import Category from './components/Category';
import Article from './components/Article';
import TagComponent from './components/Tag';
import User from './components/User';
import LoginModal from './components/Auth/LoginModal';
import { LogoutOutlined, MoonOutlined, SunOutlined, SettingOutlined } from '@ant-design/icons';
import zhCN from 'antd/locale/zh_CN';
import { useUser } from './context/UserContext.jsx';
import useThemeMode from './hooks/useThemeMode.jsx';
const { Header, Content, Footer } = Layout;
const { Title, Text, Paragraph } = Typography;

// 替换为你的Workers地址
const API_BASE = import.meta.env.VITE_API_BASE;

function Index() {
  const categoryRef = React.useRef(null);
  const tagRef = React.useRef(null);
  const videoRef = React.useRef(null);
  const articleRef = React.useRef(null);
  const userRef = React.useRef(null);
 
  const { user, updateUser, logout } = useUser();
  const [activeTab, setActiveTab] = useState('1');
  const { darkMode, themeMode, setThemeMode } = useThemeMode();
  
  // 分类弹窗状态
  const [categoryModalVisible, setCategoryModalVisible] = useState(false);
  const [editingCategory, setEditingCategory] = useState(null);
  const [categoryForm] = Form.useForm();
  
  // 标签弹窗状态
  const [tagModalVisible, setTagModalVisible] = useState(false);
  const [editingTag, setEditingTag] = useState(null);
  const [tagForm] = Form.useForm();
  
  // 登录成功处理
  const handleLoginSuccess = (userInfo) => {
    updateUser(userInfo);
  };
  
  // 登出处理
  const handleLogout = () => {
    logout();
  };

  // 标签页切换处理
  const handleTabChange = (key) => {
    setActiveTab(key);
    // 根据标签页key重新请求数据
    switch(key) {
      case '1': // 视频资源管理
        videoRef.current?.fetchVideos?.();
        break;
      case '2': // 分类管理
        categoryRef.current?.fetchCategories?.();
        break;
      case '3': // 标签管理
        tagRef.current?.fetchTags?.();
        break;
      case '4': // 文章管理
        articleRef.current?.fetchArticles?.();
        break;
      case '5': // 用户管理
        userRef.current?.fetchUsers?.();
        break;
      default:
        break;
    }
  };


  // ========== 分类管理方法 ==========
  const fetchCategories = async (method) => {
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
    } catch (err) {
      message.error('操作失败');
      console.error(err);
    }
  };
  // 如果未登录，只显示登录弹窗
  if (!user) {
    return (
      <ConfigProvider
        locale={zhCN}
        componentSize="medium"
        theme={{
          algorithm: darkMode? theme.darkAlgorithm : theme.defaultAlgorithm,
          token: {
            colorPrimary: '#ff9900',
            colorLink: '#ff9900',
            colorBgSolidActive: '#ff9900',
          }
        }}>
        <App>
          <LoginModal
            visible={true}
            onClose={() => {}}
            onLoginSuccess={handleLoginSuccess}
          />
        </App>
      </ConfigProvider>
    );
  }

  return (
    <ConfigProvider
    locale={zhCN}
    componentSize="medium"
    theme={{
      algorithm: darkMode? theme.darkAlgorithm : theme.defaultAlgorithm,
      token: {
        colorPrimary: '#ff9900',
        colorLink: '#ff9900',
        colorBgSolidActive: '#ff9900',
      }
    }}>
      <App>
        <Layout style={{ height: '100vh', width: '100%', minWidth: '1366px', overflow: 'hidden', overflowX: 'auto' }}>
          <Header style={{ background: darkMode ? '#141414' : '#fff', padding: '0 20px', boxShadow: darkMode ? '0 2px 8px rgba(0,0,0,0.3)' : '0 2px 8px rgba(0,0,0,0.1)' }}>
            <Row justify="space-between" align="middle">
              <Col>
                <Title level={3} style={{ margin: 0, lineHeight: '64px' }}>
                  CMS 管理平台
                </Title>
              </Col>
                <Col>
                  <Space size="middle">
                    <Dropdown
                      menu={{
                        items: [
                          {
                            key: 'system',
                            label: (
                              <Space>
                                跟随系统
                                {themeMode === 'system' && <Badge status="success" />}
                              </Space>
                            ),
                            onClick: () => setThemeMode('system')
                          },
                          {
                            key: 'light',
                            label: (
                              <Space>
                                浅色主题
                                {themeMode === 'light' && <Badge status="success" />}
                              </Space>
                            ),
                            onClick: () => setThemeMode('light')
                          },
                          {
                            key: 'dark',
                            label: (
                              <Space>
                                暗黑主题
                                {themeMode === 'dark' && <Badge status="success" />}
                              </Space>
                            ),
                            onClick: () => setThemeMode('dark')
                          }
                        ]
                      }}
                    >
                      <Button
                        type="link"
                        icon={darkMode ? <MoonOutlined /> : <SunOutlined />}
                      >
                      </Button>
                    </Dropdown>
                    <Text>欢迎，{user.nickname}</Text>
                    <Button 
                      icon={<LogoutOutlined />} 
                      onClick={handleLogout}
                    >
                      登出
                    </Button>
                  </Space>
                </Col>
            </Row>
          </Header>

          <Content style={{ padding: '24px 24px 0', width: '100%' }}>
            <Card style={{ width: '100%' }} styles={{ body: { padding: '0 10px' } }}>
              <Tabs 
                activeKey={activeTab} 
                onChange={handleTabChange}
                style={{ width: '100%' }} 
                items={[
                {
                  label: '视频资源管理',
                  key: '1',
                  children: <Video 
                    ref={videoRef}
                    setCategoryModalVisible={setCategoryModalVisible} 
                    setTagModalVisible={setTagModalVisible} 
                  />
                },{
                  label: '文章管理',
                  key: '4',
                  children:  <Article ref={articleRef} />
                },{
                  label: '分类管理',
                  key: '2',
                  children:  <Category ref={categoryRef} setCategoryModalVisible={showCategoryModal} />
                },{
                  label: '标签管理',
                  key: '3',
                  children:  <TagComponent ref={tagRef} setTagModalVisible={showTagModal} />
                },
                {
                  label: '用户管理',
                  key: '5',
                  children:  <User ref={userRef} />
                }
              ]}>
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
      </App>
    </ConfigProvider>
  );
}

export default Index;