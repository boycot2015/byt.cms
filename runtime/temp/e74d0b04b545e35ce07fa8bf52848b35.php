<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:87:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view/extend/pay/alipay.html";i:1629786406;}*/ ?>
<div class="layui-tab-item ">

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>支付宝设置 <a target="_blank" href="https://open.alipay.com/?maccms" class="layui-btn layui-btn-primary">点击进入注册</a></legend>
    </fieldset>

    <div class="layui-form-item">
        <label class="layui-form-label">收款账号：</label>
        <div class="layui-input-inline w400">
            <input type="text" name="pay[alipay][account]" placeholder="" value="<?php echo $config['pay']['alipay']['account']; ?>" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">合作者身份：</label>
        <div class="layui-input-inline w400">
            <input type="text" name="pay[alipay][appid]" placeholder="" value="<?php echo $config['pay']['alipay']['appid']; ?>" class="layui-input">
        </div>
        <div class="layui-form-mid layui-word-aux">appid</div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">安全校验码：</label>
        <div class="layui-input-inline w400">
            <input type="text" name="pay[alipay][appkey]" placeholder="" value="<?php echo $config['pay']['alipay']['appkey']; ?>" class="layui-input">
        </div>
        <div class="layui-form-mid layui-word-aux">appkey</div>
    </div>
</div>