<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;

class AuthJwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            // 如果用户登陆后的所有请求没有jwt的token抛出异常
            $member = JWTAuth::toUser($request->input('token'));
            if($member->id != $request->input('memberId')){
                return respondApiErrors('请重新登录',400);
            }
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return respondApiErrors('Token 无效',404);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return respondApiErrors('Token 已过期',404);
            }else{
                return respondApiErrors('Token 出错了',404);
            }
        }
        return $next($request);
    }
}
