<?php
/**
 * @desc
 * @author    [ZZM]
 * @since     2023/10/14
 * @copyright
 */

namespace ZZM\ThirdApi\WeiKe\Rest;

use GuzzleHttp\Client;
use ZZM\ThirdApi\WeiKe\Base;

class Power extends Base
{
    /**
     * 电费充值
     * @desc
     *
     * @param $params
     *
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @since     2023/10/14
     * @modify
     * @author    [ZZM]
     */
    public function pushOrder($params)
    {
        $url = $this->base_uri.'rest/Power/pushOrder';

        $client = new Client();

        $common_params = [
            'app_key' => $this->config['app_key'],
            'timestamp' => time(),
            'client' => getClientIP(),
            'v' => '1.0',
            'format' => 'json',
        ];
        $common_params['sign'] = $this->getSign(array_merge($common_params,$params));

        $url = $url. '?' . http_build_query($common_params);
        $response = $client->post($url, [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => $params,
        ]);
        if ($response->getStatusCode() === 200) {
            $body = $response->getBody()->getContents();
            return json_decode($body);
        } else {
            throw new \Exception("请求失败，状态码：{$response->getStatusCode()}");
        }
    }
}