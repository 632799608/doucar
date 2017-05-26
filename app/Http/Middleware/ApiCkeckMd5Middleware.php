<?php

namespace App\Http\Middleware;

use Closure;
class ApiCkeckMd5Middleware
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
        $data = $request->except(['s','sign']);
        $path = $request->path();
        if(empty($data['time']) || !checkTime( $data['time'] )){
            return response()->json([
                'code' => 404,
                // 'data' =>$request->all(),
                // 'time' => time(),
                // 'isTime' =>abs(time()-$request->time),
                'message' => '请求失败'
            ]);
        }
        if($request->sign != md5($path.createLinkstring($data).env('API_CHECK_KEY'))){
            return response()->json([
                'code' => 404,
                'message' => '签名错误'
            ]);
        }
        return $next($request);
    }
}