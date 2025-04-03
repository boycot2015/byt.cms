<?php
function mac_curl_gets($url,$heads=array(),$cookie='')
{
    $ch = @curl_init();
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36');

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3600);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3600);
    curl_setopt($ch, CURLOPT_HEADER,0);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
    if(!empty($cookie)){
        curl_setopt($ch, CURLOPT_COOKIE, $cookie);
    }
    if(count($heads)>0){
        curl_setopt ($ch, CURLOPT_HTTPHEADER , $heads );
    }
    $response = @curl_exec($ch);
    if(curl_errno($ch)){//出错则显示错误信息
        //print curl_error($ch);die;
    }
    curl_close($ch); //关闭curl链接
    return $response;//显示返回信息
}
function https_request($url, $post = '', $cookie = '', $timeout = 30, $ms = 0)
{
    if (empty($url)) return FALSE;
    if (version_compare(PHP_VERSION, '5.2.3', '<')) {
        $ms = 0;
        $timeout = 30;
    }
    is_array($post) and $post = http_build_query($post);
    // 没有安装curl 使用http的形式，支持post
    if (!extension_loaded('curl')) {
        //throw new Exception('server not install CURL');
        if ($post) {
            return https_post($url, $post, $cookie, $timeout);
        } else {
            return http_get($url, $cookie, $timeout);
        }
    }
    is_array($cookie) and $cookie = http_build_query($cookie);
    $curl = curl_init();
    $ssl = 'http://';
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $ssl = 'https://';
}
    curl_setopt($curl, CURLOPT_REFERER,$ssl.$_SERVER['HTTP_HOST']);
    // 返回执行结果，不输出
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //php5.5跟php5.6中的CURLOPT_SAFE_UPLOAD的默认值不同
    if (class_exists('\CURLFile')) {
        curl_setopt($curl, CURLOPT_SAFE_UPLOAD, true);
    } else {
        defined('CURLOPT_SAFE_UPLOAD') and curl_setopt($curl, CURLOPT_SAFE_UPLOAD, false);
    }
    // 设定请求的RUL
    curl_setopt($curl, CURLOPT_URL, $url);
    // 设定返回信息中包含响应信息头
    if (ini_get('safe_mode') && ini_get('open_basedir')) {
        // $post参数必须为GET
        if ('GET' == $post) {
            // 安全模式时将头文件的信息作为数据流输出
            curl_setopt($curl, CURLOPT_HEADER, true);
            // 安全模式采用连续抓取
            curl_setopt($curl, CURLOPT_NOBODY, true);
        }
    } else {
        curl_setopt($curl, CURLOPT_HEADER, false);
        // 允许跳转10次
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        // 使用自动跳转，返回最后的Location
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    }
    $ua1 = 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1';
    $ua = empty($_SERVER["HTTP_USER_AGENT"]) ? $ua1 : $_SERVER["HTTP_USER_AGENT"];
    curl_setopt($curl, CURLOPT_USERAGENT, $ua);
    // 兼容HTTPS
    if (FALSE !== stripos($url, 'https://')) {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_SSLVERSION, true);
    }

    $header = array('Content-type: application/x-www-form-urlencoded;charset=UTF-8', 'X-Requested-With: XMLHttpRequest');
    $cookie and $header[] = "Cookie: $cookie";
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    if ($post) {
        // POST
        curl_setopt($curl, CURLOPT_POST, true);
        // 自动设置Referer
        curl_setopt($curl, CURLOPT_AUTOREFERER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    }

    if ($ms) {
        curl_setopt($curl, CURLOPT_NOSIGNAL, true); // 设置毫秒超时
        curl_setopt($curl, CURLOPT_TIMEOUT_MS, intval($timeout)); // 超时毫秒
    } else {
        curl_setopt($curl, CURLOPT_TIMEOUT, intval($timeout)); // 秒超时
    }
    //优先解析 IPv6 超时后IPv4
    curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
    // 返回执行结果
    $output = curl_exec($curl);
    // 有效URL，输出URL非URL页面内容 CURLOPT_RETURNTRANSFER 必须为false
    'GET' == $post and $output = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);
    curl_close($curl);
    return $output;
}
 function auto_json_encode($data, $pretty = FALSE, $level = 0)
{
    if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
        return $pretty ? json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
    $tab = $pretty ? str_repeat("\t", $level) : '';
    $tab2 = $pretty ? str_repeat("\t", $level + 1) : '';
    $br = $pretty ? "\r\n" : '';
    switch ($type = gettype($data)) {
        case 'NULL':
            return 'null';
        case 'boolean':
            return ($data ? 'true' : 'false');
        case 'integer':
        case 'double':
        case 'float':
            return $data;
        case 'string':
            $data = '"' . str_replace(array('\\', '"'), array('\\\\', '\\"'), $data) . '"';
            $data = str_replace("\r", '\\r', $data);
            $data = str_replace("\n", '\\n', $data);
            $data = str_replace("\t", '\\t', $data);
            return $data;
        case 'object':
            return get_object_vars($data);
        case 'array':
            $output_index_count = 0;
            $output_indexed = array();
            $output_associative = array();
            foreach ($data as $key => $value) {
                $output_indexed[] = auto_json_encode($value, $pretty, $level + 1);
                $output_associative[] = $tab2 . '"' . $key . '":' . auto_json_encode($value, $pretty, $level + 1);
                if (NULL !== $output_index_count && $output_index_count++ !== $key) {
                    $output_index_count = NULL;
                }
            }
            if (NULL !== $output_index_count) {
                return '[' . implode(",$br", $output_indexed) . ']';
            } else {
                return "{{$br}" . implode(",$br", $output_associative) . "{$br}{$tab}}";
            }
        default:
            return ''; // Not supported
    }
}

