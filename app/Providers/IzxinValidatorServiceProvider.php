<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Aizxin\Extensions\IzxinValidator;
use Illuminate\Support\Facades\Validator;
//use Validator;

/**
 * IzxinValidator 扩展自定义验证类 服务提供者
 *
 * @author raoyc<raoyc2009@gmail.com>
 */
class IzxinValidatorServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        /*注册自定义验证类*/
        /*
        Validator::resolver(function($translator, $data, $rules, $messages)
        {
            return new DouyasiValidator($translator, $data, $rules, $messages);
        });
        */
       Validator::resolver(function ($translator, $data, $rules, $messages, $attributes) {
            return new IzxinValidator($translator, $data, $rules, $messages, $attributes);
        });
        // $this->app['validator']->resolver(function ($translator, $data, $rules, $messages) {
        //     return new IzxinValidator($translator, $data, $rules, $messages);
        // });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
