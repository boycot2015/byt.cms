<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:90:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view/system/configcollect.html";i:1741746097;s:81:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view/public/head.html";i:1741746097;s:81:"/Users/boycott/Desktop/my-project/byt.cms/application/admin/view/public/foot.html";i:1741746097;}*/ ?>
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
<style>
    .layui-form-pane .layui-form-label { width:140px; }
    .layui-form-pane .layui-input-block { margin-left:140px; }
</style>
<div class="page-container">
    <form class="layui-form layui-form-pane" action="">
        <input type="hidden" name="__token__" value="<?php echo \think\Request::instance()->token(); ?>" />
        <div class="layui-tab" lay-filter="tb1">
            <ul class="layui-tab-title">
                <li class="layui-this" lay-id="configcollect_1"><?php echo lang('admin/system/configcollect/vod'); ?></li>
                <li lay-id="configcollect_2"><?php echo lang('admin/system/configcollect/art'); ?></li>
                <li lay-id="configcollect_3"><?php echo lang('admin/system/configcollect/actor'); ?></li>
                <li lay-id="configcollect_4"><?php echo lang('admin/system/configcollect/role'); ?></li>
                <li lay-id="configcollect_5"><?php echo lang('admin/system/configcollect/website'); ?></li>
                <li lay-id="configcollect_6"><?php echo lang('admin/system/configcollect/comment'); ?></li>
                <li lay-id="configcollect_7"><?php echo lang('admin/system/configcollect/words'); ?></li>
            </ul>

            <div class="layui-tab-content">

                <div class="layui-tab-item layui-show">

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/status'); ?>：</label>
                    <div class="layui-input-block">
                        <input type="radio" name="collect[vod][status]" value="0" title="<?php echo lang('reviewed_not'); ?>" <?php if($config['collect']['vod']['status'] != 1): ?>checked <?php endif; ?>>
                        <input type="radio" name="collect[vod][status]" value="1" title="<?php echo lang('reviewed'); ?>" <?php if($config['collect']['vod']['status'] == 1): ?>checked <?php endif; ?>>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/hits_rnd'); ?>：</label>
                    <div class="layui-input-inline">
                        <input type="text" name="collect[vod][hits_start]" placeholder="<?php echo lang('min_val'); ?>" value="<?php echo $config['collect']['vod']['hits_start']; ?>" class="layui-input">
                    </div>
                    <div class="layui-input-inline">
                        <input type="text" name="collect[vod][hits_end]" placeholder="<?php echo lang('max_val'); ?>" value="<?php echo $config['collect']['vod']['hits_end']; ?>" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/updown_rnd'); ?>：</label>
                    <div class="layui-input-inline">
                        <input type="text" name="collect[vod][updown_start]" placeholder="<?php echo lang('min_val'); ?>" value="<?php echo $config['collect']['vod']['updown_start']; ?>" class="layui-input">
                    </div>
                    <div class="layui-input-inline">
                        <input type="text" name="collect[vod][updown_end]" placeholder="<?php echo lang('max_val'); ?>" value="<?php echo $config['collect']['vod']['updown_end']; ?>" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/score_rnd'); ?>：</label>
                    <div class="layui-input-inline">
                        <input type="radio" name="collect[vod][score]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['vod']['score'] != 1): ?>checked <?php endif; ?>>
                        <input type="radio" name="collect[vod][score]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['vod']['score'] == 1): ?>checked <?php endif; ?>>
                    </div>
                </div>


                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/sync_pic'); ?>：</label>
                    <div class="layui-input-inline">
                        <input type="radio" name="collect[vod][pic]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['vod']['pic'] != 1): ?>checked <?php endif; ?>>
                        <input type="radio" name="collect[vod][pic]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['vod']['pic'] == 1): ?>checked <?php endif; ?>>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/auto_tag'); ?>：</label>
                    <div class="layui-input-inline">
                        <input type="radio" name="collect[vod][tag]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['vod']['tag'] != 1): ?>checked <?php endif; ?>>
                        <input type="radio" name="collect[vod][tag]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['vod']['tag'] == 1): ?>checked <?php endif; ?>>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/class_filter'); ?>：</label>
                    <div class="layui-input-inline">
                        <input type="radio" name="collect[vod][class_filter]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['vod']['class_filter'] == '0'): ?>checked <?php endif; ?>>
                        <input type="radio" name="collect[vod][class_filter]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['vod']['class_filter'] != '0'): ?>checked <?php endif; ?>>
                    </div>
                    <div class="layui-form-mid layui-word-aux"><?php echo lang('admin/system/configcollect/class_filter_tip'); ?></div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/psename'); ?>：</label>
                    <div class="layui-input-inline">
                        <input type="radio" name="collect[vod][psename]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['vod']['psename'] != 1): ?>checked <?php endif; ?>>
                        <input type="radio" name="collect[vod][psename]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['vod']['psename'] == 1): ?>checked <?php endif; ?>>
                    </div>
                    <div class="layui-form-mid layui-word-aux"><?php echo lang('admin/system/configcollect/psename_tip'); ?></div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/psernd'); ?>：</label>
                    <div class="layui-input-inline">
                        <input type="radio" name="collect[vod][psernd]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['vod']['psernd'] != 1): ?>checked <?php endif; ?>>
                        <input type="radio" name="collect[vod][psernd]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['vod']['psernd'] == 1): ?>checked <?php endif; ?>>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/psesyn'); ?>：</label>
                    <div class="layui-input-inline">
                        <input type="radio" name="collect[vod][psesyn]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['vod']['psesyn'] != 1): ?>checked <?php endif; ?>>
                        <input type="radio" name="collect[vod][psesyn]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['vod']['psesyn'] == 1): ?>checked <?php endif; ?>>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/pseplayer'); ?>：</label>
                    <div class="layui-input-inline">
                        <input type="radio" name="collect[vod][pseplayer]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['vod']['pseplayer'] != 1): ?>checked <?php endif; ?>>
                        <input type="radio" name="collect[vod][pseplayer]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['vod']['pseplayer'] == 1): ?>checked <?php endif; ?>>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/psearea'); ?>：</label>
                    <div class="layui-input-inline">
                        <input type="radio" name="collect[vod][psearea]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['vod']['psearea'] != 1): ?>checked <?php endif; ?>>
                        <input type="radio" name="collect[vod][psearea]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['vod']['psearea'] == 1): ?>checked <?php endif; ?>>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/pselang'); ?>：</label>
                    <div class="layui-input-inline">
                        <input type="radio" name="collect[vod][pselang]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['vod']['pselang'] != 1): ?>checked <?php endif; ?>>
                        <input type="radio" name="collect[vod][pselang]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['vod']['pselang'] == 1): ?>checked <?php endif; ?>>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/urlrole'); ?>：</label>
                    <div class="layui-input-inline">
                        <input type="radio" name="collect[vod][urlrole]" value="0" title="<?php echo lang('replace'); ?>" <?php if($config['collect']['vod']['urlrole'] != 1): ?>checked <?php endif; ?>>
                        <input type="radio" name="collect[vod][urlrole]" value="1" title="<?php echo lang('merge'); ?>" <?php if($config['collect']['vod']['urlrole'] == 1): ?>checked <?php endif; ?>>
                        <!-- <input type="radio" name="collect[vod][urlrole]" value="2" title="<?php echo lang('admin/system/configcollect/urlrole/use_more'); ?>" <?php if($config['collect']['vod']['urlrole'] == 2): ?>checked <?php endif; ?>> -->
                    </div>
                    <div class="layui-form-mid layui-word-aux"><?php echo lang('admin/system/configcollect/urlrole_tip'); ?></div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">
                        <?php echo lang('admin/system/configcollect/inrule'); ?>：</label>
                    <div class="layui-input-block">
                        <input type="checkbox" lay-skin="primary" name="collect[vod][inrule][]" value="a" title="<?php echo lang('name'); ?>" <?php if(strpos($config['collect']['vod']['inrule'],'a') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][inrule][]" value="b" title="<?php echo lang('type'); ?>" <?php if(strpos($config['collect']['vod']['inrule'],'b') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][inrule][]" value="c" title="<?php echo lang('years'); ?>" <?php if(strpos($config['collect']['vod']['inrule'],'c') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][inrule][]" value="d" title="<?php echo lang('area'); ?>" <?php if(strpos($config['collect']['vod']['inrule'],'d') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][inrule][]" value="e" title="<?php echo lang('lang'); ?>" <?php if(strpos($config['collect']['vod']['inrule'],'e') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][inrule][]" value="f" title="<?php echo lang('actor'); ?>" <?php if(strpos($config['collect']['vod']['inrule'],'f') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][inrule][]" value="g" title="<?php echo lang('director'); ?>" <?php if(strpos($config['collect']['vod']['inrule'],'g') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][inrule][]" value="h" title="<?php echo lang('douban_id'); ?>" <?php if(strpos($config['collect']['vod']['inrule'],'h') !==false): ?>checked <?php endif; ?>>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">
                        <?php echo lang('admin/system/configcollect/uprule'); ?>：</label>
                    <div class="layui-input-block">
                        <input type="checkbox" lay-skin="primary" name="collect[vod][uprule][]" value="a" title="<?php echo lang('playurl'); ?>" <?php if(strpos($config['collect']['vod']['uprule'],'a') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][uprule][]" value="b" title="<?php echo lang('downurl'); ?>" <?php if(strpos($config['collect']['vod']['uprule'],'b') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][uprule][]" value="c" title="<?php echo lang('serial'); ?>" <?php if(strpos($config['collect']['vod']['uprule'],'c') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][uprule][]" value="d" title="<?php echo lang('remarks'); ?>" <?php if(strpos($config['collect']['vod']['uprule'],'d') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][uprule][]" value="e" title="<?php echo lang('director'); ?>" <?php if(strpos($config['collect']['vod']['uprule'],'e') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][uprule][]" value="f" title="<?php echo lang('actor'); ?>" <?php if(strpos($config['collect']['vod']['uprule'],'f') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][uprule][]" value="g" title="<?php echo lang('years'); ?>" <?php if(strpos($config['collect']['vod']['uprule'],'g') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][uprule][]" value="h" title="<?php echo lang('area'); ?>" <?php if(strpos($config['collect']['vod']['uprule'],'h') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][uprule][]" value="i" title="<?php echo lang('lang'); ?>" <?php if(strpos($config['collect']['vod']['uprule'],'i') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][uprule][]" value="j" title="<?php echo lang('pic'); ?>" <?php if(strpos($config['collect']['vod']['uprule'],'j') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][uprule][]" value="k" title="<?php echo lang('content'); ?>" <?php if(strpos($config['collect']['vod']['uprule'],'k') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][uprule][]" value="l" title="TAG" <?php if(strpos($config['collect']['vod']['uprule'],'l') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][uprule][]" value="m" title="<?php echo lang('sub'); ?>" <?php if(strpos($config['collect']['vod']['uprule'],'m') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][uprule][]" value="n" title="<?php echo lang('class'); ?>" <?php if(strpos($config['collect']['vod']['uprule'],'n') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][uprule][]" value="o" title="<?php echo lang('writer'); ?>" <?php if(strpos($config['collect']['vod']['uprule'],'o') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][uprule][]" value="p" title="<?php echo lang('version'); ?>" <?php if(strpos($config['collect']['vod']['uprule'],'p') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][uprule][]" value="q" title="<?php echo lang('state'); ?>" <?php if(strpos($config['collect']['vod']['uprule'],'q') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][uprule][]" value="r" title="<?php echo lang('blurb'); ?>" <?php if(strpos($config['collect']['vod']['uprule'],'r') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][uprule][]" value="s" title="<?php echo lang('tv'); ?>" <?php if(strpos($config['collect']['vod']['uprule'],'s') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][uprule][]" value="t" title="<?php echo lang('weekday'); ?>" <?php if(strpos($config['collect']['vod']['uprule'],'t') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][uprule][]" value="u" title="<?php echo lang('total'); ?>" <?php if(strpos($config['collect']['vod']['uprule'],'u') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][uprule][]" value="v" title="<?php echo lang('isend'); ?>" <?php if(strpos($config['collect']['vod']['uprule'],'v') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[vod][uprule][]" value="w" title="<?php echo lang('plot'); ?>" <?php if(strpos($config['collect']['vod']['uprule'],'w') !==false): ?>checked <?php endif; ?>>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/filter'); ?>：</label>
                    <div class="layui-input-block">
                        <textarea name="collect[vod][filter]" class="layui-textarea" placeholder="<?php echo lang('multi_separate_tip'); ?>"><?php echo $config['collect']['vod']['filter']; ?></textarea>
                    </div>
                </div>
            </div>

                <div class="layui-tab-item">

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/status'); ?>：</label>
                    <div class="layui-input-block">
                        <input type="radio" name="collect[art][status]" value="0" title="<?php echo lang('reviewed_not'); ?>" <?php if($config['collect']['art']['status'] != 1): ?>checked <?php endif; ?>>
                        <input type="radio" name="collect[art][status]" value="1" title="<?php echo lang('reviewed'); ?>" <?php if($config['collect']['art']['status'] == 1): ?>checked <?php endif; ?>>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/hits_rnd'); ?>：</label>
                    <div class="layui-input-inline">
                        <input type="text" name="collect[art][hits_start]" placeholder="<?php echo lang('min_val'); ?>" value="<?php echo $config['collect']['art']['hits_start']; ?>" class="layui-input">
                    </div>
                    <div class="layui-input-inline">
                        <input type="text" name="collect[art][hits_end]" placeholder="<?php echo lang('max_val'); ?>" value="<?php echo $config['collect']['art']['hits_end']; ?>" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/updown_rnd'); ?>：</label>
                    <div class="layui-input-inline">
                        <input type="text" name="collect[art][updown_start]" placeholder="<?php echo lang('min_val'); ?>" value="<?php echo $config['collect']['art']['updown_start']; ?>" class="layui-input">
                    </div>
                    <div class="layui-input-inline">
                        <input type="text" name="collect[art][updown_end]" placeholder="<?php echo lang('max_val'); ?>" value="<?php echo $config['collect']['art']['updown_end']; ?>" class="layui-input">
                    </div>
                </div>


                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/score_rnd'); ?>：</label>
                    <div class="layui-input-block">
                        <input type="radio" name="collect[art][score]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['art']['score'] != 1): ?>checked <?php endif; ?>>
                        <input type="radio" name="collect[art][score]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['art']['score'] == 1): ?>checked <?php endif; ?>>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/sync_pic'); ?>：</label>
                    <div class="layui-input-block">
                        <input type="radio" name="collect[art][pic]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['art']['pic'] != 1): ?>checked <?php endif; ?>>
                        <input type="radio" name="collect[art][pic]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['art']['pic'] == 1): ?>checked <?php endif; ?>>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/auto_tag'); ?>：</label>
                    <div class="layui-input-block">
                        <input type="radio" name="collect[art][tag]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['art']['tag'] != 1): ?>checked <?php endif; ?>>
                        <input type="radio" name="collect[art][tag]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['art']['tag'] == 1): ?>checked <?php endif; ?>>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/psernd'); ?>：</label>
                    <div class="layui-input-block">
                        <input type="radio" name="collect[art][psernd]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['art']['psernd'] != 1): ?>checked <?php endif; ?>>
                        <input type="radio" name="collect[art][psernd]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['art']['psernd'] == 1): ?>checked <?php endif; ?>>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/psesyn'); ?>：</label>
                    <div class="layui-input-block">
                        <input type="radio" name="collect[art][psesyn]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['art']['psesyn'] != 1): ?>checked <?php endif; ?>>
                        <input type="radio" name="collect[art][psesyn]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['art']['psesyn'] == 1): ?>checked <?php endif; ?>>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/inrule'); ?>：</label>
                    <div class="layui-input-block">
                        <input type="checkbox" lay-skin="primary" name="collect[art][inrule][]" value="a" title="<?php echo lang('name'); ?>" checked disabled>
                        <input type="checkbox" lay-skin="primary" name="collect[art][inrule][]" value="b" title="<?php echo lang('type'); ?>" <?php if(strpos($config['collect']['art']['inrule'],'b') !==false): ?>checked <?php endif; ?>>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/uprule'); ?>：</label>
                    <div class="layui-input-block">
                        <input type="checkbox" lay-skin="primary" name="collect[art][uprule][]" value="a" title="<?php echo lang('content'); ?>" <?php if(strpos($config['collect']['art']['uprule'],'a') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[art][uprule][]" value="b" title="<?php echo lang('author'); ?>" <?php if(strpos($config['collect']['art']['uprule'],'b') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[art][uprule][]" value="c" title="<?php echo lang('from'); ?>" <?php if(strpos($config['collect']['art']['uprule'],'c') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[art][uprule][]" value="d" title="<?php echo lang('pic'); ?>" <?php if(strpos($config['collect']['art']['uprule'],'d') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[art][uprule][]" value="e" title="TAG" <?php if(strpos($config['collect']['art']['uprule'],'e') !==false): ?>checked <?php endif; ?>>
                        <input type="checkbox" lay-skin="primary" name="collect[art][uprule][]" value="f" title="<?php echo lang('blurb'); ?>" <?php if(strpos($config['collect']['art']['uprule'],'f') !==false): ?>checked <?php endif; ?>>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/filter'); ?>：</label>
                    <div class="layui-input-block">
                        <textarea name="collect[art][filter]" class="layui-textarea" placeholder="<?php echo lang('multi_separate_tip'); ?>"><?php echo $config['collect']['art']['filter']; ?></textarea>
                    </div>
                </div>

            </div>

                <div class="layui-tab-item">

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/status'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="radio" name="collect[actor][status]" value="0" title="<?php echo lang('reviewed_not'); ?>" <?php if($config['collect']['actor']['status'] != 1): ?>checked <?php endif; ?>>
                            <input type="radio" name="collect[actor][status]" value="1" title="<?php echo lang('reviewed'); ?>" <?php if($config['collect']['actor']['status'] == 1): ?>checked <?php endif; ?>>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/hits_rnd'); ?>：</label>
                        <div class="layui-input-inline">
                            <input type="text" name="collect[actor][hits_start]" placeholder="<?php echo lang('min_val'); ?>" value="<?php echo $config['collect']['actor']['hits_start']; ?>" class="layui-input">
                        </div>
                        <div class="layui-input-inline">
                            <input type="text" name="collect[actor][hits_end]" placeholder="<?php echo lang('max_val'); ?>" value="<?php echo $config['collect']['actor']['hits_end']; ?>" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/updown_rnd'); ?>：</label>
                        <div class="layui-input-inline">
                            <input type="text" name="collect[actor][updown_start]" placeholder="<?php echo lang('min_val'); ?>" value="<?php echo $config['collect']['actor']['updown_start']; ?>" class="layui-input">
                        </div>
                        <div class="layui-input-inline">
                            <input type="text" name="collect[actor][updown_end]" placeholder="<?php echo lang('max_val'); ?>" value="<?php echo $config['collect']['actor']['updown_end']; ?>" class="layui-input">
                        </div>
                    </div>


                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/score_rnd'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="radio" name="collect[actor][score]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['actor']['score'] != 1): ?>checked <?php endif; ?>>
                            <input type="radio" name="collect[actor][score]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['actor']['score'] == 1): ?>checked <?php endif; ?>>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/sync_pic'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="radio" name="collect[actor][pic]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['actor']['pic'] != 1): ?>checked <?php endif; ?>>
                            <input type="radio" name="collect[actor][pic]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['actor']['pic'] == 1): ?>checked <?php endif; ?>>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/psernd'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="radio" name="collect[actor][psernd]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['actor']['psernd'] != 1): ?>checked <?php endif; ?>>
                            <input type="radio" name="collect[actor][psernd]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['actor']['psernd'] == 1): ?>checked <?php endif; ?>>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/psesyn'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="radio" name="collect[actor][psesyn]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['actor']['psesyn'] != 1): ?>checked <?php endif; ?>>
                            <input type="radio" name="collect[actor][psesyn]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['actor']['psesyn'] == 1): ?>checked <?php endif; ?>>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/inrule'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="checkbox" lay-skin="primary" name="collect[actor][inrule][]" value="a" title="<?php echo lang('actor_name'); ?>" checked disabled>
                            <input type="checkbox" lay-skin="primary" name="collect[actor][inrule][]" value="c" title="<?php echo lang('type'); ?>" <?php if(strpos($config['collect']['actor']['inrule'],'c') !==false): ?>checked <?php endif; ?>>
                            <input type="checkbox" lay-skin="primary" name="collect[actor][inrule][]" value="b" title="<?php echo lang('sex'); ?>" <?php if(strpos($config['collect']['actor']['inrule'],'b') !==false): ?>checked <?php endif; ?>>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/uprule'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="checkbox" lay-skin="primary" name="collect[actor][uprule][]" value="a" title="<?php echo lang('content'); ?>" <?php if(strpos($config['collect']['actor']['uprule'],'a') !==false): ?>checked <?php endif; ?>>
                            <input type="checkbox" lay-skin="primary" name="collect[actor][uprule][]" value="b" title="<?php echo lang('blurb'); ?>" <?php if(strpos($config['collect']['actor']['uprule'],'b') !==false): ?>checked <?php endif; ?>>
                            <input type="checkbox" lay-skin="primary" name="collect[actor][uprule][]" value="c" title="<?php echo lang('remarks'); ?>" <?php if(strpos($config['collect']['actor']['uprule'],'c') !==false): ?>checked <?php endif; ?>>
                            <input type="checkbox" lay-skin="primary" name="collect[actor][uprule][]" value="d" title="<?php echo lang('works'); ?>" <?php if(strpos($config['collect']['actor']['uprule'],'d') !==false): ?>checked <?php endif; ?>>
                            <input type="checkbox" lay-skin="primary" name="collect[actor][uprule][]" value="e" title="<?php echo lang('pic'); ?>" <?php if(strpos($config['collect']['actor']['uprule'],'e') !==false): ?>checked <?php endif; ?>>

                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/filter'); ?>：</label>
                        <div class="layui-input-block">
                            <textarea name="collect[actor][filter]" class="layui-textarea" placeholder="<?php echo lang('multi_separate_tip'); ?>"><?php echo $config['collect']['actor']['filter']; ?></textarea>
                        </div>
                    </div>

                </div>

                <div class="layui-tab-item">

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/status'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="radio" name="collect[role][status]" value="0" title="<?php echo lang('reviewed_not'); ?>" <?php if($config['collect']['role']['status'] != 1): ?>checked <?php endif; ?>>
                            <input type="radio" name="collect[role][status]" value="1" title="<?php echo lang('reviewed'); ?>" <?php if($config['collect']['role']['status'] == 1): ?>checked <?php endif; ?>>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/hits_rnd'); ?>：</label>
                        <div class="layui-input-inline">
                            <input type="text" name="collect[role][hits_start]" placeholder="<?php echo lang('min_val'); ?>" value="<?php echo $config['collect']['role']['hits_start']; ?>" class="layui-input">
                        </div>
                        <div class="layui-input-inline">
                            <input type="text" name="collect[role][hits_end]" placeholder="<?php echo lang('max_val'); ?>" value="<?php echo $config['collect']['role']['hits_end']; ?>" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/updown_rnd'); ?>：</label>
                        <div class="layui-input-inline">
                            <input type="text" name="collect[role][updown_start]" placeholder="<?php echo lang('min_val'); ?>" value="<?php echo $config['collect']['role']['updown_start']; ?>" class="layui-input">
                        </div>
                        <div class="layui-input-inline">
                            <input type="text" name="collect[role][updown_end]" placeholder="<?php echo lang('max_val'); ?>" value="<?php echo $config['collect']['role']['updown_end']; ?>" class="layui-input">
                        </div>
                    </div>


                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/score_rnd'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="radio" name="collect[role][score]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['role']['score'] != 1): ?>checked <?php endif; ?>>
                            <input type="radio" name="collect[role][score]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['role']['score'] == 1): ?>checked <?php endif; ?>>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/sync_pic'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="radio" name="collect[role][pic]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['role']['pic'] != 1): ?>checked <?php endif; ?>>
                            <input type="radio" name="collect[role][pic]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['role']['pic'] == 1): ?>checked <?php endif; ?>>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/psernd'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="radio" name="collect[role][psernd]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['actor']['psernd'] != 1): ?>checked <?php endif; ?>>
                            <input type="radio" name="collect[role][psernd]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['actor']['psernd'] == 1): ?>checked <?php endif; ?>>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/psesyn'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="radio" name="collect[role][psesyn]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['role']['psesyn'] != 1): ?>checked <?php endif; ?>>
                            <input type="radio" name="collect[role][psesyn]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['role']['psesyn'] == 1): ?>checked <?php endif; ?>>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/inrule'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="checkbox" lay-skin="primary" name="collect[role][inrule][]" value="a" title="<?php echo lang('role_name'); ?>" checked disabled>
                            <input type="checkbox" lay-skin="primary" name="collect[role][inrule][]" value="b" title="<?php echo lang('vod_name'); ?><?php echo lang('or'); ?><?php echo lang('douban_id'); ?>" checked disabled>
                            <input type="checkbox" lay-skin="primary" name="collect[role][inrule][]" value="c" title="<?php echo lang('actor_name'); ?>" <?php if(strpos($config['collect']['role']['inrule'],'c') !==false): ?>checked <?php endif; ?> >
                            <input type="checkbox" lay-skin="primary" name="collect[role][inrule][]" value="d" title="<?php echo lang('director'); ?>" <?php if(strpos($config['collect']['role']['inrule'],'d') !==false): ?>checked <?php endif; ?> >
                        </div>
                        <div class="layui-form-mid layui-word-aux"><?php echo lang('admin/system/configcollect/inrule_tip_role'); ?></div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/uprule'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="checkbox" lay-skin="primary" name="collect[role][uprule][]" value="a" title="<?php echo lang('content'); ?>" <?php if(strpos($config['collect']['role']['uprule'],'a') !==false): ?>checked <?php endif; ?>>
                            <input type="checkbox" lay-skin="primary" name="collect[role][uprule][]" value="b" title="<?php echo lang('remarks'); ?>" <?php if(strpos($config['collect']['role']['uprule'],'b') !==false): ?>checked <?php endif; ?>>
                            <input type="checkbox" lay-skin="primary" name="collect[role][uprule][]" value="c" title="<?php echo lang('pic'); ?>" <?php if(strpos($config['collect']['role']['uprule'],'c') !==false): ?>checked <?php endif; ?>>

                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/filter'); ?>：</label>
                        <div class="layui-input-block">
                            <textarea name="collect[role][filter]" class="layui-textarea" placeholder="<?php echo lang('multi_separate_tip'); ?>"><?php echo $config['collect']['role']['filter']; ?></textarea>
                        </div>
                    </div>

                </div>

                <div class="layui-tab-item">

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/status'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="radio" name="collect[website][status]" value="0" title="<?php echo lang('reviewed_not'); ?>" <?php if($config['collect']['website']['status'] != 1): ?>checked <?php endif; ?>>
                            <input type="radio" name="collect[website][status]" value="1" title="<?php echo lang('reviewed'); ?>" <?php if($config['collect']['website']['status'] == 1): ?>checked <?php endif; ?>>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/hits_rnd'); ?>：</label>
                        <div class="layui-input-inline">
                            <input type="text" name="collect[website][hits_start]" placeholder="<?php echo lang('min_val'); ?>" value="<?php echo $config['collect']['website']['hits_start']; ?>" class="layui-input">
                        </div>
                        <div class="layui-input-inline">
                            <input type="text" name="collect[website][hits_end]" placeholder="<?php echo lang('max_val'); ?>" value="<?php echo $config['collect']['website']['hits_end']; ?>" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/updown_rnd'); ?>：</label>
                        <div class="layui-input-inline">
                            <input type="text" name="collect[website][updown_start]" placeholder="<?php echo lang('min_val'); ?>" value="<?php echo $config['collect']['website']['updown_start']; ?>" class="layui-input">
                        </div>
                        <div class="layui-input-inline">
                            <input type="text" name="collect[website][updown_end]" placeholder="<?php echo lang('max_val'); ?>" value="<?php echo $config['collect']['website']['updown_end']; ?>" class="layui-input">
                        </div>
                    </div>


                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/score_rnd'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="radio" name="collect[website][score]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['website']['score'] != 1): ?>checked <?php endif; ?>>
                            <input type="radio" name="collect[website][score]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['website']['score'] == 1): ?>checked <?php endif; ?>>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/sync_pic'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="radio" name="collect[website][pic]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['website']['pic'] != 1): ?>checked <?php endif; ?>>
                            <input type="radio" name="collect[website][pic]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['website']['pic'] == 1): ?>checked <?php endif; ?>>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/psernd'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="radio" name="collect[website][psernd]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['website']['psernd'] != 1): ?>checked <?php endif; ?>>
                            <input type="radio" name="collect[website][psernd]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['website']['psernd'] == 1): ?>checked <?php endif; ?>>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/psesyn'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="radio" name="collect[website][psesyn]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['website']['psesyn'] != 1): ?>checked <?php endif; ?>>
                            <input type="radio" name="collect[website][psesyn]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['website']['psesyn'] == 1): ?>checked <?php endif; ?>>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/inrule'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="checkbox" lay-skin="primary" name="collect[website][inrule][]" value="a" title="<?php echo lang('name'); ?>" checked disabled>
                            <input type="checkbox" lay-skin="primary" name="collect[website][inrule][]" value="b" title="<?php echo lang('type'); ?>" <?php if(strpos($config['collect']['website']['inrule'],'b') !==false): ?>checked <?php endif; ?>>
                            <input type="checkbox" lay-skin="primary" name="collect[website][inrule][]" value="c" title="<?php echo lang('jumpurl'); ?>" <?php if(strpos($config['collect']['website']['inrule'],'c') !==false): ?>checked <?php endif; ?>>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/uprule'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="checkbox" lay-skin="primary" name="collect[website][uprule][]" value="a" title="<?php echo lang('content'); ?>" <?php if(strpos($config['collect']['website']['uprule'],'a') !==false): ?>checked <?php endif; ?>>
                            <input type="checkbox" lay-skin="primary" name="collect[website][uprule][]" value="b" title="<?php echo lang('blurb'); ?>" <?php if(strpos($config['collect']['website']['uprule'],'b') !==false): ?>checked <?php endif; ?>>
                            <input type="checkbox" lay-skin="primary" name="collect[website][uprule][]" value="c" title="<?php echo lang('remarks'); ?>" <?php if(strpos($config['collect']['website']['uprule'],'c') !==false): ?>checked <?php endif; ?>>
                            <input type="checkbox" lay-skin="primary" name="collect[website][uprule][]" value="d" title="<?php echo lang('jumpurl'); ?>" <?php if(strpos($config['collect']['website']['uprule'],'d') !==false): ?>checked <?php endif; ?>>
                            <input type="checkbox" lay-skin="primary" name="collect[website][uprule][]" value="e" title="<?php echo lang('pic'); ?>" <?php if(strpos($config['collect']['website']['uprule'],'e') !==false): ?>checked <?php endif; ?>>

                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/filter'); ?>：</label>
                        <div class="layui-input-block">
                            <textarea name="collect[website][filter]" class="layui-textarea" placeholder="<?php echo lang('multi_separate_tip'); ?>"><?php echo $config['collect']['website']['filter']; ?></textarea>
                        </div>
                    </div>

                </div>

                <div class="layui-tab-item">

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/status'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="radio" name="collect[comment][status]" value="0" title="<?php echo lang('reviewed_not'); ?>" <?php if($config['collect']['comment']['status'] != 1): ?>checked <?php endif; ?>>
                            <input type="radio" name="collect[comment][status]" value="1" title="<?php echo lang('reviewed'); ?>" <?php if($config['collect']['comment']['status'] == 1): ?>checked <?php endif; ?>>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/updown_rnd'); ?>：</label>
                        <div class="layui-input-inline">
                            <input type="text" name="collect[comment][updown_start]" placeholder="<?php echo lang('min_val'); ?>" value="<?php echo $config['collect']['comment']['updown_start']; ?>" class="layui-input">
                        </div>
                        <div class="layui-input-inline">
                            <input type="text" name="collect[comment][updown_end]" placeholder="<?php echo lang('max_val'); ?>" value="<?php echo $config['collect']['comment']['updown_end']; ?>" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/psernd'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="radio" name="collect[comment][psernd]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['actor']['psernd'] != 1): ?>checked <?php endif; ?>>
                            <input type="radio" name="collect[comment][psernd]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['actor']['psernd'] == 1): ?>checked <?php endif; ?>>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/psesyn'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="radio" name="collect[comment][psesyn]" value="0" title="<?php echo lang('close'); ?>" <?php if($config['collect']['comment']['psesyn'] != 1): ?>checked <?php endif; ?>>
                            <input type="radio" name="collect[comment][psesyn]" value="1" title="<?php echo lang('open'); ?>" <?php if($config['collect']['comment']['psesyn'] == 1): ?>checked <?php endif; ?>>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/inrule'); ?>：</label>
                        <div class="layui-input-block">
                            <input type="checkbox" lay-skin="primary" name="collect[comment][inrule][]" value="a" title="<?php echo lang('rel_name'); ?><?php echo lang('or'); ?><?php echo lang('douban_id'); ?>" checked disabled>
                            <input type="checkbox" lay-skin="primary" name="collect[comment][inrule][]" value="b" title="<?php echo lang('comment_content'); ?>" <?php if(strpos($config['collect']['comment']['inrule'],'b') !==false): ?>checked <?php endif; ?>>
                            <input type="checkbox" lay-skin="primary" name="collect[comment][inrule][]" value="c" title="<?php echo lang('comment_name'); ?>" <?php if(strpos($config['collect']['comment']['inrule'],'c') !==false): ?>checked <?php endif; ?> >
                        </div>
                        <div class="layui-form-mid layui-word-aux"><?php echo lang('admin/system/configcollect/inrule_tip_comment'); ?></div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/uprule'); ?>：</label>
                        <div class="layui-input-block">


                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/filter'); ?>：</label>
                        <div class="layui-input-block">
                            <textarea name="collect[comment][filter]" class="layui-textarea" placeholder="<?php echo lang('multi_separate_tip'); ?>"><?php echo $config['collect']['comment']['filter']; ?></textarea>
                        </div>
                    </div>

                </div>

                <div class="layui-tab-item">
                <blockquote class="layui-elem-quote layui-quote-nm">
                    <?php echo lang('admin/system/configcollect/words_tip'); ?>
                </blockquote>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/vod_namewords'); ?>：</label>
                    <div class="layui-input-block">
                        <textarea name="collect[vod][namewords]" class="layui-textarea"><?php echo mac_replace_text($config['collect']['vod']['namewords']); ?></textarea>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/vod_thesaurus'); ?>：</label>
                    <div class="layui-input-block">
                        <textarea name="collect[vod][thesaurus]" class="layui-textarea"><?php echo mac_replace_text($config['collect']['vod']['thesaurus']); ?></textarea>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/vod_playerwords'); ?>：</label>
                    <div class="layui-input-block">
                        <textarea name="collect[vod][playerwords]" class="layui-textarea"><?php echo mac_replace_text($config['collect']['vod']['playerwords']); ?></textarea>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/vod_areawords'); ?>：</label>
                    <div class="layui-input-block">
                        <textarea name="collect[vod][areawords]" class="layui-textarea"><?php echo mac_replace_text($config['collect']['vod']['areawords']); ?></textarea>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/vod_langwords'); ?>：</label>
                    <div class="layui-input-block">
                        <textarea name="collect[vod][langwords]" class="layui-textarea"><?php echo mac_replace_text($config['collect']['vod']['langwords']); ?></textarea>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/vod_words'); ?>：</label>
                    <div class="layui-input-block">
                        <textarea name="collect[vod][words]" class="layui-textarea"><?php echo mac_replace_text($config['collect']['vod']['words']); ?></textarea>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/art_thesaurus'); ?>：</label>
                    <div class="layui-input-block">
                        <textarea name="collect[art][thesaurus]" class="layui-textarea"><?php echo mac_replace_text($config['collect']['art']['thesaurus']); ?></textarea>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/art_words'); ?>：</label>
                    <div class="layui-input-block">
                        <textarea name="collect[art][words]" class="layui-textarea"><?php echo mac_replace_text($config['collect']['art']['words']); ?></textarea>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/actor_thesaurus'); ?>：</label>
                    <div class="layui-input-block">
                        <textarea name="collect[actor][thesaurus]" class="layui-textarea"><?php echo mac_replace_text($config['collect']['actor']['thesaurus']); ?></textarea>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/actor_words'); ?>：</label>
                    <div class="layui-input-block">
                        <textarea name="collect[actor][words]" class="layui-textarea"><?php echo mac_replace_text($config['collect']['actor']['words']); ?></textarea>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/role_thesaurus'); ?>：</label>
                    <div class="layui-input-block">
                        <textarea name="collect[role][thesaurus]" class="layui-textarea"><?php echo mac_replace_text($config['collect']['role']['thesaurus']); ?></textarea>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/role_words'); ?>：</label>
                    <div class="layui-input-block">
                        <textarea name="collect[role][words]" class="layui-textarea"><?php echo mac_replace_text($config['collect']['role']['words']); ?></textarea>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/website_thesaurus'); ?>：</label>
                    <div class="layui-input-block">
                        <textarea name="collect[website][thesaurus]" class="layui-textarea"><?php echo mac_replace_text($config['collect']['website']['thesaurus']); ?></textarea>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo lang('admin/system/configcollect/website_words'); ?>：</label>
                    <div class="layui-input-block">
                        <textarea name="collect[website][words]" class="layui-textarea"><?php echo mac_replace_text($config['collect']['website']['words']); ?></textarea>
                    </div>
                </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/comment_thesaurus'); ?>：</label>
                        <div class="layui-input-block">
                            <textarea name="collect[comment][thesaurus]" class="layui-textarea"><?php echo mac_replace_text($config['collect']['comment']['thesaurus']); ?></textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo lang('admin/system/configcollect/comment_words'); ?>：</label>
                        <div class="layui-input-block">
                            <textarea name="collect[comment][words]" class="layui-textarea"><?php echo mac_replace_text($config['collect']['comment']['words']); ?></textarea>
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
<script type="text/javascript" src="/static//js/jquery.cookie.js"></script>
<script type="text/javascript">
    layui.use(['element', 'form', 'layer'], function() {
        var element = layui.element
            ,form = layui.form
            , layer = layui.layer;


        element.on('tab(tb1)', function(){
            $.cookie('configcollect_tab', this.getAttribute('lay-id'));
        });

        if( $.cookie('configcollect_tab') !=null ) {
            element.tabChange('tb1', $.cookie('configcollect_tab'));
        }

    });
</script>

</body>
</html>