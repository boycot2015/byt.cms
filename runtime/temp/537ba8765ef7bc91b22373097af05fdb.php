<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:88:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view_new/vodplayer/info.html";i:1741746097;s:85:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view_new/public/head.html";i:1741746097;s:85:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view_new/public/foot.html";i:1741746097;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo $title; ?> - <?php echo lang('admin/public/head/title'); ?></title>
    <link rel="stylesheet" href="/static_new//layui/css/layui.css">
    <link rel="stylesheet" href="/static_new//layui/macCmsfont/iconfont.css?<?php echo $MAC_VERSION; ?>">
    <link rel="stylesheet" href="/static_new//css/admin_style.css?<?php echo $MAC_VERSION; ?>">
    <script type="text/javascript" src="/static_new//js/jquery.js"></script>
    <link rel="stylesheet" href="/static_new//css/tailwindcssOutput.css?<?php echo $MAC_VERSION; ?>">
    <script type="text/javascript" src="/static_new//layui/layui.js"></script>
    <script src="/static_new//js/preline.js"></script>
    <script>
        var ROOT_PATH="",ADMIN_PATH="<?php echo $_SERVER['SCRIPT_NAME']; ?>", MAC_VERSION="v10";
    </script>  
</head>
<body>
<div class="page-container p10">
    <form class="layui-form layui-form-pane" method="post" action="">
        <input type="hidden" name="__token__" value="<?php echo \think\Request::instance()->token(); ?>" />
        <div class="layui-tab">
            <ul class="layui-tab-title">
                <li class="layui-this">基本设置</li>
                <li>播放器代码</li>
            </ul>
            <div class="layui-tab-content">

                <div class="layui-tab-item layui-show" id="movementTable">

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('status'); ?>：</label>
                        <div class="layui-input-block">
                            <input name="status" type="radio" id="rad-1" value="0" title="<?php echo lang('disable'); ?>" <?php if($info['status'] != 1): ?>checked <?php endif; ?>>
                            <input name="status" type="radio" id="rad-2" value="1" title="<?php echo lang('enable'); ?>" <?php if($info['status'] == 1): ?>checked <?php endif; ?>>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('code'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="text" class="layui-input" value="<?php echo $info['from']; ?>" placeholder="<?php echo lang('admin/vodplayer/code_tip'); ?>" id="from" name="from" <?php if($info['from'] != ''): ?> readonly="readonly"<?php endif; ?>>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('name'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="text" class="layui-input" value="<?php echo $info['show']; ?>" placeholder="" id="show" name="show">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('remarks'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="text" class="layui-input" value="<?php echo $info['des']; ?>" placeholder="" id="des" name="des">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('target'); ?>：</label>
                        <div class="layui-input-block">
                            <input name="target" type="radio" value="_self" title="<?php echo lang('current'); ?>" <?php if($info['target'] != '_blank'): ?>checked <?php endif; ?>>
                            <input name="target" type="radio" value="_blank" title="<?php echo lang('blank'); ?>" <?php if($info['target'] == '_blank'): ?>checked <?php endif; ?>>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('status_parse'); ?>：</label>
                        <div class="layui-input-block">
                            <input name="ps" type="radio" value="0" title="<?php echo lang('disable'); ?>" <?php if($info['ps'] != 1): ?>checked <?php endif; ?>>
                            <input name="ps" type="radio" value="1" title="<?php echo lang('enable'); ?>" <?php if($info['ps'] == 1): ?>checked <?php endif; ?>>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/vodplayer/api_url'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="text" class="layui-input" value="<?php echo $info['parse']; ?>" placeholder="<?php echo lang('admin/vodplayer/api_url_tip'); ?>" id="parse" name="parse">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('sort'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="text" class="layui-input" value="<?php echo $info['sort']; ?>" placeholder="<?php echo lang('admin/vodplayer/sort_tip'); ?>" id="sort" name="sort">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('tip'); ?>：</label>
                        <div class="layui-input-block">
                            <textarea name="tip" cols="" style="height:50px;min-height:50px;" class="layui-textarea"  placeholder="" ><?php echo $info['tip']; ?></textarea>
                        </div>
                    </div>
              </div>
                <div class="layui-tab-item" id="movementTable">
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('file'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="text" class="layui-input" value="/static/player/<?php echo $info['from']; ?>.js" disabled="disabled">

                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('code'); ?>：</label>
                        <div class="layui-input-block">
                            <textarea name="code" cols="" rows="20" class="layui-textarea"  placeholder="" ><?php echo $info['code']; ?></textarea>
                        </div>
                    </div>
                </div>

        <div class="layui-form-item center">
            <div class="layui-input-block">
                <button type="submit" class="layui-btn" lay-submit="" lay-filter="formSubmit" data-child="true"><?php echo lang('btn_save'); ?></button>
                <button class="layui-btn layui-btn-primary" type="reset"><?php echo lang('btn_reset'); ?></button>
            </div>
        </div>
    </form>

</div>
<script type="text/javascript" src="/static_new//js/admin_common.js?<?php echo $MAC_VERSION; ?>"></script>
<script type="text/javascript">

    layui.use(['form', 'layer'], function () {
        // 操作对象
        var form = layui.form
                , layer = layui.layer
                , $ = layui.jquery;

        // 验证
        form.verify({
            from: function (value) {
                if (value == "") {
                    return "<?php echo lang('admin/vodplayer/code_empty'); ?>";
                }
            },
            show: function (value) {
                if (value == "") {
                    return "<?php echo lang('name_empty'); ?>";
                }
            }
        });


    });
</script>

</body>
</html>