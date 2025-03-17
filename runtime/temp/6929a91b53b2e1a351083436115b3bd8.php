<?php if (!defined('THINK_PATH')) exit(); /*a:14:{s:33:"template/mxone/html/vod/show.html";i:1651602154;s:79:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/seo/vod_show.html";i:1664247958;s:81:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/public/include.html";i:1664250000;s:78:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/public/head.html";i:1741942424;s:77:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/vod/screen.html";i:1639064462;s:74:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/ads/ad4.html";i:1625726626;s:75:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/ads/adqj.html";i:1625104690;s:80:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/public/vodbox.html";i:1664246986;s:80:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/public/paging.html";i:1639063948;s:77:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/vod/typeho.html";i:1640264036;s:78:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/public/foot.html";i:1664185344;s:82:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/public/tcnotice.html";i:1639063956;s:81:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/public/website.html";i:1639063970;s:75:"/Users/boycott/Desktop/my-project/byt.cms/template/mxone/html/ads/addb.html";i:1625104690;}*/ ?>
<!DOCTYPE html >
<html lang="zh-cn">
<head>
 <title><?php echo $obj['type_name']; ?>频道-好看的<?php echo $obj['type_name']; ?>推荐 - 第<?php echo $param['page']; ?>页 - <?php echo $maccms['site_name']; ?> - <?php echo $maccms['site_url']; ?></title>
