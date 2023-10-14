<?php
require 'vendor/autoload.php';

$Power = new \ZZM\ThirdApi\WeiKe\Rest\Power();
$params = [
    'cardId' => 1,
    'store_id' => 1,
    'order_no' => date('YmdHis').rand(100,999),
    'amount' => 100,
    'recharge_type' => 1,
    'notify_url' => '',
    'change' => 0,
];
$result = $Power->pushOrder($params);
var_dump($result);

