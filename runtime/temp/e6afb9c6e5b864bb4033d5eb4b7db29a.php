<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:83:"/Users/boycott/Desktop/my-project/byt.cms/application/install/view/index/index.html";i:1735873502;s:82:"/Users/boycott/Desktop/my-project/byt.cms/application/install/view/index/head.html";i:1737992722;s:82:"/Users/boycott/Desktop/my-project/byt.cms/application/install/view/index/foot.html";i:1741746097;}*/ ?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php echo lang('install/title'); ?></title>
        <link rel="stylesheet" href="/static//layui/css/layui.css">
        <link rel="stylesheet" href="/static//css/admin_style.css">
        <link rel="stylesheet" href="/static//css/install.css">
        <script type="text/javascript" src="/static//layui/layui.js"></script>
        <script>
            var ROOT_PATH = "", ADMIN_PATH="<?php echo $_SERVER['SCRIPT_NAME']; ?>";
        </script>
    </head>
<body>
<div class="header">
    <?php if($new_version == 1): ?> 
    <h2><?php echo lang('install/header'); ?></h2>
    <h1><?php echo lang('install/header1'); ?></h1>
    <?php else: ?>
    <h1><?php echo lang('install/header'); ?> <?php echo lang('install/header1'); ?></h1>
    <?php endif; ?>
</div>
<div class="install-box">
   

    <div class="protocol-box">
        <div class="title"><?php echo lang('install/user_agreement_title'); ?></div>
        <div class="protocol">
            <p>
                <?php echo lang('install/user_agreement'); ?>
            </p>
        </div>
    </div>
    <form class="layui-form layui-form-pane" action="" method="post">
        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo lang('install/lang'); ?></label>
            <div class="layui-input-inline w200 ">
                <select class="" name="lang" lay-filter="lang" style="z-index:99999;">
                    <option value=""><?php echo lang('install/select_lang'); ?></option>
                    <?php if(is_array($langs) || $langs instanceof \think\Collection || $langs instanceof \think\Paginator): $i = 0; $__LIST__ = $langs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $vo; ?>" <?php if($lang == $vo): ?>selected <?php endif; ?>><?php echo $vo; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
            <div class="layui-form-mid layui-word-aux"><?php echo lang('install/lang_tip'); ?></div>
        </div>
    </form>
    <div class="step-btns">
        <a href="?step=2" class="layui-btn layui-btn-big layui-btn-normal"><?php echo lang('install/user_agreement_agree'); ?></a>
    </div>
</div>
<div class="copyright">
    © <a href="http://www.maccms.la/?v10" target="_blank">MacCMS.LA</a> All Rights Reserved.
</div>
</body>
</html>
<script type="text/javascript">
    var test=0;
    layui.define(['element', 'form'], function(exports) {
        var $ = layui.jquery, layer = layui.layer, form = layui.form;
        form.on('select(lang)',function(data){
            if(data.value !='') {
                location.href = "<?php echo url('index'); ?>?lang=" + (data.value);
            }
        });
    });
</script>