function auto_json_decode($json)
{
    $json = trim($json, "\xEF\xBB\xBF");
    $json = trim($json, "\xFE\xFF");
    return json_decode($json, TRUE);
}
function http_get($url, $cookie = '', $timeout = 30, $times = 3)
{
    if (extension_loaded('curl')) return https_post($url, '', $cookie, $timeout, 'GET');

    $arr = array(
        'http' => array(
            'method' => 'GET',
            'timeout' => $timeout
        )
    );
    $stream = stream_context_create($arr);
    while ($times-- > 0) {
        $s = file_get_contents($url, NULL, $stream, 0, 4096000);
        if (FALSE !== $s) return $s;
    }
    return FALSE;
}

function http_post($url, $post = '', $cookie = '', $timeout = 30, $times = 3)
{
    if (extension_loaded('curl')) return https_post($url, $post, $cookie, $timeout);

    is_array($post) and $post = http_build_query($post);
    is_array($cookie) and $cookie = http_build_query($cookie);
    $stream = stream_context_create(array('http' => array('header' => "Content-type: application/x-www-form-urlencoded\r\nx-requested-with: XMLHttpRequest\r\nCookie: $cookie\r\n", 'method' => 'POST', 'content' => $post, 'timeout' => $timeout)));
    while ($times-- > 0) {
        $s = file_get_contents($url, NULL, $stream, 0, 4096000);
        if (FALSE !== $s) return $s;
    }
    return FALSE;
}

function https_get($url, $cookie = '', $timeout = 30, $times = 1)
{
    return https_post($url, '', $cookie, $timeout, 'GET');
}

