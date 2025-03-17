<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view/extend/pay/epay.html";i:1698594650;}*/ ?>
<div class="layui-tab-item">

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>易支付设置</legend>
    </fieldset>

    <div class="layui-form-item">
        <label class="layui-form-label">接口地址：</label>
        <div class="layui-input-inline w400">
            <input type="text" name="pay[epay][api_url]" value="<?php echo $config['pay']['epay']['api_url']; ?>" class="layui-input" placeholder="需保留前面http(s)://和后面/">
        </div>
        <div class="layui-form-mid layui-word-aux">如: https://www.epay.com/</div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">商户号：</label>
        <div class="layui-input-inline w400">
            <input type="text" name="pay[epay][appid]" placeholder="" value="<?php echo $config['pay']['epay']['appid']; ?>" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">密钥：</label>
        <div class="layui-input-inline w400">
            <input type="text" name="pay[epay][appkey]" placeholder="" value="<?php echo $config['pay']['epay']['appkey']; ?>" class="layui-input">
        </div>
    </div>
</div>
