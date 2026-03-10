import { useState, useEffect, forwardRef, useImperativeHandle } from 'react';
import { Table, Button, Modal, Form, Input, Select, message, Space, Switch } from 'antd';
import axios from 'axios';
import { EditOutlined, DeleteOutlined, PlusOutlined } from '@ant-design/icons';
import { usePermission } from '../../hooks/usePermission.jsx';
import { useUser } from '../../context/UserContext.jsx';

const API_BASE = import.meta.env.VITE_API_BASE;

const User = forwardRef((props, ref) => {
  const [users, setUsers] = useState([]);
  const [loading, setLoading] = useState(false);
  const [modalVisible, setModalVisible] = useState(false);
  const [editingUser, setEditingUser] = useState(null);
  const [form] = Form.useForm();
  // 获取用户信息和更新方法
  const { user: currentUser, updateUser } = useUser();
  // 获取权限信息
  const { isAdmin } = usePermission();
  const fetchUsers = async () => {
    setLoading(true);
    try {
      const res = await axios.get(`${API_BASE}/api/users`);
      setUsers(res.data);
    } catch (err) {
      message.error('获取用户列表失败');
      console.error(err);
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    fetchUsers();
  }, []);
  useImperativeHandle(ref, () => ({
    fetchUsers
  }));
  const showModal = (user = null) => {
    setEditingUser(user);
    form.setFieldsValue({
      id: user?.id || '',
      username: user?.username || '',
      password: '',
      nickname: user?.nickname || '',
      role: user?.role || 'user',
      status: user?.status || 'active'
    });
    setModalVisible(true);
  };

  const handleSubmit = async () => {
    try {
      const values = await form.validateFields();
      if (editingUser) {
        await axios.post(`${API_BASE}/api/users/${editingUser.id.replace('user:', '')}`, values);
        message.success('用户更新成功');
        
        // 如果编辑的是当前登录用户，更新用户信息
        if (editingUser.id === currentUser?.id) {
          const updatedUser = { ...currentUser, ...values };
          // 不存储密码
          delete updatedUser.password;
          updateUser(updatedUser);
        }
      } else {
        await axios.post(`${API_BASE}/api/users/register`, values);
        message.success('用户创建成功');
      }
      setModalVisible(false);
      fetchUsers();
    } catch (err) {
      message.error(err.response?.data?.error || '操作失败');
      console.error(err);
    }
  };

  const handleDelete = async (user) => {
    try {
      await axios.delete(`${API_BASE}/api/users/${user.id.replace('user:', '')}`);
      message.success('用户删除成功');
      fetchUsers();
    } catch (err) {
      message.error('删除失败');
      console.error(err);
    }
  };

  // 切换用户状态
  const handleToggleStatus = async (user) => {
    try {
      const newStatus = user.status === 'active' ? 'inactive' : 'active';
      await axios.post(`${API_BASE}/api/users/${user.id.replace('user:', '')}`, {
        status: newStatus
      });
      message.success(`用户已${newStatus === 'active' ? '启用' : '禁用'}`);
      fetchUsers();
    } catch (err) {
      message.error('操作失败');
      console.error(err);
    }
  };

  const columns = [
    {
      title: '用户名',
      dataIndex: 'username',
      key: 'username'
    },
    {
      title: '昵称',
      dataIndex: 'nickname',
      key: 'nickname'
    },
    {
      title: '角色',
      dataIndex: 'role',
      key: 'role',
      render: (role) => role === 'admin' ? '管理员' : '普通用户'
    },
    {
      title: '状态',
      dataIndex: 'status',
      key: 'status',
      render: (status, record) => {
        if (record.id === currentUser?.id || !isAdmin) {
          return status === 'active' ? '启用' : '禁用';
        }
        return (
          <Switch
            checked={status === 'active'}
            disabled={record.role =='admin'}
            onChange={() => handleToggleStatus(record)}
            checkedChildren="启用"
            unCheckedChildren="禁用"
          />
        );
      }
    },
    {
      title: '修改时间',
      dataIndex: 'updateTime',
      key: 'updateTime',
      render: (time) => new Date(time).toLocaleString()
    },
    {
      title: '创建时间',
      dataIndex: 'createTime',
      key: 'createTime',
      render: (time) => new Date(time).toLocaleString()
    },
    {
      title: '操作',
      key: 'action',
      hidden: !isAdmin,
      render: (_, record) => (
        <Space style={{marginLeft: -15}}>
          <Button type="link" icon={<EditOutlined />} onClick={() => showModal(record)}>
            编辑
          </Button>
          {record.id !== currentUser?.id && record.role !=='admin' && (
            <Button type="link" danger icon={<DeleteOutlined />} onClick={() => handleDelete(record)}>
              删除
            </Button>
          )}
        </Space>
      )
    }
  ];

  return (
    <div>
      {isAdmin && <Button type="primary" icon={<PlusOutlined />} onClick={() => showModal()} style={{ marginBottom: 16 }}>
        新增用户
      </Button>}
      <Table
        loading={loading}
        dataSource={users}
        columns={columns}
        rowKey="id"
        pagination={{ pageSize: 10 }}
      />

      <Modal
        title={editingUser ? '编辑用户' : '新增用户'}
        open={modalVisible}
        onOk={handleSubmit}
        onCancel={() => setModalVisible(false)}
        destroyOnHidden
      >
        <Form form={form} layout="vertical">
          <Form.Item
            name="username"
            label="用户名"
            rules={[{ required: true, message: '请输入用户名' }]}
          >
            <Input placeholder="请输入用户名" disabled={!!editingUser} />
          </Form.Item>
          <Form.Item
            name="password"
            label="密码"
            rules={[!editingUser && { required: true, message: '请输入密码' }].filter(Boolean)}
          >
            <Input.Password disabled={editingUser?.id !== currentUser?.id&&editingUser?.role=='admin'} placeholder={editingUser ? '留空表示不修改密码' : '请输入密码'} />
          </Form.Item>
          <Form.Item
            name="nickname"
            label="昵称"
            rules={[{ required: true, message: '请输入昵称' }]}
          >
            <Input placeholder="请输入昵称" />
          </Form.Item>
          <Form.Item
            name="role"
            label="角色"
            rules={[{ required: true, message: '请选择角色' }]}
          >
            <Select disabled={editingUser?.id === currentUser?.id||editingUser?.role=='admin'} placeholder="请选择角色">
              <Select.Option value="user">普通用户</Select.Option>
              <Select.Option value="admin">管理员</Select.Option>
            </Select>
          </Form.Item>
          {!editingUser?.id && <Form.Item
            name="status"
            label="状态"
            rules={[{ required: true, message: '请选择状态' }]}
          >
            <Select placeholder="请选择状态">
              <Select.Option value="active">启用</Select.Option>
              <Select.Option value="inactive">禁用</Select.Option>
            </Select>
          </Form.Item>}
        </Form>
      </Modal>
    </div>
  );
});

export default User;