<?php

namespace app\admin\controller;

use think\Controller;
use think\Cookie;
use think\Db;
use app\common\util\PclZip;
use app\common\util\Dir; 
set_time_limit(0);
include './addons/auto/func.php';

class Auto extends Base
{

    public function __construct()
    {
        parent::__construct();
    }
    // 初始化
    public function initialize()
    {
        $filenav = APP_PATH . 'extra/quickmenu.php';
		$lod_nav = '牛牛助手,auto/index';
		$nav = '牛牛助手,auto/index';
		if (file_exists($filenav)) {
			$nav_lod = config('quickmenu');
			if (in_array($nav, $nav_lod)) {
				return true;
			}
			if (in_array($lod_nav, $nav_lod)) {
				foreach ($nav_lod as $v) {
					if ($v != $lod_nav) {
						$nav_lod2[] = $v;
					}
				}
				$nav_lod = $nav_lod2;
			}
			$nav_new[] = $nav;
			$new_nav = array_merge($nav_lod, $nav_new);
			$res = mac_arr2file(APP_PATH . 'extra/quickmenu.php', $new_nav);
		}
		$filenav = APP_PATH . 'data/config/quickmenu.txt';
		if (file_exists($filenav)) {
			$nav_lod = @file_get_contents($filenav);
			if (strpos($nav_lod, $lod_nav) !== false) {
				$nav_lod = str_replace(PHP_EOL . $lod_nav, "", $nav_lod);
			}
			if (strpos($nav_lod, $nav) !== false) {
				return true;
			} else {
				$new_nav = $nav_lod . PHP_EOL . $nav;
				@fwrite(fopen($filenav, 'wb'), $new_nav);
			}
		}
		//清理缓存
		$request = controller('admin/index');
        $request->clear();
    }
    // 首页
    public function index()
    {
        $param = input();
        $this->initialize(); //初始化创建数据库 
        $requesturl = config("autoconf")['url'];
        $ssl = 'http://';
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $ssl = 'https://';
        }
        $pre = config('database.prefix');
        $tableName = $pre . "autolog";
        $macuri=$requesturl . '/?api.html';
        $res=mac_curl_gets($macuri);
        $arrres = auto_json_decode($res);
        $imglist = $arrres['imglist'];
        $apilist = $arrres['apilist'];
        $apijsonlist = $arrres['apijsonlist'];
        $replist = $arrres['replist'];
        $imgadlist = $arrres['imgad'];
        $v10list = $arrres['v10list'];
        $themelist = $arrres['themelist']; 
        require('./addons/auto/config/config.php');
         $tok=$token= $rq['Auto']['token'];
        $vod = $rq['Auto']['vod'];
         $img = $rq['Auto']['img'];
          $auto = $rq['Auto']['auto'];
           $update = $rq['Auto']['update'];
        $get='&sitename='.$_SERVER['HTTP_HOST'].'&serverip='.$_SERVER['SERVER_ADDR'].'&msgname=&seoname='.$GLOBALS['config']['site']['site_name'].'&msg=&vod='.$vod.'&img='.$img.'&api=&update='.$update.'&play=&uri=&from=&auto='.$auto.'&token='.$token.'&apiinfo=';
        $apires=mac_curl_gets($requesturl . '/?msg.html'.$get);
        $version = $arrres['code'];
        $not = $arrres['info'];
        $hostversion = config("autoconf")['version'];
        $this->assign('hostversion', $hostversion);
        $this->assign('version', $version);
        $this->assign("replist", $replist);
        $this->assign('ssl', $ssl);
        $this->assign('rq', $rq);
        $this->assign('not', $not);
        $this->assign('apijsonlist', $apijsonlist);
        $this->assign('apilist', $apilist);
        $this->assign('v10list', $v10list);
        $this->assign('imglist', $imglist);
        $this->assign('imgadlist', $imgadlist);
        $this->assign('themelist', $themelist);
        return $this->fetch('admin@/auto/index');
    }
    public function addplay()
    {
        $param = input();
        $name = $param['name'];
        $apiinfo = $param['apiinfo'];
        $playurl = $param['playurl'];
        $player = array(
            'status' => '1',
            'from' => "$apiinfo",
            'show' => $name,
            'des' => $name,
            'target' => '_self',
            'ps' => '1',
            'parse' => $playurl,
            'sort' => '10000',
            'tip' => '无需安装任何插件',
        );
        $file = './application/extra/vodplayer.php';
        $vodlist = require($file);
        $vodlist[$apiinfo] = $player;
        file_replace_var($file, $vodlist);
        $code = "MacPlayer.Html='<iframe width=\"100%\" height=\"'+MacPlayer.Height+'\" src=\"" . $playurl . "'+MacPlayer.PlayUrl+'\" frameborder=\"0\" allowfullscreen=\"true\" border=\"0\" marginwidth=\"0\" marginheight=\"0\" scrolling=\"no\"></iframe>';MacPlayer.Show();";
        $js = fwrite(fopen("./static/player/" . $apiinfo . ".js", "wb"), $code);
        return $this->success('添加采集源-播放器完成', 'auto/index');
    }
    public function addapi()
    {
        
        $param = input();
        $pre = config('database.prefix');
        $tableName = $pre . "collect";
        $name = $param['name'];
        $apiurl = $param['apiurl'];
        $res = Db::table($tableName)->insert(['collect_name' => $name, 'collect_url' => $apiurl, 'collect_type' => 2, 'collect_mid' => 1]);
        return $this->success('添加采集源完成');
    }
    
    public function update()
    {
        $param = input(); 
        $v = $param['to']; 
        $rq = config("autoconf")['url'] . '/update/';
        echo $this->fetch("admin@public/head");
        echo "<div class='update'><h1>在线升级中,请稍后......</h1><textarea rows=\"10\" class='layui-textarea' readonly>正在下载升级文件包...\n";
        ob_flush();
        flush();
        sleep(1);
        $save_path = ROOT_PATH . "application/data/update/" . $v . ".zip";
        $downurl = $rq . $v . ".zip";
        $zip = mac_curl_gets($downurl);
        @fwrite(@fopen($save_path, "wb"), $zip);
        if (!is_file($save_path)) {
            echo "下载升级包失败，请重试...\n";
            exit;
        }
        if (filesize($save_path) < 1) {
            @unlink($save_path);
            echo "下载升级包失败，请重试...\n";
            exit;
        }
        echo "下载升级包完毕...\n";
        echo "正在处理升级包的文件...\n";
        ob_flush();
        flush();
        sleep(1);
        $zipfile = new PclZip();
        $zipfile->PclZip($save_path);
        if (!$zipfile->extract(PCLZIP_OPT_PATH, '', PCLZIP_OPT_REPLACE_NEWER)) {
            echo $zipfile->error_string . "\n";
            echo "升级失败，请检查系统目录及文件权限！" . "\n";
            exit;
        }
        @unlink($save_path);
        $this->_cache_clear();
        echo "更新数据缓存文件...\n";
        echo "插件升级完毕...";
        echo "请及时更新API设置token密钥，以恢复默认";
        ob_flush();
        flush();
        echo "</textarea></div>";
        echo "<script type=\"text/javascript\">layui.use([\"jquery\",\"layer\"],function(){var layer=layui.layer,\$=layui.jquery;setTimeout(function(){var index=parent.layer.getFrameIndex(window.name);parent.location.reload();parent.layer.close(index)},\"6000\")});</script>";
    }
    public function help()
    {
        $param = input();
        $v = $param['id'];
        if ($v == '') {
            return $this->success('无文件id 即将返回', 'auto/index');
        }
        $ssl = 'http://';
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $ssl = 'https://';
        }
        $requesturl = config("autoconf")['url']; 
        $resd = mac_curl_gets($requesturl . '/?help.html&id='.$v); 
        $datelist = auto_json_decode($resd);
        $res = mac_curl_gets($requesturl . '/?api.html');
        $arrres = auto_json_decode($res);
        $imglist = $arrres['imglist'];
        $apilist = $arrres['apilist'];
        
        $v10list = $arrres['v10list'];
        $themelist = $arrres['themelist']; //plugin
        $pluginlist = $arrres['pluginlist'];
        $not = $arrres['info'];
        require('./addons/auto/config/config.php');
        $this->assign('hostversion', $hostversion);
        $this->assign('version', $version);
        $this->assign('playcode', $playcode);
        $this->assign('imgcode', $imgcode);
        $this->assign('ssl', $ssl);
        $this->assign('rq', $rq);
        $this->assign('not', $not);
        $this->assign('apilist', $apilist);
        $this->assign('v10list', $v10list);
        $this->assign('imglist', $imglist);
        $this->assign('themelist', $themelist);
        $this->assign('pluginlist', $pluginlist);
        $this->assign('datelist', $datelist);
        return $this->fetch('admin@/auto/info');
    }

     
    public function autotype(){
        $param = input();
        $cjflag = input('cjflag');
        $cjurl = input('cjurl');
        $nname = input('cname');
        $name = input('name');
        $cjmd5 = md5($cjflag);
        $apiinfo = $param['apiinfo'];
        $playurl = $param['playurl'];
        $apires=mac_curl_gets($cjurl);
        $apilist = auto_json_decode($apires)['class'];
        $type_list = model('Type')->getCache('type_list'); 
        $arrlist = arrlist_key_values($apilist, 'type_id', 'type_name');
        $typelist = arrlist_key_values($type_list, 'type_name', 'type_id');
        $config = config('bind');
        foreach ($arrlist as $key => $value) {
            if (!empty($typelist[$value])) {
                $col = $apiinfo."_".$key;
                $val = $typelist[$value]; 
                $config[$col] = intval($val);
            }
        }
        $res = mac_arr2file( APP_PATH .'extra/bind.php', $config);
        $list = config('timming');
        $list[$cjflag] = array(
            '__token__' => $cjmd5,
            'id' =>$cjflag,
            'status' => '1',
            'name' => $cjflag,
            'des' => '当日采集：' . $name . '【' . $nname . '】',
            'file' => 'collect',
            'param' => 'ac=cj&h=24&cjflag=' . $cjflag . '&cjurl=' . $cjurl,
            'weeks' => '1,2,3,4,5,6,0',
            'hours' => '00,01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23',
             
        );
        $res = mac_arr2file(APP_PATH . 'extra/timming.php', $list);
        $player = array(
            'status' => '1',
            'from' => "$apiinfo",
            'show' => $name,
            'des' => $name,
            'target' => '_self',
            'ps' => '1',
            'parse' => $playurl,
            'sort' => '10000',
            'tip' => '无需安装任何插件',
        );
        $file = './application/extra/vodplayer.php';
        $vodlist = require($file);
        $vodlist[$apiinfo] = $player;
        file_replace_var($file, $vodlist);
        $code = "MacPlayer.Html='<iframe width=\"100%\" height=\"'+MacPlayer.Height+'\" src=\"" . $playurl . "'+MacPlayer.PlayUrl+'\" frameborder=\"0\" allowfullscreen=\"true\" border=\"0\" marginwidth=\"0\" marginheight=\"0\" scrolling=\"no\"></iframe>';MacPlayer.Show();";
        $js = fwrite(fopen("./static/player/" . $apiinfo . ".js", "wb"), $code);
        $msg = "一键添加解析/自动分类(未创建不绑定)/定时任务成功";
        return $this->success($msg, 'auto/index');
    }
    public function addt()
    {
        $param = input();
        $cjflag = input('cjflag');
        $cjurl = input('cjurl');
        $nname = input('cname');
        $name = input('name');
        $cjmd5 = md5($cjflag);
        $list = config('timming');
        $list[$cjflag] = array(
            '__token__' => $cjmd5,
            'status' => '1',
            'id' =>$cjflag,
            'name' => $cjflag,
            'des' => '当日采集：' . $name . '【' . $nname . '】',
            'file' => 'collect',
            'param' => 'ac=cj&h=24&cjflag=' . $cjflag . '&cjurl=' . $cjurl,
            'weeks' => '1,2,3,4,5,6,0',
            'hours' => '00,01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23',
            'runtime' => time(),
        );
        $res = mac_arr2file(APP_PATH . 'extra/timming.php', $list);
        $msg = "添加定时任务成功 请再宝塔中设置计划任务 访问 你的域名/api.php/timming/index.html?enforce=1&name=$name";
        return $this->success($msg, 'auto/index');
    }
    
    public function url()
    {
        $pre = config('database.prefix');
        $tableName = $pre . "autolog";
        $param = input();
        $rq = config("autoconf")['url'];
        $res = mac_curl_gets($rq . '/?update-api.html');
        $arrlist = auto_json_decode($res);
        $list = config('vodplayer');
        foreach ($arrlist as $key => $value) {
            $apifrom = $value['apiinfo'];
            $name = $value['name'];
            $parse = $value['play'];
            if (!empty($list[$apifrom])) {
                $hostparse = $list[$apifrom]['parse'];
                if ($hostparse != $apifrom) {
                    $list[$apifrom] = array(
                        'status' => '1',
                        'from' => $apifrom,
                        'show' => $name,
                        'des' => $name,
                        'target' => '_self',
                        'ps' => '1',
                        'parse' => $parse,
                        'sort' => '10000',
                        'tip' => '无需安装任何插件',
                    );
                    $code = "MacPlayer.Html='<iframe width=\"100%\" height=\"'+MacPlayer.Height+'\" src=\"" . $parse . "'+MacPlayer.PlayUrl+'\" frameborder=\"0\" allowfullscreen=\"true\" border=\"0\" marginwidth=\"0\" marginheight=\"0\" scrolling=\"no\"></iframe>';MacPlayer.Show();";
                    $js = fwrite(fopen("./static/player/" . $apifrom . ".js", "wb"), $code);
                    $resrep = mac_arr2file(APP_PATH . 'extra/vodplayer.php', $list);
                    $res = Db::table($tableName)->insert(['name' => $name, 'old' => $hostparse, 'new' => $parse, 'type' => "解析", 'runtime' => date('Y-m-d H:i:s'), 'updatesql' => "Nosql--记录替换"]);
                }
            }
        }
        return $this->success('解析地址替换成功!', 'auto/index');
    }
    public function type()
    {
        $prefix=config('database.prefix');
        $param = input();
        $apiurl = $param['api'];
        $res=mac_curl_gets("$apiurl");
        $arr=auto_json_decode($res);
        $tablename="$prefix"."type";
        $sqladd = db_big_array_to_insert_sqladd($arr);
        $sqls="REPLACE INTO $tablename $sqladd";
        Db::execute($sqls); 
        return $this->success('以自动添加分类到数据库!', 'auto/index');
    }
     public function allvod(){
         
        $prefix=config('database.prefix');
        $param = input();
        $apiurl = $param['api'];
        $res=mac_curl_gets("$apiurl");
        $arr=auto_json_decode($res);
        $tablename="$prefix"."vod";
        $sqladd = db_big_array_to_insert_sqladd($arr);
        $sqls="REPLACE INTO $tablename $sqladd";
        Db::execute($sqls); 
       return $this->success('采集全部数据完成', 'auto/index');
    }
     public function dayvod(){
         
        $prefix=config('database.prefix');
        $param = input();
        $apiurl = $param['api'];
        $res=mac_curl_gets("$apiurl");
        $arr=auto_json_decode($res);
        $tablename="$prefix"."vod";
        $sqladd = db_big_array_to_insert_sqladd($arr);
        $sqls="REPLACE INTO $tablename $sqladd";
        Db::execute($sqls); 
       return $this->success('今日数据已更新', 'auto/index');
    }
    
    public function pageallvod(){ 
        $stime=time();
        $prefix=config('database.prefix');
        $param = input();
        
        $pg=$param['p'];
        if (empty(intval($pg))) {
                $pg = 1;
            }
        $apiurl = $param['api'];
        $apiurls = $apiurl."?p=$pg";
        $res=mac_curl_gets("$apiurls");
        
        if ($res=="[]") {
          return $this->success('已采集完成 即将返回插件', 'auto/index');
        }  
        $arr=auto_json_decode($res);
        $tablename="$prefix"."vod";
        $sqladd = db_big_array_to_insert_sqladd($arr);
        
        $sqls="REPLACE INTO $tablename $sqladd"; 
        
        Db::execute($sqls); 
        $etime=time();
        $times=$etime-$stime;
        $np=$pg+1;
        $link='/'.str_replace("/","",$GLOBALS['in_file'])."/admin/Auto/pageallvod?api=$apiurl&p=$np";
        $n="本次采集数据10000条<br>
        采集耗时$times 秒 <br>
        请耐心等待！！！<br>
        当前采集第 $pg 页 ";
        mac_echo($n);
        mac_jump( $link ,3);
    }
    public function api()
    {
        $param = input();
        $rq = config("autoconf")['url'];
        $res = mac_curl_gets($rq . '/?update-api.html');
        $arrlist = auto_json_decode($res);
        $list = config('timming');
        foreach ($arrlist as $key => $value) {
            $nname = $value['newname'];
            $cname = $value['cname'];
            $name = $value['name'];
            $cjflag = $value['apiinfo'];
            $cjurl = $value['api'];
            $cjmd5 = md5($cjflag);
            if (!empty($list[$cjflag])) {
                $hosturl = $list[$cjflag]['param'];
                parse_str($hosturl, $params);
                $hostapi = $params['cjurl'];
                if ($hostapi != $cjurl) {
                    $list[$cjflag] = array(
                        '__token__' => $cjmd5,
                        'status' => '1',
                        'id' =>$cjflag,
                        'name' => $cjflag,
                        'des' => '当日采集：' . $name . '【' . $nname . '】',
                        'file' => 'collect',
                        'param' => 'ac=cj&h=24&cjflag=' . $cjflag . '&cjurl=' . $cjurl,
                        'weeks' => '1,2,3,4,5,6,0',
                        'hours' => '00,01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23',
                        'runtime' => time(),
                    );
                    $res = mac_arr2file(APP_PATH . 'extra/timming.php', $list);
                    
                }
            }
        }
        return $this->success('定时任务-API地址替换成功!', 'auto/index');
    }
}
