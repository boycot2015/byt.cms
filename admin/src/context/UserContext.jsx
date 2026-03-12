/* eslint-disable react-hooks/set-state-in-effect */
import { createContext, useState, useContext, useEffect, useCallback } from 'react';

const UserContext = createContext();

export const useUser = () => {
  const context = useContext(UserContext);
  if (!context) {
    throw new Error('useUser must be used within a UserProvider');
  }
  return context;
};

export const UserProvider = ({ children }) => {
  const [user, setUser] = useState(null);
  const getUserInfo = () => {
    setUser(localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')) : null);
  };
  // 检查登录状态
  useEffect(() => {
     getUserInfo();
  }, []);

  // 更新用户信息
  const updateUser = useCallback((userInfo) => {
    setUser(userInfo);
    localStorage.setItem('user', JSON.stringify(userInfo));
  }, []);

  // 登出
  const logout = useCallback(() => {
    setUser(null);
    localStorage.removeItem('user');
  }, []);

  return (
    <UserContext.Provider value={{ user, updateUser, logout }}>
      {children}
    </UserContext.Provider>
  );
};
