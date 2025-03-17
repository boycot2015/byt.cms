<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:92:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view/system/configinterface.html";i:1629786416;s:81:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view/public/head.html";i:1629786412;s:81:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view/public/foot.html";i:1629786412;}*/ ?>
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
                <li class="layui-this"><?php echo lang('admin/system/configinterface/title'); ?></li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">

                    <blockquote class="layui-elem-quote layui-quote-nm">
                        <?php echo lang('admin/system/configinterface/tip'); ?>
                    </blockquote>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configinterface/status'); ?>：</label>
                    <div class="layui-input-block">
                        <input type="radio" name="interface[status]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['interface']['status'] != 1): ?>checked <?php endif; ?>>
                        <input type="radio" name="interface[status]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['interface']['status'] == 1): ?>checked <?php endif; ?>>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configinterface/pass'); ?>：</label>
                    <div class="layui-input-inline w400">
                        <input type="text" name="interface[pass]" placeholder="" value="<?php echo $config['interface']['pass']; ?>" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux"><?php echo lang('admin/system/configinterface/pass_tip'); ?></div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configinterface/vod_type'); ?>：</label>
                    <div class="layui-input-inline" style="width:230px;!important;">
                        <textarea name="interface[vodtype]" class="layui-textarea" rows="20" ><?php echo mac_replace_text($config['interface']['vodtype']); ?></textarea>
                    </div>
                    <label class="layui-form-label"><?php echo lang('admin/system/configinterface/art_type'); ?>：</label>
                    <div class="layui-input-inline" style="width:230px;!important;">
                        <textarea name="interface[arttype]" class="layui-textarea" rows="20" ><?php echo mac_replace_text($config['interface']['arttype']); ?></textarea>
                    </div>
                    <label class="layui-form-label"><?php echo lang('admin/system/configinterface/actor_type'); ?>：</label>
                    <div class="layui-input-inline" style="width:230px;!important;">
                        <textarea name="interface[actortype]" class="layui-textarea" rows="20" ><?php echo mac_replace_text($config['interface']['actortype']); ?></textarea>
                    </div>
                    <label class="layui-form-label"><?php echo lang('admin/system/configinterface/website_type'); ?>：</label>
                    <div class="layui-input-inline" style="width:230px;!important;">
                        <textarea name="interface[websitetype]" class="layui-textarea" rows="20" ><?php echo mac_replace_text($config['interface']['websitetype']); ?></textarea>
                    </div>
                </div>

                <div class="layui-form-item">

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