<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:81:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view/topic/index.html";i:1741746097;s:81:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view/public/head.html";i:1741746097;s:81:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view/public/foot.html";i:1741746097;}*/ ?>
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

    <div class="my-toolbar-box" >

        <div class="center mb10">
            <form class="layui-form " method="post" action="<?php echo url('data'); ?>">
                <div class="layui-input-inline w150">
                    <select name="status">
                        <option value=""><?php echo lang('select_status'); ?></option>
                        <option value="0" <?php if($param['status'] == '0'): ?>selected <?php endif; ?>><?php echo lang('reviewed_not'); ?></option>
                        <option value="1" <?php if($param['status'] == '1'): ?>selected <?php endif; ?>><?php echo lang('reviewed'); ?></option>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <input type="text" autocomplete="off" placeholder="<?php echo lang('wd'); ?>" class="layui-input" name="wd" value="<?php echo mac_filter_xss($param['wd']); ?>">
                </div>
                <button class="layui-btn mgl-20 j-search" ><?php echo lang('btn_search'); ?></button>
            </form>
        </div>
        <div class="layui-btn-group">
            <a data-full="1" data-href="<?php echo url('info'); ?>" class="layui-btn layui-btn-primary j-iframe"><i class="layui-icon">&#xe654;</i><?php echo lang('add'); ?></a>
            <a data-href="<?php echo url('del'); ?>" class="layui-btn layui-btn-primary j-page-btns confirm"><i class="layui-icon">&#xe640;</i><?php echo lang('del'); ?></a>
            <a data-href="<?php echo url('index/select'); ?>?tab=topic&col=topic_level&tpl=select_level&url=topic/field" data-width="270" data-height="100" data-checkbox="1" class="layui-btn layui-btn-primary j-select"><i class="layui-icon">&#xe620;</i><?php echo lang('level'); ?></a>
            <a data-href="<?php echo url('index/select'); ?>?tab=topic&col=topic_status&tpl=select_status&url=topic/field" data-width="470" data-height="100" data-checkbox="1" class="layui-btn layui-btn-primary j-select"><i class="layui-icon">&#xe620;</i><?php echo lang('status'); ?></a>
            <a class="layui-btn layui-btn-primary j-iframe" data-href="<?php echo url('images/opt?tab=topic'); ?>" href="javascript:;" title="<?php echo lang('pic_sync'); ?>"><i class="layui-icon">&#xe620;</i><?php echo lang('pic_sync'); ?></a>
        </div>
    </div>

    <form class="layui-form" method="post" id="pageListForm" >
        <table class="layui-table" lay-size="sm">
            <thead>
            <tr>
                <th width="25"><input type="checkbox" lay-skin="primary" lay-filter="allChoose"></th>
                <th width="100"><?php echo lang('id'); ?></th>
                <th ><?php echo lang('name'); ?></th>
                <th width="30"><?php echo lang('hits'); ?></th>
                <th width="30"><?php echo lang('score'); ?></th>
                <th width="30"><?php echo lang('level'); ?></th>
                <th width="30"><?php echo lang('browse'); ?></th>
                <th width="150"><?php echo lang('update_time'); ?></th>
                <th width="100"><?php echo lang('opt'); ?></th>
            </tr>
            </thead>

            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
                <td><input type="checkbox" name="ids[]" value="<?php echo $vo['topic_id']; ?>" class="layui-checkbox checkbox-ids" lay-skin="primary"></td>
                <td><?php echo $vo['topic_id']; ?></td>
                <td><a target="_blank" class="layui-badge-rim " href="<?php echo mac_url_topic_detail($vo); ?>"><?php echo htmlspecialchars($vo['topic_name']); ?></a> <?php if($vo['topic_status'] == 0): ?> <span class="layui-badge"><?php echo lang('reviewed_not'); ?></span><?php endif; ?> </td>
                <td><?php echo $vo['topic_hits']; ?></td>
                <td><?php echo $vo['topic_score']; ?></td>
                <td><a data-href="<?php echo url('index/select'); ?>?tab=topic&col=topic_level&tpl=select_level&url=topic/field&ids=<?php echo $vo['topic_id']; ?>" data-width="270" data-height="100" class=" j-select"><span class="layui-badge layui-bg-orange"><?php echo $vo['topic_level']; ?></span></a></td>
                <td><?php if($vo['ismake'] == 1): ?><a target="_blank" class="layui-badge layui-bg-green " href="<?php echo mac_url_topic_detail($vo); ?>">Y</a><?php else: ?><a class="layui-badge" href="<?php echo url('make/make?ac=topic_info'); ?>?topic=<?php echo $vo['topic_id']; ?>&ref=1">N</a><?php endif; ?></td>
                <td><?php echo mac_day($vo['topic_time'],'color'); ?></td>
                <td>
                    <a class="layui-badge-rim j-iframe" data-full="1" data-href="<?php echo url('info?id='.$vo['topic_id']); ?>" href="javascript:;" title="<?php echo lang('edit'); ?>"><?php echo lang('edit'); ?></a>
                    <a class="layui-badge-rim j-tr-del" data-href="<?php echo url('del?ids='.$vo['topic_id']); ?>" href="javascript:;" title="<?php echo lang('del'); ?>"><?php echo lang('del'); ?></a>
                </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
        <div id="pages" class="center"></div>
    </form>
</div>

<script type="text/javascript" src="/static//js/admin_common.js?<?php echo $MAC_VERSION; ?>"></script>

<script type="text/javascript">
    var curUrl="<?php echo url('topic/data',$param); ?>";
    layui.use(['laypage', 'layer','form'], function() {
        var laypage = layui.laypage
                , layer = layui.layer,
                form = layui.form;

        laypage.render({
            elem: 'pages'
            ,count: <?php echo $total; ?>
            ,limit: <?php echo $limit; ?>
            ,curr: <?php echo $page; ?>
            ,layout: ['count', 'prev', 'page', 'next', 'limit', 'skip']
            ,jump: function(obj,first){
                if(!first){
                    location.href = curUrl.replace('%7Bpage%7D',obj.curr).replace('%7Blimit%7D',obj.limit);
                }
            }
        });


    });
</script>
</body>
</html>