<meta name="keywords" content="<?php echo $obj['type_key']; ?><?php echo $maccms['site_keywords']; ?>,电影,电视剧,综艺,新闻,财经,音乐,MV,高清,视频,在线观看,全网搜,搜全网" />
<meta name="description" content="<?php echo $obj['type_des']; ?><?php echo $maccms['site_description']; ?>" />     
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
 <body class="library page">
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
									<?php $_67d7c574e5b3a=explode(',',$maccms['search_hot']); if(is_array($_67d7c574e5b3a) || $_67d7c574e5b3a instanceof \think\Collection || $_67d7c574e5b3a instanceof \think\Paginator): if( count($_67d7c574e5b3a)==0 ) : echo "" ;else: foreach($_67d7c574e5b3a as $key2=>$vo2): ?>
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
									<?php $_67d7c574e5a4c=explode(',',$maccms['search_hot']); if(is_array($_67d7c574e5a4c) || $_67d7c574e5a4c instanceof \think\Collection || $_67d7c574e5a4c instanceof \think\Paginator): if( count($_67d7c574e5a4c)==0 ) : echo "" ;else: foreach($_67d7c574e5a4c as $key2=>$vo2): ?>
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

		<div class="page-heading">
			<h1 class="page-title">影片库</h1>
					<div class="box">
		    	<?php if($mxonest['mxcms']['s3']['ad4'] == 1): ?><?php echo $mxonest['mxcms']['s3']['aad4']; ?>	 <!-- 筛选页广告位 -->	<?php endif; ?>		    
				<div class="library-box library-box-first scroll-box ovauto">
					<div class="scroll-content">
						<div class="library-list">
						   <?php $__TAG__ = '{"order":"asc","by":"sort","ids":"parent","flag":"vod","id":"vo","key":"key"}';$__LIST__ = model("Type")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>		 
							<a href="<?php echo mac_url_type($vo,[],'show'); ?>" class="library-item  <?php if(($vo['type_id'] == $GLOBALS['type_id'] || $vo['type_id'] == $GLOBALS['type_pid'])): ?>selected<?php endif; ?>" title=" <?php echo $vo['type_name']; ?>片库"> <?php echo $vo['type_name']; ?>片库</a>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
				</div>
				<?php if($obj['childids']||$obj['parent']['childids']): ?>
				<div class="library-box scroll-box">
					<div class="scroll-content">
					    <?php if($obj['type_pid'] == 0): if($maccms['aid'] == 11): ?>
						<a class="library-item library-item-first  <?php if($obj['type_pid'] == ''): ?>selected<?php endif; ?>" href="<?php echo mac_url_type($obj,[],'show'); ?>">全部类型</a>
							<?php else: ?>
						<a class="library-item library-item-first  <?php if($obj['type_pid'] == ''): ?>selected<?php endif; ?>" href="<?php echo mac_url_type($obj['type_id'],['id'=>$obj['type_id']],'show'); ?>">全部类型</a>
							<?php endif; ?>
						<div class="library-list">
						    <?php $__TAG__ = '{"ids":"current","order":"asc","by":"sort","id":"vo2","key":"key2"}';$__LIST__ = model("Type")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key2 = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($key2 % 2 );++$key2;?>
							<a class="library-item <?php if($obj['type_pid'] == $vo2['type_id']): ?>selected<?php endif; ?>" href="<?php echo mac_url_type($vo2,[],'show'); ?>"><?php echo $vo2['type_name']; ?></a>
								<?php endforeach; endif; else: echo "" ;endif; ?>	
						</div>
						<?php else: if($maccms['aid'] == 11): ?>
				    	<a class="library-item library-item-first <?php if($obj['type_pid'] == ''): ?>selected<?php endif; ?>" href="<?php echo mac_url_type($obj,[],'show'); ?>">全部类型</a>
							<?php else: ?>
				    		<a class="library-item library-item-first <?php if($obj['type_pid'] == ''): ?>selected<?php endif; ?>" href="<?php echo mac_url_type($obj['type_pid'],['id'=>$obj['type_pid']],'show'); ?>">全部类型</a>
				    		<?php endif; ?>
				    		<div class="library-list">
						    <?php $__TAG__ = '{"parent":"'.$obj['type_pid'].'","order":"asc","by":"sort","id":"vo2","key":"key2"}';$__LIST__ = model("Type")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key2 = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($key2 % 2 );++$key2;?>
							<a class="library-item <?php if($obj['type_id'] == $vo2['type_id']): ?>selected<?php endif; ?>" href="<?php echo mac_url_type($vo2,[],'show'); ?>"><?php echo $vo2['type_name']; ?></a>
								<?php endforeach; endif; else: echo "" ;endif; ?>	
						
						</div>
				    	<?php endif; ?>
					</div>
				</div>
			<?php endif; if($obj['type_extend']['class']||$obj['parent']['type_extend']['class']): ?>
				<div class="library-box scroll-box">
					<div class="scroll-content">
						<a class="library-item library-item-first <?php if($param['class'] == ''): ?> selected<?php endif; ?>" href="<?php echo mac_url_type($obj,['area'=>$param['area'],'lang'=>$param['lang'],'year'=>$param['year'],'level'=>$param['level'],'letter'=>$param['letter'],'state'=>$param['state'],'tag'=>$param['tag'],'class'=>'','order'=>$param['order'],'by'=>$param['by'] ],'show'); ?>">全部剧情</a>
						<div class="library-list">
						     <?php if(empty($obj['type_extend']['class']) || (($obj['type_extend']['class'] instanceof \think\Collection || $obj['type_extend']['class'] instanceof \think\Paginator ) && $obj['type_extend']['class']->isEmpty())): $_67d7c574e58b6=explode(',',$obj['parent']['type_extend']['class']); if(is_array($_67d7c574e58b6) || $_67d7c574e58b6 instanceof \think\Collection || $_67d7c574e58b6 instanceof \think\Paginator): if( count($_67d7c574e58b6)==0 ) : echo "" ;else: foreach($_67d7c574e58b6 as $key2=>$vo2): ?>
							<a class="library-item <?php if($param['class'] == $vo2): ?>selected<?php endif; ?>" href="<?php echo mac_url_type($obj,['area'=>$param['area'],'lang'=>$param['lang'],'year'=>$param['year'],'level'=>$param['level'],'letter'=>$param['letter'],'state'=>$param['state'],'tag'=>$param['tag'],'class'=>$vo2,'order'=>$param['order'],'by'=>$param['by'] ],'show'); ?>" title="<?php echo $vo2; ?>"><?php echo $vo2; ?></a>
							<?php endforeach; endif; else: echo "" ;endif; else: $_67d7c574e58ad=explode(',',$obj['type_extend']['class']); if(is_array($_67d7c574e58ad) || $_67d7c574e58ad instanceof \think\Collection || $_67d7c574e58ad instanceof \think\Paginator): if( count($_67d7c574e58ad)==0 ) : echo "" ;else: foreach($_67d7c574e58ad as $key2=>$vo2): ?>
				            <a class="library-item <?php if($param['class'] == $vo2): ?>selected<?php endif; ?>" href="<?php echo mac_url_type($obj,['area'=>$param['area'],'lang'=>$param['lang'],'year'=>$param['year'],'level'=>$param['level'],'letter'=>$param['letter'],'state'=>$param['state'],'tag'=>$param['tag'],'class'=>$vo2,'order'=>$param['order'],'by'=>$param['by'] ],'show'); ?>" title="<?php echo $vo2; ?>"><?php echo $vo2; ?></a>
				            
				            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
						</div>
					</div>
				</div>
					<?php endif; if($obj['type_extend']['area']||$obj['parent']['type_extend']['area']): ?>
				<div class="library-box scroll-box">
					<div class="scroll-content">
						<a class="library-item library-item-first  <?php if($param['area'] == ''): ?>selected<?php endif; ?>" href="<?php echo mac_url_type($obj,['area'=>'','lang'=>$param['lang'],'year'=>$param['year'],'level'=>$param['level'],'letter'=>$param['letter'],'state'=>$param['state'],'tag'=>$param['tag'],'class'=>$param['class'],'order'=>$param['order'],'by'=>$param['by'] ],'show'); ?>">全部地区</a>
						<div class="library-list">
						    <?php if(empty($obj['type_extend']['area']) || (($obj['type_extend']['area'] instanceof \think\Collection || $obj['type_extend']['area'] instanceof \think\Paginator ) && $obj['type_extend']['area']->isEmpty())): $_67d7c574e5888=explode(',',$obj['parent']['type_extend']['area']); if(is_array($_67d7c574e5888) || $_67d7c574e5888 instanceof \think\Collection || $_67d7c574e5888 instanceof \think\Paginator): if( count($_67d7c574e5888)==0 ) : echo "" ;else: foreach($_67d7c574e5888 as $key2=>$vo2): ?>
							<a class="library-item <?php if($param['area'] == $vo2): ?>selected<?php endif; ?> " href="<?php echo mac_url_type($obj,['area'=>$vo2,'lang'=>$param['lang'],'year'=>$param['year'],'level'=>$param['level'],'letter'=>$param['letter'],'state'=>$param['state'],'tag'=>$param['tag'],'class'=>$param['class'],'order'=>$param['order'],'by'=>$param['by'] ],'show'); ?>" title="<?php echo $vo2; ?>"><?php echo $vo2; ?></a>
						<?php endforeach; endif; else: echo "" ;endif; else: $_67d7c574e587f=explode(',',$obj['type_extend']['area']); if(is_array($_67d7c574e587f) || $_67d7c574e587f instanceof \think\Collection || $_67d7c574e587f instanceof \think\Paginator): if( count($_67d7c574e587f)==0 ) : echo "" ;else: foreach($_67d7c574e587f as $key2=>$vo2): ?>
				        <a class="library-item <?php if($param['area'] == $vo2): ?>selected<?php endif; ?> " href="<?php echo mac_url_type($obj,['area'=>$vo2,'lang'=>$param['lang'],'year'=>$param['year'],'level'=>$param['level'],'letter'=>$param['letter'],'state'=>$param['state'],'tag'=>$param['tag'],'class'=>$param['class'],'order'=>$param['order'],'by'=>$param['by'] ],'show'); ?>" title="<?php echo $vo2; ?>"><?php echo $vo2; ?></a>
				        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
						</div>
					</div>
				</div>
				<?php endif; if($obj['type_extend']['lang']||$obj['parent']['type_extend']['lang']): ?>
				<div class="library-box scroll-box">
					<div class="scroll-content">
						<a class="library-item library-item-first                                   <?php if($param['lang'] == ''): ?> selected<?php endif; ?>" href="<?php echo mac_url_type($obj,['area'=>$param['area'],'lang'=>'','year'=>$param['year'],'level'=>$param['level'],'letter'=>$param['letter'],'state'=>$param['state'],'tag'=>$param['tag'],'class'=>$param['class'],'order'=>$param['order'],'by'=>$param['by'] ],'show'); ?>">全部语言</a>
						<div class="library-list">
					 <?php if(empty($obj['type_extend']['lang']) || (($obj['type_extend']['lang'] instanceof \think\Collection || $obj['type_extend']['lang'] instanceof \think\Paginator ) && $obj['type_extend']['lang']->isEmpty())): $_67d7c574e585a=explode(',',$obj['parent']['type_extend']['lang']); if(is_array($_67d7c574e585a) || $_67d7c574e585a instanceof \think\Collection || $_67d7c574e585a instanceof \think\Paginator): if( count($_67d7c574e585a)==0 ) : echo "" ;else: foreach($_67d7c574e585a as $key2=>$vo2): ?>
							<a class="library-item  <?php if($param['lang'] == $vo2): ?>selected<?php endif; ?>" href="<?php echo mac_url_type($obj,['area'=>$param['area'],'lang'=>$vo2,'year'=>$param['year'],'level'=>$param['level'],'letter'=>$param['letter'],'state'=>$param['state'],'tag'=>$param['tag'],'class'=>$param['class'],'order'=>$param['order'],'by'=>$param['by'] ],'show'); ?>" title="<?php echo $vo2; ?>"><?php echo $vo2; ?></a>
							  <?php endforeach; endif; else: echo "" ;endif; else: $_67d7c574e5852=explode(',',$obj['type_extend']['lang']); if(is_array($_67d7c574e5852) || $_67d7c574e5852 instanceof \think\Collection || $_67d7c574e5852 instanceof \think\Paginator): if( count($_67d7c574e5852)==0 ) : echo "" ;else: foreach($_67d7c574e5852 as $key2=>$vo2): ?>
				        <a class="library-item <?php if($param['lang'] == $vo2): ?> selected<?php endif; ?>" href="<?php echo mac_url_type($obj,['area'=>$param['area'],'lang'=>$vo2,'year'=>$param['year'],'level'=>$param['level'],'letter'=>$param['letter'],'state'=>$param['state'],'tag'=>$param['tag'],'class'=>$param['class'],'order'=>$param['order'],'by'=>$param['by'] ],'show'); ?>" title="<?php echo $vo2; ?>"><?php echo $vo2; ?></a>
				              <?php endforeach; endif; else: echo "" ;endif; endif; ?>
						</div>
					</div>
				</div>
				<?php endif; if($obj['type_extend']['year']||$obj['parent']['type_extend']['year']): ?>
				<div class="library-box scroll-box">
					<div class="scroll-content">
						<a class="library-item library-item-first  <?php if($param['year'] == ''): ?>selected<?php endif; ?>" href="<?php echo mac_url_type($obj,['area'=>$param['area'],'lang'=>$param['lang'],'year'=>'','level'=>$param['level'],'letter'=>$param['letter'],'state'=>$param['state'],'tag'=>$param['tag'],'class'=>$param['class'],'order'=>$param['order'],'by'=>$param['by'] ],'show'); ?>">全部时间</a>
						<div class="library-list">
						    <?php if(empty($obj['type_extend']['year']) || (($obj['type_extend']['year'] instanceof \think\Collection || $obj['type_extend']['year'] instanceof \think\Paginator ) && $obj['type_extend']['year']->isEmpty())): $_67d7c574e582b=explode(',',$obj['parent']['type_extend']['year']); if(is_array($_67d7c574e582b) || $_67d7c574e582b instanceof \think\Collection || $_67d7c574e582b instanceof \think\Paginator): if( count($_67d7c574e582b)==0 ) : echo "" ;else: foreach($_67d7c574e582b as $key2=>$vo2): ?>
							<a class="library-item <?php if($param['year'] == $vo2): ?>selected<?php endif; ?>" href="<?php echo mac_url_type($obj,['area'=>$param['area'],'lang'=>$param['lang'],'year'=>$vo2,'level'=>$param['level'],'letter'=>$param['letter'],'state'=>$param['state'],'tag'=>$param['tag'],'class'=>$param['class'],'order'=>$param['order'],'by'=>$param['by'] ],'show'); ?>" title="<?php echo $vo2; ?>"><?php echo $vo2; ?></a>
							<?php endforeach; endif; else: echo "" ;endif; else: $_67d7c574e5822=explode(',',$obj['type_extend']['year']); if(is_array($_67d7c574e5822) || $_67d7c574e5822 instanceof \think\Collection || $_67d7c574e5822 instanceof \think\Paginator): if( count($_67d7c574e5822)==0 ) : echo "" ;else: foreach($_67d7c574e5822 as $key2=>$vo2): ?>
				        <a class="library-item <?php if($param['year'] == $vo2): ?>selected<?php endif; ?>" href="<?php echo mac_url_type($obj,['area'=>$param['area'],'lang'=>$param['lang'],'year'=>$vo2,'level'=>$param['level'],'letter'=>$param['letter'],'state'=>$param['state'],'tag'=>$param['tag'],'class'=>$param['class'],'order'=>$param['order'],'by'=>$param['by'] ],'show'); ?>" title="<?php echo $vo2; ?>"><?php echo $vo2; ?></a>
				           <?php endforeach; endif; else: echo "" ;endif; endif; ?>
						</div>
					</div>
				</div>
					<?php endif; ?>
					<div class="library-box scroll-box">
					<div class="scroll-content">
						<a class="library-item library-item-first  <?php if($param['letter'] == ''): ?>selected<?php endif; ?>" href="<?php echo mac_url_type($obj,['area'=>$param['area'],'lang'=>$param['lang'],'year'=>$param['year'],'level'=>$param['level'],'letter'=>'','state'=>$param['state'],'tag'=>$param['tag'],'class'=>$param['class'],'order'=>$param['order'],'by'=>$param['by'] ],'show'); ?>">字母查找</a>
						<div class="library-list">
						   <?php $_67d7c574e5800=explode(',','A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,0-9'); if(is_array($_67d7c574e5800) || $_67d7c574e5800 instanceof \think\Collection || $_67d7c574e5800 instanceof \think\Paginator): if( count($_67d7c574e5800)==0 ) : echo "" ;else: foreach($_67d7c574e5800 as $key2=>$vo2): ?>
							<a class="library-item <?php if($param['letter'] == $vo2): ?>selected<?php endif; ?>" href="<?php echo mac_url_type($obj,['area'=>$param['area'],'lang'=>$param['lang'],'year'=>$param['year'],'level'=>$param['level'],'letter'=>$vo2,'state'=>$param['state'],'tag'=>$param['tag'],'class'=>$param['class'],'order'=>$param['order'],'by'=>$param['by'] ],'show'); ?>" title="<?php echo $vo2; ?>"><?php echo $vo2; ?></a>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
				</div>
					
					
					
					
				<div class="library-box scroll-box">
					<div class="scroll-content">
						<div class="library-list">
							<a href="<?php echo mac_url_type($obj,['area'=>$param['area'],'lang'=>$param['lang'],'year'=>$param['year'],'level'=>$param['level'],'letter'=>$param['letter'],'state'=>$param['state'],'tag'=>$param['tag'],'class'=>$param['class'],'order'=>$param['order'],'by'=>'time' ],'show'); ?>" class="library-item  <?php if($param['by'] == '' || $param['by'] == 'time'): ?>selected<?php endif; ?>" title="按时间排序">时间排序</a>
							<a href="<?php echo mac_url_type($obj,['area'=>$param['area'],'lang'=>$param['lang'],'year'=>$param['year'],'level'=>$param['level'],'letter'=>$param['letter'],'state'=>$param['state'],'tag'=>$param['tag'],'class'=>$param['class'],'order'=>$param['order'],'by'=>'hits' ],'show'); ?>" class="library-item <?php if($param['by'] == 'hits'): ?>selected<?php endif; ?>" title="按人气排序">人气排序</a>
							<a class="library-item library-item-first <?php if($param['by'] == 'score'): ?>selected<?php endif; ?>" href="<?php echo mac_url_type($obj,['area'=>$param['area'],'lang'=>$param['lang'],'year'=>$param['year'],'level'=>$param['level'],'letter'=>$param['letter'],'state'=>$param['state'],'tag'=>$param['tag'],'class'=>$param['class'],'order'=>$param['order'],'by'=>'score' ],'show'); ?>" title="按评分排序">评分排序</a>
						</div>
					</div>
				</div>
				<div class="library-box">
				<h2 class="library-stat">影片库为你选出<span class="important mac_total"></span>部影片</h2>
				
				
				</div>
			</div>
		   <!-- 筛选 -->
	    </div>
	   <?php if($mxonest['mxcms']['s3']['adqj'] == 1): if($mxonest['mxcms']['s3']['adqj'] == 1): ?>
