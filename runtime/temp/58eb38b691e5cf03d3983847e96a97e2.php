<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:82:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view/timming/info.html";i:1629786420;s:81:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view/public/head.html";i:1629786412;s:81:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view/public/foot.html";i:1629786412;}*/ ?>
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
<div class="page-container p10">
    <form class="layui-form layui-form-pane" method="post" action="">
        <input type="hidden" name="__token__" value="<?php echo \think\Request::instance()->token(); ?>" />
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('status'); ?>：</label>
                        <div class="layui-input-inline">
                            <input name="status" type="radio" id="rad-1" value="0" title="<?php echo lang('disable'); ?>" <?php if($info['status'] != 1): ?>checked <?php endif; ?>>
                            <input name="status" type="radio" id="rad-2" value="1" title="<?php echo lang('enable'); ?>" <?php if($info['status'] == 1): ?>checked <?php endif; ?>>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('name'); ?>：</label>
                        <div class="layui-input-inline w500">
                            <input type="text" class="layui-input" value="<?php echo $info['name']; ?>" placeholder="<?php echo lang('admin/timming/unique_id'); ?>" id="name" name="name" <?php if($info['name'] != ''): ?> readonly="readonly"<?php endif; ?>>
                        </div>
                        <div class="layui-form-mid layui-word-aux"><?php echo lang('admin/timming/call_method'); ?>/api.php/timming/index?name=<?php echo $info['name']; ?></div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('remarks'); ?>：</label>
                        <div class="layui-input-inline w500">
                            <input type="text" class="layui-input" value="<?php echo $info['des']; ?>" placeholder="" id="des" name="des">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/timming/exec_file'); ?>：</label>
                        <div class="layui-input-inline w500">
                            <select class="" name="file">
                                <option value="collect" <?php if($info['file'] == 'collect'): ?>selected<?php endif; ?>><?php echo lang('admin/timming/collect'); ?></option>
                                <option value="make" <?php if($info['file'] == 'make'): ?>selected<?php endif; ?>><?php echo lang('admin/timming/make'); ?></option>
                                <option value="cj" <?php if($info['file'] == 'cj'): ?>selected<?php endif; ?>><?php echo lang('admin/timming/cj'); ?></option>
                                <option value="cache" <?php if($info['file'] == 'cache'): ?>selected<?php endif; ?>><?php echo lang('admin/timming/cache'); ?></option>
                                <option value="urlsend" <?php if($info['file'] == 'urlsend'): ?>selected<?php endif; ?>><?php echo lang('admin/timming/urlsend'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/timming/attach_param'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="text" class="layui-input" value="<?php echo $info['param']; ?>" placeholder="<?php echo lang('admin/timming/attach_param_tip'); ?>" id="param" name="param">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/timming/exec_cycle'); ?>：</label>
                        <div class="layui-input-block role-list-form">
                            <input type="checkbox" name="weeks[]" class="layui-checkbox" lay-skin="primary" value="1" title="<?php echo lang('monday'); ?>" <?php if(strpos($info['weeks'],'1')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="weeks[]" class="layui-checkbox" lay-skin="primary" value="2" title="<?php echo lang('tuesday'); ?>" <?php if(strpos($info['weeks'],'2')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="weeks[]" class="layui-checkbox" lay-skin="primary" value="3" title="<?php echo lang('wednesday'); ?>" <?php if(strpos($info['weeks'],'3')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="weeks[]" class="layui-checkbox" lay-skin="primary" value="4" title="<?php echo lang('thursday'); ?>" <?php if(strpos($info['weeks'],'4')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="weeks[]" class="layui-checkbox" lay-skin="primary" value="5" title="<?php echo lang('friday'); ?>" <?php if(strpos($info['weeks'],'5')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="weeks[]" class="layui-checkbox" lay-skin="primary" value="6" title="<?php echo lang('saturday'); ?>" <?php if(strpos($info['weeks'],'6')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="weeks[]" class="layui-checkbox" lay-skin="primary" value="0" title="<?php echo lang('sunday'); ?>" <?php if(strpos($info['weeks'],'0')!==false): ?>checked<?php endif; ?>>

                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/timming/exec_time'); ?>：</label>
                        <div class="layui-input-block role-list-form">
                            <input type="checkbox" name="hours[]" class="layui-checkbox" lay-skin="primary" value="00" title="00" <?php if(strpos($info['hours'],'00')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="hours[]" class="layui-checkbox" lay-skin="primary" value="01" title="01" <?php if(strpos($info['hours'],'01')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="hours[]" class="layui-checkbox" lay-skin="primary" value="02" title="02" <?php if(strpos($info['hours'],'02')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="hours[]" class="layui-checkbox" lay-skin="primary" value="03" title="03" <?php if(strpos($info['hours'],'03')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="hours[]" class="layui-checkbox" lay-skin="primary" value="04" title="04" <?php if(strpos($info['hours'],'04')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="hours[]" class="layui-checkbox" lay-skin="primary" value="05" title="05" <?php if(strpos($info['hours'],'05')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="hours[]" class="layui-checkbox" lay-skin="primary" value="06" title="06" <?php if(strpos($info['hours'],'06')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="hours[]" class="layui-checkbox" lay-skin="primary" value="07" title="07" <?php if(strpos($info['hours'],'07')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="hours[]" class="layui-checkbox" lay-skin="primary" value="08" title="08" <?php if(strpos($info['hours'],'08')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="hours[]" class="layui-checkbox" lay-skin="primary" value="09" title="09" <?php if(strpos($info['hours'],'09')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="hours[]" class="layui-checkbox" lay-skin="primary" value="10" title="10" <?php if(strpos($info['hours'],'10')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="hours[]" class="layui-checkbox" lay-skin="primary" value="11" title="11" <?php if(strpos($info['hours'],'11')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="hours[]" class="layui-checkbox" lay-skin="primary" value="12" title="12" <?php if(strpos($info['hours'],'12')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="hours[]" class="layui-checkbox" lay-skin="primary" value="13" title="13" <?php if(strpos($info['hours'],'13')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="hours[]" class="layui-checkbox" lay-skin="primary" value="14" title="14" <?php if(strpos($info['hours'],'14')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="hours[]" class="layui-checkbox" lay-skin="primary" value="15" title="15" <?php if(strpos($info['hours'],'15')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="hours[]" class="layui-checkbox" lay-skin="primary" value="16" title="16" <?php if(strpos($info['hours'],'16')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="hours[]" class="layui-checkbox" lay-skin="primary" value="17" title="17" <?php if(strpos($info['hours'],'17')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="hours[]" class="layui-checkbox" lay-skin="primary" value="18" title="18" <?php if(strpos($info['hours'],'18')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="hours[]" class="layui-checkbox" lay-skin="primary" value="19" title="19" <?php if(strpos($info['hours'],'19')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="hours[]" class="layui-checkbox" lay-skin="primary" value="20" title="20" <?php if(strpos($info['hours'],'20')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="hours[]" class="layui-checkbox" lay-skin="primary" value="21" title="21" <?php if(strpos($info['hours'],'21')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="hours[]" class="layui-checkbox" lay-skin="primary" value="22" title="22" <?php if(strpos($info['hours'],'22')!==false): ?>checked<?php endif; ?>>
                            <input type="checkbox" name="hours[]" class="layui-checkbox" lay-skin="primary" value="23" title="23" <?php if(strpos($info['hours'],'23')!==false): ?>checked<?php endif; ?>>
                        </div>
                    </div>
        

        <div class="layui-form-item center">
            <div class="layui-input-block">
                <button type="button" class="layui-btn layui-btn-normal formCheckAll" lay-filter="formCheckAll" ><?php echo lang('check_all'); ?></button>
                <button type="button" class="layui-btn layui-btn-normal formCheckOther" lay-filter="formCheckOther"><?php echo lang('check_other'); ?></button>

                <button type="submit" class="layui-btn" lay-submit="" lay-filter="formSubmit" data-child="true"><?php echo lang('btn_save'); ?></button>
                <button class="layui-btn layui-btn-warm" type="reset"><?php echo lang('btn_reset'); ?></button>
            </div>
        </div>
    </form>

</div>
<script type="text/javascript" src="/static//js/admin_common.js?<?php echo $MAC_VERSION; ?>"></script>
<script type="text/javascript">

    layui.use(['form', 'layer'], function () {
        // 操作对象
        var form = layui.form
                , layer = layui.layer
                , $ = layui.jquery;

        // 验证
        form.verify({
            show: function (value) {
                if (value == "") {
                    return "<?php echo lang('name_empty'); ?>";
                }
            }
        });

        $('.formCheckAll').click(function(){
            var child = $('.role-list-form').find('input');
            /* 自动选中子节点 */
            child.each(function(index, item) {
                item.checked = true;
            });
            form.render('checkbox');
        });
        $('.formCheckOther').click(function(){
            var child = $('.role-list-form').find('input');
            /* 自动选中子节点 */
            child.each(function(index, item) {
                item.checked = (item.checked  ? false : true);
            });
            form.render('checkbox');
        });


    });
</script>

</body>
</html>