<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:86:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view/system/configpay.html";i:1629786416;s:81:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view/public/head.html";i:1629786412;s:81:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view/public/foot.html";i:1629786412;}*/ ?>
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
        <div class="layui-tab" lay-filter="tb1">
            <ul class="layui-tab-title">
                <li class="layui-this" lay-id="configpay_1"><?php echo lang('admin/system/configpay/title'); ?></li>
                <li lay-id="configpay_2"><?php echo lang('admin/system/configpay/card'); ?></li>
                <?php if(is_array($extends['ext_list']) || $extends['ext_list'] instanceof \think\Collection || $extends['ext_list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $extends['ext_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li data-key="<?php echo $key; ?>" lay-id="configpay_<?php echo $i+2; ?>"><?php echo $vo; ?></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                
            </ul>
            <div class="layui-tab-content">

                <div class="layui-tab-item layui-show">

                    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
                        <legend><?php echo lang('admin/system/configpay/config'); ?></legend>
                    </fieldset>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configpay/notify'); ?>：</label>
                        <div class="layui-input-inline w400">
                            <input type="text" readonly="readonly" value="<?php echo $http_type; ?><?php echo $config['site']['site_url']; ?>/index.php/payment/notify.html" class="layui-input">
                        </div>
                        <div class="layui-form-mid layui-word-aux"><?php echo lang('admin/system/configpay/notify_tip'); ?></div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configpay/min'); ?>：</label>
                        <div class="layui-input-inline w400">
                            <input type="text" name="pay[min]" placeholder="" value="<?php echo $config['pay']['min']; ?>" class="layui-input">
                        </div>
                        <div class="layui-form-mid layui-word-aux"><?php echo lang('admin/system/configpay/min_tip'); ?></div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configpay/scale'); ?>：</label>
                        <div class="layui-input-inline w400">
                            <input type="text" name="pay[scale]" placeholder="" value="<?php echo $config['pay']['scale']; ?>" class="layui-input">
                        </div>
                        <div class="layui-form-mid layui-word-aux"><?php echo lang('admin/system/configpay/scale_tip'); ?></div>
                    </div>
                </div>

                <div class="layui-tab-item ">

                    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
                        <legend><?php echo lang('admin/system/configpay/card_config'); ?></legend>
                    </fieldset>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configpay/card_url'); ?>：</label>
                        <div class="layui-input-inline w400">
                            <input type="text" name="pay[card][url]" placeholder="" value="<?php echo $config['pay']['card']['url']; ?>" class="layui-input">
                        </div>
                        <div class="layui-form-mid layui-word-aux"><?php echo lang('admin/system/configpay/card_url_tip'); ?></div>
                    </div>
                </div>

                <?php echo $extends['ext_html']; ?>

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
<script type="text/javascript" src="/static//js/jquery.cookie.js"></script>
<script type="text/javascript">
    layui.use(['element', 'form', 'layer'], function() {
        var element = layui.element
            ,form = layui.form
            , layer = layui.layer;


        element.on('tab(tb1)', function(){
            $.cookie('configpay_tab', this.getAttribute('lay-id'));
        });

        if( $.cookie('configpay_tab') !=null ) {
            element.tabChange('tb1', $.cookie('configpay_tab'));
        }

    });
</script>

</body>
</html>