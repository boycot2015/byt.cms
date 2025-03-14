<?php if (!defined('THINK_PATH')) exit(); /*a:19:{s:35:"template/mxone/html/vod/detail.html";i:1639064358;s:81:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/seo/vod_detail.html";i:1664247958;s:81:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/public/include.html";i:1664250000;s:78:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/public/head.html";i:1642429072;s:75:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/vod/desc.html";i:1664244664;s:75:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/ads/adqj.html";i:1625104690;s:79:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/vod/playlist.html";i:1664205106;s:81:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/vod/actor_vbox.html";i:1639673002;s:80:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/public/vodbox.html";i:1664246986;s:75:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/vod/plot.html";i:1639064442;s:75:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/ads/ad22.html";i:1639673308;s:74:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/vod/art.html";i:1640348994;s:76:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/vod/serie.html";i:1639064484;s:75:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/vod/like.html";i:1639064412;s:74:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/vod/hot.html";i:1640349510;s:78:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/public/foot.html";i:1664185344;s:82:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/public/tcnotice.html";i:1639063956;s:81:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/public/website.html";i:1639063970;s:75:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/ads/addb.html";i:1625104690;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
 <head> 
 <title>《<?php echo $obj['vod_name']; ?>》详情介绍_<?php echo $obj['vod_name']; ?><?php echo $obj['vod_remarks']; ?>在线观看_<?php echo $obj['vod_name']; ?>迅雷下载_<?php echo $obj['type']['type_name']; ?>_<?php echo $maccms['site_name']; ?> - <?php echo $maccms['site_url']; ?></title>
<meta name="keywords" content="<?php echo $obj['vod_name']; ?><?php echo $obj['vod_play_list'][$param['sid']]['urls'][$param['nid']]['name']; ?><?php echo $obj['type']['type_name']; ?>高清免费在线观看,<?php echo $obj['vod_name']; ?><?php echo $obj['vod_remarks']; ?>迅雷下载,,<?php echo $obj['vod_name']; ?>完整版在线播放,<?php echo $obj['vod_name']; ?>主演:<?php echo $obj['vod_actor']; ?>">
<meta name="description" content="<?php echo $maccms['site_name']; ?>为您提供,热播<?php echo $obj['type']['type_name']; ?>,<?php echo $obj['vod_name']; ?>完整版免费免VIP无广告在线观看以及迅雷下载;<?php echo $obj['vod_name']; ?>剧情:<?php echo $obj['vod_blurb']; ?>">
 
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
<body class="view page">
    
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
									<?php $_67d3a05ed94b2=explode(',',$maccms['search_hot']); if(is_array($_67d3a05ed94b2) || $_67d3a05ed94b2 instanceof \think\Collection || $_67d3a05ed94b2 instanceof \think\Paginator): if( count($_67d3a05ed94b2)==0 ) : echo "" ;else: foreach($_67d3a05ed94b2 as $key2=>$vo2): ?>
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
									<?php $_67d3a05ed93b0=explode(',',$maccms['search_hot']); if(is_array($_67d3a05ed93b0) || $_67d3a05ed93b0 instanceof \think\Collection || $_67d3a05ed93b0 instanceof \think\Paginator): if( count($_67d3a05ed93b0)==0 ) : echo "" ;else: foreach($_67d3a05ed93b0 as $key2=>$vo2): ?>
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
   	<div class="content">   
   	
                <div class="box view-heading">
			<div class="mobile-play">
				<div class="module-item-cover">
					<div class="module-item-pic"><img class="lazyload" data-src="<?php echo mac_url_img($obj['vod_pic']); ?>" src="<?php echo mac_url_img($mxonest['mxcms']['s1']['pic']); ?>"></div>
				</div>
			</div>
			<div class="video-cover">
				<div class="module-item-cover">
					<div class="module-item-pic">
						<a href="<?php echo mac_url_vod_play($obj); ?>" title="立刻播放<?php echo $obj['vod_name']; ?>"><i class="icon-play"></i></a><img class="lazyload" alt="<?php echo $obj['vod_name']; ?>" data-src="<?php echo mac_url_img($obj['vod_pic']); ?>" src="<?php echo mac_url_img($mxonest['mxcms']['s1']['pic']); ?>">
						<div class="loading"></div>
					</div>
					{if condition="$obj.vod_points gt 0"}
					<?php if($mxonest['mxcms']['s2']['descjiaobiao'] == 1): ?> 
					<div class="module-item-ru">
						<span class="yugao"><?php echo $mxonest['mxcms']['s2']['descjiaobiaowenzi']; ?></span>
					</div> <?php endif; ?>
				</div>
			</div>
			<div class="video-info">
				<div class="video-info-header">
					<h1 class="page-title"><?php echo $obj['vod_name']; ?></h1>
					<?php if($mxonest['mxcms']['s2']['detailen'] == 1): ?>
					<h2 class="video-subtitle" title="又名：<?php echo $obj['vod_en']; ?>"><?php echo $obj['vod_en']; ?></h2>
					<?php endif; ?>
					<div class="scroll-box">
					<div class="video-info-aux scroll-content">
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
					    <?php $_67d3a05ed927d=explode(',',$obj['vod_class']); if(is_array($_67d3a05ed927d) || $_67d3a05ed927d instanceof \think\Collection || $_67d3a05ed927d instanceof \think\Paginator): if( count($_67d3a05ed927d)==0 ) : echo "" ;else: foreach($_67d3a05ed927d as $key2=>$vo2): ?>	    
						<a href="<?php echo mac_url_type($obj['type']['type_id'],['id'=>$obj['type_id'],'class'=>$vo2],'show'); ?>"><?php echo $vo2; ?></a><span class="slash">/</span>
						<?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
						
						<a class="tag-link" href="<?php echo mac_url_type($obj['type']['type_id'],['id'=>$obj['type_id'],'year'=>$obj['vod_year']],'show'); ?>"><?php echo mac_default($obj['vod_year'],'未知'); ?>	</a>
						
                        <a class="tag-link" href="<?php echo mac_url_type($obj['type']['type_id'],['id'=>$obj['type_id'],'area'=>$obj['vod_area']],'show'); ?>"><?php echo mac_default($obj['vod_area'],'未知'); ?>	</a>
                      	</div>  
					</div>
					<?php if($obj['vod_play_list']): ?>
					<a href="<?php echo mac_url_vod_play($obj); ?>" class="btn-important btn-large shadow-drop video-info-play" title="立刻播放<?php echo $obj['vod_name']; ?>"><i class="icon-play"></i><strong>立即播放</strong></a>
					<?php else: ?>
					<a class="noplaylist btn-large video-info-play" href="javaScript:;"><i class="icon-warn"></i>暂无片源</a>
					<?php endif; if($mxonest['mxcms']['s2']['shoucang'] == 1): if($maccms['user_status'] == 1): ?>
					<a href="javascript:void(0);"  data-type="2" data-mid="<?php echo $maccms['mid']; ?>" data-id="<?php echo $obj['vod_id']; ?>" class="mac_ulog btn-large btn-collect video-info-play"><i class="iconfont  icon-shoucang"></i>收藏</a>	
					<?php endif; endif; if(!(empty($obj[vod_down_from]) || (($obj[vod_down_from] instanceof \think\Collection || $obj[vod_down_from] instanceof \think\Paginator ) && $obj[vod_down_from]->isEmpty()))): ?>
					<a href="<?php echo mac_url_vod_down($obj); ?>" class="video-info-downbtn video-info-play gotodownloadlist gotodownloadlist"><i class="icon-download"></i><strong>影片下载</strong></a>
					<?php endif; ?>
				</div>
				
				<div class="video-info-main">

					<div class="video-info-items"><span class="video-info-itemtitle">导演：</span>
						<div class="video-info-item video-info-actor"><span class="slash">/</span>
					    <?php echo mac_url_create(mac_default($obj['vod_director'],'未知'),'director','vod','search','<span class="slash">/</span>'); ?>
						</div>
					</div>
					<div class="video-info-items"><span class="video-info-itemtitle">主演：</span>
						<div class="video-info-item video-info-actor"><span class="slash">/</span>
						<?php echo mac_url_create(mac_default($obj['vod_actor'],'未知'),'actor','vod','search','<span class="slash">/</span>'); ?>
						</div>
					</div>
					<div class="video-info-items"><span class="video-info-itemtitle">上映：</span>
						<div class="video-info-item"><?php echo mac_default($obj['vod_pubdate'],'未知'); ?></div>
					</div>
					<div class="video-info-items"><span class="video-info-itemtitle">更新：</span>
						<div class="video-info-item"><?php echo mac_day($obj['vod_time']); ?>，最后更新于
					<?php 
					$t = time() - $obj['vod_time'];
					$retArr = array('刚刚','分钟前','小时前','天前','月前','年前');
					switch($t){
					case $t <= 0:
					$text = date('Y-m-d',$time);
					break;
					case $t < 60:
					$text = $retArr[0];
					break;
					case $t < 3600:
					$text = floor($t / 60).$retArr[1];
					break;
					case $t < 86400:
					$text = floor($t / 3600).$retArr[2];
					break;
					case $t < 2592000: 
					$text = floor($t / 86400).$retArr[3];
					break;
					case $t < 31536000:
					$text = floor($t / 2592000).$retArr[4];
					break;
					default : 
					$text = floor($t / 31536000).$retArr[5];
					}
					echo $text;
					 ?></div>
					</div>		
					<div class="video-info-items"><span class="video-info-itemtitle">  <?php if($obj['type_id_1'] == 4||$obj['type_id'] == 4): ?>连载：<?php elseif($obj['type_id_1'] == 2||$obj['type_id'] == 2): ?>集数：<?php else: ?>备注：<?php endif; ?></span>
						<div class="video-info-item"><?php if($obj['vod_remarks'] != ''): ?><?php echo $obj['vod_remarks']; elseif($obj['vod_serial'] > 0): ?>第<?php echo $obj['vod_serial']; ?>集<?php else: ?>已完结<?php endif; ?></div>
					</div>					
					 <?php if($mxonest['mxcms']['s2']['doubanlj'] == 1): ?>
					 <div class="video-info-items"><span class="video-info-itemtitle">评价：</span>
    <span class="text-muted" style="margin-right: 10px;"><a href="https://search.douban.com/movie/subject_search?search_text=<?php echo $obj['vod_name']; ?>" target="_blank" title="到豆瓣页面查看《<?php echo $obj['vod_name']; ?>》" rel="nofollow"><img src="https://img3.doubanio.com/favicon.ico" style="width:15px; height:15px"></a></span>
    <span class="text-muted" style="margin-right: 10px;"><a href="https://www.douyin.com/search/<?php echo $obj['vod_name']; ?>" target="_blank" title="到抖音页面查看《<?php echo $obj['vod_name']; ?>》" rel="nofollow"><img src="https://lf1-cdn-tos.bytegoofy.com/goofy/ies/douyin/search/public/favicon.ico" style="width:15px; height:15px"></a></span>
    <span class="text-muted" style="margin-right: 10px;"><a href="https://www.kuaishou.com/search/video?searchKey=<?php echo $obj['vod_name']; ?>" target="_blank" title="到快手页面查看《<?php echo $obj['vod_name']; ?>》" rel="nofollow"><img src="https://static.yximgs.com/udata/pkg/WEB-LIVE/kwai_icon.8f6787d8.ico" style="width:15px; height:15px"></a></span>    
    <span class="text-muted" style="margin-right: 10px;"><a href="https://www.ixigua.com/search/<?php echo $obj['vod_name']; ?>" target="_blank" title="到西瓜视频页面查看《<?php echo $obj['vod_name']; ?>》" rel="nofollow"><img src="https://sf1-cdn-tos.douyinstatic.com/obj/eden-cn/lpqpflo/ixigua_favicon.ico" style="width:15px; height:15px"></a></span>     
    <span class="text-muted" style="margin-right: 10px;"><a href="https://s.weibo.com/weibo?q=<?php echo $obj['vod_name']; ?>" target="_blank" title="到微博页面查看《<?php echo $obj['vod_name']; ?>》" rel="nofollow"><img src="https://weibo.com/favicon.ico" style="width:15px; height:15px"></a></span>  
    
    <span class="text-muted" style="margin-right: 10px;"><a href="https://www.toutiao.com/search?keyword=<?php echo $obj['vod_name']; ?>" target="_blank" title="到头条页面查看《<?php echo $obj['vod_name']; ?>》" rel="nofollow"><img src="https://so.toutiao.com/favicon.ico" style="width:15px; height:15px"></a></span>
	<span class="text-muted" style="margin-right: 10px;"><a href="https://www.baidu.com/s?wd=<?php echo $obj['vod_name']; ?>" target="_blank" title="到百度页面查看《<?php echo $obj['vod_name']; ?>》" rel="nofollow"><img src="https://www.baidu.com/favicon.ico" style="width:15px; height:15px"></a></span>					 
					 
					 
					 </div>
						<?php endif; if($mxonest['mxcms']['s2']['tagkg'] == 1): ?>
					<div class="video-info-items"><span class="video-info-itemtitle">TAG：</span>
						<div class="video-info-item"><?php echo mac_url_create($obj['vod_tag'],'tag'); ?></div>
					</div>
					<?php endif; ?>
					<div class="video-info-items"><span class="video-info-itemtitle">剧情：</span>
						<div class="video-info-item video-info-content vod_content">
						    <span><?php echo mac_default(mac_filter_html($obj['vod_content']),'内详'); ?></span>
							<a href="javaScript:;" class="shrink">收起</a>
						</div>
					</div>

					<?php if($mxonest['mxcms']['s3']['ad2'] == 1): ?>
                    <div class="video-info-items"><span class="video-info-itemtitle">AD：</span>
						<div class="video-info-item">
						   <?php echo $mxonest['mxcms']['s3']['aad2']; ?>
						</div>
					</div>					
					<?php endif; ?>
					
					
					
				</div>
				<div class="video-info-footer display">
					<div class="video-info-share">
						<button class="share-btn" data-clipboard-text="<?php echo $maccms['site_url']; ?><?php echo mac_url_vod_detail($obj); ?> 我正在<?php echo $maccms['site_name']; ?>观看《<?php echo $obj['vod_name']; ?>》，推荐给你一起看！">好影片，与好朋友一起分享<i class="icon-happy"></i></button>
					</div>
					<?php if($obj['vod_play_list']): ?>
					<a href="<?php echo mac_url_vod_play($obj); ?>" class="btn-important btn-large shadow-drop" title="立刻播放<?php echo $obj['vod_name']; ?>"><i class="icon-play"></i><strong>立即播放</strong></a>
					<?php else: ?>
					<a class="noplaylist btn-large" href="javaScript:;"><i class="icon-warn"></i>暂无片源</a>
					<?php endif; if($mxonest['mxcms']['s2']['shoucang'] == 1): if($maccms['user_status'] == 1): ?>
					<a href="javascript:void(0);"  data-type="2" data-mid="<?php echo $maccms['mid']; ?>" data-id="<?php echo $obj['vod_id']; ?>" class="mac_ulog  btn-large btn-collect"><i class="iconfont  icon-shoucang"></i>收藏</a>	
					<?php endif; endif; if(!(empty($obj[vod_down_from]) || (($obj[vod_down_from] instanceof \think\Collection || $obj[vod_down_from] instanceof \think\Paginator ) && $obj[vod_down_from]->isEmpty()))): ?>
					<a href="<?php echo mac_url_vod_down($obj); ?>" class="btn-aux btn-aux-o btn-large gotodownloadlist"><i class="icon-download"></i><strong>下载</strong></a>
					<?php endif; ?>
				</div>
			</div>
		</div>       <!-- 简介 -->
    
<?php if($mxonest['mxcms']['s3']['adqj'] == 1): if($mxonest['mxcms']['s3']['adqj'] == 1): ?>
<?php echo $mxonest['mxcms']['s3']['aadqj']; endif; ?>	 <!-- 全局广告位 -->	<?php endif; if(!(empty($obj[vod_play_from]) || (($obj[vod_play_from] instanceof \think\Collection || $obj[vod_play_from] instanceof \think\Paginator ) && $obj[vod_play_from]->isEmpty()))): ?>
    <style>
  .module-blocklist a em  {    color: rgb(0 0 0 / 92%);position: absolute; top: -1px;right: 2px;z-index: 3; transform: scale(0.78); transform-origin: top right;border-radius: 1px 5px 0 5px; background: linear-gradient(90deg, #FFEB3B, #f9e326);padding: 0 3px; line-height: 16px;font-size: 12px; border-radius: 5px; display: inline-block !important;}
   @media (min-width: 659px){ 
       .module-blocklist a{ overflow: initial; width:auto}
       .module-blocklist a em{ top: -5px; right: -5px;}
   }
 </style>  

        <div class="module">
      <div class="module-heading">
          <h2 class="module-title" title="<?php echo $obj['vod_name']; ?>在线观看列表">选集播放:</h2>
          <div class="module-tab module-player-tab ">
            <input type="hidden" name="tab" id="tab" class="module-tab-input">
            <label class="module-tab-name"><span class="module-tab-value"><strong>切换线路</strong></span><i class="icon-arrow-bottom-o"></i></label>
              <div class="module-tab-items">
              <div class="module-tab-title">播放节点列表<span class="close-drop"><i class="icon-close-o"></i></span></div>
              <div class="module-tab-content">
               <?php if(is_array($obj['vod_play_list']) || $obj['vod_play_list'] instanceof \think\Collection || $obj['vod_play_list'] instanceof \think\Paginator): if( count($obj['vod_play_list'])==0 ) : echo "" ;else: foreach($obj['vod_play_list'] as $key=>$vo): ?>	  
               <div class="module-tab-item tab-item" data-dropdown-value="<?php echo $vo['player_info']['show']; ?>"><span><?php echo $vo['player_info']['show']; ?></span><small><?php echo $vo['url_count']; ?></small></div>
               <?php endforeach; endif; else: echo "" ;endif; ?>	
                </div>
            </div>
          </div>
          <div class="shortcuts-mobile-overlay"></div>
        </div>
        <?php if(is_array($obj['vod_play_list']) || $obj['vod_play_list'] instanceof \think\Collection || $obj['vod_play_list'] instanceof \think\Paginator): if( count($obj['vod_play_list'])==0 ) : echo "" ;else: foreach($obj['vod_play_list'] as $key=>$vo): ?>	
        <div class="module-list module-player-list tab-list sort-list <?php switch($obj['type_id_1']): case "3": ?>module-vod-list<?php break; endswitch; ?>" id="glist-<?php echo $key; ?>">
          <div class="module-tab module-sorttab">
            <input type="hidden" name="tab-sort" id="tab-sort" class="module-tab-input">
            <label class="module-tab-name"><i class="icon-sort"></i>选集</label>
            <div class="module-tab-items">
              <div class="module-tab-title">选集<span class="close-drop"><i class="icon-close-o"></i></span><a class="desc sort-button" href="javascript:void(0);" to="#sort-item-<?php echo $key; ?>"><i class="icon-sort"></i>排序</a></div>
              <div class="module-tab-content">
                <div class="module-blocklist">
                  <div class="sort-item" id="sort-item-<?php echo $key; ?>">
                   <?php if(is_array($vo['urls']) || $vo['urls'] instanceof \think\Collection || $vo['urls'] instanceof \think\Paginator): if( count($vo['urls'])==0 ) : echo "" ;else: foreach($vo['urls'] as $key2=>$vo2): ?> 
                   
                 <a href="<?php echo mac_url_vod_play($obj,['sid'=>$vo['sid'],'nid'=>$vo2['nid']]); ?>" title="播放<?php echo $obj['vod_name']; ?><?php echo $vo2['name']; ?>"><span><?php echo $vo2['name']; ?></span>
                 <?php if($vo2 == end($vo['urls'])&&$obj['vod_points'] > 0): ?> <em>VIP</em> 
                 <?php elseif($vo2['nid'] > $vo['url_count'] -2&&$vo['url_count'] > 2): ?> <em style="background:#FF008C;color:#FFFFFF">最新</em><?php endif; if($vo2 == end($vo['urls'])&&$obj['vod_level'] == '3'): ?> <em style="background:#00BFFF;color:#FFFFFF">预告</em><?php endif; ?></a>
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
            <a href="<?php echo mac_url_vod_play($obj,['sid'=>$vo['sid'],'nid'=>$vo2['nid']]); ?>" title="播放<?php echo $obj['vod_name']; ?><?php echo $vo2['name']; ?>"><span><?php echo $vo2['name']; ?></span>
             <?php if($vo2 == end($vo['urls'])&&$obj['vod_points'] > 0): ?> <em>VIP</em> 
               <?php elseif($vo2['nid'] > $vo['url_count'] -2&&$vo['url_count'] > 2): ?> <em style="background:#FF008C;color:#FFFFFF">最新</em><?php endif; if($vo2 == end($vo['urls'])&&$obj['vod_level'] == '3'): ?> <em style="background:#00BFFF;color:#FFFFFF">预告</em><?php endif; ?></a>
             <?php endforeach; endif; else: echo "" ;endif; ?>                   
           </div>
          </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <script type="text/javascript">$(".tab-item:first,.module-list:first").addClass("selected");</script>   <!-- 播放列表 -->
    <?php endif; if($obj['vod_actor'] != ''): $__TAG__ = '{"num":"1","order":"desc","name":"'.$obj[vod_actor].'","id":"vo1","key":"key"}';$__LIST__ = model("Actor")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($key % 2 );++$key;if($vo1['actor_name'] != ''): ?>    
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
   
    <?php if($obj['vod_plot'] == 1): ?>
            <div class="module">
      <div class="module-heading">
          <h2 class="module-title" title="<?php echo $obj['vod_name']; ?>分集剧情">分集剧情</h2>
        </div>
        <div class="module-list module-player-list">
          <div class="module-blocklist scroll-box scroll-box-y">
            <div class="scroll-content">
            <?php if(is_array($obj['vod_plot_list']) || $obj['vod_plot_list'] instanceof \think\Collection || $obj['vod_plot_list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $obj['vod_plot_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <a href="<?php echo mac_url_plot_detail($obj,['page'=>$key]); ?>" title="<?php echo $obj['vod_name']; ?>分集剧情">
            <span><?php echo $vo['name']; ?></span></a>
      	 <?php endforeach; endif; else: echo "" ;endif; ?>               
           </div>
          </div>
        </div>
        </div>   <!-- 分集剧情 -->
    <?php endif; if($mxonest['mxcms']['s3']['ad22'] == 1): ?><?php echo $mxonest['mxcms']['s3']['aad22']; ?>	 <!-- 详情图片广告位 -->	<?php endif; if(!(empty($obj[vod_rel_art]) || (($obj[vod_rel_art] instanceof \think\Collection || $obj[vod_rel_art] instanceof \think\Paginator ) && $obj[vod_rel_art]->isEmpty()))): ?>
<div class="module module-bg">
   <div class="module-heading">
      <h2 class="module-title">相关话题</h2>
      <div class="module-tab">
			<div class="module-tab-items">
<a class="module-tab-item" href="https://www.douyin.com/search/<?php echo $obj['vod_name']; ?>" title="<?php echo $obj['vod_name']; ?>" target="_blank">
      <img src="https://lf1-cdn-tos.bytegoofy.com/goofy/ies/douyin/search/public/favicon.ico" style="width: 12px;">&nbsp;<span class=""><?php echo $obj['vod_name']; ?></span></a>
<a class="module-tab-item" href="https://www.toutiao.com/search?keyword=<?php echo $obj['vod_name']; ?>" title="<?php echo $obj['vod_name']; ?>" target="_blank">
      <img src="https://so.toutiao.com/favicon.ico" style="width: 12px;">&nbsp;<span class=""><?php echo $obj['vod_name']; ?></span></a>
<a class="module-tab-item" href="https://s.weibo.com/weibo?q=<?php echo $obj['vod_name']; ?>" title="<?php echo $obj['vod_name']; ?>" target="_blank">
      <img src="https://s.weibo.com/favicon.ico" style="width: 12px;">&nbsp;<span class=""><?php echo $obj['vod_name']; ?></span></a> 
<a class="module-tab-item" href="https://www.baidu.com/s?wd=<?php echo $obj['vod_name']; ?>" title="<?php echo $obj['vod_name']; ?>" target="_blank">
          <img src="https://www.baidu.com/favicon.ico" style="width: 12px;">&nbsp;<span class=""><?php echo $obj['vod_name']; ?></span></a>       
			</div>
		</div>
   </div>
   <div class="module-list module-line-list">
      <div class="module-items">
  <?php $__TAG__ = '{"rel":"'.$obj['vod_rel_art'].'","order":"desc","by":"time","id":"vo","key":"key"}';$__LIST__ = model("Art")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>  	
<div class="module-search-item ovhidden">
	<div class="video-info">
				<div class="module-item-style video-name">
			<a rel="nofollow" href="<?php echo mac_url_art_detail($vo); ?>" title="<?php echo $vo['art_name']; ?>"><?php echo $vo['art_name']; ?></a>
		</div>
	<div class="module-item-style video-text"><?php echo mac_filter_html($vo['art_content']); ?></div>
    </div>
    </div>
 	<?php endforeach; endif; else: echo "" ;endif; ?>                
 </div>
   </div>
</div>


<?php endif; ?>   <!-- 相关话题 -->
    
    
    <?php if(!(empty($obj[vod_rel_vod]) || (($obj[vod_rel_vod] instanceof \think\Collection || $obj[vod_rel_vod] instanceof \think\Paginator ) && $obj[vod_rel_vod]->isEmpty()))): ?>
<div class="module">
	<div class="module-heading">
		<h2 class="module-title" title="<?php echo $obj['vod_name']; ?>同系列影片">系列影片</h2></div>
	<div class="module-list module-lines-list">
		<div class="module-items scroll-box">
			<div class="scroll-content">
			    <?php $__TAG__ = '{"num":"6","rel":"'.$obj['vod_rel_vod'].'","order":"desc","by":"time","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
				<div class="module-item module-item-go">
					<div class="module-item-cover">
						<div class="module-item-pic">
							<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" title="<?php echo $vo['vod_name']; ?>"><i class="icon-play"></i></a><img class=" ls-is-cached  lazy lazyloaded" data-src="<?php echo mac_url_img($vo['vod_pic']); ?>" src="<?php echo mac_url_img($mxonest['mxcms']['s1']['pic']); ?>" alt="<?php echo $vo['vod_name']; ?>">
							<div class="loading"></div>
						</div>
						<div class="module-item-caption"></div>
					</div>
					<div class="module-item-titlebox">
						<a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" class="module-item-title" title="<?php echo $vo['vod_name']; ?>"><?php echo $vo['vod_name']; ?></a>
					</div>
					<div class="module-item-text"><span><?php echo $vo['vod_year']; ?>年</span></div>
				</div>
				    <?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>   <!-- 系列影片 -->
    
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
    <?php if($mxonest['mxcms']['s2']['hot'] == 1): if($mxonest['mxcms']['s2']['hot'] == 1): ?>
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
     <?php endif; ?>
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
    <script type="text/javascript"  src="<?php echo $maccms['path_tpl']; ?>mxstatic/js/desc.js"></script>
   <div class="shortcuts-box"><div id="shortcuts-info"></div></div>
   <span style="display:none" class="mac_ulog_set" alt="设置内容页浏览记录" data-type="1" data-mid="<?php echo $maccms['mid']; ?>" data-id="<?php echo $obj['vod_id']; ?>" data-sid="<?php echo $param['sid']; ?>" data-nid="<?php echo $param['nid']; ?>"></span>
<span style="display:none" class="mac_history_set" alt="设置History历史记录" data-name="[<?php echo $obj['type']['type_name']; ?>]<?php echo $obj['vod_name']; ?>" data-pic="<?php echo mac_url_img($obj['vod_pic']); ?>"></span>
 </body>
</html>