<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:90:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view/system/configconnect.html";i:1629786416;s:81:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view/public/head.html";i:1629786412;s:81:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view/public/foot.html";i:1629786412;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo $title; ?> - <?php echo lang('admin/public/head/title'); ?></title>
    <link rel="stylesheet" href="/static//layui/css/layui.css">
    <link rel="stylesheet" href="/static//css/admin_style.css?<?php echo $MAC_VERSION; ?>">
    <script type="text/javascript" src="/static//js/jquery.js"></script>
    <script type="text/javascript" src="/static//layui/layui.js"></script>
    <script>
        var ROOT_PATH="",ADMIN_PATH="<?php echo $_SERVER['SCRIPT_NAME']; ?>", MAC_VERSION="v10";
    </script>
</head>
<body>

<div class="page-container">
    <form class="layui-form layui-form-pane" action="">
        <input type="hidden" name="__token__" value="<?php echo \think\Request::instance()->token(); ?>" />
        <div class="layui-tab">
            <ul class="layui-tab-title">
                <li class="layui-this"><?php echo lang('admin/system/configconnect/title'); ?></li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">

                    <blockquote class="layui-elem-quote layui-quote-nm">
                        <?php echo lang('admin/system/configconnect/tip'); ?>
                    </blockquote>


                    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
                        <legend><?php echo lang('admin/system/configconnect/qq'); ?> <a target="_blank" href="http://connect.qq.com/?maccms" class="layui-btn layui-btn-primary"><?php echo lang('admin/system/configconnect/go_reg'); ?></a></legend>
                    </fieldset>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('status'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="radio" name="connect[qq][status]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['connect']['qq']['status'] != 1): ?>checked <?php endif; ?>>
                            <input type="radio" name="connect[qq][status]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['connect']['qq']['status'] == 1): ?>checked <?php endif; ?>>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">APP_KEY：</label>
                        <div class="layui-input-block">
                            <input type="text" name="connect[qq][key]" placeholder="" value="<?php echo $config['connect']['qq']['key']; ?>" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">APP_SECRET：</label>
                        <div class="layui-input-block">
                            <input type="text" name="connect[qq][secret]" placeholder="" value="<?php echo $config['connect']['qq']['secret']; ?>" class="layui-input">
                        </div>
                    </div>


                    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
                        <legend><?php echo lang('admin/system/configconnect/wx'); ?> <a target="_blank" href="https://open.weixin.qq.com/?maccms" class="layui-btn layui-btn-primary"><?php echo lang('admin/system/configconnect/go_reg'); ?></a></legend>
                    </fieldset>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('status'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="radio" name="connect[weixin][status]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['connect']['weixin']['status'] != 1): ?>checked <?php endif; ?>>
                            <input type="radio" name="connect[weixin][status]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['connect']['weixin']['status'] == 1): ?>checked <?php endif; ?>>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">APP_KEY：</label>
                        <div class="layui-input-block">
                            <input type="text" name="connect[weixin][key]" placeholder="" value="<?php echo $config['connect']['weixin']['key']; ?>" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">APP_SECRET：</label>
                        <div class="layui-input-block">
                            <input type="text" name="connect[weixin][secret]" placeholder="" value="<?php echo $config['connect']['weixin']['secret']; ?>" class="layui-input">
                        </div>
                    </div>


            </div>
            </div>

        </div>
        <div class="layui-form-item center">
            <div class="layui-input-block">
                <button type="submit" class="layui-btn" lay-submit="" lay-filter="formSubmit"><?php echo lang('btn_save'); ?></button>
                <button class="layui-btn layui-btn-warm" type="reset"><?php echo lang('btn_reset'); ?></button>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript" src="/static//js/admin_common.js?<?php echo $MAC_VERSION; ?>"></script>
<script type="text/javascript">

</script>

</body>
</html>