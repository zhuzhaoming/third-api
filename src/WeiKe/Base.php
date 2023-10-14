<?php
/**
 * @desc
 * @author    [ZZM]
 * @since     2023/10/14
 * @copyright
 */

namespace SMG\ThirdApi\WeiKe;

use SMG\ThirdApi\WeiKe\Rest\Power;

class Base
{
    protected $base_uri = 'https://router.wikeyun.cn/';

    protected $config = [];

    public function __construct($config=null) {
        if($config){
            $this->config = $config;
        }else{
            $this->config = config('third_api.weike');
        }
        if(empty($this->config['app_key'])){
            throw new \Exception("缺少 app_key");
        }
        if(empty($this->config['app_secret'])){
            throw new \Exception("缺少 app_secret");
        }
    }

    /**
     * 签名
     * @desc
     *
     * @param $params
     *
     * @return string
     * @author    [ZZM]
     * @since     2023/10/14
     * @modify
     */
    protected function getSign($params){
        $str = '';

        #首字母以ASCII方式升序排列
        uksort($params, function($a, $b) {
            return strcmp($a, $b);
        });

        foreach ($params as $key => $value){
            $str .= $key.$value;
        }

        $str = $this->config['app_secret']."{$str}".$this->config['app_secret'];
        return strtoupper(md5($str));
    }
}