function https_post($url, $post = '', $cookie = '', $timeout = 30, $method = 'POST')
{
    $allow_url_fopen = strtolower(ini_get('allow_url_fopen'));
    $allow_url_fopen = (empty($allow_url_fopen) || 'off' == $allow_url_fopen) ? 0 : 1;
    $allow_get_contents = $allow_url_fopen && strtolower(ini_get('user_agent'));
    $allow_curl = extension_loaded('curl');

    if (!$allow_curl && !$allow_get_contents) return xn_error(-1, 'CURL and OpenSSL are not installed on the server.');

    is_array($post) and $post = http_build_query($post);
    is_array($cookie) and $cookie = http_build_query($cookie);

    //$w = stream_get_wrappers(); //  && in_array('https', $w)
    if (!$allow_curl) {
        if ('https://' == substr($url, 0, 8) && !extension_loaded('openssl')) return xn_error(-1, 'CURL and OpenSSL are not installed on the server.');

        $stream = stream_context_create(array('http' => array('header' => "Content-type: application/x-www-form-urlencoded\r\nx-requested-with: XMLHttpRequest\r\nCookie: $cookie\r\n", 'method' => $method, 'content' => $post, 'timeout' => $timeout)));
        $s = file_get_contents($url, NULL, $stream, 0, 4096000);
        return $s;
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //php5.5跟php5.6中的CURLOPT_SAFE_UPLOAD的默认值不同
    if (class_exists('\CURLFile')) {
        curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
    } else {
        defined('CURLOPT_SAFE_UPLOAD') and curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
    }
    curl_setopt($ch, CURLOPT_HEADER, 2); // 1/2
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER('HTTP_USER_AGENT'));

    // 兼容HTTPS
    if (false !== stripos($url, 'https://')) {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        //ssl版本控制
        //curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
        curl_setopt($ch, CURLOPT_SSLVERSION, true);
    }

    if ('POST' == $method) {
        curl_setopt($ch, CURLOPT_POST, true);
        // 自动设置Referer
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }

    $header = array('Content-type: application/x-www-form-urlencoded', 'X-Requested-With: XMLHttpRequest');
    $cookie and $header[] = "Cookie: $cookie";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

    // 使用自动跳转, 安全模式不允许
    (!ini_get('safe_mode') && !ini_get('open_basedir')) && curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    //优先解析 IPv6 超时后IPv4
    //curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
    $data = curl_exec($ch);
    if (curl_errno($ch)) {
        return xn_error(-1, 'Errno' . curl_error($ch));
    }
    if (!$data) {
        curl_close($ch);
        return '';
    }

    list($header, $data) = explode("\r\n\r\n", $data, 2);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if (301 == $http_code || 302 == $http_code) {
        $matches = array();
        preg_match('/Location:(.*?)\n/', $header, $matches);
        $url = trim(array_pop($matches));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $data = curl_exec($ch);
    }
    curl_close($ch);
    return $data;
}
function file_replace_var($filepath, $replace = array(), $pretty = FALSE)
{
    $ext = file_ext($filepath);
    if ('php' == $ext) {
        $arr = include $filepath;
        $arr = array_merge($arr, $replace);
        $s = "<?php\r\nreturn " . var_export($arr, true) . ";\r\n?>";
        // 备份文件
        file_backup($filepath);
        $r = file_put_contents_try($filepath, $s);
        $r != strlen($s) ? file_backup_restore($filepath) : file_backup_unlink($filepath);
        return $r;
    } elseif ('js' == $ext || 'json' == $ext) {
        $s = file_get_contents_try($filepath);
        $arr = auto_json_decode($s);
        if (empty($arr)) return FALSE;
        $arr = array_merge($arr, $replace);
        $s = auto_json_encode($arr, $pretty);
        file_backup($filepath);
        $r = file_put_contents_try($filepath, $s);
        $r != strlen($s) ? file_backup_restore($filepath) : file_backup_unlink($filepath);
        return $r;
    }
}
function file_put_contents_try($file, $s, $times = 3)
{
    while ($times-- > 0) {
        $fp = fopen($file, 'wb');
        if ($fp and flock($fp, LOCK_EX)) {
            $n = fwrite($fp, $s);
            version_compare(PHP_VERSION, '5.3.2', '>=') and flock($fp, LOCK_UN);
            fclose($fp);
            clearstatcache();
            return $n;
        } else {
            sleep(1);
        }
    }
    return FALSE;
}
function file_backup_unlink($filepath)
{
    $backfile = file_backname($filepath);
    $r = auto_unlink($backfile);
    return $r;
}
function auto_unlink($file)
{
    $r = is_file($file) ? unlink($file) : FALSE;
    return $r;
}
function file_ext($filename, $max = 16)
{
    $ext = strtolower(substr(strrchr($filename, '.'), 1));
    $ext = auto_urlencode($ext);
    strlen($ext) > $max and $ext = substr($ext, 0, $max);
    if (!preg_match('#^\w+$#', $ext)) $ext = 'attach';
    return $ext;
}
function file_pre($filename, $max = 32)
{
    return substr($filename, 0, strrpos($filename, '.'));
}
function auto_urlencode($s)
{
    $s = urlencode($s);
    $s = str_replace('_', '_5f', $s);
    $s = str_replace('-', '_2d', $s);
    $s = str_replace('.', '_2e', $s);
    $s = str_replace('+', '_2b', $s);
    $s = str_replace('=', '_3d', $s);
    $s = str_replace('%', '_', $s);
    return $s;
}

