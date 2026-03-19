import { useState, useEffect, forwardRef, useImperativeHandle } from 'react';
import { useRequest } from 'ahooks';
import { 
  Form, Input, Button, message, Upload, Select, 
  InputNumber, Space, Card, Row, Col, Tabs, Typography
} from 'antd';
import { UploadOutlined, PlusOutlined, MinusOutlined } from '@ant-design/icons';
import axios from 'axios';
import { useUser } from '../../context/UserContext';

const { Title, Text } = Typography;
const API_BASE = import.meta.env.VITE_API_BASE;

const SiteConfig = forwardRef((props, ref) => {
  const { user } = useUser();
  const [form] = Form.useForm();
  const [categories, setCategories] = useState([]);
  const [loading, setLoading] = useState(false);
  const [config, setConfig] = useState({});
  // 获取分类列表
  const fetchCategories = async () => {
    try {
      const res = await axios.get(`${API_BASE}/api/categories`);
      setCategories(res.data || []);
    } catch (error) {
      console.error('获取分类列表失败:', error);
    }
  };
  
  // 获取网站配置
  const { loading: configLoading, run: fetchConfig } = useRequest(async () => {
    try {
      const res = await axios.get(`${API_BASE}/api/site-config`);
      if (res.data) {
        form.setFieldsValue({
          logo: res.data.logo,
          title: res.data.title,
          bannerCount: res.data.bannerCount,
          categoryIds: res.data.categoryIds,
          categoryCols: res.data.categoryCols,
          categoryRows: res.data.categoryRows,
          rankingCategoryIds: res.data.rankingCategoryIds,
          rankingCount: res.data.rankingCount,
          recommendTitle: res.data.recommendTitle,
          links: res.data.links || []
        });
      }
    } catch (error) {
      console.error('获取网站配置失败:', error);
    }
  }, {
    auto: true
  });
  
  // 上传图片
  const handleUpload = async (file) => {
    const formData = new FormData();
    formData.append('file', file);
    
    try {
      const res = await axios.post(`${API_BASE}/api/upload/image`, formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      });
      return res.data.data.url;
    } catch (error) {
      console.error('上传图片失败:', error);
      throw error;
    }
  };
  
  // 提交配置
  const handleSubmit = async () => {
    try {
      const values = await form.validateFields();
      setLoading(true);
      
      const res = await axios.post(`${API_BASE}/api/site-config`, {
        userId: user.id,
        ...values
      });
      
      if (res.data.success) {
        message.success(res.data.message);
      } else {
        message.error('更新配置失败');
      }
    } catch (error) {
      console.error('更新配置失败:', error);
      message.error('更新配置失败，请检查输入');
    } finally {
      setLoading(false);
    }
  };
  
  // 初始化
  useEffect(() => {
    fetchCategories();
  }, []);
  
  // 暴露方法给父组件
  useImperativeHandle(ref, () => ({
    fetchConfig
  }));
  
  return (
    <div style={{ padding: '0 10px 20px', maxHeight: '70vh', overflowY: 'auto' }}>
      <Card styles={{ body: { padding: '0 15px 15px' } }}>
        <Form
          form={form}
          layout="vertical"
          onFinish={handleSubmit}
        >
          <Tabs 
            defaultActiveKey="basic"
            items={[
              {
                key: 'basic',
                label: '基本设置',
                children: (
                  <Row gutter={16}>
                    <Col span={12}>
                      <Form.Item
                        name="logo"
                        label="网站Logo"
                      >
                        <Upload
                          name="file"
                          listType="picture"
                          maxCount={1}
                          key={form.getFieldValue('logo')}
                          customRequest={async ({ file, onSuccess, onError }) => {
                            try {
                              const url = await handleUpload(file);
                              onSuccess(url);
                              form.setFieldsValue({ logo: url });    
                              setConfig({ ...config, logo: url });                       
                            } catch (error) {
                              onError(error);
                            }
                          }}
                          fileList={config.logo ? [{ 
                            uid: '1', 
                            name: 'logo.png', 
                            status: 'done', 
                            url: config.logo 
                          }] : []}
                          onRemove={() => {
                            form.setFieldsValue({ logo: '' });
                            setConfig({ ...config, logo: '' });
                          }}
                        >
                          <Button icon={<UploadOutlined />}>上传Logo</Button>
                        </Upload>
                      </Form.Item>
                    </Col>
                    <Col span={12}>
                      <Form.Item
                        name="title"
                        label="网站标题"
                        rules={[{ required: true, message: '请输入网站标题' }]}
                      >
                        <Input placeholder="请输入网站标题" />
                      </Form.Item>
                    </Col>
                  </Row>
                )
              },
              {
                key: 'home',
                label: '首页配置',
                children: (
                  <Row gutter={16}>
                    <Col span={12}>
                      <Form.Item
                        name="bannerCount"
                        label="Banner展示数量"
                        rules={[{ required: true, message: '请输入Banner展示数量' }]}
                      >
                        <InputNumber 
                          min={1} 
                          max={6} 
                          placeholder="最多6个" 
                          style={{ width: '100%' }} 
                        />
                      </Form.Item>
                    </Col>
                    
                    <Col span={12}>
                      <Form.Item
                        name="categoryIds"
                        label="首页分类展示"
                        rules={[{ required: true, message: '请选择要展示的分类' }]}
                      >
                        <Select
                          mode="multiple"
                          optionFilterProp="label"
                          placeholder="选择要在首页展示的分类"
                          style={{ width: '100%' }}
                          options={categories.map(cat => ({
                            label: cat.name,
                            value: cat.id
                          }))}
                        />
                      </Form.Item>
                    </Col>
                    <Col span={12}>
                      <Form.Item
                      name="categoryCols"
                      label="分类一行展示数量"
                      rules={[{ required: true, message: '请选择一行展示数量' }]}
                    >
                      <Select 
                        placeholder="选择一行展示数量" 
                        style={{ width: '100%' }}
                        options={[
                          { label: '5个', value: 5 },
                          { label: '6个', value: 6 }
                        ]}
                      />
                    </Form.Item>
                    </Col>
                    <Col span={12}>
                      <Form.Item
                      name="categoryRows"
                      label="分类展示行数"
                      rules={[{ required: true, message: '请选择展示行数' }]}
                    >
                      <Select 
                        placeholder="选择展示行数" 
                        style={{ width: '100%' }}
                        options={[
                          { label: '1行', value: 1 },
                          { label: '2行', value: 2 }
                        ]}
                      />
                    </Form.Item>
                    </Col>
                    <Col span={12}>
                      <Form.Item
                        name="rankingCategoryIds"
                        label="首页推荐展示分类"
                        rules={[{ required: true, message: '请选择要展示的推荐分类' }]}
                      >
                        <Select
                          mode="multiple"
                          optionFilterProp="label"
                          placeholder="选择要在首页推荐展示的分类"
                          style={{ width: '100%' }}
                          options={categories.map(cat => ({
                            label: cat.name,
                            value: cat.id
                          }))}
                        />
                      </Form.Item>
                    </Col>
                    <Col span={12}>
                      <Form.Item
                        name="recommendTitle"
                        label="首页推荐标题"
                        rules={[{ required: true, message: '请输入首页推荐标题' }]}
                      >
                        <Input
                          placeholder="输入首页推荐标题"
                          style={{ width: '100%' }}
                        />
                      </Form.Item>
                    </Col>
                    <Col span={12}>
                      <Form.Item
                        name="rankingCount"
                        label="排行展示数量"
                        rules={[{ required: true, message: '请输入排行展示数量' }]}
                      >
                        <InputNumber 
                          min={1} 
                          max={50} 
                          placeholder="每个分类展示几个" 
                          style={{ width: '100%' }} 
                        />
                      </Form.Item>
                    </Col>
                  </Row>
                )
              },
              {
                key: 'links',
                label: '友情链接',
                children: (
                  <Form.List
                    name="links"
                    initialValue={[]}
                  >
                    {(fields, { add, remove }) => (
                      <Row>
                        {fields.map((field) => (
                          <Col span={12}>
                            <Space key={field.key} style={{ display: 'flex', marginBottom: 8 }} align="baseline">
                              <Form.Item
                                {...field}
                                name={[field.name, 'name']}
                                fieldKey={[field.fieldKey, 'name']}
                                rules={[{ required: true, message: '请输入链接名称' }]}
                              >
                                <Input placeholder="链接名称" style={{ width: 150 }} />
                              </Form.Item>
                              <Form.Item
                                {...field}
                                name={[field.name, 'url']}
                                fieldKey={[field.fieldKey, 'url']}
                                rules={[{ required: true, message: '请输入链接地址' }]}
                              >
                                <Input placeholder="链接地址" style={{ width: 300 }} />
                              </Form.Item>
                              <Button
                                type="text"
                                icon={<MinusOutlined />}
                                onClick={() => remove(field.name)}
                              />
                            </Space>
                          </Col>
                        ))}
                        <Form.Item>
                          <Button
                            type="dashed"
                            onClick={() => add()}
                            icon={<PlusOutlined />}
                          >
                            添加友情链接
                          </Button>
                        </Form.Item>
                      </Row>
                    )}
                  </Form.List>
                )
              }
            ]}
          />
          
          <Form.Item>
            <Button type="primary" htmlType="submit" loading={loading || configLoading}>
              保存配置
            </Button>
          </Form.Item>
        </Form>
      </Card>
    </div>
  );
});

export default SiteConfig;