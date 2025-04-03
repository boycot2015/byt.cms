<?php
require_once('class.db.php');
include 'func.php';
session_start();
if (isset($_SESSION['lock_config'])) {
	$time = (int)$_SESSION['lock_config'] - (int)time();
	if ($time > 0) {
		exit(json_encode(array('success' => 0, 'icon' => 5, 'msg' => "请勿频繁提交，" . $time . "秒后再试！")));
	}
}
$_SESSION['lock_config'] = time() + $from_timeout;
$ssl = 'http://';
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
	$ssl = 'https://';
}
$rq['Auto']['token'] = $rqtoken = filter_input(INPUT_POST, "rq_Auto_token");
$rq['Auto']['type'] = filter_input(INPUT_POST, "rq_Auto_type");
$rq['Auto']['time'] = $interval = filter_input(INPUT_POST, "rq_Auto_time");
$rq['Auto']['status']['vod'] = $vod = filter_input(INPUT_POST, "rq_Auto_vod");
$rq['Auto']['status']['img'] = $img = filter_input(INPUT_POST, "rq_Auto_img");
$rq['Auto']['status']['play'] = $play = filter_input(INPUT_POST, "rq_Auto_play");
$rq['Auto']['status']['api'] = $api = filter_input(INPUT_POST, "rq_Auto_api");
$rq['Auto']['status']['uri'] = $uri = filter_input(INPUT_POST, "rq_Auto_uri");
$rq['Auto']['status']['auto'] = $auto = filter_input(INPUT_POST, "rq_Auto_auto");
$rq['Auto']['status']['update'] = $update = filter_input(INPUT_POST, "rq_Auto_update");
$rq['Auto']['post']['name'] =  $msgname = filter_input(INPUT_POST, "rq_Auto_name");
$rq['Auto']['post']['info'] = $msg = filter_input(INPUT_POST, "rq_Auto_info");
$rq['Auto']['post']['apiinfo'] = $apiinfo = filter_input(INPUT_POST, "rq_Auto_apiinfo");
if (Main_db::save()) {
	$post = '?rqtoken=' . $rqtoken . '&interval=' . $interval . '&vod=' . $vod . '&img=' . $img . '&play=' . $play . '&msgname=' . $msgname . '&msg=' . $msg . '&token=' . $rqtoken . '&api=' . $api . '&auto=' . $auto .'&update=' . $update.'&apiinfo=' . $apiinfo . '&uri=' . $uri;
	$http_get = $ssl . $_SERVER['HTTP_HOST'] . '/api.php/Auto/infos' . $post;
	$res = https_request($http_get, '', '', 1500, 3);
	exit(json_encode(array('success' => 1, 'icon' => 1, 'msg' => "保存成功")));
} else {
	exit(json_encode(array('success' => 0, 'icon' => 0, 'msg' => "保存失败!请检测配置文件权限")));
}