<?php echo $mxonest['mxcms']['s3']['aadqj']; endif; ?>	 <!-- 全局广告位 -->	<?php endif; ?>
		<div class="module">
			<div class="module-list">
				<div class="module-items">
				<?php $__TAG__ = '{"num":"72","paging":"yes","pageurl":"vod\/show","type":"current","order":"desc","by":"time","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__);$__PAGING__ = mac_page_param($__LIST__['total'],$__LIST__['limit'],$__LIST__['page'],$__LIST__['pageurl'],$__LIST__['half']); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;if($mxonest['mxcms']['s2']['qzslt'] == 0): ?>	  
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
		    <?php if($__PAGING__['page_total'] > 1): ?>
<div class="module-footer">
      <div id="page">
        <a href="<?php echo mac_url_page($__PAGING__['page_url'],1); ?>" class="page-number page-previous" title="首页">首页</a>
        <a href="<?php echo mac_url_page($__PAGING__['page_url'],$__PAGING__['page_prev']); ?>" class="page-number page-previous" title="上一页">上一页</a>
        <?php if(is_array($__PAGING__['page_num']) || $__PAGING__['page_num'] instanceof \think\Collection || $__PAGING__['page_num'] instanceof \think\Paginator): if( count($__PAGING__['page_num'])==0 ) : echo "" ;else: foreach($__PAGING__['page_num'] as $key=>$num): if($__PAGING__['page_current'] == $num): ?>
        <span class="page-number page-current display"><?php echo $num; ?></span>
        <?php else: ?>
          <a href="<?php echo mac_url_page($__PAGING__['page_url'],$num); ?>" class="page-number display" title="第<?php echo $num; ?>页"><?php echo $num; ?></a>
            <?php endif; endforeach; endif; else: echo "" ;endif; ?>
           <a href="<?php echo mac_url_page($__PAGING__['page_url'],$__PAGING__['page_next']); ?>" class="page-number page-next" title="下一页">下一页</a>
        <a href="<?php echo mac_url_page($__PAGING__['page_url'],$__PAGING__['page_total']); ?>" class="page-number page-next" title="尾页">尾页</a>
      </div>
    </div>
<?php endif; ?> <!-- 分页筛选 -->
                <?php if($obj['type_extend']['area']): ?>
         <div class="module module-bg">
      <div class="module-heading">
        <h2 class="module-title">热播<?php echo $obj['type_name']; ?></h2>
      </div>
      <div class="module-list module-lines-list">
        <div class="module-items">
            <?php if($mxonest['mxcms']['s2']['qzslt'] == 1): $__TAG__ = '{"num":"12","type":"current","order":"desc","by":"hits_month","level":"'.$mxonest['mxcms']['s2']['hotlevel'].'","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;if($mxonest['mxcms']['s2']['qzslt'] == 0): ?>	  
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
        <?php endif; endforeach; endif; else: echo "" ;endif; else: $__TAG__ = '{"num":"16","type":"current","order":"desc","by":"hits_month","level":"'.$mxonest['mxcms']['s2']['hotlevel'].'","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;if($mxonest['mxcms']['s2']['qzslt'] == 0): ?>	  
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
    <?php endif; ?>  <!-- 分类页热播 -->
		</div>
	
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
 <script>
  $(".mac_total").text('<?php echo $__PAGING__['record_total']; ?>');
</script>
 </body>