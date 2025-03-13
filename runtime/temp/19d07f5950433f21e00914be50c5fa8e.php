<?php if (!defined('THINK_PATH')) exit(); /*a:23:{s:36:"template/mxone/html/index/index.html";i:1664180262;s:76:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/seo/index.html";i:1664247958;s:81:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/public/include.html";i:1664250000;s:78:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/public/head.html";i:1642429072;s:81:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/index/bigslide.html";i:1651601364;s:87:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/public/swiper_banner.html";i:1651638674;s:76:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/index/nav.html";i:1640791368;s:78:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/vod/home_sm.html";i:1640257448;s:78:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/index/slide.html";i:1639063770;s:75:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/ads/adqj.html";i:1625104690;s:76:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/index/hot.html";i:1650689824;s:80:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/public/vodbox.html";i:1664246986;s:74:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/ads/ad1.html";i:1625714972;s:78:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/index/yugao.html";i:1664183820;s:77:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/index/list.html";i:1654185188;s:78:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/index/topic.html";i:1639063778;s:76:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/index/art.html";i:1639063716;s:76:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/index/new.html";i:1639063756;s:78:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/index/links.html";i:1639063742;s:78:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/public/foot.html";i:1664185344;s:82:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/public/tcnotice.html";i:1639063956;s:81:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/public/website.html";i:1639063970;s:75:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/ads/addb.html";i:1625104690;}*/ ?>
<!doctype html>
<html lang="zh-CN">
<head>
<title><?php echo $maccms['site_name']; ?> - <?php echo $maccms['site_url']; ?></title>
<meta name="keywords" content="<?php echo $maccms['site_keywords']; ?>" />
<meta name="description" content="<?php echo $maccms['site_description']; ?>" />    
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
<body class="homepage">
 
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
									<?php $_67d2dce5875dc=explode(',',$maccms['search_hot']); if(is_array($_67d2dce5875dc) || $_67d2dce5875dc instanceof \think\Collection || $_67d2dce5875dc instanceof \think\Paginator): if( count($_67d2dce5875dc)==0 ) : echo "" ;else: foreach($_67d2dce5875dc as $key2=>$vo2): ?>
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
									<?php $_67d2dce587518=explode(',',$maccms['search_hot']); if(is_array($_67d2dce587518) || $_67d2dce587518 instanceof \think\Collection || $_67d2dce587518 instanceof \think\Paginator): if( count($_67d2dce587518)==0 ) : echo "" ;else: foreach($_67d2dce587518 as $key2=>$vo2): ?>
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
 <?php if($mxonest['mxcms']['s2']['app'] == 1): ?>	
    <div class="app-text">
    <a href="<?php echo mac_url('label/app'); ?>"><i class="icon-download"></i>下载<strong><?php echo $maccms['site_name']; ?>APP</strong>客户端</a>
    <div class="bg-ball">
    </div>
    </div>	
    <?php endif; if($mxonest['mxcms']['s2']['bigslide'] == 1): ?> <link rel="stylesheet" href="<?php echo $maccms['path_tpl']; ?>mxstatic/css/swiper.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo $maccms['path_tpl']; ?>mxstatic/css/hdp.css" type="text/css">
   <div class="swiper-container">
      <div class="swiper-wrapper">
          
           		<?php if($mxonest['mxcms']['s2']['slidediy1'] == 1): ?>
           	<div class="swiper-slide">
        <a class="dymrslide banner" data-name="<?php echo $mxonest['mxcms']['s2']['slidediy1name']; ?>" data-fname="<?php if($mxonest['mxcms']['s2']['slidediy1fname'] != ''): ?><?php echo $mxonest['mxcms']['s2']['slidediy1fname']; else: ?>暂无<?php endif; ?>" href="<?php echo $mxonest['mxcms']['s2']['slidediy1url']; ?>" target="_blank" style="background: url(<?php echo $mxonest['mxcms']['s2']['slidediy1pic']; ?>) center no-repeat;  background-size: cover;">
            <div class="focus_leftshode focusleftshode"></div>
            <div class="focus_rightshode focusrightshode"></div>
            <div class="focus_topshode focustopshode"></div>
            <div class="focus_bottomshode focusbottomshode"></div>
          <div class="txt-info">
            <p class="gate"><span>广告</span></p>  
            <p class="name"><?php echo $mxonest['mxcms']['s2']['slidediy1name']; ?></p>
            <p class="info"><?php if($mxonest['mxcms']['s2']['slidediy1fname'] != ''): ?><?php echo $mxonest['mxcms']['s2']['slidediy1fname']; else: ?>暂无<?php endif; ?> </p>            
          </div>
          </a>
        </div>
           	  <?php endif; if($mxonest['mxcms']['s2']['slidediy2'] == 1): ?>
           	<div class="swiper-slide">
        <a class="dymrslide banner" data-name="<?php echo $mxonest['mxcms']['s2']['slidediy2name']; ?>" data-fname="<?php if($mxonest['mxcms']['s2']['slidediy2fname'] != ''): ?><?php echo $mxonest['mxcms']['s2']['slidediy2fname']; else: ?>暂无<?php endif; ?>" href="<?php echo $mxonest['mxcms']['s2']['slidediy2url']; ?>" target="_blank"  style="background: url(<?php echo $mxonest['mxcms']['s2']['slidediy2pic']; ?>) center no-repeat;  background-size: cover;">
            <div class="focus_leftshode focusleftshode"></div>
            <div class="focus_rightshode focusrightshode"></div>
            <div class="focus_topshode focustopshode"></div>
            <div class="focus_bottomshode focusbottomshode"></div>            
          <div class="txt-info">
            <p class="gate"><span>广告</span></p>    
            <p class="name"><?php echo $mxonest['mxcms']['s2']['slidediy2name']; ?></p>
            <p class="info"><?php if($mxonest['mxcms']['s2']['slidediy2fname'] != ''): ?><?php echo $mxonest['mxcms']['s2']['slidediy2fname']; else: ?>暂无<?php endif; ?> </p>     
          </div>
          </a>
        </div>
           	  <?php endif; if($mxonest['mxcms']['s2']['slidediy3'] == 1): ?>
           	<div class="swiper-slide">
        <a class="dymrslide banner" data-name="<?php echo $mxonest['mxcms']['s2']['slidediy3name']; ?>" data-fname="<?php if($mxonest['mxcms']['s2']['slidediy3fname'] != ''): ?><?php echo $mxonest['mxcms']['s2']['slidediy3fname']; else: ?>暂无<?php endif; ?>" href="<?php echo $mxonest['mxcms']['s2']['slidediy3url']; ?>" target="_blank"  style="background: url(<?php echo $mxonest['mxcms']['s2']['slidediy3pic']; ?>) center no-repeat;  background-size: cover;">
            <div class="focus_leftshode focusleftshode"></div>
            <div class="focus_rightshode focusrightshode"></div>
            <div class="focus_topshode focustopshode"></div>
            <div class="focus_bottomshode focusbottomshode"></div>            
          <div class="txt-info">
            <p class="gate"><span>广告</span></p>    
            <p class="name"><?php echo $mxonest['mxcms']['s2']['slidediy3name']; ?></p>
            <p class="info"><?php if($mxonest['mxcms']['s2']['slidediy3fname'] != ''): ?><?php echo $mxonest['mxcms']['s2']['slidediy3fname']; else: ?>暂无<?php endif; ?> </p>
          </div>
          </a>
        </div>


           	  <?php endif; ?>          
 <style>
 .gifpic{display:none}
 </style>
  <?php if($maccms['aid'] == 7): $__TAG__ = '{"num":"'.$mxonest['mxcms']['s2']['slidenum'].'","type":"all","order":"desc","by":"time","level":"9","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
                        <div class="swiper-slide">
         <div class=" gifpic" style="background: url(<?php if($vo['vod_pic_thumb'] == ''): ?><?php echo mac_url_img($vo['vod_pic_slide']); else: ?><?php echo $vo['vod_pic_thumb']; endif; ?>) center no-repeat;  background-size: cover;padding-top: 30%;border-radius: 5px;position: relative;">            
            <div class="focus_leftshode focusleftshode"></div>
            <div class="focus_rightshode focusrightshode"></div>
            <div class="focus_topshode focustopshode"></div>
            <div class="focus_bottomshode focusbottomshode"></div>                        
            <div class="txt-info">
            <p class="gate"><span><?php echo $vo['type']['type_name']; ?></span></p>
            <p class="name"><?php echo $vo['vod_name']; ?></p>
            <p class="info"><?php if($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; elseif($vo['vod_serial'] > 0): ?>第<?php echo $vo['vod_serial']; ?>集<?php else: ?>已完结<?php endif; ?> </p>
            </div>           
         </div> 
        <a class="dymrslide banner jpgpic" data-name="<?php echo $vo['vod_name']; ?>" data-fname="<?php if($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; elseif($vo['vod_sub'] != ''): ?><?php echo $vo['vod_sub']; else: ?><?php echo $vo['vod_tag']; endif; ?>" href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" style="background: url(<?php echo mac_url_img($vo['vod_pic_slide']); ?>) center no-repeat;  background-size: cover;">
            <div class="focus_leftshode focusleftshode"></div>
            <div class="focus_rightshode focusrightshode"></div>
            <div class="focus_topshode focustopshode"></div>
            <div class="focus_bottomshode focusbottomshode"></div>                        
           <div class="txt-info">
            <p class="gate"><span><?php echo $vo['type']['type_name']; ?></span></p>
            <p class="name"><?php echo $vo['vod_name']; ?></p>
            <p class="info"><?php if($vo['vod_actor'] != ''): ?><?php echo $vo['vod_actor']; elseif($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; else: ?><?php echo $vo['vod_state']; endif; ?>  </p><!--左边顺序主演-备注-资源类别--->
          </div>
          </a>
	     </div>	
           	<?php endforeach; endif; else: echo "" ;endif; elseif($maccms['aid'] == 11): $__TAG__ = '{"num":"'.$mxonest['mxcms']['s2']['slidenum'].'","type":"current","order":"desc","by":"time","level":"9,8","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
                        <div class="swiper-slide">
         <div class=" gifpic" style="background: url(<?php if($vo['vod_pic_thumb'] == ''): ?><?php echo mac_url_img($vo['vod_pic_slide']); else: ?><?php echo $vo['vod_pic_thumb']; endif; ?>) center no-repeat;  background-size: cover;padding-top: 30%;border-radius: 5px;position: relative;">            
            <div class="focus_leftshode focusleftshode"></div>
            <div class="focus_rightshode focusrightshode"></div>
            <div class="focus_topshode focustopshode"></div>
            <div class="focus_bottomshode focusbottomshode"></div>                        
            <div class="txt-info">
            <p class="gate"><span><?php echo $vo['type']['type_name']; ?></span></p>
            <p class="name"><?php echo $vo['vod_name']; ?></p>
            <p class="info"><?php if($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; elseif($vo['vod_serial'] > 0): ?>第<?php echo $vo['vod_serial']; ?>集<?php else: ?>已完结<?php endif; ?> </p>
            </div>           
         </div> 
        <a class="dymrslide banner jpgpic" data-name="<?php echo $vo['vod_name']; ?>" data-fname="<?php if($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; elseif($vo['vod_sub'] != ''): ?><?php echo $vo['vod_sub']; else: ?><?php echo $vo['vod_tag']; endif; ?>" href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" style="background: url(<?php echo mac_url_img($vo['vod_pic_slide']); ?>) center no-repeat;  background-size: cover;">
            <div class="focus_leftshode focusleftshode"></div>
            <div class="focus_rightshode focusrightshode"></div>
            <div class="focus_topshode focustopshode"></div>
            <div class="focus_bottomshode focusbottomshode"></div>                        
           <div class="txt-info">
            <p class="gate"><span><?php echo $vo['type']['type_name']; ?></span></p>
            <p class="name"><?php echo $vo['vod_name']; ?></p>
            <p class="info"><?php if($vo['vod_actor'] != ''): ?><?php echo $vo['vod_actor']; elseif($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; else: ?><?php echo $vo['vod_state']; endif; ?>  </p><!--左边顺序主演-备注-资源类别--->
          </div>
          </a>
	     </div>	
           	<?php endforeach; endif; else: echo "" ;endif; ?>	 <!--分类页幻灯默认取推荐9的分类图片,若需要额外推荐,选择对于的分类推荐8-->
<?php else: $__TAG__ = '{"num":"'.$mxonest['mxcms']['s2']['slidenum'].'","type":"all","order":"desc","by":"time","level":"'.$mxonest['mxcms']['s2']['slidetj'].'","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
                        <div class="swiper-slide">
         <div class=" gifpic" style="background: url(<?php if($vo['vod_pic_thumb'] == ''): ?><?php echo mac_url_img($vo['vod_pic_slide']); else: ?><?php echo $vo['vod_pic_thumb']; endif; ?>) center no-repeat;  background-size: cover;padding-top: 30%;border-radius: 5px;position: relative;">            
            <div class="focus_leftshode focusleftshode"></div>
            <div class="focus_rightshode focusrightshode"></div>
            <div class="focus_topshode focustopshode"></div>
            <div class="focus_bottomshode focusbottomshode"></div>                        
            <div class="txt-info">
            <p class="gate"><span><?php echo $vo['type']['type_name']; ?></span></p>
            <p class="name"><?php echo $vo['vod_name']; ?></p>
            <p class="info"><?php if($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; elseif($vo['vod_serial'] > 0): ?>第<?php echo $vo['vod_serial']; ?>集<?php else: ?>已完结<?php endif; ?> </p>
            </div>           
         </div> 
        <a class="dymrslide banner jpgpic" data-name="<?php echo $vo['vod_name']; ?>" data-fname="<?php if($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; elseif($vo['vod_sub'] != ''): ?><?php echo $vo['vod_sub']; else: ?><?php echo $vo['vod_tag']; endif; ?>" href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" style="background: url(<?php echo mac_url_img($vo['vod_pic_slide']); ?>) center no-repeat;  background-size: cover;">
            <div class="focus_leftshode focusleftshode"></div>
            <div class="focus_rightshode focusrightshode"></div>
            <div class="focus_topshode focustopshode"></div>
            <div class="focus_bottomshode focusbottomshode"></div>                        
           <div class="txt-info">
            <p class="gate"><span><?php echo $vo['type']['type_name']; ?></span></p>
            <p class="name"><?php echo $vo['vod_name']; ?></p>
            <p class="info"><?php if($vo['vod_actor'] != ''): ?><?php echo $vo['vod_actor']; elseif($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; else: ?><?php echo $vo['vod_state']; endif; ?>  </p><!--左边顺序主演-备注-资源类别--->
          </div>
          </a>
	     </div>	
           	<?php endforeach; endif; else: echo "" ;endif; ?>		  <!--首页幻灯-->
<?php endif; ?>         	
 

        			
      </div>
      <div class="swiper-pagination"></div>
    </div>

 <!-- 轮播图 --> <?php endif; ?>
<main id="index-main" class="wrapper">
	<div class="content">
		    <br>		
	    <?php if($mxonest['mxcms']['s2']['nav'] == 1): ?> <div class="module homepage_homepage_channelnav">
	<div class="homepage_left_content">
	    <div class="homepage_main_tabs_wrap_new">
            <?php $__TAG__ = '{"num":"6","ids":"'.$mxonest['mxcms']['s2']['navids'].'","order":"asc","by":"sort","id":"vo1","key":"key1","flag":"vod"}';$__LIST__ = model("Type")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key1 = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($key1 % 2 );++$key1;?>
            <div class="homepage_main_tabs_new">
	          <a class="homepage_main_tabs_title_new" href="<?php echo mac_url_type($vo1); ?>" target="_blank" ><?php echo $vo1['type_name']; ?></a>
	          <div class="homepage_main_tabs_sub_new">
	             		<?php $_67d2dce587396=explode(',',$vo1['type_extend']['class']); if(is_array($_67d2dce587396) || $_67d2dce587396 instanceof \think\Collection || $_67d2dce587396 instanceof \think\Paginator): if( count($_67d2dce587396)==0 ) : echo "" ;else: foreach($_67d2dce587396 as $key2=>$vo2): if($key2 < 2): ?>
	                  	<a class="homepage_sub_title_new" target="_blank" href="<?php echo mac_url_type($vo1,['class'=>$vo2],'show'); ?>" title="<?php echo $vo2; ?>"><?php echo mac_substring($vo2,2); ?></a>     <?php endif; endforeach; endif; else: echo "" ;endif; ?>
	          </div>
     <div class="homepage_channel_video_wrap">
         <div class="homepage_arrow"></div>
            <a class="homepage_title col4" href="<?php echo mac_url_type($vo1); ?>">更多<?php echo $vo1['type_name']; ?><span class="fa fa-step-forward"></span></a>
                            <?php $__TAG__ = '{"num":"4","type":"'.$vo1['type_id'].'","order":"desc","by":"hits_week","level":"'.$mxonest['mxcms']['s2']['hotlevel'].'","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
            <a href="<?php echo mac_url_vod_play($vo); ?>" class="homepage_video_wrap" title="<?php echo $vo['vod_name']; ?>"><img src="<?php echo mac_url_img($vo['vod_pic']); ?>" class="homepage_video_img" />
            <div class="homepage_video_title col1"><?php echo $vo['vod_name']; ?></div></a>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>  	          
 </div>   
            <?php endforeach; endif; else: echo "" ;endif; ?>	        
	    </div>
	    <div class="homepage_normal_tabs_wrap">
	        <div class="homepage_normal_tabs homepage_hide_1">
	            <?php if($mxonest['mxcms']['s2']['navdiy1'] == 1): ?>
	            <a class="homepage_tab aplus_exp aplus_clk" href="<?php echo $mxonest['mxcms']['s2']['navdiyu1']; ?>" target="_blank" ><?php echo $mxonest['mxcms']['s2']['navdiyn1']; ?></a>
	            <?php endif; if($mxonest['mxcms']['s2']['navdiy2'] == 1): ?>
	            <a class="homepage_tab aplus_exp aplus_clk" href="<?php echo $mxonest['mxcms']['s2']['navdiyu2']; ?>" target="_blank" ><?php echo $mxonest['mxcms']['s2']['navdiyn2']; ?></a>
	            <?php endif; ?>
	         </div>
	        <div class="homepage_normal_tabs homepage_hide_2">
	            <?php if($mxonest['mxcms']['s2']['navdiy3'] == 1): ?>
	            <a class="homepage_tab aplus_exp aplus_clk" href="<?php echo $mxonest['mxcms']['s2']['navdiyu3']; ?>" target="_blank" ><?php echo $mxonest['mxcms']['s2']['navdiyn3']; ?></a>
	            <?php endif; if($mxonest['mxcms']['s2']['navdiy4'] == 1): ?>
	            <a class="homepage_tab aplus_exp aplus_clk" href="<?php echo $mxonest['mxcms']['s2']['navdiyu4']; ?>" target="_blank" ><?php echo $mxonest['mxcms']['s2']['navdiyn4']; ?></a>
	            <?php endif; ?>
	         </div>
 	        <div class="homepage_normal_tabs homepage_hide_3">
	            <?php if($mxonest['mxcms']['s2']['navdiy5'] == 1): ?>
	            <a class="homepage_tab aplus_exp aplus_clk" href="<?php echo $mxonest['mxcms']['s2']['navdiyu5']; ?>" target="_blank" ><?php echo $mxonest['mxcms']['s2']['navdiyn5']; ?></a>
	            <?php endif; if($mxonest['mxcms']['s2']['navdiy6'] == 1): ?>
	            <a class="homepage_tab aplus_exp aplus_clk" href="<?php echo $mxonest['mxcms']['s2']['navdiyu6']; ?>" target="_blank" ><?php echo $mxonest['mxcms']['s2']['navdiyn6']; ?></a>
	            <?php endif; ?>
	         </div>
	         
	    </div>
	    	
	</div>

    <div class="homepage_opt_wrap">
        <a  href="<?php echo mac_url('/user'); ?>" class=" aplus_exp aplus_clk">
            <img src="<?php echo $maccms['path_tpl']; ?>mxstatic/image/vip.png" style="margin-left:0">
            <span>VIP会员</span></a>
        <a href="<?php echo mac_url('label/live'); ?>" class="undefined aplus_exp aplus_clk" >
            <img src="<?php echo $maccms['path_tpl']; ?>mxstatic/image/zhibo.png" style="margin-left:">
            <span>直播</span></a>
        <a  href="<?php echo mac_url_type($obj,['id'=>1],'show'); ?>" class="undefined aplus_exp aplus_clk" >
            <img src="<?php echo $maccms['path_tpl']; ?>mxstatic/image/pianku.png" style="margin-left:">
            <span>片库</span></a>
     </div>
    <div class="homepage_cut_line_wrap">
        <div class="homepage_cut_line">
        </div>
    </div>
</div>

	<!-- 幻灯下导航 --> <?php endif; if($mxonest['mxcms']['s2']['slide'] == 1): ?> <script type="text/javascript"  src="<?php echo $maccms['path_tpl']; ?>mxstatic/js/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="<?php echo $maccms['path_tpl']; ?>mxstatic/css/swiper-bundle.min.css" type="text/css">
   <div class="swiper-container" style="margin-bottom: 20px;">
      <div class="swiper-wrapper">
          <?php $__TAG__ = '{"num":"'.$mxonest['mxcms']['s2']['slidenum'].'","type":"all","order":"desc","by":"time","level":"'.$mxonest['mxcms']['s2']['slidetj'].'","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
         <div class="swiper-slide">
        <a class="dymrslide banner" data-name="<?php echo $vo['vod_name']; ?>" data-fname="<?php if($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; elseif($vo['vod_serial'] > 0): ?>第<?php echo $vo['vod_serial']; ?>集<?php else: ?>已完结<?php endif; ?>" href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" style="background: url(<?php echo mac_url_img($vo['vod_pic_slide']); ?>) center no-repeat;  background-size: cover;">
          <div class="txt-info">
            <p class="gate"><span><?php echo $vo['type']['type_name']; ?></span></p>
            <p class="name"><?php echo $vo['vod_name']; ?></p>
            <p class="info"><?php if($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; elseif($vo['vod_serial'] > 0): ?>第<?php echo $vo['vod_serial']; ?>集<?php else: ?>已完结<?php endif; ?> </p>
          </div>
          </a>
        </div>
           	<?php endforeach; endif; else: echo "" ;endif; if($mxonest['mxcms']['s2']['slidediy1'] == 1): ?>
           	<div class="swiper-slide">
        <a class="dymrslide banner" href="<?php echo $mxonest['mxcms']['s2']['slidediy1url']; ?>" target="_blank" style="background: url(<?php echo $mxonest['mxcms']['s2']['slidediy1pic']; ?>) center no-repeat;  background-size: cover;">
          <div class="txt-info">
            <p class="name"><?php echo $mxonest['mxcms']['s2']['slidediy1name']; ?></p>
          </div>
          </a>
        </div>
           	  <?php endif; if($mxonest['mxcms']['s2']['slidediy2'] == 1): ?>
           	<div class="swiper-slide">
        <a class="dymrslide banner" href="<?php echo $mxonest['mxcms']['s2']['slidediy2url']; ?>" target="_blank"  style="background: url(<?php echo $mxonest['mxcms']['s2']['slidediy2pic']; ?>) center no-repeat;  background-size: cover;">
          <div class="txt-info">
            <p class="name"><?php echo $mxonest['mxcms']['s2']['slidediy2name']; ?></p>
          </div>
          </a>
        </div>
           	  <?php endif; if($mxonest['mxcms']['s2']['slidediy3'] == 1): ?>
           	<div class="swiper-slide">
        <a class="dymrslide banner" href="<?php echo $mxonest['mxcms']['s2']['slidediy3url']; ?>" target="_blank"  style="background: url(<?php echo $mxonest['mxcms']['s2']['slidediy3pic']; ?>) center no-repeat;  background-size: cover;">
          <div class="txt-info">
            <p class="name"><?php echo $mxonest['mxcms']['s2']['slidediy3name']; ?></p>
          </div>
          </a>
        </div>
           	  <?php endif; if($mxonest['mxcms']['s2']['slidediy4'] == 1): ?>
           	<div class="swiper-slide">
        <a class="dymrslide banner" href="<?php echo $mxonest['mxcms']['s2']['slidediy4url']; ?>" target="_blank"  style="background: url(<?php echo $mxonest['mxcms']['s2']['slidediy4pic']; ?>) center no-repeat;  background-size: cover;">
          <div class="txt-info">
            <p class="name"><?php echo $mxonest['mxcms']['s2']['slidediy4name']; ?></p>
          </div>
          </a>
        </div>
           	  <?php endif; if($mxonest['mxcms']['s2']['slidediy5'] == 1): ?>
           	<div class="swiper-slide">
        <a class="dymrslide banner" href="<?php echo $mxonest['mxcms']['s2']['slidediy5url']; ?>" target="_blank"  style="background: url(<?php echo $mxonest['mxcms']['s2']['slidediy5pic']; ?>) center no-repeat;  background-size: cover;">
          <div class="txt-info">
            <p class="name"><?php echo $mxonest['mxcms']['s2']['slidediy5name']; ?></p>
          </div>
          </a>
        </div>
           	  <?php endif; ?>
           	
        			
      </div>
      <div class="swiper-pagination"></div>
    </div>
     <script>
       var swiper = new Swiper('.swiper-container', {
            direction: 'horizontal',
            loop: true, 
            autoplay: true,
            autoplay: {
                delay: 3000,
                stopOnLastSlide: false,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
				 clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            scrollbar: {
                el: '.swiper-scrollbar',
            },
        
        					onInit:function() {
						setTimeout(function () {
							$.adaptiveBackground.run()	
						},1500);
					},
  paginationBulletRender: function (swiper, index, className) {
    var name = document.querySelectorAll('.dymrslide')[index].getAttribute('data-name');
    var fname = document.querySelectorAll('.dymrslide')[index].getAttribute('data-fname');

    return '<li class="' + className + '"><div class="focusswiper_nav_slide"><h2> <span class="nav_index nav_index_' + (index + 1) + '">' + (index + 1) + '</span>' + name + '</h2><div class="sub_title focusswiper_sub_title">' + fname + '</div></div></li>';
  }						
				});
	  $(".swiper-pagination-bullet").hover(function() {
          $(this).click(); //鼠标划上去之后，自动触发点击事件来模仿鼠标划上去的事件
      },function() {
          mySwiper.autoplay.start(); //鼠标移出之后，自动轮播开启
      })
      
      
      });
    </script>
  	 <!-- 轮播图 --> <?php endif; if($mxonest['mxcms']['s3']['adqj'] == 1): if($mxonest['mxcms']['s3']['adqj'] == 1): ?>
<?php echo $mxonest['mxcms']['s3']['aadqj']; endif; ?>	 <!-- 全局广告位 --><?php endif; if($mxonest['mxcms']['s2']['hot'] == 1): ?>
<div class="module">
	<div class="module-heading">
		<h2 class="module-title"><?php if($mxonest['mxcms']['s2']['hoticon'] == 1): ?><i class="icon-hot" style="color:<?php echo $mxonest['mxcms']['s2']['hoticoncss']; ?>"></i> <?php endif; ?> 最新热播</h2>
		<div class="module-sub-title">
		     <!---{maccms:vod num="5"  type="current" order="desc" by="hits_week" levels="1"}  -->
			 <?php $__TAG__ = '{"num":"6","level":"5","order":"desc","by":"time","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><!---数量6推荐5-->
		    <div class="module-link-wrap" ><a  href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>"  title="<?php echo $vo['vod_name']; ?>" ><?php echo $vo['vod_name']; ?> </a></div>
		    <?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<?php if($mxonest['mxcms']['s2']['todaygx'] == 1): ?><span class="more nonemore">今日更新：<font color="<?php echo $mxonest['mxcms']['s2']['todaycss']; ?>">“<?php echo mac_data_count(0,'today','vod'); ?>”</font> 部</span><?php endif; ?>
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
	 <!-- 正在热播 -->   <?php endif; if($mxonest['mxcms']['s3']['ad1'] == 1): ?><?php echo $mxonest['mxcms']['s3']['aad1']; ?>
 <!-- 广告位01 -->	 <?php endif; if($mxonest['mxcms']['s2']['yugao'] == 1): ?>	<div class="module">
		<div class="module-heading">
			<h2 class="module-title"><?php if($mxonest['mxcms']['s2']['yugaoicon'] == 1): ?><i class="<?php echo $mxonest['mxcms']['s2']['yugaoicons']; ?>" style="color:<?php echo $mxonest['mxcms']['s2']['yugaoiconcss']; ?>"></i> <?php endif; ?> <?php echo $mxonest['mxcms']['s2']['yugaoname']; ?></h2>
			
			<div class="module-tab">
				<div class="module-tab-items">
					
	<?php if($mxonest['mxcms']['s2']['yugaoall'] > 0): $__TAG__ = '{"order":"asc","by":"sort","ids":"'.$mxonest['mxcms']['s2']['yugaoall'].'","id":"vo1","key":"key1","flag":"vod"}';$__LIST__ = model("Type")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key1 = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($key1 % 2 );++$key1;?>
	<a class="module-tab-item" href="<?php echo mac_url_type($vo1,[],'show'); ?>" title="更多<?php echo $vo1['type_name']; ?>">更多<?php echo $vo1['type_name']; ?><i class="icon-arrow-right-o"></i></a>
	<?php endforeach; endif; else: echo "" ;endif; endif; ?>	
	   
				</div>
			</div>
		</div>
			<div class="module-list module-line-list ">
				<div class="module-items scroll-box">
					<div class="scroll-content">
	<?php $dqtime=date("Y-m-d");if($mxonest['mxcms']['s2']['yugaoall'] > 0): $__TAG__ = '{"num":"16","type":"'.$mxonest['mxcms']['s2']['yugaoall'].'","order":"desc","by":"time","flag":"vod","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?> 
			  
	<div class="module-item">
		
		
		<?php if(mxcms[s2][yugaowenzi] == 1): ?>
		
			 <div class="pack_reserve"><p><?php echo $mxonest['mxcms']['s2']['yugaotip3']; ?></p></div>
		  <?php else: ?>
			 <div class="pack_reserve"><p><?php if($vo['vod_pubdate'] == ''): ?><?php echo $mxonest['mxcms']['s2']['yugaotip1']; elseif($vo['vod_pubdate'] < $dqtime): ?><?php echo $mxonest['mxcms']['s2']['yugaotip2']; elseif($vo['vod_pubdate'] != ''): ?><?php echo $vo['vod_pubdate']; else: ?><?php echo $mxonest['mxcms']['s2']['yugaotip1']; endif; ?></p></div>
		  <?php endif; ?>
			 
			 
			 
					<div class="module-item-cover ">
						
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
				<?php if($mxonest['mxcms']['s2']['yugaoall'] > 0): ?>
						<div class="module-item-rt">
							<span class="yugao"><?php echo $mxonest['mxcms']['s2']['yugaoname1']; ?></span>
						</div>			
				<?php else: if($vo['vod_state'] == '预告片'): ?>
						<div class="module-item-rt">
							<span class="yugao">预告</span>
						</div>
						<?php endif; endif; ?>	
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
					<?php if($mxonest['mxcms']['s2']['yugaoshoucang'] == 1): ?>
					<a href="javascript:;" class="mac_ulog reserve" data-type="2" data-mid="1" data-id="<?php echo $vo['vod_id']; ?>">收藏</a><?php endif; ?>
				</div>  			
				
				
				
			  <?php endforeach; endif; else: echo "" ;endif; else: $__TAG__ = '{"num":"16","state":"\u9884\u544a\u7247","order":"desc","by":"time","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
					<div class="module-item">
			 <div class="pack_reserve"><p><?php if($vo['vod_pubdate'] == ''): ?><?php echo $mxonest['mxcms']['s2']['yugaotip1']; elseif($vo['vod_pubdate'] < $dqtime): ?><?php echo $mxonest['mxcms']['s2']['yugaotip2']; elseif($vo['vod_pubdate'] != ''): ?><?php echo $vo['vod_pubdate']; else: ?><?php echo $mxonest['mxcms']['s2']['yugaotip1']; endif; ?></p></div>
					<div class="module-item-cover ">
						
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
						<?php if($vo['vod_state'] == '预告片'): ?>
						<div class="module-item-rt">
							<span class="yugao">预告</span>
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
					<a href="javascript:;" class="mac_ulog reserve" data-type="2" data-mid="1" data-id="<?php echo $vo['vod_id']; ?>">收藏</a>
				</div>        
			<?php endforeach; endif; else: echo "" ;endif; endif; ?>	        
			
			
			  </div>
			</div>
		</div>
	</div><?php endif; ?> <!-- 预告-->
	     
<?php $__TAG__ = '{"order":"asc","by":"sort","ids":"'.$mxonest['mxcms']['s2']['logtype'].'","id":"vo1","key":"key1","flag":"vod"}';$__LIST__ = model("Type")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key1 = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($key1 % 2 );++$key1;?>	
<div class="module <?php if($mxonest['mxcms']['s2']['listphb'] == 1): ?>module-wrapper<?php endif; ?>">
    <div <?php if($mxonest['mxcms']['s2']['listphb'] == 1): ?> class="module-main" <?php endif; ?>>
	<div class="module-heading">
		<h2 class="module-title">
		<?php if($mxonest['mxcms']['s2']['lbiconkg'] == 1): if($vo1['type_id_1'] == $mxonest['mxcms']['s2']['lbnum1']||$vo1['type_id'] == $mxonest['mxcms']['s2']['lbnum1']): ?>
        <i class="<?php echo $mxonest['mxcms']['s2']['lbicon1']; ?>" style="color:<?php echo $mxonest['mxcms']['s2']['lbiconcss']; ?>"></i>
        <?php elseif($vo1['type_id_1'] == $mxonest['mxcms']['s2']['lbnum2']||$vo1['type_id'] == $mxonest['mxcms']['s2']['lbnum2']): ?>
        <i class="<?php echo $mxonest['mxcms']['s2']['lbicon2']; ?>" style="color:<?php echo $mxonest['mxcms']['s2']['lbiconcss']; ?>"></i>
       <?php elseif($vo1['type_id_1'] == $mxonest['mxcms']['s2']['lbnum3']||$vo1['type_id'] == $mxonest['mxcms']['s2']['lbnum3']): ?>
        <i class="<?php echo $mxonest['mxcms']['s2']['lbicon3']; ?>" style="color:<?php echo $mxonest['mxcms']['s2']['lbiconcss']; ?>"></i>
         <?php elseif($vo1['type_id_1'] == $mxonest['mxcms']['s2']['lbnum4']||$vo1['type_id'] == $mxonest['mxcms']['s2']['lbnum4']): ?>
         <i class="<?php echo $mxonest['mxcms']['s2']['lbicon4']; ?>" style="color:<?php echo $mxonest['mxcms']['s2']['lbiconcss']; ?>"></i>
         <?php elseif($vo1['type_id_1'] == $mxonest['mxcms']['s2']['lbnum5']||$vo1['type_id'] == $mxonest['mxcms']['s2']['lbnum5']): ?>
         <i class="<?php echo $mxonest['mxcms']['s2']['lbicon5']; ?>" style="color:<?php echo $mxonest['mxcms']['s2']['lbiconcss']; ?>"></i>
         <?php elseif($vo1['type_id_1'] == $mxonest['mxcms']['s2']['lbnum6']||$vo1['type_id'] == $mxonest['mxcms']['s2']['lbnum6']): ?>
         <i class="<?php echo $mxonest['mxcms']['s2']['lbicon6']; ?>" style="color:<?php echo $mxonest['mxcms']['s2']['lbiconcss']; ?>"></i>
         <?php elseif($vo1['type_id_1'] == $mxonest['mxcms']['s2']['lbnum7']||$vo1['type_id'] == $mxonest['mxcms']['s2']['lbnum7']): ?>
         <i class="<?php echo $mxonest['mxcms']['s2']['lbicon7']; ?>" style="color:<?php echo $mxonest['mxcms']['s2']['lbiconcss']; ?>"></i>
          <?php elseif($vo1['type_id_1'] == $mxonest['mxcms']['s2']['lbnum8']||$vo1['type_id'] == $mxonest['mxcms']['s2']['lbnum8']): ?>
         <i class="<?php echo $mxonest['mxcms']['s2']['lbicon8']; ?>" style="color:<?php echo $mxonest['mxcms']['s2']['lbiconcss']; ?>"></i>
         <?php else: ?>
         <i class="<?php echo $mxonest['mxcms']['s2']['lbiconmr']; ?>"></i>
         <?php endif; endif; ?> 
         <?php echo $vo1['type_name']; ?>
		  </h2>
		<a class="more" href="<?php echo mac_url_type($vo1,[],'type'); ?>" title="更多<?php echo $vo1['type_name']; ?>">更多<?php echo $vo1['type_name']; ?>
		<i class="icon-arrow-right-o"></i>
		</a>
	</div>
	<div class="module-list module-lines-list">
		<div class="module-items">
	    <?php if($mxonest['mxcms']['s2']['qzslt'] == 1): $__TAG__ = '{"num":"12","type":"'.$vo1['type_id'].'","order":"desc","by":"time","level":"'.$mxonest['mxcms']['s2']['listlevel'].'","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;if($mxonest['mxcms']['s2']['qzslt'] == 0): ?>	  
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
        <?php endif; endforeach; endif; else: echo "" ;endif; else: $__TAG__ = '{"num":"16","type":"'.$vo1['type_id'].'","order":"desc","by":"time","level":"'.$mxonest['mxcms']['s2']['listlevel'].'","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;if($mxonest['mxcms']['s2']['qzslt'] == 0): ?>	  
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
	<?php if($mxonest['mxcms']['s2']['listphb'] == 1): ?>
	<div class="module-side">
				<div class="module-heading">
					<h2 class="module-title"><?php echo $vo1['type_name']; ?><span>•</span><?php echo $mxonest['mxcms']['s2']['listphbname']; ?></h2>
				</div>
				<div class="module-side-list module-bg">
					<div class="scroll-box">
						<div class="module-textlist scroll-content">
						    
						 <?php if($mxonest['mxcms']['s2']['qzslt'] == 1): $__TAG__ = '{"num":"6","type":"'.$vo1['type_id'].'","order":"desc","by":"'.$mxonest['mxcms']['s2']['listphbby'].'","level":"'.$mxonest['mxcms']['s2']['listphbtj'].'","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>  
						    <a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" class="text-list-item">
								<div class="text-list-num <?php if($key == '1'): ?>top-main top-1<?php endif; if($key == '2'): ?>top-main top-2<?php endif; if($key == '3'): ?>top-main top-3<?php endif; ?>"><?php echo $key; ?></div>
								<div class="text-list-title">
									<h3><?php echo $vo['vod_name']; ?></h3>
									<p><?php if($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; elseif($vo['vod_serial'] > 0): ?>第<?php echo $vo['vod_serial']; ?>集<?php else: ?>已完结<?php endif; ?></p>
								</div>
							</a>
								<?php endforeach; endif; else: echo "" ;endif; else: $__TAG__ = '{"num":"10","type":"'.$vo1['type_id'].'","order":"desc","by":"'.$mxonest['mxcms']['s2']['listphbby'].'","level":"'.$mxonest['mxcms']['s2']['listphbtj'].'","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>  
						    <a href="<?php if($mxonest['mxcms']['s2']['tzzt'] == 1): ?><?php echo mac_url_vod_play($vo); else: ?><?php echo mac_url_vod_detail($vo); endif; ?>" class="text-list-item">
								<div class="text-list-num <?php if($key == '1'): ?>top-main top-1<?php endif; if($key == '2'): ?>top-main top-2<?php endif; if($key == '3'): ?>top-main top-3<?php endif; ?>"><?php echo $key; ?></div>
								<div class="text-list-title">
									<h3><?php echo $vo['vod_name']; ?></h3>
									<p><?php if($vo['vod_remarks'] != ''): ?><?php echo $vo['vod_remarks']; elseif($vo['vod_serial'] > 0): ?>第<?php echo $vo['vod_serial']; ?>集<?php else: ?>已完结<?php endif; ?></p>
								</div>
							</a>
								<?php endforeach; endif; else: echo "" ;endif; endif; ?>	
								
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
</div>
 <?php endforeach; endif; else: echo "" ;endif; ?>
 <!-- 列表 -->
	     
	     <?php if($mxonest['mxcms']['s2']['indextopic'] == 1): ?><div class="module">
	<div class="module-heading">
		<h2 class="module-title" title="最新专题"><?php if($mxonest['mxcms']['s2']['sytopicicon'] == 1): ?><i class="iconfont icon-shoucang1 f26" style="color:<?php echo $mxonest['mxcms']['s2']['sytopiciconcss']; ?>"></i> <?php endif; ?> 专题</h2>
			<a class="more" href="<?php echo mac_url('topic/index'); ?>" title="更多专题">更多专题</a>
		</div>
	<div class="module-list module-lines-list">
		<div class="module-items scroll-box">
			<div class="scroll-content">
			 	<?php $__TAG__ = '{"num":"'.$mxonest['mxcms']['s2']['indextopicnum'].'","order":"desc","by":"time","id":"vo","key":"key"}';$__LIST__ = model("Topic")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
				<div class="module-item module-item-go picw">
					<div class="module-item-cover nohoverbg pt50">
						<div class="module-item-pic">
							<a href="<?php echo mac_url_topic_detail($vo); ?>"></a><img class=" ls-is-cached  lazy lazyloaded" data-src="<?php echo mac_url_img($vo['topic_pic']); ?>" src="<?php echo mac_url_img($mxonest['mxcms']['s1']['pic']); ?>" alt="<?php echo $vo['topic_name']; ?>">
							<div class="loading"></div>
						</div>
					</div>
					<div class="module-item-titlebox w100">
						<a href="<?php echo mac_url_topic_detail($vo); ?>" class="module-item-title ccenter " title="<?php echo $vo['topic_name']; ?>"><?php echo $vo['topic_name']; ?></a>
					</div>
					<div class="module-item-text ccenter"><span>—— <?php echo count(explode(',',$vo['topic_rel_vod'])); ?>个影片 ——</span></div>
				</div>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
	</div>
</div> <!-- 专题 --> <?php endif; if($mxonest['mxcms']['s2']['indexart'] == 1): $__TAG__ = '{"ids":"'.$mxonest['mxcms']['s2']['indexartid'].'","order":"asc","by":"sort","id":"vo1","key":"key1","flag":"art"}';$__LIST__ = model("Type")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key1 = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($key1 % 2 );++$key1;?>
<div class="module module-bg">
   <div class="module-heading">
      <h2 class="module-title"><?php if($mxonest['mxcms']['s2']['syzixunicon'] == 1): ?><i class="iconfont icon-zixun f26" style="color:<?php echo $mxonest['mxcms']['s2']['syzixuniconcss']; ?>"></i> <?php endif; ?> <?php echo $vo1['type_name']; ?></h2>
      	<a class="more" href="<?php echo mac_url_type($vo1); ?>" title="更多<?php echo $vo1['type_name']; ?>">更多<?php echo $vo1['type_name']; ?></a>
   </div>
   <div class="module-list module-line-list">
      <div class="module-items">
     	<?php $__TAG__ = '{"num":"'.$mxonest['mxcms']['s2']['indexartnum'].'","type":"'.$vo1['type_id'].'","by":"time","id":"vo","key":"key"}';$__LIST__ = model("Art")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
<div class="module-search-item ovhidden">
     <div class="video-info-header"><a class="video-serial" href="<?php echo mac_url_type($vo1); ?>" title="<?php echo $vo['art_name']; ?>"><?php echo $vo['type']['type_name']; ?></a>
              </div>
            <div class="video-cover">
              <div class="module-item-cover nohoverbg top65">
                <div class="module-item-pic"><a href="<?php echo mac_url_art_detail($vo); ?>" title="<?php echo $vo['art_name']; ?>"></a><img class="lazy lazyload" data-src="<?php echo mac_url_img($vo['art_pic']); ?>" src="<?php echo mac_url_img($mxonest['mxcms']['s1']['pic']); ?>" alt="<?php echo $vo['art_name']; ?>">
                  <div class="loading"></div>
                </div>
              </div>
            </div>
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
<?php endforeach; endif; else: echo "" ;endif; ?> <!-- 资讯 --><?php endif; if($mxonest['mxcms']['s2']['new'] == 1): ?><div class="module">
	<div class="module-heading">
		<h2 class="module-title"><?php if($mxonest['mxcms']['s2']['newicon'] == 1): ?><i class="icon-happy" style="color:<?php echo $mxonest['mxcms']['s2']['newiconcss']; ?>"></i> <?php endif; ?> 最新影片</h2>
		<div class="module-tab">
			<input type="hidden" name="tab" id="tab" class="module-tab-input">
			<label class="module-tab-name"><span class="module-tab-value">全部</span><i class="icon-arrow-bottom"></i></label>
			<div class="module-tab-items">
				<div class="module-tab-title">选择类型<span class="close-drop"><i class="icon-close-o"></i></span></div>
				<div>
				    <span class="module-tab-item tab-item selected" data-dropdown-value="全部">全部</span>
					<?php $__TAG__ = '{"order":"asc","by":"sort","ids":"'.$mxonest['mxcms']['s2']['newids'].'","flag":"vod","id":"vo","key":"key"}';$__LIST__ = model("Type")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>	
					<span class="module-tab-item tab-item" data-dropdown-value="<?php echo $vo['type_name']; ?>"><?php echo $vo['type_name']; ?></span>
					<?php endforeach; endif; else: echo "" ;endif; ?>	
				</div>
			</div>
		</div>
		<div class="shortcuts-mobile-overlay"></div>
	</div>
	<div>
		<div class="module-list module-line-list tab-list selected">
			<div class="module-items scroll-box">
				<div class="scroll-content">
				<?php $__TAG__ = '{"num":"16","type":"all","order":"desc","by":"time","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;if($mxonest['mxcms']['s2']['qzslt'] == 0): ?>	  
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
			<div class="module-footer">
				<a href="<?php echo mac_url_type($obj,['id'=>1],'show'); ?>" class="load-all" title="更多">查看更多<i class="icon-arrow-right-o"></i></a>
			</div>
		</div>
		<?php $__TAG__ = '{"order":"asc","by":"sort","ids":"'.$mxonest['mxcms']['s2']['newids'].'","id":"vo1","key":"key1","flag":"vod"}';$__LIST__ = model("Type")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key1 = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($key1 % 2 );++$key1;?>	
		<div class="module-list module-line-list tab-list">
			<div class="module-items scroll-box">
				<div class="scroll-content">
				<?php $__TAG__ = '{"num":"16","type":"'.$vo1['type_id'].'","order":"desc","by":"time","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;if($mxonest['mxcms']['s2']['qzslt'] == 0): ?>	  
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
			<div class="module-footer">
				<a href="<?php echo mac_url_type($vo1,[],'type'); ?>" class="load-all" title="查看更多<?php echo $vo1['type_name']; ?>">更多<?php echo $vo1['type_name']; ?><i class="icon-arrow-right-o"></i></a>
			</div>
		</div>
		 <?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
</div>
 <!-- 最新影片 -->   <?php endif; ?>
	     
	</div>
</main>
         <div id="friendlink" class="wrapper hidden-xs">
	<div class="content">
		<h2>友情链接：</h2>
		<?php $__TAG__ = '{"num":"99","type":"font","id":"vo","key":"key"}';$__LIST__ = model("Link")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
		<a href="<?php echo $vo['link_url']; ?>" target="_blank" title="<?php echo $vo['link_name']; ?>"><?php echo $vo['link_name']; ?></a>
        <?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
</div> <!-- 友情链接 -->
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
         
</body>
</html>
