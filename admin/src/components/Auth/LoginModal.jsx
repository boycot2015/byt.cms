import React, { useState } from 'react';
import { Modal, Form, Input, Button, message, Tabs } from 'antd';
import axios from 'axios';
import { useUser } from '../../context/UserContext.jsx';

const { TabPane } = Tabs;
const API_BASE = import.meta.env.VITE_API_BASE;

const LoginModal = ({ visible, onClose, onLoginSuccess }) => {
  const [loading, setLoading] = useState(false);
  const [activeTab, setActiveTab] = useState('login');
  const [loginForm] = Form.useForm();
  const [registerForm] = Form.useForm();
  const { updateUser } = useUser();

  const handleLogin = async () => {
    try {
      setLoading(true);
      const values = await loginForm.validateFields();
      const response = await axios.post(`${API_BASE}/api/users/login`, values);
      if (response.data.success) {
        message.success('登录成功');
        updateUser(response.data.user);
        onLoginSuccess(response.data.user);
        onClose();
      }
    } catch (error) {
      message.error(error.response?.data?.error || '登录失败');
    } finally {
      setLoading(false);
    }
  };

  const handleRegister = async () => {
    try {
      setLoading(true);
      const values = await registerForm.validateFields();
      const response = await axios.post(`${API_BASE}/api/users/register`, values);
      message.success('注册成功，请登录');
      setActiveTab('login');
      loginForm.setFieldsValue({ username: values.username });
    } catch (error) {
      message.error(error.response?.data?.error || '注册失败');
    } finally {
      setLoading(false);
    }
  };

  return (
    <Modal
      title={<div style={{textAlign: 'center'}}>欢迎使用CMS管理平台</div>}
      open={visible}
      onCancel={onClose}
      closeIcon={null}
      footer={null}
      centered
      width={460}
    >
      <Tabs activeKey={activeTab} onChange={setActiveTab}>
        <TabPane tab="登录" key="login">
          <Form form={loginForm} layout="vertical" onFinish={handleLogin}>
            <Form.Item
              name="username"
              label="用户名"
              rules={[{ required: true, message: '请输入用户名' }]}
            >
              <Input placeholder="请输入用户名" />
            </Form.Item>
            <Form.Item
              name="password"
              label="密码"
              rules={[{ required: true, message: '请输入密码' }]}
            >
              <Input.Password placeholder="请输入密码" />
            </Form.Item>
            <Form.Item>
                <div style={{marginBottom: 10, color: 'grey', textAlign: 'right'}}>还没有账号？<Button type="link" onClick={() => setActiveTab('register')}>点我注册</Button></div>
              <Button type="primary" htmlType="submit" loading={loading} block>
                登录
              </Button>
            </Form.Item>
          </Form>
        </TabPane>
        <TabPane tab="注册" key="register">
          <Form form={registerForm} layout="vertical" onFinish={handleRegister}>
            <Form.Item
              name="username"
              label="用户名"
              rules={[{ required: true, message: '请输入用户名' }]}
            >
              <Input placeholder="请输入用户名" />
            </Form.Item>
            <Form.Item
              name="password"
              label="密码"
              rules={[{ required: true, message: '请输入密码' }]}
            >
              <Input.Password placeholder="请输入密码" />
            </Form.Item>
            <Form.Item
              name="nickname"
              label="昵称"
              rules={[{ required: true, message: '请输入昵称' }]}
            >
              <Input placeholder="请输入昵称" />
            </Form.Item>
            <Form.Item>
                <div style={{marginBottom: 10, color: 'red'}}>注意：首次注册成功即为管理员账户，清妥善保管账号密码！</div>
              <Button type="primary" htmlType="submit" loading={loading} block>
                注册
              </Button>
            </Form.Item>
          </Form>
        </TabPane>
      </Tabs>
    </Modal>
  );
};

export default LoginModal;