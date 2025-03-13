<?php
namespace app\admin\controller;

class Mojia extends Base
{
    public function theme()
    {
        if (Request()->isPost()) {
            $config = input();

            $config_old = config("mojiaopt");
            $config_new = array_merge($config_old, $config['mojia']);
            $res = mac_arr2file(APP_PATH . "extra/mojiaopt.php", $config_new);
            if ($res === false) {
                return $this->error("保存失败，请重试!");
            }

            //预设目录权限
            chmod('./template/mojia/html/tinier/seokey.html', 0755);
            chmod('./template/mojia/html/index/index.html', 0755);

            //更新首页启用模块
            $array = array();
            $home = $config['mojia']['home'];
            array_multisort(array_column($home, 'id'), SORT_ASC, $home);
            foreach ($home as $value => $key) {
                if ($home[$value]['state']) {
                    array_push($array, 'index/' . $value);
                }
            }
            if (!file_put_contents('./template/mojia/html/index/index.html', '{include file="public/header,' . implode(',', $array) . ',public/footer"}')) {
                return $this->error("首页设置保存失败!");
            }

            //更新seo设置
            $html = file_get_contents('./template/mojia/html/basics/seokey.html');
            $seokey = $config['mojia']['seo'];
            foreach ($seokey as $value => $key) {
                foreach ($seokey[$value] as $item => $sub) {
                    $html = str_replace('{' . $item . $seokey[$value]['aid'] . '}', $sub, $html);
                }
            }
            if (!file_put_contents('./template/mojia/html/tinier/seokey.html', $html)) {
                return $this->error("SEO设置保存失败,请检查文件权限!");
            }

            //更新淘宝客配置
            if ($config['mojia']['home']['taoke']['state'] == 1) {
                $taoke = $this->moJiaDaTaoKe('https://openapi.dataoke.com/api/goods/get-goods-list', array('pageSize' => '50', 'cids' => $config['mojia']['home']['taoke']['type'], 'juHuaSuan' => $config['mojia']['home']['taoke']['qiang'] == 1 ? 1 : '', 'taoQiangGou' => $config['mojia']['home']['taoke']['qiang'] == 2 ? 1 : '', 'tmall' => $config['mojia']['home']['taoke']['qiang'] == 3 ? 1 : '', 'tchaoshi' => $config['mojia']['home']['taoke']['qiang'] == 4 ? 1 : '', 'goldSeller' => $config['mojia']['home']['taoke']['qiang'] == 5 ? 1 : '', 'haitao' => $config['mojia']['home']['taoke']['qiang'] == 6 ? 1 : '', 'specialId' => $config['mojia']['home']['taoke']['brand'], 'sort' => $config['mojia']['home']['taoke']['sort'], 'version' => $config['mojia']['home']['taoke']['ver'], 'appKey' => $config['mojia']['other']['taoke']['key']), $config['mojia']['other']['taoke']['secret']);
                if (!file_put_contents('./application/extra/mojiatao.php', '<?php ' . PHP_EOL . 'return ' . var_export(array_slice($taoke['data']['list'], 0, $config['mojia']['home']['taoke']['num']), true) . ';')) {
                    return $this->error("首页淘客数据更新失败!");
                }
            }

            return $this->success("保存成功!");
        }

        $config = parse_ini_file('./template/mojia/info.ini');

        $this->assign("config", $config);
        $this->assign("mojia", config("mojiaopt"));
        return $this->fetch("admin@system/maccmsbox");
    }

    private function moJiaDaTaoKe($api, $param, $appSecret) {
        $output = '';
        ksort($param);
        foreach ($param as $key => $value) {
            $output .= '&' . $key . '=' . $value;
        }
        $output = trim($output, '&');
        $param['sign'] = strtoupper(md5($output . '&key=' . $appSecret));
        return json_decode(moJiaCurlGet($api . '?' . http_build_query($param)), true);
    }

    public function seo(){
        if (file_exists(moJiaPath('path') . 'application/extra/mojiaopt.php')) {
            if (@unlink(moJiaPath('path') . 'application/extra/mojiaopt.php')) {
                chmod('../../html/tinier/seokey.html', 0755);
                $html = file_get_contents('../../html/basics/seokey.html');
                $seokey = @require ('config.php');
                foreach ($seokey['seo'] as $value => $key) {
                    foreach ($seokey['seo'][$value] as $item => $sub) {
                        $html = str_replace('{' . $item . $seokey['seo'][$value]['aid'] . '}', $sub, $html);
                    }
                }
                if (!file_put_contents('../../html/tinier/seokey.html', $html)) {
                    die(json_encode(array('msg' => 'SEO设置恢复失败,请检查文件权限')));
                }
                die(json_encode(array('msg' => '恢复成功')));
            } else {
                die(json_encode(array('msg' => '恢复失败')));
            }
        } else {
            die(json_encode(array('msg' => '当前已经是默认设置了')));
        }

    }

}
