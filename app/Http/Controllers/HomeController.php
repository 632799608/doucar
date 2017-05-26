<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyWeChat\Support\Url as UrlHelper;
class HomeController extends Controller
{
    public function index()
    {
        // 检查当前不是微信 oauth 的回调，则跳过去授权
        // 注意，授权回调地址为当前页
        $wechat = app('wechat');
        // if (empty($_GET['code'])) {
        //     $currentUrl = UrlHelper::current(); // 获取当前页 URL
        //     $response = $wechat->oauth->scopes(['snsapi_userinfo'])->redirect($currentUrl);
        //     return $response; // or echo $response;
        // }
        $js = $wechat->js;
        // $user = $wechat->oauth->user();
        // session(['openid' => $user->getId()]);
        return view('welcome',compact('js'));
    }
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        $app = app('wechat');
        $controllerInstance = $this;
        $app->server->setMessageHandler(function($message) use ($controllerInstance,$app){
            return $controllerInstance->messageHandler($message,$app);
        });
        return $app->server->serve();
    }
    /**
     * 根据消息的类型进行再分配的方法
     *
     * @param $message
     * @param $app
     * @return string
     */
    protected function messageHandler($message,$app){
        $userApi = $app->user;
        switch ($message->MsgType) {
            case 'event':
                # 事件消息...
                return "欢迎关注";
                break;
            case 'text':
                return $userApi->get($message->FromUserName)->headimgurl;
                break;
            case 'image':
                # 图片消息...
                break;
            case 'voice':
                # 语音消息...
                break;
            case 'video':
                # 视频消息...
                break;
            case 'location':
                # 坐标消息...
                break;
            case 'link':
                # 链接消息...
                break;
            // ... 其它消息
            default:
                # code...
                break;
        }
        return "success";
    }
}
