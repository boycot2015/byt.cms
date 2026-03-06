import { useState, useEffect } from 'react';

const useThemeMode = () => {
  // 从 localStorage 中读取主题模式偏好，如果没有则使用默认值 'system'
  const [themeMode, setThemeMode] = useState(() => {
    const savedMode = localStorage.getItem('themeMode');
    return savedMode || 'system';
  });

  // 检测系统主题偏好
  const [systemDarkMode, setSystemDarkMode] = useState(() => {
    return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
  });

  // 当系统主题变化时更新状态
  useEffect(() => {
    const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
    const handleChange = (e) => {
      setSystemDarkMode(e.matches);
    };

    mediaQuery.addEventListener('change', handleChange);
    return () => mediaQuery.removeEventListener('change', handleChange);
  }, []);

  // 根据主题模式计算当前是否为暗黑模式
  const darkMode = themeMode === 'system' ? systemDarkMode : themeMode === 'dark';

  // 当主题模式变化时，保存到 localStorage
  useEffect(() => {
    localStorage.setItem('themeMode', themeMode);
  }, [themeMode]);

  return { darkMode, themeMode, setThemeMode };
};

export default useThemeMode;