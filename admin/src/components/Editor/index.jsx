import React, { useEffect, useRef, useState } from 'react';
import { Editor, Toolbar } from '@wangeditor/editor-for-react';
import '@wangeditor/editor/dist/css/style.css'; // 引入编辑器样式

// 封装富文本编辑器组件
const RichTextEditor = ({ value, onChange, disabled = false }) => {
  // 编辑器实例 ref
  const editorRef = useRef(null);
  // 编辑器配置
  const [editorConfig, setEditorConfig] = useState({
    placeholder: '请输入文章内容（支持图文、格式排版）',
    readOnly: disabled,
    // 隐藏不需要的菜单（可根据需求调整）
    excludeKeys: ['fullScreen', 'group-video', 'formula', 'codeBlock'],
    // ========== 新增：图片上传配置 ==========
    MENU_CONF: {
      uploadImage: {
        server: import.meta.env.VITE_API_BASE + '/api/upload/image', // 你的上传接口
        fieldName: 'file', // 和 Workers 中接收的字段名一致
        maxFileSize: 5 * 1024 * 1024, // 5MB，和后端一致
        maxNumberOfFiles: 10, // 单次最多上传10张
        headers: {
          // 如需鉴权可添加，如 Token
          // 'Authorization': 'Bearer ' + localStorage.getItem('token')
        },
        // 上传前钩子（可选）
        beforeUpload(file) {
          // 可做额外验证
          console.log('准备上传:', file.name);
          return file;
        },
        // 上传成功回调（适配后端返回格式）
        customInsert(res, insertFn) {
          if (res.success) {
            // 插入图片到富文本
            insertFn(res.data.url, res.data.name, res.data.size);
          } else {
            // 上传失败提示
            alert('图片上传失败：' + res.message);
          }
        },
        // 上传失败回调
        onFailed(file, res) {
          alert(`上传 ${file.name} 失败：${res.message}`);
        },
        // 上传进度回调（可选）
        onProgress(progress) {
          console.log('上传进度:', progress);
        },
      },
    }
  });

  // 组件卸载时销毁编辑器（防止内存泄漏）
  useEffect(() => {
    return () => {
      if (editorRef.current) {
        editorRef.current.destroy();
        editorRef.current = null;
      }
    };
  }, []);

  // 监听富文本内容变化
  const handleEditorChange = (editor) => {
    const html = editor.getHtml(); // 获取HTML格式内容
    onChange(html); // 传递给父组件
  };

  return (
    <div style={{ border: '1px solid #e8e8e8', borderRadius: 4 }}>
      {/* 工具栏 */}
      <Toolbar
        editor={editorRef.current}
        defaultConfig={editorConfig}
        mode="default"
        style={{ borderBottom: '1px solid #e8e8e8' }}
      />
      {/* 编辑器内容区 */}
      <Editor
        defaultConfig={editorConfig}
        value={value}
        onCreated={(editor) => (editorRef.current = editor)}
        onChange={handleEditorChange}
        mode="default"
        style={{ height: 260, overflow: 'auto' }}
      />
    </div>
  );
};

export default RichTextEditor;