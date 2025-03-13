<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:37:"template/mxone/html/comment/ajax.html";i:1639063672;}*/ ?>
<!--评论开始-->
    <div class="col-pd">
	    <form class="comment_form clearfix">
	        <input type="hidden" name="comment_pid" value="0">
	        <!--评论框-->
	        <div class="mxone-comment__form clearfix">       	
	            <textarea class="comment_content form-control" name="comment_content" rows="5" placeholder="请输入评论内容..."></textarea>
	            <div class="submit-box">
	                <?php if($comment['verify'] == 1): ?>
	                <img id="verify_img" src="<?php echo url('verify/index'); ?>" onClick="this.src=this.src+'?'"  alt="单击刷新" height="30"  style="vertical-align: middle;"/>	                
	                &nbsp;&nbsp;<input class="form-control" type="text" id="verify" name="verify" placeholder="验证码" style="display: inline-block; width: 80px;"/>
	                <?php endif; ?>
	                &nbsp;&nbsp;<input class="comment_submit btn btn-primary pull-right" type="button" value="发布">
	            </div>
	        </div>
	    </form>
	    <?php $__TAG__ = '{"num":"5","paging":"yes","order":"desc","by":"id","id":"vo","key":"key"}';$__LIST__ = model("Comment")->listCacheData($__TAG__);$__PAGING__ = mac_page_param($__LIST__['total'],$__LIST__['limit'],$__LIST__['page'],$__LIST__['pageurl'],$__LIST__['half']); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;endforeach; endif; else: echo "" ;endif; ?>
    	<div class="mxone-pannel__head active clearfix">
    		<span class="more pull-right nomore">共“<span class="text-red" id="item_count"><?php echo intval($__PAGING__['record_total']); ?></span>”条评论</span>
			<h3 class="title">
				用户评论
			</h3>						
		</div>	
        <?php if(is_array($__LIST__) || $__LIST__ instanceof \think\Collection || $__LIST__ instanceof \think\Paginator): if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ?>
        <div class="mxone-comment__item top-line clearfix">
        	<a class="avatar" href="javascript:;"><img class="face" src="<?php echo mac_url_img(mac_default($vo['user_portrait'],'static/images/touxiang.png')); ?>"></a>              
            <div class="comment-head clearfix">
            	<span class="text-muted pull-right hidden-xs"><?php echo long2ip($vo['comment_ip']); ?></span>
            	<h4 class="title"><?php echo $vo['comment_name']; ?></h4>
                <p class="font-12 text-muted"><?php echo date('Y-m-d H:i:s',$vo['comment_time']); ?></p>                      
            </div>
            <div class="comment-cont clearfix"><?php echo mac_em_replace($vo['comment_content']); ?></div>
            <div class="comment-foot clearfix">
            	<a class="comment_report pull-right text-muted" data-id="<?php echo $vo['comment_id']; ?>" href="javascript:;">举报</a>
                <a class="digg_link" data-id="<?php echo $vo['comment_id']; ?>" data-mid="4" data-type="up" href="javascript:;">
                   <span>顶</span>
                    <span class="digg_num text-red"><?php echo $vo['comment_up']; ?></span>
                </a>
                <span class="split-line"></span>
                <a class="digg_link" data-id="<?php echo $vo['comment_id']; ?>" data-mid="4" data-type="down" href="javascript:;">
                    <span>踩</span>
                    <span class="digg_num text-red"><?php echo $vo['comment_down']; ?></span>
                </a>
                <span class="split-line"></span>
                <a class="comment_reply text-muted" data-id="<?php echo $vo['comment_id']; ?>" href="javascript:;">回复 <i class="icon iconfont icon-moreunfold"></i></a>              
            </div>
            <?php if(is_array($vo['sub']) || $vo['sub'] instanceof \think\Collection || $vo['sub'] instanceof \think\Paginator): if( count($vo['sub'])==0 ) : echo "" ;else: foreach($vo['sub'] as $key=>$child): ?>
            <div class="mxone-comment__item active top-line clearfix">
               	<a class="avatar" href="javascript:;"><img class="face" src="<?php echo mac_url_img(mac_default($vo['user_portrait'],'static/images/touxiang.png')); ?>"></a>
                <div class="comment-head clearfix">
                	<span class="text-muted pull-right"><?php echo long2ip($child['comment_ip']); ?></span>
                	<h4 class="title"><?php echo $child['comment_name']; ?></h4>
                	<p class="font-12 text-muted"><?php echo date('Y-m-d H:i:s',$child['comment_time']); ?></p>    
                </div>
                <div class="comment-cont clearfix"><?php echo mac_em_replace($child['comment_content']); ?></div>
                <div class="comment-foot clearfix">
                	<a class="comment_report pull-right text-muted" data-id="<?php echo $child['comment_id']; ?>" href="javascript:;">举报</a>
                    <a class="digg_link" data-id="<?php echo $child['comment_id']; ?>" data-mid="4" data-type="up" href="javascript:;">
                        <span>顶</span>
                        <span class="digg_num text-red"><?php echo $child['comment_up']; ?></span>
                    </a>
                    <span class="split-line"></span>
                    <a class="digg_link" data-id="<?php echo $child['comment_id']; ?>" data-mid="4" data-type="down" href="javascript:;">
                        <span>踩</span>
                        <span class="digg_num text-red"><?php echo $child['comment_down']; ?></span>
                    </a>                   
                </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>

    </div>
    <!--评论结束-->
    
    <?php if($__PAGING__['page_total'] > 1): ?>
	<div class="module-footer">
      <div id="page">
        <a href="javascript:void(0);" onclick="MAC.Comment.Show(1)" class="page-number page-previous">首页</a>
        <a href="javascript:void(0);" onclick="MAC.Comment.Show('<?php echo $__PAGING__['page_prev']; ?>')" class="page-number page-previous" title="上一页">上一页</a>
        <?php if(is_array($__PAGING__['page_num']) || $__PAGING__['page_num'] instanceof \think\Collection || $__PAGING__['page_num'] instanceof \think\Paginator): if( count($__PAGING__['page_num'])==0 ) : echo "" ;else: foreach($__PAGING__['page_num'] as $key=>$num): if($__PAGING__['page_current'] == $num): ?>
        <span class="page-number page-current display"><?php echo $num; ?></span>
        <?php else: ?>
          <a href="javascript:void(0)" onclick="MAC.Comment.Show('<?php echo $num; ?>')" class="page-number display" title="第<?php echo $num; ?>页"><?php echo $num; ?></a>
            <?php endif; endforeach; endif; else: echo "" ;endif; ?>
           <a href="javascript:void(0)" onclick="MAC.Comment.Show('<?php echo $__PAGING__['page_next']; ?>')" class="page-number page-next" title="下一页">下一页</a>
        <a href="javascript:void(0)" onclick="MAC.Comment.Show('<?php echo $__PAGING__['page_total']; ?>')" class="page-number page-next" title="尾页">尾页</a>
      </div>
    </div>
	<?php endif; ?>
