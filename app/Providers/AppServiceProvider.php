<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Log;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 管理员共享
        view()->composer(
            'layouts.header', 'App\Http\ViewComposers\AdminComposer'
        );
        // 菜单共享
        view()->composer(
            'layouts.left', 'App\Http\ViewComposers\MenuComposer'
        );
        //  sql 语句
        $dbListen = env( 'DB_LISTEN', false );
        if( $dbListen )
        {
            DB::listen(function ($query) {
                Log::info( "sql：{$query->sql},数据：".json_encode( $query->bindings, JSON_UNESCAPED_UNICODE ).",时间：{$query->time}" );
            });
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
