第三方API包
===

## laravel 配置文件发布
`php artisan vendor:publish --tag=third-api`

## 微客API示例
~~~
#非laravel项目
$config = [
    'app_key' => '',
    'app_secret' => '',
];
$Power = new \SMG\ThirdApi\WeiKe\Rest\Power($config);

#laravel项目(需要发布配置文件后配置)
$Power = new \SMG\ThirdApi\WeiKe\Rest\Power();

#电费充值
$params = [];
$Power->pushOrder($params);

#xxx
~~~
