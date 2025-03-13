<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:89:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view/public/select_state.html";i:1741746097;}*/ ?>
<form class="layui-form m10" method="post" action="<?php echo $url; ?>">
    <input type="hidden" name="col" value="<?php echo $col; ?>">
    <input type="hidden" name="ids" value="<?php echo $ids; ?>">

    <div class="layui-input-inline w150">
        <select name="val">
            <option value=""><?php echo lang('select_opt'); ?></option>
            <option value="0" ><?php echo lang('disable'); ?></option>
            <option value="1" ><?php echo lang('enable'); ?></option>
        </select>
    </div>
    <div class="layui-input-inline">
        <button type="submit" class="layui-btn" lay-submit="" refresh="<?php echo $refresh; ?>" lay-filter="formSubmit"><?php echo lang('btn_save'); ?></button>
    </div>
</form>