function db_big_array_to_insert_sqladd($arr)
{
    $keys = array();
    $valstr = '';
    $i = 0;
    foreach ($arr as $key => $v) {
        $values = array();
        $n = count($v);
        foreach ($v as $k => $v1) {
            $i++;
            $k = isset($k) ? $k : '';
            $k = addslashes($k);
            $v1 = isset($v1) ? $v1 : '';
            $v1 = addslashes($v1);
            $i <= $n and $keys[] = '`' . $k . '`';
            $v1 = (is_int($v1) || is_float($v1)) ? $v1 : "'$v1'";
            $values[] = $v1;
        }

        $valstr .= '(' . implode(',', $values) . '),';
    }

    $sqladd = '(' . implode(',', $keys) . ') VALUES ' . rtrim($valstr, ',');

    return $sqladd;
}
function file_backup($filepath)
{
    $backfile = file_backname($filepath);
    if (is_file($backfile)) return TRUE; // 备份已经存在
    $r = auto_copy($filepath, $backfile);
    clearstatcache();
    return $r && filesize($backfile) == filesize($filepath);
}
function auto_copy($src, $dest)
{
    $r = is_file($src) ? copy($src, $dest) : FALSE;
    return $r;
}
function file_backname($filepath)
{
    $filepre = file_pre($filepath);
    $fileext = file_ext($filepath);
    $s = "$filepre.backup.$fileext";
    return $s;
}
function array_value($arr, $key, $default = '')
{
    return isset($arr[$key]) ? $arr[$key] : $default;
}

function array_filter_empty($arr)
{
    foreach ($arr as $k => $v) {
        if (empty($v)) unset($arr[$k]);
    }
    return $arr;
}

/*
function array_isset_push(&$arr, $key, $value) {
	!isset($arr[$key]) AND $arr[$key] = array();
	$arr[$key][] = $value;
}
*/

function array_addslashes(&$var)
{
    if (is_array($var)) {
        foreach ($var as $k => &$v) {
            array_addslashes($v);
        }
    } else {
        $var = isset($var) ? $var : '';
        $var = addslashes($var);
    }
    return $var;
}

function array_stripslashes(&$var)
{
    if (is_array($var)) {
        foreach ($var as $k => &$v) {
            array_stripslashes($v);
        }
    } else {
        $var = stripslashes($var);
    }
    return $var;
}

function array_htmlspecialchars(&$var)
{
    if (is_array($var)) {
        foreach ($var as $k => &$v) {
            array_htmlspecialchars($v);
        }
    } else {
        $var = str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $var);
    }
    return $var;
}

function array_trim(&$var)
{
    if (is_array($var)) {
        foreach ($var as $k => &$v) {
            array_trim($v);
        }
    } else {
        $var = trim($var);
    }
    return $var;
}

// 比较数组的值，如果不相同则保留，以第一个数组为准
function array_diff_value($arr1, $arr2)
{
    foreach ($arr1 as $k => $v) {
        if (isset($arr2[$k]) && $arr2[$k] == $v) unset($arr1[$k]);
    }
    return $arr1;
}

/*
	$data = array();
	$data[] = array('volume' => 67, 'edition' => 2);
	$data[] = array('volume' => 86, 'edition' => 1);
	$data[] = array('volume' => 85, 'edition' => 6);
	$data[] = array('volume' => 98, 'edition' => 2);
	$data[] = array('volume' => 86, 'edition' => 6);
	$data[] = array('volume' => 67, 'edition' => 7);
	arrlist_multisort($data, 'edition', TRUE);
*/
// 对多维数组排序
function arrlist_multisort($arrlist, $col, $asc = TRUE)
{
    $colarr = array();
    foreach ($arrlist as $k => $arr) {
        $colarr[$k] = $arr[$col];
    }
    $asc = $asc ? SORT_ASC : SORT_DESC;
    array_multisort($colarr, $asc, $arrlist);
    return $arrlist;
}

// 对数组进行查找，排序，筛选，支持多种条件排序
function arrlist_cond_orderby($arrlist, $cond = array(), $orderby = array(), $page = 1, $pagesize = 20)
{
    $resultarr = array();
    if (empty($arrlist)) return $arrlist;

    // 根据条件，筛选结果
    if ($cond) {
        foreach ($arrlist as $key => $val) {
            $ok = TRUE;
            foreach ($cond as $k => $v) {
                if (!isset($val[$k])) {
                    $ok = FALSE;
                    break;
                }
                if (!is_array($v)) {
                    if ($val[$k] != $v) {
                        $ok = FALSE;
                        break;
                    }
                } else {
                    foreach ($v as $k3 => $v3) {
                        if (
                            ($k3 == '>' && $val[$k] <= $v3) ||
                            ($k3 == '<' && $val[$k] >= $v3) ||
                            ($k3 == '>=' && $val[$k] < $v3) ||
                            ($k3 == '<=' && $val[$k] > $v3) ||
                            ($k3 == '==' && $val[$k] != $v3) ||
                            ($k3 == 'LIKE' && stripos($val[$k], $v3) === FALSE)
                        ) {
                            $ok = FALSE;
                            break 2;
                        }
                    }
                }
            }
            if ($ok) $resultarr[$key] = $val;
        }
    } else {
        $resultarr = $arrlist;
    }

    if ($orderby) {

        // php 7.2 deprecated each()
        //list($k, $v) = each($orderby);

        $k = key($orderby);
        $v = current($orderby);

        $resultarr = arrlist_multisort($resultarr, $k, $v == 1);
    }

    $start = ($page - 1) * $pagesize;

    $resultarr = array_assoc_slice($resultarr, $start, $pagesize);
    return $resultarr;
}

