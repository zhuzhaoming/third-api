<?php
/**
 * @desc
 * @author    [ZZM]
 * @since     2023/10/14
 * @copyright
 */

namespace SMG\ThirdApi;

use Illuminate\Support\ServiceProvider;

class ThirdApiServiceProvider extends ServiceProvider
{
    /**
     * 在注册后进行服务的启动。
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../config' => config_path()], 'third-api');
        }
    }

    /**
     * 在服务容器里注册
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(realpath(__DIR__.'/../config/third_api.php'), 'third_api');
    }
}