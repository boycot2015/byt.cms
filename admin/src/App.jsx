import { useState, useEffect } from 'react';
import { 
  Layout, Table, Button, Modal, Form, Input, Typography, Space, 
  message, Card, Row, Col, Tabs, Switch, Select, Tag,
  Image, Drawer, Divider
} from 'antd';
import axios from 'axios';
import { 
  EditOutlined, DeleteOutlined, PlusOutlined, SyncOutlined, 
  ClockCircleOutlined, FolderAddOutlined, TagOutlined, PlayCircleOutlined
} from '@ant-design/icons';

const { Header, Content, Footer } = Layout;
const { Title, Text } = Typography;
const { TabPane } = Tabs;
const { Option } = Select;

// 替换为你的Workers地址
const API_BASE = 'https://byt-cms-api.boycot.workers.dev';

function App() {
  // ========== 文章相关状态 ==========
  const [articles, setArticles] = useState([]);
  const [articleLoading, setArticleLoading] = useState(false);
  const [articleModalVisible, setArticleModalVisible] = useState(false);
  const [editingArticle, setEditingArticle] = useState(null);
  const [articleForm] = Form.useForm();

  // ========== 分类/标签状态 ==========
  const [categories, setCategories] = useState([]);
  const [tags, setTags] = useState([]);
  const [categoryModalVisible, setCategoryModalVisible] = useState(false);
  const [tagModalVisible, setTagModalVisible] = useState(false);
  const [newCategoryName, setNewCategoryName] = useState('');
  const [newTagName, setNewTagName] = useState('');

  // ========== 视频相关状态 ==========
  const [videos, setVideos] = useState([]);
  const [videoLoading, setVideoLoading] = useState(false);
  const [selectedCategory, setSelectedCategory] = useState('');
  const [selectedTag, setSelectedTag] = useState('');
  const [videoPlayDrawer, setVideoPlayDrawer] = useState({
    visible: false,
    video: null
  });
  const [sourceConfigDrawer, setSourceConfigDrawer] = useState({
    visible: false
  });
  const [videoSources, setVideoSources] = useState([]);

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

  const showArticleModal = (record = null) => {
    setEditingArticle(record);
    articleForm.setFieldsValue(record || { title: '', content: '' });
    setArticleModalVisible(true);
  };

  // ========== 分类/标签管理方法 ==========
  const fetchCategories = async () => {
    try {
      const res = await axios.get(`${API_BASE}/api/categories`);
      setCategories(res.data);
    } catch (err) {
      message.error('获取分类失败');
      console.error(err);
    }
  };

  const fetchTags = async () => {
    try {
      const res = await axios.get(`${API_BASE}/api/tags`);
      setTags(res.data);
    } catch (err) {
      message.error('获取标签失败');
      console.error(err);
    }
  };

  const addCategory = async () => {
    if (!newCategoryName) {
      message.warning('请输入分类名称');
      return;
    }
    try {
      await axios.post(`${API_BASE}/api/categories`, { name: newCategoryName });
      message.success('分类创建成功');
      setCategoryModalVisible(false);
      setNewCategoryName('');
      fetchCategories();
    } catch (err) {
      message.error('创建分类失败');
      console.error(err);
    }
  };

  const addTag = async () => {
    if (!newTagName) {
      message.warning('请输入标签名称');
      return;
    }
    try {
      await axios.post(`${API_BASE}/api/tags`, { name: newTagName });
      message.success('标签创建成功');
      setTagModalVisible(false);
      setNewTagName('');
      fetchTags();
    } catch (err) {
      message.error('创建标签失败');
      console.error(err);
    }
  };

  // ========== 视频管理方法 ==========
  const fetchVideos = async () => {
    setVideoLoading(true);
    try {
      let url = `${API_BASE}/api/videos`;
      const params = [];
      if (selectedCategory) params.push(`category=${selectedCategory}`);
      if (selectedTag) params.push(`tag=${selectedTag}`);
      if (params.length) url += `?${params.join('&')}`;
      
      const res = await axios.get(url);
      setVideos(res.data);
    } catch (err) {
      message.error('获取视频失败');
      console.error(err);
    } finally {
      setVideoLoading(false);
    }
  };

  const fetchVideoSources = async () => {
    try {
      const res = await axios.get(`${API_BASE}/api/video-sources`);
      setVideoSources(res.data || []);
    } catch (err) {
      message.error('获取视频源配置失败');
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

  const handleDeleteVideo = async (record) => {
    try {
      const id = record.id.replace('video:', '');
      await axios.delete(`${API_BASE}/api/videos/${id}`);
      message.success('视频删除成功');
      fetchVideos();
    } catch (err) {
      message.error('删除失败');
      // console.error(err);
    }
  };

  const playVideo = (video) => {
    setVideoPlayDrawer({
      visible: true,
      video
    });
  };

  const updateVideoSource = (index, key, value) => {
    const newSources = [...videoSources];
    newSources[index][key] = value;
    setVideoSources(newSources);
  };

  const addVideoSource = () => {
    setVideoSources([
      ...videoSources,
      {
        name: `新源${Date.now()}`,
        type: 'aliyun',
        cron: '* * * * *',
        enabled: true,
        path: '/',
        categoryId: '',
        category: '',
        tags: []
      }
    ]);
  };

  const deleteVideoSource = (index) => {
    const newSources = [...videoSources];
    newSources.splice(index, 1);
    setVideoSources(newSources);
  };

  // ========== 初始化 ==========
  useEffect(() => {
    fetchArticles();
    fetchCategories();
    fetchTags();
    fetchVideos();
    fetchVideoSources();
  }, [selectedCategory, selectedTag]);

  // ========== 文章列配置 ==========
  const articleColumns = [
    {
      title: '标题',
      dataIndex: 'title',
      key: 'title',
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
          <Button 
            danger 
            icon={<DeleteOutlined />} 
            onClick={() => handleDeleteArticle(record)}
          >
            删除
          </Button>
        </Space>
      ),
    },
  ];

  return (
    <Layout style={{ minHeight: '100vh' }}>
      <Header style={{ background: '#fff', padding: '0 20px', boxShadow: '0 2px 8px rgba(0,0,0,0.1)' }}>
        <Row justify="space-between" align="middle">
          <Col>
            <Title level={3} style={{ margin: 0, lineHeight: '64px' }}>
              Cloudflare KV CMS 管理平台
            </Title>
          </Col>
        </Row>
      </Header>

      <Content style={{ padding: '24px' }}>
        <Card>
          <Tabs defaultActiveKey="1">
            {/* 文章管理标签页 */}
            <TabPane tab="文章管理" key="1">
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
                loading={articleLoading}
                pagination={{ pageSize: 10 }}
              />
            </TabPane>

            {/* 视频资源管理标签页 */}
            <TabPane tab="视频资源管理" key="2">
              <Row gutter={16} style={{ marginBottom: 16 }}>
                <Col span={8}>
                  <Space>
                    <Button 
                      type="primary" 
                      icon={<SyncOutlined />} 
                      onClick={() => fetchVideos()}
                    >
                      刷新视频列表
                    </Button>
                    <Button 
                      icon={<FolderAddOutlined />} 
                      onClick={() => setCategoryModalVisible(true)}
                    >
                      新增分类
                    </Button>
                    <Button 
                      icon={<TagOutlined />} 
                      onClick={() => setTagModalVisible(true)}
                    >
                      新增标签
                    </Button>
                  </Space>
                </Col>
                <Col span={16}>
                  <Space>
                    <Select
                      placeholder="选择分类筛选"
                      style={{ width: 200 }}
                      value={selectedCategory}
                      onChange={setSelectedCategory}
                      allowClear
                    >
                      {categories.map(c => (
                        <Option key={c.id} value={c.name}>{c.name}</Option>
                      ))}
                    </Select>
                    <Select
                      placeholder="选择标签筛选"
                      style={{ width: 200 }}
                      value={selectedTag}
                      onChange={setSelectedTag}
                      allowClear
                    >
                      {tags.map(t => (
                        <Option key={t.id} value={t.name}>{t.name}</Option>
                      ))}
                    </Select>
                    <Button 
                      icon={<ClockCircleOutlined />}
                      onClick={() => setSourceConfigDrawer({ visible: true })}
                    >
                      视频源配置
                    </Button>
                  </Space>
                </Col>
              </Row>

              {/* 视频列表（带预览） */}
              <Table 
                columns={[
                  {
                    title: '封面',
                    key: 'cover',
                    width: 100,
                    render: (_, record) => (
                      record.cover ? (
                        <Image 
                          width={80} 
                          height={60} 
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
                  },
                  {
                    title: '分类',
                    dataIndex: 'category',
                    key: 'category',
                    render: (category) => <Tag color="blue">{category}</Tag>
                  },
                  {
                    title: '标签',
                    dataIndex: 'tags',
                    key: 'tags',
                    render: (tags) => (
                      <>
                        {tags.map(tag => (
                          <Tag key={tag}>{tag}</Tag>
                        ))}
                      </>
                    )
                  },
                  {
                    title: '来源',
                    dataIndex: 'source',
                    key: 'source',
                  },
                  {
                    title: '抓取时间',
                    dataIndex: 'fetchTime',
                    key: 'fetchTime',
                    render: (time) => new Date(time).toLocaleString()
                  },
                  {
                    title: '操作',
                    key: 'action',
                    render: (_, record) => (
                      <Space>
                        <Button 
                          type="text" 
                          icon={<PlayCircleOutlined />}
                          onClick={() => playVideo(record)}
                        >
                          播放
                        </Button>
                        <Button 
                          danger 
                          icon={<DeleteOutlined />}
                          onClick={() => handleDeleteVideo(record)}
                        >
                          删除
                        </Button>
                      </Space>
                    )
                  }
                ]} 
                dataSource={videos} 
                rowKey="id" 
                loading={videoLoading}
                pagination={{ pageSize: 10 }}
              />
            </TabPane>
          </Tabs>
        </Card>
      </Content>

      <Footer style={{ textAlign: 'center' }}>
        Cloudflare + KV + Ant Design CMS ©{new Date().getFullYear()}
      </Footer>

      {/* 文章编辑/新增弹窗 */}
      <Modal
        title={editingArticle ? '编辑文章' : '新增文章'}
        open={articleModalVisible}
        onOk={handleArticleSubmit}
        onCancel={() => setArticleModalVisible(false)}
        destroyOnClose
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
            name="content"
            label="文章内容"
            rules={[{ required: true, message: '请输入内容' }]}
          >
            <Input.TextArea rows={8} placeholder="请输入文章内容" />
          </Form.Item>
        </Form>
      </Modal>

      {/* 新增分类弹窗 */}
      <Modal
        title="新增视频分类"
        open={categoryModalVisible}
        onOk={addCategory}
        onCancel={() => setCategoryModalVisible(false)}
      >
        <Input 
          placeholder="输入分类名称（如：电影、短视频）" 
          value={newCategoryName}
          onChange={(e) => setNewCategoryName(e.target.value)}
        />
      </Modal>

      {/* 新增标签弹窗 */}
      <Modal
        title="新增视频标签"
        open={tagModalVisible}
        onOk={addTag}
        onCancel={() => setTagModalVisible(false)}
      >
        <Input 
          placeholder="输入标签名称（如：搞笑、科技）" 
          value={newTagName}
          onChange={(e) => setNewTagName(e.target.value)}
        />
      </Modal>

      {/* 视频播放抽屉 */}
      <Drawer
        title={videoPlayDrawer.video?.title || "视频播放"}
        open={videoPlayDrawer.visible}
        onClose={() => setVideoPlayDrawer({...videoPlayDrawer, visible: false})}
        width={800}
      >
        {videoPlayDrawer.video ? (
          <div style={{ padding: 20 }}>
            <video 
              src={videoPlayDrawer.video.url} 
              controls 
              width="100%"
              style={{ maxHeight: 400 }}
              poster={videoPlayDrawer.video.cover}
            >
              您的浏览器不支持HTML5视频播放
            </video>
            <Divider />
            <Row gutter={16}>
              <Col span={8}><Text strong>标题：</Text>{videoPlayDrawer.video.title}</Col>
              <Col span={8}><Text strong>分类：</Text>{videoPlayDrawer.video.category}</Col>
              <Col span={8}><Text strong>来源：</Text>{videoPlayDrawer.video.source}</Col>
              <Col span={24} style={{ marginTop: 8 }}>
                <Text strong>标签：</Text>
                {videoPlayDrawer.video.tags.map(tag => (
                  <Tag key={tag}>{tag}</Tag>
                ))}
              </Col>
              <Col span={24} style={{ marginTop: 8 }}>
                <Text strong>视频链接：</Text>
                <Input 
                  value={videoPlayDrawer.video.url} 
                  readOnly 
                  style={{ marginTop: 8 }}
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
        title="视频源配置（夸克/阿里云盘）"
        open={sourceConfigDrawer.visible}
        onClose={() => setSourceConfigDrawer({ visible: false })}
        width={800}
        footer={[
          <Button key="save" type="primary" onClick={saveVideoSources}>
            保存配置
          </Button>
        ]}
      >
        <Table 
          dataSource={videoSources}
          rowKey={(record, index) => `source_${index}`}
          pagination={false}
          columns={[
            {
              title: '源名称',
              render: (_, record, index) => (
                <Input 
                  placeholder="如：阿里云盘-电影库"
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
                >
                  <Option value="quark">夸克网盘</Option>
                  <Option value="aliyun">阿里云盘</Option>
                  <Option value="bilibili">B站（待扩展）</Option>
                </Select>
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
              title: '网盘路径',
              render: (_, record, index) => (
                <Input 
                  placeholder="/ 表示根目录"
                  value={record.path || "/"}
                  onChange={(e) => updateVideoSource(index, 'path', e.target.value)}
                  style={{ width: 150 }}
                />
              )
            },
            {
              title: '分类',
              render: (_, record, index) => (
                <Select
                  placeholder="选择分类"
                  value={record.category}
                  onChange={(value) => updateVideoSource(index, 'category', value)}
                  style={{ width: 120 }}
                >
                  {categories.map(c => (
                    <Option key={c.id} value={c.name}>{c.name}</Option>
                  ))}
                </Select>
              )
            },
            {
              title: '标签',
              render: (_, record, index) => (
                <Select
                  mode="tags"
                  placeholder="选择/输入标签"
                  value={record.tags || []}
                  onChange={(value) => updateVideoSource(index, 'tags', value)}
                  style={{ width: 200 }}
                >
                  {tags.map(t => (
                    <Option key={t.id} value={t.name}>{t.name}</Option>
                  ))}
                </Select>
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
              render: (_, record, index) => (
                <Button 
                  danger 
                  onClick={() => deleteVideoSource(index)}
                >
                  删除
                </Button>
              )
            }
          ]}
        />
        <Button 
          type="dashed" 
          style={{ marginTop: 16, width: '100%' }}
          onClick={addVideoSource}
        >
          添加视频源
        </Button>
        <Divider />
        <Text type="secondary">
          Cron表达式格式：分 时 日 月 周<br/>
          示例：<br/>
          * * * * * - 每分钟<br/>
          0 */2 * * * - 每2小时<br/>
          0 9 * * * - 每天9点<br/>
          */30 * * * * - 每30分钟
        </Text>
      </Drawer>
    </Layout>
  );
}

export default App;