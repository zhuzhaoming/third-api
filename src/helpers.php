<?php

/**
 * 获取客户端地址
 * @desc
 * @return mixed
 * @since     2023/10/14
 * @modify
 * @author    [ZZM]
 */
if(!function_exists('getClientIP')){
    function getClientIP() {
        // 检查是否存在 HTTP_CLIENT_IP 头部
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }

        // 检查是否存在 HTTP_X_FORWARDED_FOR 头部
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        // 使用默认的 REMOTE_ADDR 备选方案
        return $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    }
}


if(!function_exists('config')){
    function config($configKey = '') {
        // 按点分割键路径
        $keys = explode('.', $configKey);

        $configFileName = array_shift($keys);

        // 构建配置文件路径
        $configFilePath = __DIR__ . '/../config/' . $configFileName . '.php';

        // 加载配置文件
        if(file_exists($configFilePath)){
            $config = require $configFilePath;
        }else{
            return $configKey;
        }

        // 逐层遍历数组以查找值
        foreach ($keys as $key) {
            if (isset($config[$key])) {
                $config = $config[$key];
            } else {
                return null; // 如果键不存在，返回 null 或其他适当的默认值
            }
        }

        return $config;
    }
}