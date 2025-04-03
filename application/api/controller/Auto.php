<?php

namespace app\api\controller;

use think\Controller;
use think\Cookie;
use think\Db;
use app\common\util\PclZip;
use app\common\util\Dir;

include './addons/auto/func.php';
class Auto extends Base
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function test(){
        $param = input();
        require('./addons/auto/config/config.php');
        $tok = $rq['Auto']['token'];
        $token = $param['token'];
        $execute = false; 
        if (($token == $tok) || $execute) {
            echo "ok-可以正常访问";  
        }else{
            echo "err-无法访问";  
        }
    } 
     public function dayvod(){
         $prefix=config('database.prefix');
        $param = input();
        $apiurl = $param['api'];
        $res=mac_curl_get("$apiurl");
        $arr=auto_json_decode($res);
        $tablename="$prefix"."vod";
        $sqladd = db_big_array_to_insert_sqladd($arr);
        $sqls="REPLACE INTO $tablename $sqladd";
        Db::execute($sqls); 
       echo "数据已更新";
    } 
     public function replace(){
       
       $pre = config('database.prefix');
       
        $param = input();
        require('./addons/auto/config/config.php');
        $tok = $rq['Auto']['token'];
        $token = $param['token'];
        $type = $param['types'];
        $old=$param['old'];
        $new=$param['new']; 
         if (($token == $tok) || $execute) {
             echo 'ok';
             if ($type=='img') {
                 $sql = 'UPDATE ' . $pre . 'vod SET vod_pic=REPLACE(vod_pic, "' . $old . '", "' . $new . '")'; 
                 $upres = Db::execute($sql);
                 echo "--替换图片--$upres条";
             }
             if ($type=='play') {
                 $sql = 'UPDATE ' . $pre . 'vod SET vod_play_url=REPLACE(vod_play_url, "' . $old . '", "' . $new . '")';
                 $upres = Db::execute($sql);
                 
                 echo "--替换播放域名--$upres条";
             }
         }else{
             
         }
   } 
    
    
    public function update()
    { 
        $param = input();
        $token = $param['token'];
        require('./addons/auto/config/config.php');
        $tok = $rq['Auto']['token'];
        $update = $rq['Auto']['status']['update'];
        if ($token==$tok) {
            echo "ok"; 
        $list = config('timming');
        $list=arrlist_cond_orderby($list, $cond = array('status'=>1,'file'=>"collect"), $orderby = array(), $page = 1, $pagesize = 100);
        foreach ($list as $key => $value) {
            if (!empty($value['__token__'])) {
                $hosturl=$GLOBALS['_SERVER']['HTTP_HOST'];
                //想要使用ip域名访问的请打开注释把8111端口换成自己网站的
                //$hosturl=$GLOBALS['_SERVER']['HTTP_HOST'].":8111";
                $apiuri="/api.php/timming/index.html?enforce=1&name=".rawurlencode($value['name']);
                $curi=$hosturl.$apiuri; 
                $res=mac_curl_get($curi);
                echo $res;
            }
        }} else {
            echo "err";
        }
    }
    public function cron()
    {
        $pre = config('database.prefix');
        $tableName = $pre . "autolog";
        $param = input();
        require('./addons/auto/config/config.php');
        $tok = $rq['Auto']['token'];
        $img = $rq['Auto']['status']['img'];
        $vod = $rq['Auto']['status']['vod'];
        $play = $rq['Auto']['status']['play'];
        $api = $rq['Auto']['status']['api'];
        $uri = $rq['Auto']['status']['uri'];
        $token = $param['token'];
        $execute = false;
        $rq = config("autoconf")['url'];
        if (($token == $tok) || $execute) {
            echo "ok";
            if ($img == 1) {
                $res = mac_curl_get($rq . '/?update-img.html'); 
                $arrlist = auto_json_decode($res);
                //提高执行效率 先查询数据库 判断是否存在该资源   
                $sql1 = 'SELECT DISTINCT vod_play_from FROM ' . $pre . 'vod';
                $res = db()->query($sql1);
                $arr = arrlist_values($res, 'vod_play_from');
                $arr = array_filter_empty($arr);
                foreach ($arr as $key => $value) {
                    $vod_play_from_list = explode('$$$', $value);
                    $rplist = arrlist_cond_orderby($arrlist, array('typename' => $vod_play_from_list['0']), array('upday' => -1), 1, 100);
                    if (!empty($rplist)) {
                        foreach ($rplist as $k => $v) {
                            $new = $v['new'];
                            $old = $v['old'];
                            $type = $v['typename'];
                            $sitename = $v['sitename'];
                            if (!empty($new)) {
                                $where['old'] = $old;
                                $where['new'] = $new;
                                $where['name'] = $sitename;
                                $infos = Db::table($tableName)->where($where)->find();
                                if (!$infos) {
                                    $sql = 'UPDATE ' . $pre . 'vod SET vod_pic=REPLACE(vod_pic, "' . $old . '", "' . $new . '")';
                                    $upres = Db::execute($sql);
                                    if ($upres == 0) {
                                        $res = Db::table($tableName)->insert(['name' => $sitename, 'old' => $old, 'new' => $new, 'type' => "图片", 'runtime' => date('Y-m-d H:i:s'), 'updatesql' => "请勿删除-本次替换数量" . $upres . "执行语句为:" . $sql]);
                                    } else {
                                        $res = Db::table($tableName)->insert(['name' => $sitename, 'old' => $old, 'new' => $new, 'type' => "图片", 'runtime' => date('Y-m-d H:i:s'), 'updatesql' => "请勿删除-本次替换数量" . $upres . "执行语句为:" . $sql]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if ($uri == 1) {
                $res = mac_curl_get($rq . '/?vod.html'); 
                $arrlist = auto_json_decode($res);
                //提高执行效率 先查询数据库 判断是否存在该资源   
                $sql1 = 'SELECT DISTINCT vod_play_from FROM ' . $pre . 'vod';
                $res = db()->query($sql1);
                $arr = arrlist_values($res, 'vod_play_from');
                $arr = array_filter_empty($arr);
                foreach ($arr as $key => $value) {
                    $vod_play_from_list = explode('$$$', $value);
                    $rplist = arrlist_cond_orderby($arrlist, array('typename' => $vod_play_from_list['0']), array('upday' => -1), 1, 100);
                    if (!empty($rplist)) {
                        foreach ($rplist as $k => $v) {
                            $new = $v['new'];
                            $old = $v['old'];
                            $type = $v['typename'];
                            $sitename = $v['sitename'];
                            $vodname = $v['vod_name'];
                            if (!empty($new)) {
                                $where['old'] = $old;
                                $where['new'] = $new;
                                $where['name'] = $sitename . $vodname;
                                $infos = Db::table($tableName)->where($where)->find();
                                if (!$infos) {
                                    $sql = 'UPDATE ' . $pre . 'vod SET vod_play_url=REPLACE(vod_play_url, "' . $old . '", "' . $new . '") where vod_name="' . $vodname . '"';
                                    $upres = Db::execute($sql);
                                    if ($upres == 0) {
                                        $res = Db::table($tableName)->insert(['name' => $sitename . $vodname, 'old' => $old, 'new' => $new, 'type' => "播放", 'runtime' => date('Y-m-d H:i:s'), 'updatesql' => "请勿删除-本次替换数量" . $upres . "执行语句为:" . $sql]);
                                    } else {
                                        $res = Db::table($tableName)->insert(['name' => $sitename . $vodname, 'old' => $old, 'new' => $new, 'type' => "播放", 'runtime' => date('Y-m-d H:i:s'), 'updatesql' => "请勿删除-本次替换数量" . $upres . "执行语句为:" . $sql]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
            //播放地址替换
            if ($vod == 1) {
                $res = mac_curl_get($rq . '/?update-play.html');
                $arrlist = auto_json_decode($res);
                //提高执行效率 先查询数据库 判断是否存在该资源   
                $sql1 = 'SELECT DISTINCT vod_play_from FROM ' . $pre . 'vod';
                $res = db()->query($sql1);
                $arr = arrlist_values($res, 'vod_play_from');
                $arr = array_filter_empty($arr);
                foreach ($arr as $key => $value) {
                    $vod_play_from_list = explode('$$$', $value);
                    $rplist = arrlist_cond_orderby($arrlist, array('typename' => $vod_play_from_list['0']), array('upday' => -1), 1, 100);
                    if (!empty($rplist)) {
                        foreach ($rplist as $k => $v) {
                            $new = $v['new'];
                            $old = $v['old'];
                            $type = $v['typename'];
                            $sitename = $v['sitename'];
                            if (!empty($new)) {
                                $where['old'] = $old;
                                $where['new'] = $new;
                                $where['name'] = $sitename;
                                $infos = Db::table($tableName)->where($where)->find();
                                if (!$infos) {
                                    $sql = 'UPDATE ' . $pre . 'vod SET vod_play_url=REPLACE(vod_play_url, "' . $old . '", "' . $new . '")';
                                    $upres = Db::execute($sql);
                                    if ($upres == 0) {
                                        $res = Db::table($tableName)->insert(['name' => $sitename, 'old' => $old, 'new' => $new, 'type' => "播放", 'runtime' => date('Y-m-d H:i:s'), 'updatesql' => "请勿删除-本次替换数量" . $upres . "执行语句为:" . $sql]);
                                    } else {
                                        $res = Db::table($tableName)->insert(['name' => $sitename, 'old' => $old, 'new' => $new, 'type' => "播放", 'runtime' => date('Y-m-d H:i:s'), 'updatesql' => "请勿删除-本次替换数量" . $upres . "执行语句为:" . $sql]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
            //解析替换
            if ($play == 1) {
                $res = mac_curl_get($rq . '/?update-api.html');
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
            }
            //api替换
            if ($api == 1) {
                $res = mac_curl_get($rq . '/?update-api.html'); 
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
                                'name' => $name,
                                'des' => '当日采集：' . $name . '【' . $nname . '】',
                                'file' => 'collect',
                                'param' => 'ac=cj&h=24&cjflag=' . $cjflag . '&cjurl=' . $cjurl,
                                'weeks' => '1,2,3,4,5,6,0',
                                'hours' => '00,01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23',
                                'runtime' => time(),
                            );
                            $res = mac_arr2file(APP_PATH . 'extra/timming.php', $list);
                            $res = Db::table($tableName)->insert(['name' => $name, 'old' => $hostapi, 'new' => $cjurl, 'type' => "API", 'runtime' => date('Y-m-d H:i:s'), 'updatesql' => "Nosql--记录替换"]);
                        }
                    }
                }
            }
        } else {
            echo "err";
        }
    }
    public function infos()
    {
        $param = input();
        $requesturl = config("autoconf")['url'];
        $msgname = input('msgname') == '' ? 0 : input('msgname');
        $msg = input('msg') == '' ? 0 : input('msg');
        $vod = input('vod') == '' ? 0 : input('vod');
        $img = input('img') == '' ? 0 : input('img');
        $api = input('api') == '' ? 0 : input('api');
        $uri = input('uri') == '' ? 0 : input('uri');
        $update = input('update') == '' ? 0 : input('update');
        $apiinfo = input('apiinfo') == '' ? 0 : input('apiinfo');
        $play = input('play') == '' ? 0 : input('play');
        $auto = input('auto') == '' ? 0 : input('auto');
        $url = input('url');
        $token = input('token');
        require('./addons/auto/config/config.php');
        $tok = $rq['Auto']['token'];
        $token = $param['token'];
        $execute = false;
        $pre = config('database.prefix');
        $sql1 = 'SELECT DISTINCT vod_play_from FROM ' . $pre . 'vod';
        $ress = db()->query($sql1);
        $arr = arrlist_values($ress, 'vod_play_from');
        $arr = array_filter_empty($arr);
        $arrlist = [];
        foreach ($arr as $key => $value) {
            $vod_play_from_list = explode('$$$', $value);
            $num=count($vod_play_from_list);
            if ($num == 1) {
                $arrlist[] = $vod_play_from_list[0];
            } else {
                foreach ($vod_play_from_list as $k => $v) {
                    $arrlist[] = $v;
                }
            }
        }
        $arrlist = array_unique($arrlist);
        $from = auto_json_encode($arrlist);
        if (($token == $tok) || $execute) {
            //部分站长无法post提交数据 改用get
            $get='&sitename='.$_SERVER['HTTP_HOST'].'&serverip='.$_SERVER['SERVER_ADDR'].'&msgname='.$msgname.'&seoname='.$GLOBALS['config']['site']['site_name'].'&msg='.$msg.'&vod='.$vod.'&img='.$img.'&api='.$api.'&update='.$update.'&play='.$play.'&uri='.$uri.'&from='.$from.'&auto='.$auto.'&token='.$token.'&apiinfo='.$apiinfo;
            echo $get;
            $apires=mac_curl_get($requesturl . '/?msg.html'.$get);
        }
    }
}
