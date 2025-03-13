<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:80:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view/type/index.html";i:1741746097;s:81:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view/public/head.html";i:1741746097;s:81:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view/public/foot.html";i:1741746097;}*/ ?>
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

    <div class="my-toolbar-box">
        <div class="layui-btn-group">
            <a data-full="1" data-href="<?php echo url('info'); ?>" class="layui-btn layui-btn-primary j-iframe"><i class="layui-icon">&#xe654;</i><?php echo lang('add'); ?></a>
            <a data-href="<?php echo url('batch'); ?>" class="layui-btn layui-btn-primary j-page-btns confirm"><i class="layui-icon">&#xe642;</i><?php echo lang('edit'); ?></a>
            <a data-href="<?php echo url('del'); ?>" class="layui-btn layui-btn-primary j-page-btns confirm"><i class="layui-icon">&#xe640;</i><?php echo lang('del'); ?></a>
            <a data-href="<?php echo url('index/select'); ?>?tab=type&col=type_status&tpl=select_status&url=type/field" data-width="470" data-height="100" data-checkbox="1" class="layui-btn layui-btn-primary j-select"><i class="layui-icon">&#xe620;</i><?php echo lang('status'); ?></a>
            <a data-href="<?php echo url('index/select'); ?>?tab=type&col=type_status&tpl=select_type&url=type/move" data-width="470" data-height="100" data-checkbox="1" class="layui-btn layui-btn-primary j-select"><i class="layui-icon">&#xe620;</i><?php echo lang('transfer'); ?></a>
        </div>

    </div>

    <form class="layui-form " method="post" id="pageListForm">
        <table class="layui-table" lay-size="sm">
        <thead>
            <tr>
                <th width="25"><input type="checkbox" lay-skin="primary" lay-filter="allChoose"></th>
                <th><?php echo lang('name'); ?></th>
                <th width="50"><?php echo lang('status'); ?></th>
                <th width="40"><?php echo lang('genre'); ?></th>
                <th width="40"><?php echo lang('sort'); ?></th>
                <th width="80"><?php echo lang('name'); ?></th>
                <th width="120"><?php echo lang('en'); ?></th>
                <th width="100"><?php echo lang('admin/type/type_tpl'); ?></th>
                <th width="100"><?php echo lang('admin/type/show_tpl'); ?></th>
                <th width="100"><?php echo lang('admin/type/detail_tpl'); ?></th>
                <th width="130"><?php echo lang('opt'); ?></th>
            </tr>
            </thead>

            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
                <td><input type="checkbox" name="ids[]" value="<?php echo $vo['type_id']; ?>" class="layui-checkbox checkbox-ids" lay-skin="primary"></td>
                <td><?php echo $vo['type_id']; ?>、<a target="_blank" class="layui-badge-rim " href="<?php echo mac_url_type($vo); ?>"><?php echo $vo['type_name']; ?></a> <span class="layui-badge"><?php echo $vo['cc']; ?></span></td>
                <td>
                    <input type="checkbox" name="status" <?php if($vo['type_status'] == 1): ?>checked<?php endif; ?> value="<?php echo $vo['type_status']; ?>" lay-skin="switch" lay-filter="switchStatus" lay-text="<?php echo lang('open'); ?>|<?php echo lang('close'); ?>" data-href="<?php echo url('field?col=type_status&ids='.$vo['type_id']); ?>">
                </td>
                <td>
                    <span class="label label-success radius	"><?php echo mac_get_mid_text($vo['type_mid']); ?></span>
                </td>
                <td><input type="input" name="type_sort_<?php echo $vo['type_id']; ?>" value="<?php echo $vo['type_sort']; ?>" class="layui-input"></td>
                <td><input type="input" name="type_name_<?php echo $vo['type_id']; ?>" value="<?php echo $vo['type_name']; ?>" class="layui-input"></td>
                <td><input type="input" name="type_en_<?php echo $vo['type_id']; ?>" value="<?php echo $vo['type_en']; ?>" class="layui-input"></td>
                <td><input type="input" name="type_tpl_<?php echo $vo['type_id']; ?>" value="<?php echo $vo['type_tpl']; ?>" class="layui-input"></td>
                <td><input type="input" name="type_tpl_list_<?php echo $vo['type_id']; ?>" value="<?php echo $vo['type_tpl_list']; ?>" class="layui-input"></td>
                <td><input type="input" name="type_tpl_detail_<?php echo $vo['type_id']; ?>" value="<?php echo $vo['type_tpl_detail']; ?>" class="layui-input"></td>
                <td>
                    <a class="layui-badge-rim j-iframe" data-full="1" data-href="<?php echo url('info?id='.$vo['type_id']); ?>" href="javascript:;" title="<?php echo lang('edit'); ?>"><?php echo lang('edit'); ?></a>
                    <a class="layui-badge-rim j-tr-del" data-href="<?php echo url('del?ids='.$vo['type_id']); ?>" href="javascript:;" title="<?php echo lang('del'); ?>"><?php echo lang('del'); ?></a>
                    <a class="layui-badge-rim j-iframe" data-full="1" data-href="<?php echo url('info'); ?>?pid=<?php echo $vo['type_id']; ?>" href="javascript:;" title="<?php echo lang('add'); ?>"><?php echo lang('add'); ?></a>
                </td>
            </tr>
            <?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ch): $mod = ($i % 2 );++$i;?>
            <tr>
                <td><input type="checkbox" name="ids[]" value="<?php echo $ch['type_id']; ?>" class="layui-checkbox checkbox-ids" lay-skin="primary"></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;├&nbsp;<?php echo $ch['type_id']; ?>、<a target="_blank" class="layui-badge-rim " href="<?php echo mac_url_type($ch); ?>"><?php echo $ch['type_name']; ?></a> <span class="layui-badge"><?php echo $ch['cc']; ?></span></td>
                <td>
                    <input type="checkbox" name="status" <?php if($ch['type_status'] == 1): ?>checked<?php endif; ?> value="<?php echo $ch['type_status']; ?>" lay-skin="switch" lay-filter="switchStatus" lay-text="<?php echo lang('open'); ?>|<?php echo lang('close'); ?>" data-href="<?php echo url('field?col=type_status&ids='.$ch['type_id']); ?>">
                </td>
                <td>
                    <span class="label label-success radius	"><?php echo mac_get_mid_text($ch['type_mid']); ?></span>
                </td>
                <td><input type="input" name="type_sort_<?php echo $ch['type_id']; ?>" value="<?php echo $ch['type_sort']; ?>" class="layui-input"></td>
                <td><input type="input" name="type_name_<?php echo $ch['type_id']; ?>" value="<?php echo $ch['type_name']; ?>" class="layui-input"></td>
                <td><input type="input" name="type_en_<?php echo $ch['type_id']; ?>" value="<?php echo $ch['type_en']; ?>" class="layui-input"></td>
                <td><input type="input" name="type_tpl_<?php echo $ch['type_id']; ?>" value="<?php echo $ch['type_tpl']; ?>" class="layui-input"></td>
                <td><input type="input" name="type_tpl_list_<?php echo $ch['type_id']; ?>" value="<?php echo $ch['type_tpl_list']; ?>" class="layui-input"></td>
                <td><input type="input" name="type_tpl_detail_<?php echo $ch['type_id']; ?>" value="<?php echo $ch['type_tpl_detail']; ?>" class="layui-input"></td>
                <td>
                    <a class="layui-badge-rim j-iframe" data-full="1" data-href="<?php echo url('info?id='.$ch['type_id']); ?>" href="javascript:;" title="<?php echo lang('edit'); ?>"><?php echo lang('edit'); ?></a>
                    <a class="layui-badge-rim j-tr-del" data-href="<?php echo url('del?ids='.$ch['type_id']); ?>" href="javascript:;" title="<?php echo lang('del'); ?>"><?php echo lang('del'); ?></a>
                </td>
            </tr>


            <?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>

    </form>
</div>

<script type="text/javascript" src="/static//js/admin_common.js?<?php echo $MAC_VERSION; ?>"></script>

<script type="text/javascript">

    layui.use(['laypage', 'layer'], function() {
        var laypage = layui.laypage
                , layer = layui.layer;


    });
</script>
</body>
</html>