// 取一维或二维数组指定数量的数据 并按之前排序
function array_assoc_slice($arrlist, $start, $length = 0)
{
    if (isset($arrlist[0])) return array_slice($arrlist, $start, $length);
    $keys = array_keys($arrlist);
    $keys2 = array_slice($keys, $start, $length);
    $retlist = array();
    foreach ($keys2 as $key) {
        $retlist[$key] = $arrlist[$key];
    }

    return $retlist;
}

// 从一个二维数组中取出一个 key=>value 格式的一维数组
function arrlist_key_values($arrlist, $key, $value = NULL, $pre = '')
{
    $return = array();
    if ($key) {
        foreach ((array)$arrlist as $k => $arr) {
            $return[$pre . $arr[$key]] = $value ? $arr[$value] : $k;
        }
    } else {
        foreach ((array)$arrlist as $arr) {
            $return[] = $arr[$value];
        }
    }
    return $return;
}

/* php 5.5:
function array_column($arrlist, $key) {
	return arrlist_values($arrlist, $key);
}
*/

// @从一个二维数组中取出一个 values() 格式的一维数组，某一列key，$index_key数组的索引或键的列
function arrlist_values($arrlist, $key, $index_key = NULL)
{
    if (!$arrlist) return array();
    if (version_compare(PHP_VERSION, '5.5', '<')) {
        $return = array();
        foreach ($arrlist as &$arr) {
            $return[] = $arr[$key];
        }
    } else {
        $return = array_column($arrlist, $key, $index_key);
    }
    return $return;
}

// 从一个二维数组中对某一列求和
function arrlist_sum($arrlist, $key)
{
    if (!$arrlist) return 0;
    $n = 0;
    foreach ($arrlist as &$arr) {
        $n += $arr[$key];
    }
    return $n;
}

// 从一个二维数组中对某一列求最大值
function arrlist_max($arrlist, $key)
{
    if (!$arrlist) return 0;
    $first = array_pop($arrlist);
    $max = $first[$key];
    foreach ($arrlist as &$arr) {
        if ($arr[$key] > $max) {
            $max = $arr[$key];
        }
    }
    return $max;
}

// 从一个二维数组中对某一列求最大值
function arrlist_min($arrlist, $key)
{
    if (!$arrlist) return 0;
    $first = array_pop($arrlist);
    $min = $first[$key];
    foreach ($arrlist as &$arr) {
        if ($min > $arr[$key]) {
            $min = $arr[$key];
        }
    }
    return $min;
}

// 将 key 更换为某一列的值，在对多维数组排序后，数字key会丢失，需要此函数
function arrlist_change_key($arrlist, $key = '', $pre = '')
{
    $return = array();
    if (empty($arrlist)) return $return;
    foreach ($arrlist as &$arr) {
        if (empty($key)) {
            $return[] = $arr;
        } else {
            $return[$pre . '' . $arr[$key]] = $arr;
        }
    }
    //$arrlist = $return;
    return $return;
}

// 保留指定的 key
function arrlist_keep_keys($arrlist, $keys = array())
{
    !is_array($keys) AND $keys = array($keys);
    foreach ($arrlist as &$v) {
        $arr = array();
        foreach ($keys as $key) {
            $arr[$key] = isset($v[$key]) ? $v[$key] : NULL;
        }
        $v = $arr;
    }
    return $arrlist;
}

// 根据某一列的值进行 chunk
function arrlist_chunk($arrlist, $key)
{
    $r = array();
    if (empty($arrlist)) return $r;
    foreach ($arrlist as &$arr) {
        !isset($r[$arr[$key]]) AND $r[$arr[$key]] = array();
        $r[$arr[$key]][] = $arr;
    }
    return $r;
}
function in_string($s, $str)
{
    if (!$s || !$str) return FALSE;
    $s = ",$s,";
    $str = ",$str,";
    return FALSE !== strpos($str, $s);
}
?>