<style>
.mxone-comment__form {
position:relative;
margin-bottom:20px;
}

.mxone-comment__form .comment_content {
margin-bottom:20px;
}

.mxone-comment__form .submit-box {
float:right;
}

.mxone-comment__item {
position:relative;
padding:15px 0 15px 60px;
}

.mxone-comment__item.active {
margin-top:10px;
padding:15px 0 0 60px;
}

.mxone-comment__item .avatar {
position:absolute;
top:15px;
left:0;
}

.mxone-comment__item .avatar img {
width:50px;
height:50px;
border-radius:50%;
}

.mxone-comment__item .comment-head .title {
margin:0;
}

.mxone-comment__item .comment-cont {
margin-bottom:10px;
line-height:25px;
}

.mxone-comment__item .comment-foot a {
display:inline-block;
font-size:12px;
}

.mxone-comment__item .mxone-comment__form {
margin-top:10px;
margin-bottom:0;
}

textarea.form-control {
height:auto;
}

.form-control {
display:block;
width:100%;
height:30px;
font-size:12px;
line-height:25px;
border-radius:4px;
transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s;
background-color:#F5F5F5;
color:#999;
border:1px solid #EEE;
padding:10px;
}

.pull-right {
float:right!important;
}

.btn {
display:inline-block;
font-size:12px;
border-radius:4px;
padding:4px 30px;
}

.btn-primary {
background-color:#25252b;
border:1px solid #25252b;
color:#FFF;
}

h4 {
font-size:16px;
line-height:22px;
}

.font-12 {
font-size:12px;
}

.text-muted {
color:#999;
}

p {
margin:0 0 10px;
}

.split-line {
display:inline-block;
margin-left:12px;
margin-right:12px;
width:1px;
height:14px;
vertical-align:-2px;
background-color:#EEE;
}

.text-red {
color:red;
}

.top-line:before {
border-top:1px solid #EEE;
}

.top-line:before,.top-line-dot:before {
content:" ";
position:absolute;
left:0;
top:0;
right:0;
width:100%;
height:1px;
}

.nomore,.nomore:hover {
background:none;
}

@media(max-width:767px){
.mxone-comment__form .submit-box {
float:none;
}

.mxone-comment__item {
position:relative;
padding:10px 0 10px 40px;
}

.mxone-comment__item.active {
margin-top:5px;
padding:15px 0 0 40px;
}

.mxone-comment__item .avatar {
top:10px;
}

.mxone-comment__item .avatar img {
width:30px;
height:30px;
}
}   
</style>	