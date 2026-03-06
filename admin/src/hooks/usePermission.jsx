import { useUser } from '../context/UserContext.jsx';

export const usePermission = () => {
  const { user } = useUser();
  
  // 检查是否为管理员
  const isAdmin = user?.role === 'admin';
  
  // 检查是否有操作权限
  const hasPermission = (action) => {
    // 这里可以根据需要扩展权限控制逻辑
    // 目前只有管理员有所有操作权限
    return isAdmin;
  };
  
  return {
    isAdmin,
    hasPermission
  };
};
