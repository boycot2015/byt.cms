<?php if (!defined('THINK_PATH')) exit(); /*a:16:{s:33:"template/mxone/html/vod/play.html";i:1653888868;s:79:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/seo/vod_play.html";i:1664247958;s:81:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/public/include.html";i:1664250000;s:78:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/public/head.html";i:1642429072;s:75:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/ads/adqj.html";i:1625104690;s:74:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/ads/ad3.html";i:1625726522;s:81:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/vod/actor_vbox.html";i:1639673002;s:80:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/public/vodbox.html";i:1664246986;s:75:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/vod/like.html";i:1639064412;s:74:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/vod/hot.html";i:1640349510;s:78:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/vod/comment.html";i:1639064332;s:78:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/public/foot.html";i:1664185344;s:82:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/public/tcnotice.html";i:1639063956;s:81:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/public/website.html";i:1639063970;s:75:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/ads/addb.html";i:1625104690;s:81:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/vod/projection.html";i:1639064456;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<title>正在播放《<?php echo $obj['vod_name']; ?>》<?php echo $obj['vod_play_list'][$param['sid']]['urls'][$param['nid']]['name']; ?>_高清1080P在线观看平台_<?php echo $obj['type']['type_name']; ?>_高清版完整视频免费在线播放_<?php echo $maccms['site_name']; ?> - <?php echo $maccms['site_url']; ?></title>
<meta name="keywords" content="<?php echo $obj['vod_name']; ?><?php echo $obj['vod_play_list'][$param['sid']]['urls'][$param['nid']]['name']; ?><?php echo $obj['type']['type_name']; ?>高清版完整视频免费在线播放,<?php echo $obj['vod_name']; ?>剧情介绍,<?php echo $obj['vod_actor']; ?>">
<meta name="description" content="<?php echo $obj['vod_name']; ?><?php echo $obj['vod_play_list'][$param['sid']]['urls'][$param['nid']]['name']; ?>;视频剧情简介:,<?php echo mac_default(mac_filter_html($obj['vod_content']),'内详'); ?>免费在线观看,<?php echo $obj['vod_name']; ?>剧情介绍">    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<?php $file = 'template/mxone/asset/admin/Mxone.php'; $newfile = 'application/admin/controller/Mxone.php'; if (file_exists($newfile)) {} else { copy($file,$newfile); } $file = 'template/mxone/asset/admin/mxonest.php'; $newfile = 'application/extra/mxonest.php'; if (file_exists($newfile)) {} else { copy($file,$newfile); } $file = 'template/mxone/asset/admin/mxcms.html'; $newfile = 'application/admin/view/system/mxcms.html'; if (file_exists($newfile)) {} else { copy($file,$newfile); } $mxonest = file_exists('application/extra/mxonest.php') ? require('application/extra/mxonest.php') : require(substr($maccms['path_tpl'], strlen($maccms['path'])).'asset/admin/mxonest.php'); if($mxonest['mxcms']['s4']['tbdm'] == 1): ?>
<?php echo $mxonest['mxcms']['s4']['tbdmtips']; endif; ?>
<script>var maccms={"path":"","mid":"<?php echo $maccms['mid']; ?>","url":"<?php echo $maccms['site_url']; ?>","wapurl":"<?php echo $maccms['site_wapurl']; ?>","mob_status":"<?php echo $maccms['mob_status']; ?>"};</script>
<link rel="icon" href="<?php echo mac_url_img($mxonest['mxcms']['s1']['logo3']); ?>" type="image/png" />
<link href="<?php echo $maccms['path_tpl']; ?>mxstatic/css/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo $maccms['path_tpl']; ?>mxstatic/css/aliicon.css" rel="stylesheet" type="text/css">
<link href="<?php echo $maccms['path_tpl']; ?>mxstatic/css/index.css" rel="stylesheet" type="text/css">
<?php if($mxonest['mxcms']['s2']['mryj'] == 0): ?><link disabled="" class="theme_black" type="text/css" rel="stylesheet" href="<?php echo $maccms['path_tpl']; ?>mxstatic/css/mxhtmlblack.css"><?php endif; if($mxonest['mxcms']['s2']['mryj'] == 1): ?><link type="text/css" rel="stylesheet" href="<?php echo $maccms['path_tpl']; ?>mxstatic/css/mxhtmlblack.css"><?php endif; if($mxonest['mxcms']['s2']['mryj'] == 1): ?><link disabled="" class="theme_white"  type="text/css" rel="stylesheet" href="<?php echo $maccms['path_tpl']; ?>mxstatic/css/white.css"><?php endif; ?>
<script src="<?php echo $maccms['path_tpl']; ?>mxstatic/js/jquery.js"></script>
<script type="text/javascript"  src="<?php echo $maccms['path_tpl']; ?>mxstatic/js/jquery.lazyload.js"></script>
<script src="<?php echo $maccms['path_tpl']; ?>mxstatic/js/jquery.autocomplete.js"></script>
<script src="<?php echo $maccms['path_tpl']; ?>mxstatic/js/vue.min.js"></script>
<script src="<?php echo $maccms['path_tpl']; ?>mxstatic/js/index.js"></script>
<script src="<?php echo $maccms['path_tpl']; ?>mxstatic/js/jquery.cookie.js"></script>
<script src="<?php echo $maccms['path_tpl']; ?>mxstatic/js/home.js"></script>
<script type="text/javascript"  src="<?php echo $maccms['path_tpl']; ?>mxstatic/js/jquery.clipboard.js"></script>
<script src="<?php echo $maccms['path_tpl']; ?>mxstatic/js/layer.js"></script>
<script src="<?php echo $maccms['path_tpl']; ?>mxstatic/js/js_push.js"></script>
 <script type="text/javascript" src="<?php echo $maccms['path_tpl']; ?>mxstatic/js/swiper.min.js"></script>
<?php if($maccms['aid'] == 15): ?>
<script type="text/javascript">var vod_name='<?php echo $obj['vod_name']; ?>',vod_url=window.location.href,vod_part='<?php echo $obj['vod_play_list'][$param['sid']]['urls'][$param['nid']]['name']; ?>';</script>
<script type="text/javascript"  src="<?php echo $maccms['path_tpl']; ?>mxstatic/js/history.js"></script>
 <script type="text/javascript"  src="<?php echo $maccms['path_tpl']; ?>mxstatic/js/jquery.qrcode.min.js"></script>
 <script type="text/javascript"  src="<?php echo $maccms['path_tpl']; ?>mxstatic/js/swiper.min.js"></script>
<link rel="stylesheet" href="<?php echo $maccms['path_tpl']; ?>mxstatic/css/swiper.min.css" type="text/css">
<?php endif; if($mxonest['mxcms']['s2']['gddhbg'] == 1): ?><style>.homepage .header-bg{background:<?php echo $mxonest['mxcms']['s2']['gddhbgdm']; ?>;}.homepage .header-bg::after{background:<?php echo $mxonest['mxcms']['s2']['gddhbgdm']; ?>;}.border-bottom::after, .header-content::after, .play .app-text::after{background-color: <?php echo $mxonest['mxcms']['s2']['gddhbgdm']; ?>;} .header-content{background:<?php echo $mxonest['mxcms']['s2']['gddhbgdm']; ?>!important;}</style><?php endif; ?>
<script src="<?php echo $maccms['path_tpl']; ?>mxstatic/js/script.js"></script>
<?php if($mxonest['mxcms']['s2']['mryj'] == 0): ?>
<script>
	var clothes = $.cookie('clothes');
	if (clothes) {
		if (clothes == 'white') {
			$('.theme_black').removeAttr('disabled');
		} else {
			$('.theme_black').attr('disabled', '');
		}
	} else {
		$.cookie('clothes', 'black', { expires: 365, path: '/' })
	}
</script>
<script>

	function clothesChange(){
		var clothes = $.cookie('clothes');
		if (clothes == 'black') {
			$.cookie('clothes','white', {expires: 365, path: '/'});  
			$('.theme_black').each(function(){
			    $(this).removeAttr('disabled');
			});
			
		} else {
			$.cookie('clothes','black', {expires: 365, path: '/'});  
			$('.theme_black').each(function(){
			    $(this).attr('disabled', '');
			});
		}
		clothes = $.cookie('clothes');
	}
</script>
<?php endif; if($mxonest['mxcms']['s2']['mryj'] == 1): ?>
<script>
	var clothes = $.cookie('clothes');
if (clothes) {
		if (clothes == 'black') {
			$('.theme_white').removeAttr('disabled');
		} else {
			$('.theme_white').attr('disabled', '');
		}
	} else {
		$.cookie('clothes', 'white', { expires: 365, path: '/' })
	}
</script>
<script>
	function clothesChange(){
		var clothes = $.cookie('clothes');
		if (clothes == 'white') {
			$.cookie('clothes','black', {expires: 365, path: '/'});  
			$('.theme_white').each(function(){
			    $(this).removeAttr('disabled');
			});
		} else {
			$.cookie('clothes','white', {expires: 365, path: '/'});  
			$('.theme_white').each(function(){
			    $(this).attr('disabled', '');
			});
		}
		clothes = $.cookie('clothes');
	}
</script>
<?php endif; if($mxonest['mxcms']['s4']['stylediy'] == 1): ?>
<style>
  <?php echo $mxonest['mxcms']['s4']['stylecss']; ?>  
</style>
<?php endif; ?>
   
</head>
<!--新的-->
<style>
    @media(min-width:899px) { .player-info .page-title a::after {height: 3px !important;}}b { width: 16px; height: 16px; font-weight: 400; background: #2cbafc; color: #fff; padding: 2px 4px; margin-left: 4px; font-size: 13px; border-radius: 5px;}.col-xs-1{min-height: 1px; padding: 10px; color: #fff;}.col-xs-1 a{color: #fff;}
/*新和VIP图标css*/
  .module-blocklist a em  {    color: rgb(0 0 0 / 92%);position: absolute; top: -1px;right: 2px;z-index: 3; transform: scale(0.78); transform-origin: top right;border-radius: 1px 5px 0 5px; background: linear-gradient(90deg, #FFEB3B, #f9e326);padding: 0 3px; line-height: 16px;font-size: 12px; border-radius: 5px; display: inline-block !important;}
   @media (min-width: 659px){ 
       .module-blocklist a{ overflow: initial; width:auto}
       .module-blocklist a em{ top: -5px; right: -5px;}
   }
   @media (min-width: 1239px){
.player-side-playlist .module-blocklist  a {overflow: hidden;}
.player-side-playlist .module-blocklist  a em{ top: 0px; right: 0px;}
}
/*新和VIP图标css*/
 </style> 
<!--新的-->

<body  class="page play">
  <?php if($maccms['aid'] == 1): ?>
<header id="header" class="wrapper" <?php if($mxonest['mxcms']['s2']['pcgddh'] == 0): ?>style="padding-top: 0!important;"<?php endif; ?>>
	<div class="header-content <?php if($mxonest['mxcms']['s2']['pcgddh'] == 0): ?>qxgddh<?php endif; ?>" >
		<div class="banyundog-com">
			<div class="header-logo">
				<h1 class="slogan"><?php echo $mxonest['mxcms']['s1']['gg']; ?></h1>
				<div class="fixed-logo">
					<a href="<?php echo $maccms['path']; ?>" class="logo" title="<?php echo $maccms['site_name']; ?>"><img src="<?php echo mac_url_img($mxonest['mxcms']['s1']['logo2']); ?>" alt="<?php echo $maccms['site_name']; ?>"></a>
				</div>
			</div>
		</div>
<style></style>	
		
	
		<div class="nav-search">
		   <form action="<?php echo mac_url('vod/search'); ?>" class="search-dh">
		       
				    <?php if($maccms['aid'] != 13): ?>
					<div class="search-box"><input class="search-input ac_wd txtKeywords" type="text" name="wd" autocomplete="off" placeholder="<?php echo $mxonest['mxcms']['s1']['searchwd']; ?>">
						<div class="search-drop">
							<div class="drop-content-items ac_hot none">
								<div class="list-item list-item-title"><strong>大家都在搜这些影片</strong></div>
								<div class="search-tag">
									<?php $_67d3a9038b1c1=explode(',',$maccms['search_hot']); if(is_array($_67d3a9038b1c1) || $_67d3a9038b1c1 instanceof \think\Collection || $_67d3a9038b1c1 instanceof \think\Paginator): if( count($_67d3a9038b1c1)==0 ) : echo "" ;else: foreach($_67d3a9038b1c1 as $key2=>$vo2): ?>
									<a href="<?php echo mac_url('vod/search',['wd'=>$vo2]); ?>" class="<?php if($key2 < 4): ?>hot <?php else: endif; ?>"><i class="icon-hot"></i><?php echo $vo2; ?></a>
									<?php endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</div>
						</div>
					     <?php if($mxonest['mxcms']['s2']['searchhoticon'] == 1): ?><a href="<?php echo mac_url('label/top'); ?>" class="search-btn search-cupfox" id="search-cupfox" title="<?php echo $maccms['site_name']; ?>排行榜" ><i class="<?php echo $mxonest['mxcms']['s2']['diysearchhoticon']; ?> phb"></i></a><?php endif; ?>
						<button class="search-btn search-go" type="submit"><i class="icon-search"></i></button>
						<button class="cancel-btn" type="button">取消</button>
					</div>
					<?php endif; ?>		       
		       
		       
		   </form>
		</div>
    
		<div class="nav">
			<ul class="nav-menu-items">
				<li class="nav-menu-item <?php if($maccms['aid'] == 1): ?>selected<?php endif; ?>">
					<a href="<?php echo $maccms['path']; ?>" title="<?php echo $maccms['site_name']; ?>首页"><?php if($mxonest['mxcms']['s2']['pcdhicon'] == 1): ?><i class="icon-home"></i><?php endif; ?> <span>首页</span></a>
				</li>
				<?php $__TAG__ = '{"order":"asc","by":"sort","ids":"'.$mxonest['mxcms']['s2']['daohangid'].'","id":"vo","key":"key"}';$__LIST__ = model("Type")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
				<li class="nav-menu-item  <?php if(($vo['type_id'] == $GLOBALS[ 'type_id'] || $vo['type_id'] == $GLOBALS[ 'type_pid'])): ?>selected<?php endif; ?>">
					<a href="<?php echo mac_url_type($vo); ?>" title="<?php echo $vo['type_name']; ?>">
					     <?php if($mxonest['mxcms']['s2']['pcdhicon'] == 1): if($vo['type_id_1'] == $mxonest['mxcms']['s2']['num1']||$vo['type_id'] == $mxonest['mxcms']['s2']['num1']): ?>
                                  <i class="<?php echo $mxonest['mxcms']['s2']['icon1']; ?>"></i>
                                <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s2']['num2']||$vo['type_id'] == $mxonest['mxcms']['s2']['num2']): ?>
                                <i class="<?php echo $mxonest['mxcms']['s2']['icon2']; ?>"></i>
                                <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s2']['num3']||$vo['type_id'] == $mxonest['mxcms']['s2']['num3']): ?>
                                <i class="<?php echo $mxonest['mxcms']['s2']['icon3']; ?>"></i>
                                <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s2']['num4']||$vo['type_id'] == $mxonest['mxcms']['s2']['num4']): ?>
                                <i class="<?php echo $mxonest['mxcms']['s2']['icon4']; ?>"></i>
                                 <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s2']['num5']||$vo['type_id'] == $mxonest['mxcms']['s2']['num5']): ?>
                                <i class="<?php echo $mxonest['mxcms']['s2']['icon5']; ?>"></i>
                                 <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s2']['num6']||$vo['type_id'] == $mxonest['mxcms']['s2']['num6']): ?>
                                <i class="<?php echo $mxonest['mxcms']['s2']['icon6']; ?>"></i>
                                 <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s2']['num7']||$vo['type_id'] == $mxonest['mxcms']['s2']['num7']): ?>
                                <i class="<?php echo $mxonest['mxcms']['s2']['icon7']; ?>"></i>
                                <?php else: ?>
                                  <i class="<?php echo $mxonest['mxcms']['s2']['iconmr']; ?>"></i>
                                <?php endif; endif; ?>
                                <span><?php echo $vo['type_name']; ?></span>
					 </a>
				</li>
				<?php endforeach; endif; else: echo "" ;endif; if($mxonest['mxcms']['s2']['diy1'] == 1): ?>
					<li class="nav-menu-item">
					<a href="<?php echo $mxonest['mxcms']['s2']['diy1url']; ?>" target="_blank" title="<?php echo $mxonest['mxcms']['s2']['diy1name']; ?>">
					  <i class="<?php echo $mxonest['mxcms']['s2']['diy1icon']; ?>"></i> <span><?php echo $mxonest['mxcms']['s2']['diy1name']; ?></span>
					 </a>
				</li>
				<?php endif; if($mxonest['mxcms']['s2']['diy2'] == 1): ?>
					<li class="nav-menu-item">
					<a href="<?php echo $mxonest['mxcms']['s2']['diy2url']; ?>" target="_blank" title="<?php echo $mxonest['mxcms']['s2']['diy2name']; ?>" > 
					<i class="<?php echo $mxonest['mxcms']['s2']['diy2icon']; ?>"></i> <span><?php echo $mxonest['mxcms']['s2']['diy2name']; ?></span>
					</a>
				</li>
				<?php endif; if($mxonest['mxcms']['s2']['diy3'] == 1): ?>
					<li class="nav-menu-item">
					<a href="<?php echo $mxonest['mxcms']['s2']['diy3url']; ?>" target="_blank" title="<?php echo $mxonest['mxcms']['s2']['diy3name']; ?>" >
					 <i class="<?php echo $mxonest['mxcms']['s2']['diy3icon']; ?>"></i> <span><?php echo $mxonest['mxcms']['s2']['diy3name']; ?></span>
					 </a>
				</li>
				<?php endif; if($mxonest['mxcms']['s2']['zhiboym'] == 1): ?>
				<li class="nav-menu-item <?php if($maccms['aid'] == 7): ?>selected<?php endif; ?>">
					<a href="<?php echo mac_url('label/live'); ?>" title="<?php echo $maccms['site_name']; ?>直播" >
					<?php if($mxonest['mxcms']['s2']['pcdhicon'] == 1): ?> <i class="<?php echo $mxonest['mxcms']['s2']['diyliveicon']; ?>"></i><?php endif; ?><span>直播</span>
					 </a>
				</li>
					<?php endif; if($mxonest['mxcms']['s2']['wz0'] == 1): ?>
				<li class="nav-menu-item  domain plus">
					<a href="javascript:;" title="<?php echo $maccms['site_name']; ?>最新域名">
					   <?php if($mxonest['mxcms']['s2']['pcdhicon'] == 1): ?><i class="icon-domain"></i><?php endif; ?>  
					    <span>网址</span><em>+</em></a>
				</li>
					<?php endif; if($mxonest['mxcms']['s2']['app'] == 1): ?>	
				<li class="nav-menu-item">
					<a href="<?php echo mac_url('label/app'); ?>" title="下载<?php echo $maccms['site_name']; ?>APP"><i class="icon-app pc"></i><span>APP</span></a>
				</li>
			    <?php endif; ?>
			</ul>
		</div>
		 <?php if($mxonest['mxcms']['s2']['sydh'] == 1): ?>
			<div class="pc">
			<ul class="nav-menu-items">
			    	<li class="space-line-bold"></li>
					<li class="nav-menu-item drop ">
					<span class="nav-menu-icon">
                        <i class="<?php echo $mxonest['mxcms']['s2']['sydhicon']; ?>"></i>
                    </span>
					<div class="drop-content sub-block subw500">
						<div class="drop-content-box grid-box">
							<ul class="drop-content-items grid-items">
							 <?php $__TAG__ = '{"order":"asc","by":"sort","ids":"'.$mxonest['mxcms']['s2']['sydhall'].'","id":"vo","key":"key"}';$__LIST__ = model("Type")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>			
								<li class="grid-item">
									<a href="<?php echo mac_url_type($vo); ?>" title="<?php echo $vo['type_name']; ?>">
										<div class="grid-item-name"><?php echo $vo['type_name']; ?></div>
									</a>
								</li>
								<?php endforeach; endif; else: echo "" ;endif; ?>	
							</ul>
						</div>
					</div>
					<div class="shortcuts-mobile-overlay"></div>
				</li>
			</ul>
		</div>
		<?php endif; ?>
		
	
		
		<div class="header-module">
			<ul class="nav-menu-items">
			    <?php if($mxonest['mxcms']['s2']['wapsydh'] == 1): ?>
				<li class="nav-menu-item drop"><span class="nav-menu-icon"><i class="icon-all"></i></span>
					<div class="drop-content sub-block">
						<div class="drop-content-box grid-box">
							<ul class="drop-content-items grid-items">
								<li class="grid-item">
									<a href="<?php echo $maccms['path']; ?>"><i class="icon-home"></i>
										<div class="grid-item-name" title="<?php echo $maccms['site_name']; ?>首页">首页</div>
									</a>
								</li>
								<?php $__TAG__ = '{"order":"asc","by":"sort","ids":"'.$mxonest['mxcms']['s5']['wapdaohangid'].'","id":"vo","key":"key"}';$__LIST__ = model("Type")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
								<li class="grid-item">
									<a href="<?php echo mac_url_type($vo); ?>" title="<?php echo $vo['type_name']; ?>">
										<?php if($vo['type_id_1'] == $mxonest['mxcms']['s5']['num1']||$vo['type_id'] == $mxonest['mxcms']['s5']['num1']): ?>
										<i class="<?php echo $mxonest['mxcms']['s5']['icon1']; ?>"></i> <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s5']['num2']||$vo['type_id'] == $mxonest['mxcms']['s5']['num2']): ?>
										<i class="<?php echo $mxonest['mxcms']['s5']['icon2']; ?>"></i> <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s5']['num3']||$vo['type_id'] == $mxonest['mxcms']['s5']['num3']): ?>
										<i class="<?php echo $mxonest['mxcms']['s5']['icon3']; ?>"></i> <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s5']['num4']||$vo['type_id'] == $mxonest['mxcms']['s5']['num4']): ?>
										<i class="<?php echo $mxonest['mxcms']['s5']['icon4']; ?>"></i> <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s5']['num5']||$vo['type_id'] == $mxonest['mxcms']['s5']['num5']): ?>
										<i class="<?php echo $mxonest['mxcms']['s5']['icon5']; ?>"></i> <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s5']['num6']||$vo['type_id'] == $mxonest['mxcms']['s5']['num6']): ?>
										<i class="<?php echo $mxonest['mxcms']['s5']['icon6']; ?>"></i> <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s5']['num7']||$vo['type_id'] == $mxonest['mxcms']['s5']['num7']): ?>
										<i class="<?php echo $mxonest['mxcms']['s5']['icon7']; ?>"></i> <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s5']['num8']||$vo['type_id'] == $mxonest['mxcms']['s5']['num8']): ?>
										<i class="<?php echo $mxonest['mxcms']['s5']['icon8']; ?>"></i> <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s5']['num9']||$vo['type_id'] == $mxonest['mxcms']['s5']['num9']): ?>
										<i class="<?php echo $mxonest['mxcms']['s5']['icon9']; ?>"></i> <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s5']['num10']||$vo['type_id'] == $mxonest['mxcms']['s5']['num10']): ?>
										<i class="<?php echo $mxonest['mxcms']['s5']['icon10']; ?>"></i> 
										<?php else: ?>
										<i class="<?php echo $mxonest['mxcms']['s5']['iconmr']; ?>"></i>
										<?php endif; ?>
										<div class="grid-item-name"><?php echo $vo['type_name']; ?></div>
									</a>
								</li>
								<?php endforeach; endif; else: echo "" ;endif; if($mxonest['mxcms']['s5']['diy1'] == 1): ?>
								<li class="grid-item">
									<a target="_blank" href="<?php echo $mxonest['mxcms']['s5']['diy1url']; ?>" title="<?php echo $mxonest['mxcms']['s5']['diy1name']; ?>">
										<i class="<?php echo $mxonest['mxcms']['s5']['diy1icon']; ?>"></i>
										<div class="grid-item-name"><?php echo $mxonest['mxcms']['s5']['diy1name']; ?></div>
									</a>
								</li>
								<?php endif; if($mxonest['mxcms']['s5']['diy2'] == 1): ?>
								<li class="grid-item">
									<a  target="_blank" href="<?php echo $mxonest['mxcms']['s5']['diy2url']; ?>" title="<?php echo $mxonest['mxcms']['s5']['diy2name']; ?>">
										<i class="<?php echo $mxonest['mxcms']['s5']['diy2icon']; ?>"></i>
										<div class="grid-item-name"><?php echo $mxonest['mxcms']['s5']['diy2name']; ?></div>
									</a>
								</li>
								<?php endif; if($mxonest['mxcms']['s2']['wz0'] == 1): ?>
								<li class="grid-item">
									<a href="<?php echo mac_url('label/web'); ?>"><i class="icon-domain"></i>
										<div class="grid-item-name" title="网址">网址</div>
									</a>
								</li>
								<?php endif; ?>
								<li class="grid-item grid-more">
									<a class="grid-more-link" href="<?php echo mac_url_type($obj,['id'=>1],'show'); ?>" title="查看全部影片">
										<div class="grid-item-name">全部影片</div>
									</a>
								</li>
								<?php if($mxonest['mxcms']['s2']['app'] == 1): ?>
								<li class="grid-item grid-more android">
									<a href="<?php echo mac_url('label/app'); ?>" class="grid-more-link" title="下载<?php echo $maccms['site_name']; ?>APP">
										<div class="grid-item-name">下载客户端</div>
									</a>
								</li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
					<div class="shortcuts-mobile-overlay"></div>
				</li>
					<?php endif; ?>
				<li class="nav-menu-item nav-menu-search"><i class="icon-search"></i></li>
				<li class="space-line-bold"></li>
				<li class="nav-menu-item drop"><span class="nav-menu-icon"><i class="icon-watch-history"></i></span>
					<div class="drop-content drop-history">
						<div class="drop-content-box">
							<ul class="drop-content-items" id="history">
								<li class="list-item list-item-title">
									<a href="" class="playlist historyclean"><i class="icon-clear"></i></a>
									<strong>我的观影记录</strong></li>
							</ul>
						</div>
					</div>
					<div class="shortcuts-mobile-overlay"></div>
				</li>
				<?php if($mxonest['mxcms']['s2']['user'] == 1): if($maccms['user_status'] == 1): ?>
				<li class="space-line-bold"></li>
				
				

				
								
				<li class="nav-menu-item drop wapblock">
				    <span class="mac_user_center" title="会员中心" ><i class="iconfont icon-yonghu-fuben"></i></span>
				    <!--a class="mac_user" href="javascript:;" title="会员中心"><i class="iconfont icon-yonghu-fuben"></i></a-->
<?php if($GLOBALS['user']['user_id']): ?>
              <div class="drop-content drop-user-after">
              		<div class="drop-content-box">
							<ul class="drop-content-items" id="drop-user-after">
							
									
                            <li class="list-item list-item-title">
								<a style="float: right;font-size: 12px;" href="<?php echo mac_url('user/logout'); ?>">退出</a>
							<strong style="overflow: hidden;max-width: 100px;float: left;text-overflow: ellipsis;"><?php if(!$user['user_nick_name'] == ''): ?><?php echo $user['user_nick_name']; else: ?> <?php echo $user['user_name']; endif; ?>	</strong>
							<img src="<?php echo $maccms['path_tpl']; ?>mxstatic/image/<?php if($GLOBALS['user']['group_id'] == 3): ?>user_vip.png<?php else: ?>user_vip_no.png <?php endif; ?>"  width="22" style="margin-left: 6px;">
							</li>
<li class="list-item text-alink"><a href="<?php echo mac_url('user/plays'); ?>" ><i style="color:#03c8d4" class="icon-play"></i><span>我观看的</span></a></li>
<li class="list-item text-alink"><a href="<?php echo mac_url('user/favs'); ?>" ><i style="color:#03c8d4" class="icon-cate-zy"></i><span>我的收藏</span></a></li>
<li class="list-item text-alink"><a href="<?php echo mac_url('user/info'); ?>" ><i style="color:#03c8d4" class="icon-home"></i><span>个人中心</span></a></li>

            </ul></div></div>		

 <?php else: ?> 
				    <div class="drop-content drop-user">
						<div class="drop-content-box">
							<ul class="drop-content-items" id="drop-user">
								<li class="list-item list-item-title">	
									<div class="text-content">登录后可享受</div></li>
	<li class="list-item text-alink"><i style="color:#03c8d4" class="icon-play"></i><span>尊享极清观影体验</span></li>
	<li class="list-item text-alink"><i style="color:#03c8d4" class="icon-play"></i><span>同步多端播放记录</span></li>
	<li class="list-item text-alink"><i style="color:#03c8d4" class="icon-play"></i><span>热播精彩及时追</span></li>
	<li class="list-item button-area"><button class="mac_user" href="javascript:;" >立即登录</button></li></ul></div></div>	
<?php endif; endif; endif; ?>
			</ul>
		</div>
	</div>
</header>
<?php else: ?>
<header id="header" class="wrapper" <?php if($mxonest['mxcms']['s2']['pcgddh'] == 0): ?>style="padding-top: 0!important;"<?php endif; ?>>
	<div class="header-content  <?php if($mxonest['mxcms']['s2']['pcgddh'] == 0): ?>qxgddh<?php endif; ?>">
		<div class="content">
			<div class="brand">
				<a href="<?php echo $maccms['path']; ?>" class="logo" title="<?php echo $maccms['site_name']; ?>"><img src="<?php echo mac_url_img($mxonest['mxcms']['s1']['logo2']); ?>" alt="<?php echo $maccms['site_name']; ?>"></a>
			</div>

			<div class="nav-search">
				<form action="<?php echo mac_url('vod/search'); ?>" class="search-dh">
				    <?php if($maccms['aid'] != 13): ?>
					<div class="search-box"><input class="search-input ac_wd txtKeywords" type="text" name="wd" autocomplete="off" placeholder="<?php echo $mxonest['mxcms']['s1']['searchwd']; ?>">
						<div class="search-drop">
							<div class="drop-content-items ac_hot none">
								<div class="list-item list-item-title"><strong>大家都在搜这些影片</strong></div>
								<div class="search-tag">
									<?php $_67d3a9038b0be=explode(',',$maccms['search_hot']); if(is_array($_67d3a9038b0be) || $_67d3a9038b0be instanceof \think\Collection || $_67d3a9038b0be instanceof \think\Paginator): if( count($_67d3a9038b0be)==0 ) : echo "" ;else: foreach($_67d3a9038b0be as $key2=>$vo2): ?>
									<a href="<?php echo mac_url('vod/search',['wd'=>$vo2]); ?>" class="<?php if($key2 < 4): ?>hot <?php else: endif; ?>"><i class="icon-hot"></i><?php echo $vo2; ?></a>
									<?php endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</div>
						</div>
					     <?php if($mxonest['mxcms']['s2']['searchhoticon'] == 1): ?><a href="<?php echo mac_url('label/top'); ?>" class="search-btn search-cupfox" id="search-cupfox" title="<?php echo $maccms['site_name']; ?>排行榜" ><i class="<?php echo $mxonest['mxcms']['s2']['diysearchhoticon']; ?> phb"></i></a><?php endif; ?>
						<button class="search-btn search-go" type="submit"><i class="icon-search"></i></button>
						<button class="cancel-btn" type="button">取消</button>
					</div>
					<?php endif; ?>
				</form>
			</div>

			<div class="nav">
				<ul class="nav-menu-items">
					<li class="nav-menu-item <?php if($maccms['aid'] == 1): ?>selected<?php endif; ?>">
						<a href="<?php echo $maccms['path']; ?>" title="<?php echo $maccms['site_name']; ?>首页">
						<?php if($mxonest['mxcms']['s2']['pcdhicon'] == 1): ?><i class="icon-home nav-menu-item-name-white"></i><?php endif; ?> <span class="nav-menu-item-name">首页</span></a>
					</li>
					<?php $__TAG__ = '{"order":"asc","by":"sort","ids":"'.$mxonest['mxcms']['s2']['daohangid'].'","id":"vo","key":"key"}';$__LIST__ = model("Type")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
					<li class="nav-menu-item  <?php if(($vo['type_id'] == $GLOBALS[ 'type_id'] || $vo['type_id'] == $GLOBALS[ 'type_pid'])): ?>selected<?php endif; ?>">
						<a href="<?php echo mac_url_type($vo); ?>" title="<?php echo $vo['type_name']; ?>">
						    <?php if($mxonest['mxcms']['s2']['pcdhicon'] == 1): if($vo['type_id_1'] == $mxonest['mxcms']['s2']['num1']||$vo['type_id'] == $mxonest['mxcms']['s2']['num1']): ?>
                                  <i class="<?php echo $mxonest['mxcms']['s2']['icon1']; ?> nav-menu-item-name-white"></i>
                                <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s2']['num2']||$vo['type_id'] == $mxonest['mxcms']['s2']['num2']): ?>
                                <i class="<?php echo $mxonest['mxcms']['s2']['icon2']; ?> nav-menu-item-name-white"></i>
                                <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s2']['num3']||$vo['type_id'] == $mxonest['mxcms']['s2']['num3']): ?>
                                <i class="<?php echo $mxonest['mxcms']['s2']['icon3']; ?> nav-menu-item-name-white"></i>
                                <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s2']['num4']||$vo['type_id'] == $mxonest['mxcms']['s2']['num4']): ?>
                                <i class="<?php echo $mxonest['mxcms']['s2']['icon4']; ?> nav-menu-item-name-white"></i>
                                 <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s2']['num5']||$vo['type_id'] == $mxonest['mxcms']['s2']['num5']): ?>
                                <i class="<?php echo $mxonest['mxcms']['s2']['icon5']; ?> nav-menu-item-name-white"></i>
                                 <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s2']['num6']||$vo['type_id'] == $mxonest['mxcms']['s2']['num6']): ?>
                                <i class="<?php echo $mxonest['mxcms']['s2']['icon6']; ?> nav-menu-item-name-white"></i>
                                 <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s2']['num7']||$vo['type_id'] == $mxonest['mxcms']['s2']['num7']): ?>
                                <i class="<?php echo $mxonest['mxcms']['s2']['icon7']; ?> nav-menu-item-name-white"></i>
                                <?php else: ?>
                                  <i class="<?php echo $mxonest['mxcms']['s2']['iconmr']; ?> nav-menu-item-name-white"></i>
                                <?php endif; endif; ?> 
						    <span class="nav-menu-item-name"><?php echo $vo['type_name']; ?></span></a>
					</li>
					<?php endforeach; endif; else: echo "" ;endif; if($mxonest['mxcms']['s2']['diy1'] == 1): ?>
					<li class="nav-menu-item">
					<a target="_blank" href="<?php echo $mxonest['mxcms']['s2']['diy1url']; ?>" class="nav-link" >
					  <i class="<?php echo $mxonest['mxcms']['s2']['diy1icon']; ?> nav-menu-item-name-white"></i> 
					   <span class="nav-menu-item-name"> <?php echo $mxonest['mxcms']['s2']['diy1name']; ?></span>
					 </a>
				</li>
				<?php endif; if($mxonest['mxcms']['s2']['diy2'] == 1): ?>
					<li class="nav-menu-item">
					<a target="_blank" href="<?php echo $mxonest['mxcms']['s2']['diy2url']; ?>" class="nav-link" > 
					<i class="<?php echo $mxonest['mxcms']['s2']['diy2icon']; ?> nav-menu-item-name-white"></i> 
					 <span class="nav-menu-item-name"> <?php echo $mxonest['mxcms']['s2']['diy2name']; ?></span>
					</a>
				</li>
				<?php endif; if($mxonest['mxcms']['s2']['diy3'] == 1): ?>
					<li class="nav-menu-item">
					<a target="_blank" href="<?php echo $mxonest['mxcms']['s2']['diy3url']; ?>" class="nav-link" >
					 <i class="<?php echo $mxonest['mxcms']['s2']['diy3icon']; ?> nav-menu-item-name-white"></i> 
					  <span class="nav-menu-item-name"> <?php echo $mxonest['mxcms']['s2']['diy3name']; ?></span>
					 </a>
				</li>
				<?php endif; if($mxonest['mxcms']['s2']['zhiboym'] == 1): ?>
				<li class="nav-menu-item <?php if($maccms['aid'] == 9999): ?>selected<?php endif; ?>">
					<a href="<?php echo mac_url('label/live'); ?>" title="<?php echo $maccms['site_name']; ?>直播" >
					<?php if($mxonest['mxcms']['s2']['pcdhicon'] == 1): ?> <i class="<?php echo $mxonest['mxcms']['s2']['diyliveicon']; ?>"></i><?php endif; ?><span class="nav-menu-item-name">直播</span>
					 </a>
				</li>
					<?php endif; if($mxonest['mxcms']['s2']['wz0'] == 1): ?>	
					<li class="nav-menu-item  domain plus">
						<a href="javascript:;" title="<?php echo $maccms['site_name']; ?>最新域名">
						 <?php if($mxonest['mxcms']['s2']['pcdhicon'] == 1): ?><i class="icon-domain nav-menu-item-name-white"></i><?php endif; ?>  
						    <span class="nav-menu-item-name">网址</span><em>+</em></a>
					</li>
					 <?php endif; if($mxonest['mxcms']['s2']['app'] == 1): ?> 
					<li class="nav-menu-item  <?php if($maccms['aid'] == 9998): ?>selected<?php endif; ?>">
					<a href="<?php echo mac_url('label/app'); ?>" title="下载<?php echo $maccms['site_name']; ?>APP"><i class="icon-app pc"></i><span class="nav-menu-item-name">APP</span></a>
					</li>
					 <?php endif; ?>
					 
				</ul>
			</div>
				 <?php if($mxonest['mxcms']['s2']['sydh'] == 1): ?>
			<div class="pc">
			<ul class="nav-menu-items">
			    	<li class="space-line-bold"></li>
					<li class="nav-menu-item drop ">
					<span class="nav-menu-icon">
                        <i class="<?php echo $mxonest['mxcms']['s2']['sydhicon']; ?>"></i>
                    </span>
					<div class="drop-content sub-block subw500">
						<div class="drop-content-box grid-box">
							<ul class="drop-content-items grid-items">
							 <?php $__TAG__ = '{"order":"asc","by":"sort","ids":"'.$mxonest['mxcms']['s2']['sydhall'].'","id":"vo","key":"key"}';$__LIST__ = model("Type")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>			
								<li class="grid-item">
									<a href="<?php echo mac_url_type($vo); ?>" title="<?php echo $vo['type_name']; ?>">
										<div class="grid-item-name"><?php echo $vo['type_name']; ?></div>
									</a>
								</li>
								<?php endforeach; endif; else: echo "" ;endif; ?>	
							</ul>
						</div>
					</div>
					<div class="shortcuts-mobile-overlay"></div>
				</li>
			</ul>
		</div>
		<?php endif; ?>
			<div class="header-module">
				<ul class="nav-menu-items">
				     <?php if($mxonest['mxcms']['s2']['wapsydh'] == 1): ?>
					<li class="nav-menu-item drop"><span class="nav-menu-icon"><i class="icon-all"></i></span>
						<div class="drop-content sub-block">
							<div class="drop-content-box grid-box">
								<ul class="drop-content-items grid-items">
									<li class="grid-item">
										<a href="<?php echo $maccms['path']; ?>"><i class="icon-home"></i>
											<div class="grid-item-name" title="<?php echo $maccms['site_name']; ?>首页">首页</div>
										</a>
									</li>
									<?php $__TAG__ = '{"order":"asc","by":"sort","ids":"'.$mxonest['mxcms']['s5']['wapdaohangid'].'","id":"vo","key":"key"}';$__LIST__ = model("Type")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
									<li class="grid-item">
										<a href="<?php echo mac_url_type($vo); ?>" title="<?php echo $vo['type_name']; ?>">
											<?php if($vo['type_id_1'] == $mxonest['mxcms']['s5']['num1']||$vo['type_id'] == $mxonest['mxcms']['s5']['num1']): ?>
											<i class="<?php echo $mxonest['mxcms']['s5']['icon1']; ?>"></i> <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s5']['num2']||$vo['type_id'] == $mxonest['mxcms']['s5']['num2']): ?>
											<i class="<?php echo $mxonest['mxcms']['s5']['icon2']; ?>"></i> <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s5']['num3']||$vo['type_id'] == $mxonest['mxcms']['s5']['num3']): ?>
											<i class="<?php echo $mxonest['mxcms']['s5']['icon3']; ?>"></i> <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s5']['num4']||$vo['type_id'] == $mxonest['mxcms']['s5']['num4']): ?>
											<i class="<?php echo $mxonest['mxcms']['s5']['icon4']; ?>"></i> <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s5']['num5']||$vo['type_id'] == $mxonest['mxcms']['s5']['num5']): ?>
											<i class="<?php echo $mxonest['mxcms']['s5']['icon5']; ?>"></i> <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s5']['num6']||$vo['type_id'] == $mxonest['mxcms']['s5']['num6']): ?>
											<i class="<?php echo $mxonest['mxcms']['s5']['icon6']; ?>"></i> <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s5']['num7']||$vo['type_id'] == $mxonest['mxcms']['s5']['num7']): ?>
											<i class="<?php echo $mxonest['mxcms']['s5']['icon7']; ?>"></i> <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s5']['num8']||$vo['type_id'] == $mxonest['mxcms']['s5']['num8']): ?>
											<i class="<?php echo $mxonest['mxcms']['s5']['icon8']; ?>"></i> <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s5']['num9']||$vo['type_id'] == $mxonest['mxcms']['s5']['num9']): ?>
											<i class="<?php echo $mxonest['mxcms']['s5']['icon9']; ?>"></i> <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s5']['num10']||$vo['type_id'] == $mxonest['mxcms']['s5']['num10']): ?>
											<i class="<?php echo $mxonest['mxcms']['s5']['icon10']; ?>"></i> <?php else: ?>
											<i class="<?php echo $mxonest['mxcms']['s5']['iconmr']; ?>"></i> <?php endif; ?>
											<div class="grid-item-name"><?php echo $vo['type_name']; ?></div>
										</a>
									</li>
									<?php endforeach; endif; else: echo "" ;endif; if($mxonest['mxcms']['s5']['diy1'] == 1): ?>
									<li class="grid-item">
										<a target="_blank" href="<?php echo $mxonest['mxcms']['s5']['diy1url']; ?>" title="<?php echo $mxonest['mxcms']['s5']['diy1name']; ?>">
											<i class="<?php echo $mxonest['mxcms']['s5']['diy1icon']; ?>"></i>
											<div class="grid-item-name"><?php echo $mxonest['mxcms']['s5']['diy1name']; ?></div>
										</a>
									</li>
									<?php endif; if($mxonest['mxcms']['s5']['diy2'] == 1): ?>
									<li class="grid-item">
										<a target="_blank" href="<?php echo $mxonest['mxcms']['s5']['diy2url']; ?>" title="<?php echo $mxonest['mxcms']['s5']['diy2name']; ?>">
											<i class="<?php echo $mxonest['mxcms']['s5']['diy2icon']; ?>"></i>
											<div class="grid-item-name"><?php echo $mxonest['mxcms']['s5']['diy2name']; ?></div>
										</a>
									</li>
									<?php endif; if($mxonest['mxcms']['s2']['wz0'] == 1): ?>
									<li class="grid-item">
										<a href="<?php echo mac_url('label/web'); ?>"><i class="icon-domain"></i>
											<div class="grid-item-name" title="网址">网址</div>
										</a>
									</li>
									<?php endif; ?>
									<li class="grid-item grid-more">
										<a class="grid-more-link" href="<?php echo mac_url_type($obj,['id'=>1],'show'); ?>" title="查看全部影片">
											<div class="grid-item-name">全部影片</div>
										</a>
									</li>
									<?php if($mxonest['mxcms']['s2']['app'] == 1): ?>
									<li class="grid-item grid-more android">
										<a href="<?php echo mac_url('label/app'); ?>" class="grid-more-link" title="下载<?php echo $maccms['site_name']; ?>APP">
											<div class="grid-item-name">下载客户端</div>
										</a>
									</li>
									<?php endif; ?>
								</ul>
							</div>
						</div>
						<div class="shortcuts-mobile-overlay"></div>
					</li>
					<?php endif; ?>
					
					<li class="nav-menu-item nav-menu-search"><i class="icon-search"></i></li>
					<li class="space-line-bold"></li>
					<li class="nav-menu-item drop"><span class="nav-menu-icon"><i class="icon-watch-history"></i></span>
						<div class="drop-content drop-history">
							<div class="drop-content-box">
								<ul class="drop-content-items" id="history">
									<li class="list-item list-item-title">
										<a href="" class="playlist historyclean"><i class="icon-clear"></i></a>
										<strong>我的观影记录</strong></li>
								</ul>
							</div>
						</div>
						<div class="shortcuts-mobile-overlay"></div>
					</li>
					<?php if($mxonest['mxcms']['s2']['user'] == 1): if($maccms['user_status'] == 1): ?>
					<li class="space-line-bold"></li>
					
				<li class="nav-menu-item drop wapblock">
				    <span class="mac_user_center" title="会员中心" ><i class="iconfont icon-yonghu-fuben"></i></span>
				    <!--a class="mac_user" href="javascript:;" title="会员中心"><i class="iconfont icon-yonghu-fuben"></i></a-->
<?php if($GLOBALS['user']['user_id']): ?>
              <div class="drop-content drop-user-after">
              		<div class="drop-content-box">
							<ul class="drop-content-items" id="drop-user-after">
							
					<?php echo $GLOBALS['user']['group_id']; ?>				
                            <li class="list-item list-item-title">
									 <a style="float: right;font-size: 12px;" href="<?php echo mac_url('user/logout'); ?>">退出</a>
							<strong style="overflow: hidden;max-width: 100px;float: left;text-overflow: ellipsis;"><?php if(!$user['user_nick_name'] == ''): ?><?php echo $user['user_nick_name']; else: ?> <?php echo $user['user_name']; endif; ?>	</strong>
							<img src="<?php echo $maccms['path_tpl']; ?>mxstatic/image/<?php if($GLOBALS['user']['group_id'] == 3): ?>user_vip.png<?php else: ?>user_vip_no.png <?php endif; ?>"  width="22" style="margin-left: 6px;">
							</li>
<li class="list-item text-alink"><a href="<?php echo mac_url('user/plays'); ?>" ><i style="color:#03c8d4" class="icon-play"></i><span>我观看的</span></a></li>
<li class="list-item text-alink"><a href="<?php echo mac_url('user/favs'); ?>" ><i style="color:#03c8d4" class="icon-cate-zy"></i><span>我的收藏</span></a></li>
<li class="list-item text-alink"><a href="<?php echo mac_url('user/info'); ?>" ><i style="color:#03c8d4" class="icon-home"></i><span>个人中心</span></a></li>

            </ul></div></div>		

 <?php else: ?> 
				    <div class="drop-content drop-user">
						<div class="drop-content-box">
							<ul class="drop-content-items" id="drop-user">
								<li class="list-item list-item-title">	
									<div class="text-content">登录后可享受</div></li>
	<li class="list-item text-alink"><i style="color:#03c8d4" class="icon-play"></i><span>尊享极清观影体验</span></li>
	<li class="list-item text-alink"><i style="color:#03c8d4" class="icon-play"></i><span>同步多端播放记录</span></li>
	<li class="list-item text-alink"><i style="color:#03c8d4" class="icon-play"></i><span>热播精彩及时追</span></li>
	<li class="list-item button-area"><button class="mac_user" href="javascript:;" >立即登录</button></li></ul></div></div>	
<?php endif; endif; endif; ?>
				</ul>
			</div>
		</div>
	</div>
</header>

<?php endif; if($mxonest['mxcms']['s2']['pcgddh'] == 1): ?>
<script>
		 $(".nav-menu-search").click(function () {
             $(".nav-search").addClass("block");
         });
                
	$(document).scroll(function() {
		var H = $(document).scrollTop();
		if(H > 20) {
		  $(".header-content").addClass("header-bg");
		} else {
		  $(".header-content").removeClass("header-bg");
		}
		if(H > 80) {
          $(".header-content").addClass("header-bg");
         $(".search-dh").append($(".search-box"));
           $(".nav-menu-search").click(function () {
             $(".nav-search").addClass("block");
         });
		} else {
         $(".header-content").removeClass("header-bg");

          $(".search-main").append($(".search-box"));
         
		}
	});
</script>
<?php endif; ?> 
     <!-- 头部 -->
<main id="main" class="wrapper">
<?php if(!(empty($obj[vod_play_from]) || (($obj[vod_play_from] instanceof \think\Collection || $obj[vod_play_from] instanceof \think\Paginator ) && $obj[vod_play_from]->isEmpty()))): ?>
  <div class="player-block">
    <div class="content">
      <div class="player-box">
        <div class="player-box-main" >
          <?php if($mxonest['mxcms']['s2']['bftip'] == 1): ?>   
          <div class="tips-box">
              <div class="tips-list fodong_tips">
              <span class="close-btn"><i class="icon-close-o"></i></span>
        
          
              <ul>
                    <li>正在播放《<?php echo $obj['vod_name']; ?>》<?php echo $obj['vod_play_list'][$param['sid']]['urls'][$param['nid']]['name']; ?> - <?php echo $obj['vod_play_list'][$param['sid']]['player_info']['show']; ?></li>
					<li><span class="btn-main">提醒</span><?php echo $mxonest['mxcms']['s2']['bftips1']; ?></li>
					<li><span class="btn-yellow">技巧</span><?php echo $mxonest['mxcms']['s2']['bftips2']; ?></li>
					<li><span class="btn-yellow">收藏</span><?php echo $maccms['site_name']; ?>网址：<strong><?php echo $maccms['site_url']; ?>&nbsp; /&nbsp; <?php echo $maccms['site_url']; ?>&nbsp; ,记得收藏哟～</strong></li>
					
			</ul>        
             </div>
          </div>
         <?php endif; ?> 
          <div class="player-wrapper">
            <?php if($obj['vod_copyright'] == 1): ?>
		    <div style="background-color: #000;padding-bottom: 56.25%;">
			<div class="mxonenotice">
				<div class="col-pd text-center">
					<h5 class="mb20">温馨提示！</h5>
			        <h3 class="mb20"><?php echo $GLOBALS['config']['app']['copyright_notice']; ?></h3>
			        <p>	            	
			        	<a class="btnmxone btn-blue" href="<?php echo mac_url_vod_detail($obj); ?>">返回详情</a>
			        	<a class="btnmxone btn-yellows" href="<?php echo $maccms['path']; ?>">回到首页</a> 
			        </p>	            			        
				</div>          
			</div>
		</div>
		<?php else: ?>
		<?php echo $player_data; ?><?php echo $player_js; endif; ?>
        </div>
          
        </div>
      </div>
      <div class="player-info">
        <div class="video-info">
          <div class="video-info-box">
            <div class="video-info-header">
			  <h1 class="page-title"><a href="<?php echo mac_url_vod_detail($obj); ?>" title="<?php echo $obj['vod_name']; ?>"><?php echo $obj['vod_name']; ?></a></h1>
              <span class="btn-pc page-title"><?php echo $obj['vod_play_list'][$param['sid']]['urls'][$param['nid']]['name']; ?></span>
              <div class="video-info-aux">
                <a href="<?php if($obj['type_1']!=''): ?><?php echo mac_url_type($obj['type_1']); else: ?><?php echo mac_url_type($obj['type']); endif; ?>" title="<?php if($obj['type_1']!=''): ?><?php echo $obj['type_1']['type_name']; else: ?><?php echo $obj['type']['type_name']; endif; ?>" class="tag-link">
                <span class="video-tag-icon">
                    <?php if($obj['type_id_1'] == 1||$obj['type_id'] == 1): ?>
                     <i class="icon-cate-dy"></i>
                     <?php elseif($obj['type_id_1'] == 2||$obj['type_id'] == 2): ?>
                     <i class="icon-cate-ds"></i>
                     <?php elseif($obj['type_id_1'] == 3||$obj['type_id'] == 3): ?>
                     <i class="icon-cate-zy"></i>
                      <?php elseif($obj['type_id_1'] == 4||$obj['type_id'] == 4): ?>
                      <i class="icon-cate-dm"></i>
                     <?php else: endif; if($obj['type_1']!=''): ?><?php echo $obj['type_1']['type_name']; else: ?><?php echo $obj['type']['type_name']; endif; ?>
                </span>
                </a>
                 
                <div class="tag-link">
				<span class="slash">/</span>    
				<?php $_67d3a9038af77=explode(',',$obj['vod_class']); if(is_array($_67d3a9038af77) || $_67d3a9038af77 instanceof \think\Collection || $_67d3a9038af77 instanceof \think\Paginator): if( count($_67d3a9038af77)==0 ) : echo "" ;else: foreach($_67d3a9038af77 as $key2=>$vo2): ?>	    
				<a href="<?php echo mac_url_type($obj['type']['type_id'],['id'=>$obj['type_id'],'class'=>$vo2],'show'); ?>"><?php echo $vo2; ?></a><span class="slash">/</span>
                <?php if($key2>='1'): break; endif; endforeach; endif; else: echo "" ;endif; ?>
				</div>
						
		    	<a class="tag-link" href="<?php echo mac_url_type($obj['type']['type_id'],['id'=>$obj['type_id'],'year'=>$obj['vod_year']],'show'); ?>"><?php echo mac_default($obj['vod_year'],'未知'); ?>	</a>
						
                <a class="tag-link" href="<?php echo mac_url_type($obj['type']['type_id'],['id'=>$obj['type_id'],'area'=>$obj['vod_area']],'show'); ?>"><?php echo mac_default($obj['vod_area'],'未知'); ?>	</a>
                <a class="tag-link icon-hot" href="#"><?php echo $obj['vod_hits']; ?>+</a>        
                        
                        
                        <?php echo $obj['vod_hits']; ?>+
                 </div>
            </div>
            <div class="video-info-main">
              <div class="video-info-items"><span class="video-info-itemtitle">剧情：</span>
              <div class="video-info-item video-info-content vod_content">
						    <span><?php echo mac_default(mac_filter_html($obj['vod_content']),'内详'); ?></span>
							<a href="javaScript:;" class="shrink">收起</a>
						</div>
              </div>
            </div>
          </div>
           <div class="col-lg-wide-7 col-xs-1" style="color: #fff!important;position: relative;overflow: hidden;background-color: var(--bs-dark);text-align: center;border-radius: 30px;background-image: linear-gradient(135deg, #c209ff 10%, #ff4700 100%);margin: 15px 10px 10px 0px;width: 100%;">
              <b>推荐</b>
              <a onclick="MAC.Gbook.Report('<?php echo $obj['vod_play_list'][$param['sid']]['player_info']['show']; ?>线路-《<?php echo $obj['vod_name']; ?>》' + location.href,'<?php echo $param['sid']; ?>')">如果是遇到无法播放，可以点击这里反馈！</a></div>
          <div class="video-player-handle">
              <?php if($obj['player_info']['link_next']): ?>
             <a href="<?php if($param['nid'] == $obj['vod_play_list'][$param['sid']]['url_count']): ?>javascript:void(0); <?php else: ?><?php echo $obj['player_info']['link_next']; endif; ?>" class="btn-block-o handle-btn" title="播放《<?php echo $obj['vod_name']; ?>》下一集"><i class="icon-next"></i><p class="block-name">下一集</p></a>
          
             <?php endif; ?>
            <div class="drop pc"><span class="btn-block-o handle-btn handle-more" title="使用手机扫二维码观看"><i class="icon-qrcode"></i>
              <em>观看</em><p class="block-name">手机扫码</p>
              </span>
              <div class="drop-content handle-more-drop">
                <div class="drop-content-box">
                  <div class="drop-content-items"><a class="btn-qrcode">
                    <div class="qrcode-img"></div>
                    <div class="block-name">
                      <p>使用 手机浏览器 扫码观看</p>
                      <strong><?php echo $obj['vod_name']; ?> -<?php echo $obj['vod_play_list'][$param['sid']]['urls'][$param['nid']]['name']; ?></strong></div>
                    </a></div>
                </div>
              </div>
              <div class="shortcuts-mobile-overlay"></div>
            </div>
            <?php if(!(empty($obj[vod_down_from]) || (($obj[vod_down_from] instanceof \think\Collection || $obj[vod_down_from] instanceof \think\Paginator ) && $obj[vod_down_from]->isEmpty()))): ?>
             <a href="<?php echo mac_url_vod_down($obj); ?>" class="btn-block-o handle-btn handle-down" title="《<?php echo $obj['vod_name']; ?>》免费下载"><i class="icon-download-bold"></i><em>免费</em><p class="block-name">下载</p></a>
             <?php endif; ?>
            <div class="video-player-handle-more">
              <div class="btn-block-o handle-btn handle-share share-btn" title="分享《<?php echo $obj['vod_name']; ?>》给朋友一起看" data-clipboard-text="<?php echo $maccms['site_url']; ?><?php echo mac_url_vod_detail($obj); ?> 我正在<?php echo $maccms['site_name']; ?>观看《<?php echo $obj['vod_name']; ?>》，推荐给你一起看！"><i class="icon-share"></i>
                <p class="block-name">分享</p>
              </div>
<?php

if (strstr($obj['vod_play_list'][$param['sid']]['urls'][$param['nid']]['url'],"qq.com")==true||
strstr($obj['vod_play_list'][$param['sid']]['urls'][$param['nid']]['url'],"iqiyi.com")==true||
strstr($obj['vod_play_list'][$param['sid']]['urls'][$param['nid']]['url'],"youku.com")==true||
strstr($obj['vod_play_list'][$param['sid']]['urls'][$param['nid']]['url'],"mgtv.com")==true||
strstr($obj['vod_play_list'][$param['sid']]['urls'][$param['nid']]['url'],"letv.com")==true||
strstr($obj['vod_play_list'][$param['sid']]['urls'][$param['nid']]['url'],"pptv.com")==true||
strstr($obj['vod_play_list'][$param['sid']]['urls'][$param['nid']]['url'],"bilibili.com")==true||
strstr($obj['vod_play_list'][$param['sid']]['urls'][$param['nid']]['url'],"sohu.com")==true||
strstr($obj['vod_play_list'][$param['sid']]['urls'][$param['nid']]['url'],"m1905.com")==true||
strstr($obj['vod_play_list'][$param['sid']]['urls'][$param['nid']]['url'],"migu.com")==true||
strstr($obj['vod_play_list'][$param['sid']]['urls'][$param['nid']]['url'],"cctv.com")==true||
strstr($obj['vod_play_list'][$param['sid']]['urls'][$param['nid']]['url'],"cntv.com")==true||
strstr($obj['vod_play_list'][$param['sid']]['urls'][$param['nid']]['url'],"wasu.com")==true
){ ?>	

              <div class="drop"><span class="btn-block-o handle-btn handle-more"><i class="iconfont icon-qiehuan"></i>
                <em>线路</em><p class="block-name">切换<d></p>
                </span>
                <div class="drop-content handle-more-drop">
                  <div class="drop-content-box">
                    <div class="drop-content-items" id="ig-xlqh">
                      <a  target="_blank"  class="btn-block-o" href="<?php echo $obj['vod_play_list'][$param['sid']]['urls'][$param['nid']]['url']; ?>"><i class="icon-play"></i><p class="block-name"><strong>跳转官网</strong><br>请支持正版！</p></a>
                      </div>
                    <div class="drop-content-items" id="ig-xlqh">

                    </div>
                  </div>
                </div>
                <div class="shortcuts-mobile-overlay"></div>
              </div>

<?php } ?>	
 

              
              <div class="drop"><span class="btn-block-o handle-btn handle-more"><i class="icon-more"></i>
                <p class="block-name">观影+<d></p>
                </span>
                <div class="drop-content handle-more-drop">
                  <div class="drop-content-box">
                    <div class="drop-content-items">
                       <a class="btn-block-o" onclick="MAC.Gbook.Report('ID:<?php echo $obj['vod_id']; ?> -【视频名：<?php echo $obj['vod_name']; ?> - <?php echo $obj['vod_play_list'][$param['sid']]['urls'][$param['nid']]['name']; ?> - <?php echo $obj['vod_play_list'][$param['sid']]['player_info']['show']; ?>】无法观看请官方修复一下')"><i class="icon-warn"></i>
                      <p class="block-name"><strong>视频报错</strong><br>
                        如果是遇到无法播放请提交反馈</p>
                      </a>
                      <a class="btn-block-o btn-screen"><i class="icon-tv"></i>
                      <p class="block-name"><strong>投屏到电视</strong><br>
                        教程：把手机影片投到电视上播放</p>
                      </a></div>
                  </div>
                </div>
                <div class="shortcuts-mobile-overlay"></div>
              </div>
            </div>
          </div>
        </div>
                <style>
                    .handle-more-drop .ok .block-name strong {color: rgb(224 39 39 / 83%);}
                </style>          
         <div id="jxline" style="display:none"><?php echo $mxonest['mxcms']['s2']['play']['jxxl']; ?></div>
         <a style="display:none" id="bfurl" href="<?php echo $obj['vod_play_list'][$param['sid']]['urls'][$param['nid']]['url']; ?>"></a>
                            
      <?php if($mxonest['mxcms']['s3']['adqj'] == 1): if($mxonest['mxcms']['s3']['adqj'] == 1): ?>
<?php echo $mxonest['mxcms']['s3']['aadqj']; endif; ?>	 <!-- 全局广告位 -->	<?php endif; ?>
        
      </div>
      <div class="player-box-side"> 
        <div class="module-heading">
          <h2 class="module-title" title="<?php echo $obj['vod_name']; ?>的在线观看列表">在线观看</h2>
          <div class="module-tab module-player-tab  player-side-tab">
            <input type="hidden" name="tab" id="tab" class="module-tab-input">
            <label class="module-tab-name"><span class="module-tab-value"><?php echo $obj['vod_play_list'][$param['sid']]['player_info']['show']; ?></span><i class="icon-arrow-bottom-o"></i></label>
             <div class="module-tab-items">
              <div class="module-tab-title">播放节点列表<span class="close-drop"><i class="icon-close-o"></i></span></div>





<div class="module-tab-content">
               <?php if(is_array($obj['vod_play_list']) || $obj['vod_play_list'] instanceof \think\Collection || $obj['vod_play_list'] instanceof \think\Paginator): if( count($obj['vod_play_list'])==0 ) : echo "" ;else: foreach($obj['vod_play_list'] as $key=>$vo): if($param['sid'] == $vo['sid']): ?> 
                 <div class="module-tab-item tab-item selected" data-dropdown-value="<?php echo $vo['player_info']['show']; ?>"><span><?php echo $vo['player_info']['show']; ?></span><small><?php echo $vo['url_count']; ?></small></div>
               <?php else: ?>    
               <a class="module-tab-item tab-item" href="<?php echo mac_url_vod_play($obj,['sid'=>$vo['sid'],'nid'=>$param['nid']]); ?>"><span data-dropdown-value="<?php echo $vo['player_info']['show']; ?>"><?php echo $vo['player_info']['show']; ?></span><small><?php echo $vo['url_count']; ?></small></a>
               <?php endif; endforeach; endif; else: echo "" ;endif; ?>	
                 </div>
            </div>
          </div>
          <div class="shortcuts-mobile-overlay"></div>
        </div>
        
        <?php if(is_array($obj['vod_play_list']) || $obj['vod_play_list'] instanceof \think\Collection || $obj['vod_play_list'] instanceof \think\Paginator): if( count($obj['vod_play_list'])==0 ) : echo "" ;else: foreach($obj['vod_play_list'] as $key=>$vo): ?>	
          <div class="module-list module-player-list tab-list sort-list <?php switch($obj['type_id_1']): case "3": ?>module-vod-list<?php break; endswitch; if($param['sid'] == $vo['sid']): ?> selected<?php endif; ?>    player-side-playlist">

              
              
         <div class="module-list-right-title-wrap">
    <div class="normal-title-wrap">
        <div class="thesis-wrap">
            
            <strong><a href="<?php echo mac_url_vod_detail($obj); ?>" target="_blank" class="title-link" title="<?php echo $obj['vod_name']; ?>"><?php echo $obj['vod_name']; ?></a></strong>
            <a href="javascript:void(0);" class="mac_ulog reserve" data-type="2" data-mid="<?php echo $maccms['mid']; ?>" data-id="<?php echo $obj['vod_id']; ?>" title="收藏"><i class="iconfont icon-shoucang1"></i></a>
            
        </div>
     <div class="title-info"><span>【<?php if($obj['vod_remarks'] != ''): ?><?php echo $obj['vod_remarks']; elseif($obj['vod_serial'] > 0): ?>第<?php echo $obj['vod_serial']; ?>集<?php else: if($obj['type']['type_id'] == '1'): ?>超清<?php else: ?>已完结<?php endif; endif; ?>】<br><strong>官网同步更新,若有延迟请稍作休息再看看</strong></span><br>
       </div>
       
     <div class="title-info-ad">
         <?php if($obj['vod_points'] > 0): ?>
         <a href="/user/upgrade.html"   target="_blank">
         <div  class="button-container button-vip"><div class="content-ad">VIP观看全集，点击直达！</div></div>
         </a>
         <?php endif; if($mxonest['mxcms']['s2']['app'] == 1): ?>      
          <a href="/label/app.html"   target="_blank">
         <div  class="button-container button-app"><div class="content-ad">客户端下载，点击直达！</div></div>
         </a>        
         <?php endif; $_67d3a9038aef4=explode(',',$mxonest['mxcms']['s2']['play']['jxxlhost']); if(is_array($_67d3a9038aef4) || $_67d3a9038aef4 instanceof \think\Collection || $_67d3a9038aef4 instanceof \think\Paginator): if( count($_67d3a9038aef4)==0 ) : echo "" ;else: foreach($_67d3a9038aef4 as $key2=>$vo2): ?> 
       if (strstr($obj['vod_play_list'][$param['sid']]['urls'][$param['nid']]['url'],$vo2)==true){ 
         <a href="">
         <div  class="button-container button-app"><div class="content-ad">播放失败点我【切换】解析或线路！</div></div>
         </a> 

        <?php endforeach; endif; else: echo "" ;endif; ?>
     </div>  
     
     
    </div>
          </div>   
              
              
              
              
              
              
          <div class="module-tab module-sorttab">
            <input type="hidden" name="tab-sort" id="tab-sort" class="module-tab-input">
            <label class="module-tab-name"><i class="icon-sort"></i>选集</label>
            <div class="module-tab-items">
              <div class="module-tab-title">选集<span class="close-drop"><i class="icon-close-o"></i></span><a class="desc sort-button" href="javascript:void(0);" to="#sort-item-<?php echo $key; ?>"><i class="icon-sort"></i>排序</a></div>
              <div class="module-tab-content">
                <div class="module-blocklist">
                  <div class="sort-item" id="sort-item-<?php echo $key; ?>">
                <?php if(is_array($vo['urls']) || $vo['urls'] instanceof \think\Collection || $vo['urls'] instanceof \think\Paginator): if( count($vo['urls'])==0 ) : echo "" ;else: foreach($vo['urls'] as $key2=>$vo2): ?> 

                <!---新添加新和VIP更新图标+1-->
                 <a onclick="topLine(event)" href="<?php echo mac_url_vod_play($obj,['sid'=>$vo['sid'],'nid'=>$vo2['nid']]); ?>" class="<?php if($param['sid'] == $vo['sid'] && $param['nid'] == $vo2['nid']): ?>selected<?php endif; ?>"  title="播放<?php echo $obj['vod_name']; ?><?php echo $vo2['name']; ?>"><span><?php echo $vo2['name']; ?></span>
<?php if($vo2 == end($vo['urls'])&&$obj['vod_points'] > 0): ?> <em>VIP</em>
<?php elseif($vo2['nid'] > $vo['url_count'] -2&&$vo['url_count'] > 2): ?> <em style="background:#FF008C;color:#FFFFFF">最新</em><?php endif; if($vo2 == end($vo['urls'])&&$obj['vod_level'] == '3'): ?> <em style="background:#00BFFF;color:#FFFFFF">预告</em><?php endif; if($vo2 == end($vo['urls'])&&$obj['vod_level'] == '7'): ?> <em style="background:#99cc00;color:#FFFFFF">自播</em><?php endif; if($param['sid'] == $vo['sid'] && $param['nid'] == $vo2['nid']): ?><div class="playon"><i></i><i></i><i></i><i></i></div><?php endif; ?>
                 
                <!---新添加新和VIP更新图标+1结束-->
                 
                
                 <!---旧版的没有新和VIP图标-1-->
                 <!---
                <a onclick="topLine(event)" href="<?php echo mac_url_vod_play($obj,['sid'=>$vo['sid'],'nid'=>$vo2['nid']]); ?>" class="<?php if($param['sid'] == $vo['sid'] && $param['nid'] == $vo2['nid']): ?>selected<?php endif; ?>"  title="播放<?php echo $obj['vod_name']; ?><?php echo $vo2['name']; ?>"><span><?php echo $vo2['name']; ?></span>
                  <?php if($param['sid'] == $vo['sid'] && $param['nid'] == $vo2['nid']): ?><div class="playon"><i></i><i></i><i></i><i></i></div><?php endif; ?>
                  -->
                   <!---旧版的没有新和VIP图标-1-->
                  
                  
                </a>
                <?php endforeach; endif; else: echo "" ;endif; ?>                     
                   </div>
                </div>
              </div>
            </div>
          </div>
          <div class="shortcuts-mobile-overlay"></div>
          <div class="module-blocklist scroll-box scroll-box-y">
            <div class="scroll-content">
               <?php if(is_array($vo['urls']) || $vo['urls'] instanceof \think\Collection || $vo['urls'] instanceof \think\Paginator): if( count($vo['urls'])==0 ) : echo "" ;else: foreach($vo['urls'] as $key2=>$vo2): ?> 
               <!---新添加新和VIP更新图标+2-->
            <a href="<?php echo mac_url_vod_play($obj,['sid'=>$vo['sid'],'nid'=>$vo2['nid']]); ?>" class="<?php if($param['sid'] == $vo['sid'] && $param['nid'] == $vo2['nid']): ?>selected<?php endif; ?>" title="播放<?php echo $obj['vod_name']; ?><?php echo $vo2['name']; ?>"><span><?php echo $vo2['name']; ?></span> 
<?php if($vo2 == end($vo['urls'])&&$obj['vod_points'] > 0): ?> <em>VIP</em>
<?php elseif($vo2['nid'] > $vo['url_count'] -2&&$vo['url_count'] > 2): ?> <em style="background:#FF008C;color:#FFFFFF">最新</em><?php endif; if($vo2 == end($vo['urls'])&&$obj['vod_level'] == '3'): ?><em style="background:#00BFFF;color:#FFFFFF">预告</em><?php endif; if($vo2 == end($vo['urls'])&&$obj['vod_level'] == '7'): ?> <em style="background:#99cc00;color:#FFFFFF">自播</em><?php endif; if($param['sid'] == $vo['sid'] && $param['nid'] == $vo2['nid']): ?><div class="playon"><i></i><i></i><i></i><i></i></div><?php endif; ?> 
               
               <!---新添加新和VIP更新图标+2结束-->
               
               <!---旧版的没有新和VIP图标-2-->
               <!---
            <a href="<?php echo mac_url_vod_play($obj,['sid'=>$vo['sid'],'nid'=>$vo2['nid']]); ?>" class="<?php if($param['sid'] == $vo['sid'] && $param['nid'] == $vo2['nid']): ?>selected<?php endif; ?>" title="播放<?php echo $obj['vod_name']; ?><?php echo $vo2['name']; ?>"><span><?php echo $vo2['name']; ?></span>
              <?php if($param['sid'] == $vo['sid'] && $param['nid'] == $vo2['nid']): ?><div class="playon"><i></i><i></i><i></i><i></i></div><?php endif; ?>
              -->
              <!---旧版的没有新和VIP图标-2-->
            </a>
             <?php endforeach; endif; else: echo "" ;endif; ?>              
                          
            </div>
          </div>
        </div>
         <?php endforeach; endif; else: echo "" ;endif; ?>
              </div>
    </div>
  </div>
	<?php endif; ?>
          	
  <div class="content">

<?php if($mxonest['mxcms']['s3']['ad3'] == 1): ?><?php echo $mxonest['mxcms']['s3']['aad3']; ?>
 <!-- 广告位03 -->	 <?php endif; if($obj['vod_actor'] != ''): $__TAG__ = '{"num":"1","order":"desc","name":"'.$obj[vod_actor].'","id":"vo1","key":"key"}';$__LIST__ = model("Actor")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($key % 2 );++$key;if($vo1['actor_name'] != ''): ?>    
        <div class="module">
			<div class="module-heading">
			<h2 class="module-title" title="<?php echo $obj['vod_name']; ?>相关演员">相关演员</h2>
			</div>
      <div class="module-actor-list  ">
         <div class="module-list module-line-list"> 
					<div class="module-items actor-list  scroll-box ">
                      <div class="scroll-content" style="display: inline-flex;">
                          
                          <?php $__TAG__ = '{"num":"6","order":"desc","name":"'.$obj[vod_actor].'","id":"vo2","key":"key"}';$__LIST__ = model("Actor")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($key % 2 );++$key;?>
                          
						<div><a class="actor_part" title="<?php echo $vo2['actor_name']; ?>" >
						    <div class="actor_pic">
						<img class=" lazy lazyloaded" data-src="<?php echo mac_url_img($vo2['actor_pic']); ?>" src="<?php echo mac_url_img($mxonest['mxcms']['s1']['pic']); ?>">
						   </div>
                			<div class="actor_name"><?php echo $vo2['actor_name']; ?></div>
                			</a>
                			<i class="actor_arrow"></i>
                       </div>
                           	<?php endforeach; endif; else: echo "" ;endif; ?>
                       
                      </div>
                      <div class="actor_xian"></div>   
			    	</div>		    

		             <div class="module-list module-line-list trochanter-actorvbox">
<?php $__TAG__ = '{"num":"6","order":"desc","name":"'.$obj[vod_actor].'","id":"vo2","key":"key"}';$__LIST__ = model("Actor")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($key % 2 );++$key;?>        
                       <div class="module-items scroll-box dd">
                        <div class="scroll-content">

			    <?php $__TAG__ = '{"num":"","actor":"'.$vo2['actor_name'].'","order":"desc","by":"time","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;if($mxonest['mxcms']['s2']['qzslt'] == 0): ?>	  
                <div class="module-item">
				<div class="module-item-cover">
					<div class="module-item-pic">
						<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" title="<?php echo $vo['vod_name']; ?>" >
							<i class="icon-play"></i>
						</a>
						<img class="lazy lazyloaded"  data-src="<?php echo mac_url_img($vo['vod_pic']); ?>" src="<?php echo mac_url_img($mxonest['mxcms']['s1']['pic']); ?>"  alt="<?php echo $vo['vod_name']; ?>">
						<div class="loading"></div>
					</div>
					<div class="module-item-caption">
						<span><?php echo $vo['vod_year']; ?></span>
						<span class="video-class"><?php echo $vo['type']['type_name']; ?></span>
						<span><?php echo $vo['vod_area']; ?></span>
					</div>
			
					<?php if($vo['vod_points'] > '0'): ?>
					<div class="module-item-ru">
						<span class="vip">VIP</span>
					</div>
					<?php endif; if($vo['vod_level'] == $mxonest['mxcms']['s2']['hotlevel']): ?>
					<div class="module-item-ru">
						<span class="<?php echo $mxonest['mxcms']['s2']['rebocss']; ?>">热播</span>
					</div>
					<?php endif; if($vo['vod_level'] == '9'): ?>
					<div class="module-item-ru">
						<span class="<?php echo $mxonest['mxcms']['s2']['vipcss']; ?>">独家推荐</span>
					</div>
					<?php endif; if($vo['vod_level'] == '2'): ?>
					<div class="module-item-ru">
						<span class="yugao">首播</span>
					</div>
					<?php endif; if($vo['vod_level'] == '3'): ?>
					<div class="module-item-ru">
						<span class="yugao">预告</span>
					</div>
					<?php endif; if($vo['vod_level'] == '4'): ?>
					<div class="module-item-ru">
						<span class="rebo">独播</span>
					</div>
					<?php endif; if($vo['vod_level'] == '5'): ?><!--热播标题的左侧额外的推荐电影名称：视频推荐 5-->
					<div class="module-item-ru">
						<span class="<?php echo $mxonest['mxcms']['s2']['tuijiancss']; ?>">推荐</span>
					</div>
					<?php endif; if($vo['vod_class'] == '院线'): ?>
					<div class="module-item-ru">
						<span class="yugao">院线</span>
					</div>
					<?php endif; ?>					
					
					<div class="module-item-content">
						<div class="module-item-style video-name">
							<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" title="<?php echo $vo['vod_name']; ?>"><?php echo $vo['vod_name']; ?></a>
						</div>
						<div class="module-item-style video-tag">
						<?php echo mac_url_create(mac_default($vo['vod_actor'],'未知'),'actor'); ?>
						</div>
						<div class="module-item-style video-text"><?php echo $vo['vod_blurb']; ?></div>
					</div>
				</div>
				<div class="module-item-titlebox">
					<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" class="module-item-title" title="<?php echo $vo['vod_name']; ?>"><?php echo $vo['vod_name']; ?></a>
				</div>
				<div class="module-item-text"><?php if($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; elseif($vo['vod_serial'] > 0): ?>第<?php echo $vo['vod_serial']; ?>集<?php else: ?>已完结<?php endif; ?></div>
			</div>
			<?php else: ?>
				<div class="module-item module-item-go w16">
					<div class="module-item-cover">
						<div class="module-item-pic">
							<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" title="<?php echo $vo['vod_name']; ?>">
							    	<i class="icon-play"></i>
							</a>
							<img class=" ls-is-cached  lazy lazyloaded" data-src="<?php echo mac_url_img($vo['vod_pic']); ?>" src="<?php echo mac_url_img($mxonest['mxcms']['s1']['pic1']); ?>" alt="<?php echo $vo['vod_name']; ?>">
							<div class="loading"></div>
						</div>
						<div class="module-item-caption">
						   <span><?php echo $vo['vod_year']; ?></span>
						  <span class="video-class"><?php echo $vo['type']['type_name']; ?></span>
						</div>
					<?php if($vo['vod_points'] > '0'): ?>
					<div class="module-item-ru">
						<span class="vip">VIP</span>
					</div>
					<?php endif; if($vo['vod_levels'] == '8'): ?>
					<div class="module-item-ru">
						<span class="rebo">热播</span>
					</div>
					<?php endif; if($vo['vod_levels'] == '9'): ?>
					<div class="module-item-ru">
						<span class="rebo">独家推荐</span>
					</div>
					<?php endif; if($vo['vod_class'] == '院线'): ?>
					<div class="module-item-ru">
						<span class="yugao">院线</span>
					</div>
					<?php endif; ?>						
					</div>
					<div class="module-item-titlebox">
						<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" class="module-item-title" title="<?php echo $vo['vod_name']; ?>"><?php echo $vo['vod_name']; ?></a>
					</div>
					<div class="module-item-text"><?php if($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; elseif($vo['vod_serial'] > 0): ?>第<?php echo $vo['vod_serial']; ?>集<?php else: ?>已完结<?php endif; ?></div>
				</div>
        <?php endif; endforeach; endif; else: echo "" ;endif; ?>
						</div>	
					   </div>
<?php endforeach; endif; else: echo "" ;endif; ?>							
							
                     </div>
				</div>
			</div>
	
		</div> 

  					 <?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>	       <!-- 演员表 -->
      	<div class="module">
			<div class="module-heading">
			<h2 class="module-title" title="与<?php echo $obj['vod_name']; ?>相关的影片列表">相关影片</h2>
			</div>
			<div class="module-list module-lines-list">
				<div class="module-items">
			  <?php if($mxonest['mxcms']['s2']['qzslt'] == 1): $__TAG__ = '{"num":"12","type":"current","order":"desc","by":"time","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;if($mxonest['mxcms']['s2']['qzslt'] == 0): ?>	  
                <div class="module-item">
				<div class="module-item-cover">
					<div class="module-item-pic">
						<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" title="<?php echo $vo['vod_name']; ?>" >
							<i class="icon-play"></i>
						</a>
						<img class="lazy lazyloaded"  data-src="<?php echo mac_url_img($vo['vod_pic']); ?>" src="<?php echo mac_url_img($mxonest['mxcms']['s1']['pic']); ?>"  alt="<?php echo $vo['vod_name']; ?>">
						<div class="loading"></div>
					</div>
					<div class="module-item-caption">
						<span><?php echo $vo['vod_year']; ?></span>
						<span class="video-class"><?php echo $vo['type']['type_name']; ?></span>
						<span><?php echo $vo['vod_area']; ?></span>
					</div>
			
					<?php if($vo['vod_points'] > '0'): ?>
					<div class="module-item-ru">
						<span class="vip">VIP</span>
					</div>
					<?php endif; if($vo['vod_level'] == $mxonest['mxcms']['s2']['hotlevel']): ?>
					<div class="module-item-ru">
						<span class="<?php echo $mxonest['mxcms']['s2']['rebocss']; ?>">热播</span>
					</div>
					<?php endif; if($vo['vod_level'] == '9'): ?>
					<div class="module-item-ru">
						<span class="<?php echo $mxonest['mxcms']['s2']['vipcss']; ?>">独家推荐</span>
					</div>
					<?php endif; if($vo['vod_level'] == '2'): ?>
					<div class="module-item-ru">
						<span class="yugao">首播</span>
					</div>
					<?php endif; if($vo['vod_level'] == '3'): ?>
					<div class="module-item-ru">
						<span class="yugao">预告</span>
					</div>
					<?php endif; if($vo['vod_level'] == '4'): ?>
					<div class="module-item-ru">
						<span class="rebo">独播</span>
					</div>
					<?php endif; if($vo['vod_level'] == '5'): ?><!--热播标题的左侧额外的推荐电影名称：视频推荐 5-->
					<div class="module-item-ru">
						<span class="<?php echo $mxonest['mxcms']['s2']['tuijiancss']; ?>">推荐</span>
					</div>
					<?php endif; if($vo['vod_class'] == '院线'): ?>
					<div class="module-item-ru">
						<span class="yugao">院线</span>
					</div>
					<?php endif; ?>					
					
					<div class="module-item-content">
						<div class="module-item-style video-name">
							<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" title="<?php echo $vo['vod_name']; ?>"><?php echo $vo['vod_name']; ?></a>
						</div>
						<div class="module-item-style video-tag">
						<?php echo mac_url_create(mac_default($vo['vod_actor'],'未知'),'actor'); ?>
						</div>
						<div class="module-item-style video-text"><?php echo $vo['vod_blurb']; ?></div>
					</div>
				</div>
				<div class="module-item-titlebox">
					<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" class="module-item-title" title="<?php echo $vo['vod_name']; ?>"><?php echo $vo['vod_name']; ?></a>
				</div>
				<div class="module-item-text"><?php if($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; elseif($vo['vod_serial'] > 0): ?>第<?php echo $vo['vod_serial']; ?>集<?php else: ?>已完结<?php endif; ?></div>
			</div>
			<?php else: ?>
				<div class="module-item module-item-go w16">
					<div class="module-item-cover">
						<div class="module-item-pic">
							<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" title="<?php echo $vo['vod_name']; ?>">
							    	<i class="icon-play"></i>
							</a>
							<img class=" ls-is-cached  lazy lazyloaded" data-src="<?php echo mac_url_img($vo['vod_pic']); ?>" src="<?php echo mac_url_img($mxonest['mxcms']['s1']['pic1']); ?>" alt="<?php echo $vo['vod_name']; ?>">
							<div class="loading"></div>
						</div>
						<div class="module-item-caption">
						   <span><?php echo $vo['vod_year']; ?></span>
						  <span class="video-class"><?php echo $vo['type']['type_name']; ?></span>
						</div>
					<?php if($vo['vod_points'] > '0'): ?>
					<div class="module-item-ru">
						<span class="vip">VIP</span>
					</div>
					<?php endif; if($vo['vod_levels'] == '8'): ?>
					<div class="module-item-ru">
						<span class="rebo">热播</span>
					</div>
					<?php endif; if($vo['vod_levels'] == '9'): ?>
					<div class="module-item-ru">
						<span class="rebo">独家推荐</span>
					</div>
					<?php endif; if($vo['vod_class'] == '院线'): ?>
					<div class="module-item-ru">
						<span class="yugao">院线</span>
					</div>
					<?php endif; ?>						
					</div>
					<div class="module-item-titlebox">
						<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" class="module-item-title" title="<?php echo $vo['vod_name']; ?>"><?php echo $vo['vod_name']; ?></a>
					</div>
					<div class="module-item-text"><?php if($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; elseif($vo['vod_serial'] > 0): ?>第<?php echo $vo['vod_serial']; ?>集<?php else: ?>已完结<?php endif; ?></div>
				</div>
        <?php endif; endforeach; endif; else: echo "" ;endif; else: $__TAG__ = '{"num":"16","type":"current","order":"desc","by":"time","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;if($mxonest['mxcms']['s2']['qzslt'] == 0): ?>	  
                <div class="module-item">
				<div class="module-item-cover">
					<div class="module-item-pic">
						<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" title="<?php echo $vo['vod_name']; ?>" >
							<i class="icon-play"></i>
						</a>
						<img class="lazy lazyloaded"  data-src="<?php echo mac_url_img($vo['vod_pic']); ?>" src="<?php echo mac_url_img($mxonest['mxcms']['s1']['pic']); ?>"  alt="<?php echo $vo['vod_name']; ?>">
						<div class="loading"></div>
					</div>
					<div class="module-item-caption">
						<span><?php echo $vo['vod_year']; ?></span>
						<span class="video-class"><?php echo $vo['type']['type_name']; ?></span>
						<span><?php echo $vo['vod_area']; ?></span>
					</div>
			
					<?php if($vo['vod_points'] > '0'): ?>
					<div class="module-item-ru">
						<span class="vip">VIP</span>
					</div>
					<?php endif; if($vo['vod_level'] == $mxonest['mxcms']['s2']['hotlevel']): ?>
					<div class="module-item-ru">
						<span class="<?php echo $mxonest['mxcms']['s2']['rebocss']; ?>">热播</span>
					</div>
					<?php endif; if($vo['vod_level'] == '9'): ?>
					<div class="module-item-ru">
						<span class="<?php echo $mxonest['mxcms']['s2']['vipcss']; ?>">独家推荐</span>
					</div>
					<?php endif; if($vo['vod_level'] == '2'): ?>
					<div class="module-item-ru">
						<span class="yugao">首播</span>
					</div>
					<?php endif; if($vo['vod_level'] == '3'): ?>
					<div class="module-item-ru">
						<span class="yugao">预告</span>
					</div>
					<?php endif; if($vo['vod_level'] == '4'): ?>
					<div class="module-item-ru">
						<span class="rebo">独播</span>
					</div>
					<?php endif; if($vo['vod_level'] == '5'): ?><!--热播标题的左侧额外的推荐电影名称：视频推荐 5-->
					<div class="module-item-ru">
						<span class="<?php echo $mxonest['mxcms']['s2']['tuijiancss']; ?>">推荐</span>
					</div>
					<?php endif; if($vo['vod_class'] == '院线'): ?>
					<div class="module-item-ru">
						<span class="yugao">院线</span>
					</div>
					<?php endif; ?>					
					
					<div class="module-item-content">
						<div class="module-item-style video-name">
							<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" title="<?php echo $vo['vod_name']; ?>"><?php echo $vo['vod_name']; ?></a>
						</div>
						<div class="module-item-style video-tag">
						<?php echo mac_url_create(mac_default($vo['vod_actor'],'未知'),'actor'); ?>
						</div>
						<div class="module-item-style video-text"><?php echo $vo['vod_blurb']; ?></div>
					</div>
				</div>
				<div class="module-item-titlebox">
					<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" class="module-item-title" title="<?php echo $vo['vod_name']; ?>"><?php echo $vo['vod_name']; ?></a>
				</div>
				<div class="module-item-text"><?php if($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; elseif($vo['vod_serial'] > 0): ?>第<?php echo $vo['vod_serial']; ?>集<?php else: ?>已完结<?php endif; ?></div>
			</div>
			<?php else: ?>
				<div class="module-item module-item-go w16">
					<div class="module-item-cover">
						<div class="module-item-pic">
							<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" title="<?php echo $vo['vod_name']; ?>">
							    	<i class="icon-play"></i>
							</a>
							<img class=" ls-is-cached  lazy lazyloaded" data-src="<?php echo mac_url_img($vo['vod_pic']); ?>" src="<?php echo mac_url_img($mxonest['mxcms']['s1']['pic1']); ?>" alt="<?php echo $vo['vod_name']; ?>">
							<div class="loading"></div>
						</div>
						<div class="module-item-caption">
						   <span><?php echo $vo['vod_year']; ?></span>
						  <span class="video-class"><?php echo $vo['type']['type_name']; ?></span>
						</div>
					<?php if($vo['vod_points'] > '0'): ?>
					<div class="module-item-ru">
						<span class="vip">VIP</span>
					</div>
					<?php endif; if($vo['vod_levels'] == '8'): ?>
					<div class="module-item-ru">
						<span class="rebo">热播</span>
					</div>
					<?php endif; if($vo['vod_levels'] == '9'): ?>
					<div class="module-item-ru">
						<span class="rebo">独家推荐</span>
					</div>
					<?php endif; if($vo['vod_class'] == '院线'): ?>
					<div class="module-item-ru">
						<span class="yugao">院线</span>
					</div>
					<?php endif; ?>						
					</div>
					<div class="module-item-titlebox">
						<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" class="module-item-title" title="<?php echo $vo['vod_name']; ?>"><?php echo $vo['vod_name']; ?></a>
					</div>
					<div class="module-item-text"><?php if($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; elseif($vo['vod_serial'] > 0): ?>第<?php echo $vo['vod_serial']; ?>集<?php else: ?>已完结<?php endif; ?></div>
				</div>
        <?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
				</div>
			</div>
		</div>
		       <!-- 相关影片 -->
<?php if($mxonest['mxcms']['s2']['hot'] == 1): endif; if($mxonest['mxcms']['s2']['hot'] == 1): ?>
	   <div class="module">
			<div class="module-heading">
				<h2 class="module-title">正在热播</h2>
				<a class="more" href="<?php echo mac_url_type($vo,[],'show'); ?>" title="更多">更多<i class="icon-arrow-right-o"></i></a>
			</div>
			<div class="module-list module-lines-list">
				<div class="module-items">
		    <?php if($mxonest['mxcms']['s2']['hotlevels'] == levels): if($mxonest['mxcms']['s2']['qzslt'] == 1): $__TAG__ = '{"num":"12","type":"'.$mxonest['mxcms']['s2']['hotall'].'","order":"desc","by":"time","levels":"'.$mxonest['mxcms']['s2']['hotlevel'].'","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;if($mxonest['mxcms']['s2']['qzslt'] == 0): ?>	  
                <div class="module-item">
				<div class="module-item-cover">
					<div class="module-item-pic">
						<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" title="<?php echo $vo['vod_name']; ?>" >
							<i class="icon-play"></i>
						</a>
						<img class="lazy lazyloaded"  data-src="<?php echo mac_url_img($vo['vod_pic']); ?>" src="<?php echo mac_url_img($mxonest['mxcms']['s1']['pic']); ?>"  alt="<?php echo $vo['vod_name']; ?>">
						<div class="loading"></div>
					</div>
					<div class="module-item-caption">
						<span><?php echo $vo['vod_year']; ?></span>
						<span class="video-class"><?php echo $vo['type']['type_name']; ?></span>
						<span><?php echo $vo['vod_area']; ?></span>
					</div>
			
					<?php if($vo['vod_points'] > '0'): ?>
					<div class="module-item-ru">
						<span class="vip">VIP</span>
					</div>
					<?php endif; if($vo['vod_level'] == $mxonest['mxcms']['s2']['hotlevel']): ?>
					<div class="module-item-ru">
						<span class="<?php echo $mxonest['mxcms']['s2']['rebocss']; ?>">热播</span>
					</div>
					<?php endif; if($vo['vod_level'] == '9'): ?>
					<div class="module-item-ru">
						<span class="<?php echo $mxonest['mxcms']['s2']['vipcss']; ?>">独家推荐</span>
					</div>
					<?php endif; if($vo['vod_level'] == '2'): ?>
					<div class="module-item-ru">
						<span class="yugao">首播</span>
					</div>
					<?php endif; if($vo['vod_level'] == '3'): ?>
					<div class="module-item-ru">
						<span class="yugao">预告</span>
					</div>
					<?php endif; if($vo['vod_level'] == '4'): ?>
					<div class="module-item-ru">
						<span class="rebo">独播</span>
					</div>
					<?php endif; if($vo['vod_level'] == '5'): ?><!--热播标题的左侧额外的推荐电影名称：视频推荐 5-->
					<div class="module-item-ru">
						<span class="<?php echo $mxonest['mxcms']['s2']['tuijiancss']; ?>">推荐</span>
					</div>
					<?php endif; if($vo['vod_class'] == '院线'): ?>
					<div class="module-item-ru">
						<span class="yugao">院线</span>
					</div>
					<?php endif; ?>					
					
					<div class="module-item-content">
						<div class="module-item-style video-name">
							<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" title="<?php echo $vo['vod_name']; ?>"><?php echo $vo['vod_name']; ?></a>
						</div>
						<div class="module-item-style video-tag">
						<?php echo mac_url_create(mac_default($vo['vod_actor'],'未知'),'actor'); ?>
						</div>
						<div class="module-item-style video-text"><?php echo $vo['vod_blurb']; ?></div>
					</div>
				</div>
				<div class="module-item-titlebox">
					<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" class="module-item-title" title="<?php echo $vo['vod_name']; ?>"><?php echo $vo['vod_name']; ?></a>
				</div>
				<div class="module-item-text"><?php if($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; elseif($vo['vod_serial'] > 0): ?>第<?php echo $vo['vod_serial']; ?>集<?php else: ?>已完结<?php endif; ?></div>
			</div>
			<?php else: ?>
				<div class="module-item module-item-go w16">
					<div class="module-item-cover">
						<div class="module-item-pic">
							<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" title="<?php echo $vo['vod_name']; ?>">
							    	<i class="icon-play"></i>
							</a>
							<img class=" ls-is-cached  lazy lazyloaded" data-src="<?php echo mac_url_img($vo['vod_pic']); ?>" src="<?php echo mac_url_img($mxonest['mxcms']['s1']['pic1']); ?>" alt="<?php echo $vo['vod_name']; ?>">
							<div class="loading"></div>
						</div>
						<div class="module-item-caption">
						   <span><?php echo $vo['vod_year']; ?></span>
						  <span class="video-class"><?php echo $vo['type']['type_name']; ?></span>
						</div>
					<?php if($vo['vod_points'] > '0'): ?>
					<div class="module-item-ru">
						<span class="vip">VIP</span>
					</div>
					<?php endif; if($vo['vod_levels'] == '8'): ?>
					<div class="module-item-ru">
						<span class="rebo">热播</span>
					</div>
					<?php endif; if($vo['vod_levels'] == '9'): ?>
					<div class="module-item-ru">
						<span class="rebo">独家推荐</span>
					</div>
					<?php endif; if($vo['vod_class'] == '院线'): ?>
					<div class="module-item-ru">
						<span class="yugao">院线</span>
					</div>
					<?php endif; ?>						
					</div>
					<div class="module-item-titlebox">
						<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" class="module-item-title" title="<?php echo $vo['vod_name']; ?>"><?php echo $vo['vod_name']; ?></a>
					</div>
					<div class="module-item-text"><?php if($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; elseif($vo['vod_serial'] > 0): ?>第<?php echo $vo['vod_serial']; ?>集<?php else: ?>已完结<?php endif; ?></div>
				</div>
        <?php endif; endforeach; endif; else: echo "" ;endif; else: $__TAG__ = '{"num":"16","type":"'.$mxonest['mxcms']['s2']['hotall'].'","order":"desc","by":"time","levels":"'.$mxonest['mxcms']['s2']['hotlevel'].'","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;if($mxonest['mxcms']['s2']['qzslt'] == 0): ?>	  
                <div class="module-item">
				<div class="module-item-cover">
					<div class="module-item-pic">
						<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" title="<?php echo $vo['vod_name']; ?>" >
							<i class="icon-play"></i>
						</a>
						<img class="lazy lazyloaded"  data-src="<?php echo mac_url_img($vo['vod_pic']); ?>" src="<?php echo mac_url_img($mxonest['mxcms']['s1']['pic']); ?>"  alt="<?php echo $vo['vod_name']; ?>">
						<div class="loading"></div>
					</div>
					<div class="module-item-caption">
						<span><?php echo $vo['vod_year']; ?></span>
						<span class="video-class"><?php echo $vo['type']['type_name']; ?></span>
						<span><?php echo $vo['vod_area']; ?></span>
					</div>
			
					<?php if($vo['vod_points'] > '0'): ?>
					<div class="module-item-ru">
						<span class="vip">VIP</span>
					</div>
					<?php endif; if($vo['vod_level'] == $mxonest['mxcms']['s2']['hotlevel']): ?>
					<div class="module-item-ru">
						<span class="<?php echo $mxonest['mxcms']['s2']['rebocss']; ?>">热播</span>
					</div>
					<?php endif; if($vo['vod_level'] == '9'): ?>
					<div class="module-item-ru">
						<span class="<?php echo $mxonest['mxcms']['s2']['vipcss']; ?>">独家推荐</span>
					</div>
					<?php endif; if($vo['vod_level'] == '2'): ?>
					<div class="module-item-ru">
						<span class="yugao">首播</span>
					</div>
					<?php endif; if($vo['vod_level'] == '3'): ?>
					<div class="module-item-ru">
						<span class="yugao">预告</span>
					</div>
					<?php endif; if($vo['vod_level'] == '4'): ?>
					<div class="module-item-ru">
						<span class="rebo">独播</span>
					</div>
					<?php endif; if($vo['vod_level'] == '5'): ?><!--热播标题的左侧额外的推荐电影名称：视频推荐 5-->
					<div class="module-item-ru">
						<span class="<?php echo $mxonest['mxcms']['s2']['tuijiancss']; ?>">推荐</span>
					</div>
					<?php endif; if($vo['vod_class'] == '院线'): ?>
					<div class="module-item-ru">
						<span class="yugao">院线</span>
					</div>
					<?php endif; ?>					
					
					<div class="module-item-content">
						<div class="module-item-style video-name">
							<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" title="<?php echo $vo['vod_name']; ?>"><?php echo $vo['vod_name']; ?></a>
						</div>
						<div class="module-item-style video-tag">
						<?php echo mac_url_create(mac_default($vo['vod_actor'],'未知'),'actor'); ?>
						</div>
						<div class="module-item-style video-text"><?php echo $vo['vod_blurb']; ?></div>
					</div>
				</div>
				<div class="module-item-titlebox">
					<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" class="module-item-title" title="<?php echo $vo['vod_name']; ?>"><?php echo $vo['vod_name']; ?></a>
				</div>
				<div class="module-item-text"><?php if($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; elseif($vo['vod_serial'] > 0): ?>第<?php echo $vo['vod_serial']; ?>集<?php else: ?>已完结<?php endif; ?></div>
			</div>
			<?php else: ?>
				<div class="module-item module-item-go w16">
					<div class="module-item-cover">
						<div class="module-item-pic">
							<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" title="<?php echo $vo['vod_name']; ?>">
							    	<i class="icon-play"></i>
							</a>
							<img class=" ls-is-cached  lazy lazyloaded" data-src="<?php echo mac_url_img($vo['vod_pic']); ?>" src="<?php echo mac_url_img($mxonest['mxcms']['s1']['pic1']); ?>" alt="<?php echo $vo['vod_name']; ?>">
							<div class="loading"></div>
						</div>
						<div class="module-item-caption">
						   <span><?php echo $vo['vod_year']; ?></span>
						  <span class="video-class"><?php echo $vo['type']['type_name']; ?></span>
						</div>
					<?php if($vo['vod_points'] > '0'): ?>
					<div class="module-item-ru">
						<span class="vip">VIP</span>
					</div>
					<?php endif; if($vo['vod_levels'] == '8'): ?>
					<div class="module-item-ru">
						<span class="rebo">热播</span>
					</div>
					<?php endif; if($vo['vod_levels'] == '9'): ?>
					<div class="module-item-ru">
						<span class="rebo">独家推荐</span>
					</div>
					<?php endif; if($vo['vod_class'] == '院线'): ?>
					<div class="module-item-ru">
						<span class="yugao">院线</span>
					</div>
					<?php endif; ?>						
					</div>
					<div class="module-item-titlebox">
						<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" class="module-item-title" title="<?php echo $vo['vod_name']; ?>"><?php echo $vo['vod_name']; ?></a>
					</div>
					<div class="module-item-text"><?php if($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; elseif($vo['vod_serial'] > 0): ?>第<?php echo $vo['vod_serial']; ?>集<?php else: ?>已完结<?php endif; ?></div>
				</div>
        <?php endif; endforeach; endif; else: echo "" ;endif; endif; else: if($mxonest['mxcms']['s2']['qzslt'] == 1): $__TAG__ = '{"num":"12","type":"'.$mxonest['mxcms']['s2']['hotall'].'","order":"desc","by":"time","level":"'.$mxonest['mxcms']['s2']['hotlevel'].'","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;if($mxonest['mxcms']['s2']['qzslt'] == 0): ?>	  
                <div class="module-item">
				<div class="module-item-cover">
					<div class="module-item-pic">
						<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" title="<?php echo $vo['vod_name']; ?>" >
							<i class="icon-play"></i>
						</a>
						<img class="lazy lazyloaded"  data-src="<?php echo mac_url_img($vo['vod_pic']); ?>" src="<?php echo mac_url_img($mxonest['mxcms']['s1']['pic']); ?>"  alt="<?php echo $vo['vod_name']; ?>">
						<div class="loading"></div>
					</div>
					<div class="module-item-caption">
						<span><?php echo $vo['vod_year']; ?></span>
						<span class="video-class"><?php echo $vo['type']['type_name']; ?></span>
						<span><?php echo $vo['vod_area']; ?></span>
					</div>
			
					<?php if($vo['vod_points'] > '0'): ?>
					<div class="module-item-ru">
						<span class="vip">VIP</span>
					</div>
					<?php endif; if($vo['vod_level'] == $mxonest['mxcms']['s2']['hotlevel']): ?>
					<div class="module-item-ru">
						<span class="<?php echo $mxonest['mxcms']['s2']['rebocss']; ?>">热播</span>
					</div>
					<?php endif; if($vo['vod_level'] == '9'): ?>
					<div class="module-item-ru">
						<span class="<?php echo $mxonest['mxcms']['s2']['vipcss']; ?>">独家推荐</span>
					</div>
					<?php endif; if($vo['vod_level'] == '2'): ?>
					<div class="module-item-ru">
						<span class="yugao">首播</span>
					</div>
					<?php endif; if($vo['vod_level'] == '3'): ?>
					<div class="module-item-ru">
						<span class="yugao">预告</span>
					</div>
					<?php endif; if($vo['vod_level'] == '4'): ?>
					<div class="module-item-ru">
						<span class="rebo">独播</span>
					</div>
					<?php endif; if($vo['vod_level'] == '5'): ?><!--热播标题的左侧额外的推荐电影名称：视频推荐 5-->
					<div class="module-item-ru">
						<span class="<?php echo $mxonest['mxcms']['s2']['tuijiancss']; ?>">推荐</span>
					</div>
					<?php endif; if($vo['vod_class'] == '院线'): ?>
					<div class="module-item-ru">
						<span class="yugao">院线</span>
					</div>
					<?php endif; ?>					
					
					<div class="module-item-content">
						<div class="module-item-style video-name">
							<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" title="<?php echo $vo['vod_name']; ?>"><?php echo $vo['vod_name']; ?></a>
						</div>
						<div class="module-item-style video-tag">
						<?php echo mac_url_create(mac_default($vo['vod_actor'],'未知'),'actor'); ?>
						</div>
						<div class="module-item-style video-text"><?php echo $vo['vod_blurb']; ?></div>
					</div>
				</div>
				<div class="module-item-titlebox">
					<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" class="module-item-title" title="<?php echo $vo['vod_name']; ?>"><?php echo $vo['vod_name']; ?></a>
				</div>
				<div class="module-item-text"><?php if($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; elseif($vo['vod_serial'] > 0): ?>第<?php echo $vo['vod_serial']; ?>集<?php else: ?>已完结<?php endif; ?></div>
			</div>
			<?php else: ?>
				<div class="module-item module-item-go w16">
					<div class="module-item-cover">
						<div class="module-item-pic">
							<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" title="<?php echo $vo['vod_name']; ?>">
							    	<i class="icon-play"></i>
							</a>
							<img class=" ls-is-cached  lazy lazyloaded" data-src="<?php echo mac_url_img($vo['vod_pic']); ?>" src="<?php echo mac_url_img($mxonest['mxcms']['s1']['pic1']); ?>" alt="<?php echo $vo['vod_name']; ?>">
							<div class="loading"></div>
						</div>
						<div class="module-item-caption">
						   <span><?php echo $vo['vod_year']; ?></span>
						  <span class="video-class"><?php echo $vo['type']['type_name']; ?></span>
						</div>
					<?php if($vo['vod_points'] > '0'): ?>
					<div class="module-item-ru">
						<span class="vip">VIP</span>
					</div>
					<?php endif; if($vo['vod_levels'] == '8'): ?>
					<div class="module-item-ru">
						<span class="rebo">热播</span>
					</div>
					<?php endif; if($vo['vod_levels'] == '9'): ?>
					<div class="module-item-ru">
						<span class="rebo">独家推荐</span>
					</div>
					<?php endif; if($vo['vod_class'] == '院线'): ?>
					<div class="module-item-ru">
						<span class="yugao">院线</span>
					</div>
					<?php endif; ?>						
					</div>
					<div class="module-item-titlebox">
						<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" class="module-item-title" title="<?php echo $vo['vod_name']; ?>"><?php echo $vo['vod_name']; ?></a>
					</div>
					<div class="module-item-text"><?php if($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; elseif($vo['vod_serial'] > 0): ?>第<?php echo $vo['vod_serial']; ?>集<?php else: ?>已完结<?php endif; ?></div>
				</div>
        <?php endif; endforeach; endif; else: echo "" ;endif; else: $__TAG__ = '{"num":"16","type":"'.$mxonest['mxcms']['s2']['hotall'].'","order":"desc","by":"time","level":"'.$mxonest['mxcms']['s2']['hotlevel'].'","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;if($mxonest['mxcms']['s2']['qzslt'] == 0): ?>	  
                <div class="module-item">
				<div class="module-item-cover">
					<div class="module-item-pic">
						<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" title="<?php echo $vo['vod_name']; ?>" >
							<i class="icon-play"></i>
						</a>
						<img class="lazy lazyloaded"  data-src="<?php echo mac_url_img($vo['vod_pic']); ?>" src="<?php echo mac_url_img($mxonest['mxcms']['s1']['pic']); ?>"  alt="<?php echo $vo['vod_name']; ?>">
						<div class="loading"></div>
					</div>
					<div class="module-item-caption">
						<span><?php echo $vo['vod_year']; ?></span>
						<span class="video-class"><?php echo $vo['type']['type_name']; ?></span>
						<span><?php echo $vo['vod_area']; ?></span>
					</div>
			
					<?php if($vo['vod_points'] > '0'): ?>
					<div class="module-item-ru">
						<span class="vip">VIP</span>
					</div>
					<?php endif; if($vo['vod_level'] == $mxonest['mxcms']['s2']['hotlevel']): ?>
					<div class="module-item-ru">
						<span class="<?php echo $mxonest['mxcms']['s2']['rebocss']; ?>">热播</span>
					</div>
					<?php endif; if($vo['vod_level'] == '9'): ?>
					<div class="module-item-ru">
						<span class="<?php echo $mxonest['mxcms']['s2']['vipcss']; ?>">独家推荐</span>
					</div>
					<?php endif; if($vo['vod_level'] == '2'): ?>
					<div class="module-item-ru">
						<span class="yugao">首播</span>
					</div>
					<?php endif; if($vo['vod_level'] == '3'): ?>
					<div class="module-item-ru">
						<span class="yugao">预告</span>
					</div>
					<?php endif; if($vo['vod_level'] == '4'): ?>
					<div class="module-item-ru">
						<span class="rebo">独播</span>
					</div>
					<?php endif; if($vo['vod_level'] == '5'): ?><!--热播标题的左侧额外的推荐电影名称：视频推荐 5-->
					<div class="module-item-ru">
						<span class="<?php echo $mxonest['mxcms']['s2']['tuijiancss']; ?>">推荐</span>
					</div>
					<?php endif; if($vo['vod_class'] == '院线'): ?>
					<div class="module-item-ru">
						<span class="yugao">院线</span>
					</div>
					<?php endif; ?>					
					
					<div class="module-item-content">
						<div class="module-item-style video-name">
							<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" title="<?php echo $vo['vod_name']; ?>"><?php echo $vo['vod_name']; ?></a>
						</div>
						<div class="module-item-style video-tag">
						<?php echo mac_url_create(mac_default($vo['vod_actor'],'未知'),'actor'); ?>
						</div>
						<div class="module-item-style video-text"><?php echo $vo['vod_blurb']; ?></div>
					</div>
				</div>
				<div class="module-item-titlebox">
					<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" class="module-item-title" title="<?php echo $vo['vod_name']; ?>"><?php echo $vo['vod_name']; ?></a>
				</div>
				<div class="module-item-text"><?php if($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; elseif($vo['vod_serial'] > 0): ?>第<?php echo $vo['vod_serial']; ?>集<?php else: ?>已完结<?php endif; ?></div>
			</div>
			<?php else: ?>
				<div class="module-item module-item-go w16">
					<div class="module-item-cover">
						<div class="module-item-pic">
							<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" title="<?php echo $vo['vod_name']; ?>">
							    	<i class="icon-play"></i>
							</a>
							<img class=" ls-is-cached  lazy lazyloaded" data-src="<?php echo mac_url_img($vo['vod_pic']); ?>" src="<?php echo mac_url_img($mxonest['mxcms']['s1']['pic1']); ?>" alt="<?php echo $vo['vod_name']; ?>">
							<div class="loading"></div>
						</div>
						<div class="module-item-caption">
						   <span><?php echo $vo['vod_year']; ?></span>
						  <span class="video-class"><?php echo $vo['type']['type_name']; ?></span>
						</div>
					<?php if($vo['vod_points'] > '0'): ?>
					<div class="module-item-ru">
						<span class="vip">VIP</span>
					</div>
					<?php endif; if($vo['vod_levels'] == '8'): ?>
					<div class="module-item-ru">
						<span class="rebo">热播</span>
					</div>
					<?php endif; if($vo['vod_levels'] == '9'): ?>
					<div class="module-item-ru">
						<span class="rebo">独家推荐</span>
					</div>
					<?php endif; if($vo['vod_class'] == '院线'): ?>
					<div class="module-item-ru">
						<span class="yugao">院线</span>
					</div>
					<?php endif; ?>						
					</div>
					<div class="module-item-titlebox">
						<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" class="module-item-title" title="<?php echo $vo['vod_name']; ?>"><?php echo $vo['vod_name']; ?></a>
					</div>
					<div class="module-item-text"><?php if($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; elseif($vo['vod_serial'] > 0): ?>第<?php echo $vo['vod_serial']; ?>集<?php else: ?>已完结<?php endif; ?></div>
				</div>
        <?php endif; endforeach; endif; else: echo "" ;endif; endif; endif; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>       <!-- 正在热播 -->
 
    	<?php if($mxonest['mxcms']['s2']['comment'] == 1): if($comment['status'] == 1): ?>
   <div class="module">
			<div class="module-heading">
				<h2 class="module-title">影片评论</h2>
			</div>
				<div class="mxone-pannel mxone-pannel-bg clearfix">
					<div class="mxone-pannel-box clearfix">
						<div class="mxone-pannel_bd clearfix">
							<div class="mxone-pannel_bd">
								<div class="mac_comment" data-id="<?php echo $obj['vod_id']; ?>" data-mid="<?php echo $maccms['mid']; ?>" ></div>
								<script>
							        $(function(){
							            MAC.Comment.Login = <?php echo $comment['login']; ?>;
							            MAC.Comment.Verify = <?php echo $comment['verify']; ?>;
							            MAC.Comment.Init();
							            MAC.Comment.Show(1);
							        });
							    </script>
							</div>
						</div>
					</div>					
				</div>		
		</div>
	<?php endif; endif; ?>       <!-- 评论 -->
  
  </div>
</main>

 <footer id="footer" class="wrapper <?php if($mxonest['mxcms']['s2']['dbdh'] == 1): ?>pd60<?php endif; ?>">
	<p class="sitemap"><img src="<?php echo mac_url_img($mxonest['mxcms']['s1']['logo3']); ?>" height="10">
		 <?php if($mxonest['mxcms']['s2']['about'] == 1): ?>
		<a target="_blank" href="<?php echo mac_url('label/about'); ?>">关于</a><span class="space-line-bold"></span>
		<?php endif; ?>
		<a target="_blank" href="<?php echo mac_url('label/banquan'); ?>">版权</a><span class="space-line-bold"></span>
		<a target="_blank" href="<?php echo mac_url('label/help'); ?>">投屏</a><span class="space-line-bold"></span>
		<a target="_blank" href="<?php echo mac_url('label/live'); ?>">直播</a><span class="space-line-bold"></span>
		 <?php if($mxonest['mxcms']['s2']['dbtop'] == 1): ?>
		<a target="_blank" href="<?php echo mac_url('label/top'); ?>">排行榜</a><span class="space-line-bold"></span>
		<?php endif; ?>
		<a target="_blank" href="<?php echo mac_url('map/index'); ?>">MAP</a><span class="space-line-bold"></span>
		<a target="_blank" href="<?php echo mac_url('rss/index'); ?>">RSS</a><span class="space-line-bold"></span>
		<a target="_blank" href="<?php echo mac_url('rss/baidu'); ?>">Baidu</a><span class="space-line-bold"></span>
		<a target="_blank" href="<?php echo mac_url('rss/baidu'); ?>">Google</a><span class="space-line-bold"></span>
		<a target="_blank" href="<?php echo mac_url('rss/bing'); ?>">Bing</a><span class="space-line-bold"></span>
		<a target="_blank" href="<?php echo mac_url('rss/so'); ?>">so</a><span class="space-line-bold"></span>
		<a target="_blank" href="<?php echo mac_url('rss/sogou'); ?>">Sogou</a><span class="space-line-bold"></span>
		<a target="_blank" href="<?php echo mac_url('rss/sm'); ?>">SM</a>
	</p>
	<p><?php echo $mxonest['mxcms']['s1']['sm']; ?></p>
	<?php if($mxonest['mxcms']['s4']['dbdm'] == 1): ?>
    <?php echo $mxonest['mxcms']['s4']['dbdmtips']; endif; ?>
</footer>


<?php if($mxonest['mxcms']['s2']['yxjcd'] == 1): ?>
<div class="fixed_right_bar">
  <div class="mx-lrmenu">  
 <div class="ant-back-top dbicon" style="display:none;">
	 <i class="iconfont icon-a-zhiding5"></i>	
</div>
  <?php if($mxonest['mxcms']['s2']['fontqh'] == 1): ?>
<div class="dbicon">
<a id="numerous" href="javascript:;" style="color: #ffffff; font-weight: bold;"></a>  
<script src="<?php echo $maccms['path_tpl']; ?>mxstatic/js/font.js"></script>
</div>
<?php endif; if($mxonest['mxcms']['s2']['yjqh'] == 1): ?>
<div class="dbicon"  id="clothes" onclick="clothesChange();">
<?php if($mxonest['mxcms']['s2']['mryj'] == 1): ?>  
<i class="iconfont icon-rijianmoshi"></i>
<?php else: ?> 
<i class="iconfont icon-a-yejian2"></i>
<?php endif; ?>
</div>
<?php endif; if($mxonest['mxcms']['s2']['liuyan'] == 1): ?>
<div class="dbicon ly">
<a   href="<?php echo mac_url('gbook/index'); ?>" ><i class="iconfont icon-a-pinglun" ></i></a>
<span class="anchor-txt">留言</span>
</div>
<?php endif; if($mxonest['mxcms']['s2']['topic'] == 1): ?>
<div class="dbicon">
<a  href="<?php echo mac_url('topic/index'); ?>" ><i class="iconfont icon-zhuanti-2" ></i></a>
</div>
<?php endif; ?>
</div>
<div class="moremeum">
	    <i class="iconfont icon-a-gengduo1"></i>
	</div>
</div>
<?php endif; if($mxonest['mxcms']['s2']['dbdh'] == 1): ?>
<div class="mxonefoot">
		<a class="item" href="<?php echo $maccms['path']; ?>">
    	<i class="icon-home size20"></i>
		<div class="grid-item-name" title="<?php echo $maccms['site_name']; ?>首页">首页</div>
		</a>
		 <?php $__TAG__ = '{"order":"asc","by":"sort","ids":"'.$mxonest['mxcms']['s6']['wapdaohangid'].'","id":"vo","key":"key"}';$__LIST__ = model("Type")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>	
		<a class="item" href="<?php echo mac_url_type($vo); ?>">
			<?php if($vo['type_id_1'] == $mxonest['mxcms']['s6']['num1']||$vo['type_id'] == $mxonest['mxcms']['s6']['num1']): ?>
              <i class="size20 <?php echo $mxonest['mxcms']['s6']['icon1']; ?>"></i>
               <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s6']['num2']||$vo['type_id'] == $mxonest['mxcms']['s6']['num2']): ?>
               <i class="size20 <?php echo $mxonest['mxcms']['s6']['icon2']; ?>"></i>
               <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s6']['num3']||$vo['type_id'] == $mxonest['mxcms']['s6']['num3']): ?>
                <i class="size20 <?php echo $mxonest['mxcms']['s6']['icon3']; ?>"></i>
                 <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s6']['num4']||$vo['type_id'] == $mxonest['mxcms']['s6']['num4']): ?>
                 <i class="size20 <?php echo $mxonest['mxcms']['s6']['icon4']; ?>"></i>
                 <?php elseif($vo['type_id_1'] == $mxonest['mxcms']['s6']['num5']||$vo['type_id'] == $mxonest['mxcms']['s6']['num5']): ?>
               <i class="size20 <?php echo $mxonest['mxcms']['s6']['icon5']; ?>"></i> 
                <?php else: ?>
                 <i class="size20  <?php echo $mxonest['mxcms']['s6']['iconmr']; ?>"></i>
               <?php endif; ?>
		<div class="grid-item-name"><?php echo $vo['type_name']; ?></div>
		</a>
		<?php endforeach; endif; else: echo "" ;endif; if($mxonest['mxcms']['s6']['diy1'] == 1): ?>
		<a class="item" href="<?php echo $mxonest['mxcms']['s6']['diy1url']; ?>">
        <i class="size20  <?php echo $mxonest['mxcms']['s6']['diy1icon']; ?>"></i>
		<div class="grid-item-name"><?php echo $mxonest['mxcms']['s6']['diy1name']; ?></div>
		</a>
		<?php endif; if($mxonest['mxcms']['s6']['diy2'] == 1): ?>
		<a class="item" href="<?php echo $mxonest['mxcms']['s6']['diy2url']; ?>">
        <i class="size20  <?php echo $mxonest['mxcms']['s6']['diy2icon']; ?>"></i>
		<div class="grid-item-name"><?php echo $mxonest['mxcms']['s6']['diy2name']; ?></div>
		</a>
		<?php endif; ?>
</div>
<?php endif; ?>

<script type="text/javascript">
<?php if($mxonest['mxcms']['s2']['mryj'] == 1): ?> 
 $("#clothes").on('click',function () {
        $(this).children(".iconfont").toggleClass("icon-a-yejian2");
        $(this).children(".iconfont").toggleClass("icon-rijianmoshi")
    });
  <?php else: ?>
    $("#clothes").on('click',function () {
        $(this).children(".iconfont").toggleClass("icon-rijianmoshi");
        $(this).children(".iconfont").toggleClass("icon-a-yejian2")
    });
 <?php endif; ?>
</script>

<?php if($mxonest['mxcms']['s2']['tc'] == 1): ?>
<div class="popup" id="note" style="display:none;">
	<div class="popup-icon"><img src="<?php echo $maccms['path_tpl']; ?>mxstatic/picture/backhome.svg"></div>
	<div class="popup-header">
		<h3 class="popup-title">公告内容</h3>
	</div>
	<div class="popup-main">
		<?php echo $mxonest['mxcms']['s2']['tc_noti']; ?>
	</div>
	<div class="popup-footer"><span class="popup-btn" onclick="closeclick()">我记住啦</span></div>
</div>
 <!-- 弹窗公告-->
<?php endif; if($mxonest['mxcms']['s2']['wz0'] == 1): ?>  
<div class="popup popup-notice none">
	<div class="popup-icon"><img src="<?php echo $maccms['path_tpl']; ?>mxstatic/picture/backhome.svg"></div>
	<div class="popup-header">
		<h3 class="popup-title">域名列表</h3></div>
	<div class="popup-main">
		<p>
			<a><strong><?php echo $maccms['site_url']; ?></strong></a><br>
		   	<?php if($mxonest['mxcms']['s2']['wz1'] == 1): ?>
			<a><strong><?php echo $mxonest['mxcms']['s2']['web1']; ?></strong></a><br>
			<?php endif; if($mxonest['mxcms']['s2']['wz2'] == 1): ?>
			<a><strong><?php echo $mxonest['mxcms']['s2']['web2']; ?></strong></a><br>
			<?php endif; if($mxonest['mxcms']['s2']['wz3'] == 1): ?>
			<a><strong><?php echo $mxonest['mxcms']['s2']['web3']; ?></strong></a><br>
			<?php endif; if($mxonest['mxcms']['s2']['wz4'] == 1): ?>
			<a><strong><?php echo $mxonest['mxcms']['s2']['web4']; ?></strong></a><br>
			<?php endif; if($mxonest['mxcms']['s2']['wz5'] == 1): ?>
			<a><strong><?php echo $mxonest['mxcms']['s2']['web5']; ?></strong></a><br>
			<?php endif; ?>
		</p>
	</div>
	<div class="popup-footer">
		<a href="<?php echo mac_url('label/web'); ?>" class="popup-btn-o">查看全部域名</a>
	</div>
	<div class="close-popup" id="close-popup"><i class="icon-close-o"></i></div>
</div> <!-- 网址-->
<?php endif; ?>
<!--新的-->
<script type="text/javascript">   
	document.onkeydown=function(){
	    
		var e = window.event||arguments[0];
		
	     <?php if($mxonest['mxcms']['s4']['shier'] == 1): ?> 
if(window.event&&window.event.keyCode==123){event.keyCode=0;event.returnValue=false;new Vue({data:function(){this.$notify({title:"<?php echo $mxonest['mxcms']['s4']['pbtips']; ?>",message:"你非要调试的话试试 Alt+Shift+Fn+F4",position:'bottom-right',offset:50,showClose:true,type:"error"});return{visible:false}}})
				return false;
			}
        <?php endif; if($mxonest['mxcms']['s4']['ctrl'] == 1): ?> 
if((event.ctrlKey)&&(event.shiftKey)&&(event.keyCode==73)){new Vue({data:function(){this.$notify({title:"<?php echo $mxonest['mxcms']['s4']['pbtips']; ?>",message:"老弟，好好看电影吧不要瞎调试换哟~",position:'bottom-right',offset:50,showClose:true,type:"error"});return{visible:false}}})
			return false;
		}
if(e.ctrlKey&&window.event.keyCode==85){new Vue({data:function(){this.$notify({title:"<?php echo $mxonest['mxcms']['s4']['pbtips']; ?>",message:"老弟，在干嘛呢？好好看电影吧~",position:'bottom-right',offset:50,showClose:true,type:"error"});return{visible:false}}})
		   return false;
		}		
if(event.ctrlKey&&window.event.keyCode==83){new Vue({data:function(){this.$notify({title:"<?php echo $mxonest['mxcms']['s4']['pbtips']; ?>",message:"看电影网页不需要保存哦~",position:'bottom-right',offset:50,showClose:true,type:"error"});return{visible:false}}})
		   return false;
		}
        <?php endif; ?>
	}
  <?php if($mxonest['mxcms']['s4']['right'] == 1): ?> 
document.oncontextmenu = function (){new Vue({data:function(){this.$notify({title:"<?php echo $mxonest['mxcms']['s4']['pbtips']; ?>",message:"复制请用键盘快捷键 Ctrl+C",position:'bottom-right',offset:50,showClose:true,type:"warning"});return{visible:false}}})
		return false;
	}
 <?php endif; if($mxonest['mxcms']['s4']['mode'] == 1): ?> 
	var threshold = 160;
	window.setInterval(function() {  
	    if (window.outerWidth - window.innerWidth > threshold ||   
	    window.outerHeight - window.innerHeight > threshold) {  
			function disableDebugger() {
				debugger;
			}
			$(document).ready(function () {
				disableDebugger();
			});
	    }  
	}, 1e3);
 <?php endif; ?>
</script>
<!--新的-->

<div class="shortcuts-mobile-overlay"></div>
<?php if($mxonest['mxcms']['s2']['yxjdiy'] == 1): ?>
<style>
.fixed_right_bar i{color:<?php echo $mxonest['mxcms']['s2']['iconztys']; ?>}.fixed_right_bar .moremeum{background:<?php echo $mxonest['mxcms']['s2']['cdbjys']; ?>}.fixed_right_bar .dbicon{background:<?php echo $mxonest['mxcms']['s2']['iconbjys']; ?>.fixed_right_bar .dbicon:hover {
	background: <?php echo $mxonest['mxcms']['s2']['iconbjglys']; ?>;}}.fixed_right_bar .dbicon:hover {	background: <?php echo $mxonest['mxcms']['s2']['iconbjglys']; ?>;}}background: <?php echo $mxonest['mxcms']['s2']['iconbjglys']; ?>;color:<?php echo $mxonest['mxcms']['s2']['iconztys']; ?>}}}
</style>
 <?php endif; if($mxonest['mxcms']['s2']['tc'] == 1): ?>
<script src="<?php echo $maccms['path_tpl']; ?>mxstatic/js/mxhtml.js"></script>
 <?php endif; ?>
<script src="<?php echo $maccms['path_tpl']; ?>mxstatic/js/mxui.js"></script>
<?php if($mxonest['mxcms']['s3']['addb'] == 1): ?>
<?php echo $mxonest['mxcms']['s3']['aaddb']; endif; ?>	 <!-- 底部广告位 -->
 <!-- 底部-->
 
 <div class="shortcuts-box"><div id="shortcuts-info"></div></div>

 <div class="shortcuts-mobile-overlay"></div>

 <div class="popup popup-tips none" >
  <div class="popup-header">
    <h3 class="popup-title">投屏教程</h3>
  </div>
  <div class="popup-main">
    <p><strong>第一步</strong><br>
      将电视/盒子、手机连接到同一WIFI下；</p>
    <p><strong>第二步</strong><br>
      在视频播放页面，找到 <strong><i class="icon-screen-o"></i></strong> 图标，从列表中选择需要投屏的设备即可投屏成功；</p>
    <p><strong>依然无法连接到电视？</strong><br>
      请点击下方按钮，查看不同手机和浏览器的投屏教程。</p>
  </div>
  <div class="popup-footer"><a href="<?php echo mac_url('label/help'); ?>" target="_blank" class="popup-btn-o">查看详细教程</a></div>
  <div class="close-popup" id="close-popup"><i class="icon-close-o"></i></div>
</div>
       <!-- 投屏教程 -->
 
 <div class="shortcuts-mobile-overlay"></div>
 
 



 


<div class="shortcuts-mobile-overlay"></div>
    <script type="text/javascript"  src="<?php echo $maccms['path_tpl']; ?>mxstatic/js/desc.js"></script>
<span class="mac_ulog_set none" alt="设置播放页浏览记录" data-type="4" data-mid="<?php echo $maccms['mid']; ?>" data-id="<?php echo $obj['vod_id']; ?>" data-sid="<?php echo $param['sid']; ?>" data-nid="<?php echo $param['nid']; ?>"></span>
<span class="mac_hits none" data-mid="<?php echo $maccms['mid']; ?>" data-id="<?php echo $obj['vod_id']; ?>" data-type="hits"></span>
<script type="text/javascript">
		function autoScroll(obj){
			$(obj).find("ul").animate({
				marginTop : "-40px"
			},500,function(){
				$(this).css({marginTop : "0px"}).find("li:first").appendTo(this);
			})
		}
		$(function(){
			setInterval('autoScroll(".fodong_tips")',3000);
		})
	</script>


 <?php if($mxonest['mxcms']['s2']['miniplay'] == 1): ?>
<script>
 window.onload=function(){
 var ha = ($('.MacPlayer').find('table').offset().top + $('.MacPlayer').find('table').height());
 $(window).scroll(function(){ 
 if ( $(window).scrollTop() > ha ) { 
 $('.MacPlayer').find('table').removeClass('in').addClass('out');
 $('.MacPlayer').find('table').css('height','250px');
 $('.MacPlayer').find('table').css('width','450px');
 } else if ( $(window).scrollTop() < ha) { 
 $('.MacPlayer').find('table').removeClass('out').addClass('in'); 
 $('.MacPlayer').find('table').css('height','100%');
 } 
 });
}	    
</script>
<?php endif; ?>
</body>

</html>