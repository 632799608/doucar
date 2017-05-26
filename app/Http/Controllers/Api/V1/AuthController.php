<?php
/**
 *  管理员认证
 */
namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Aizxin\Services\Api\AuthService;

class AuthController extends Controller
{
    protected $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }
    /**
     *  [smsSend 发送验证码]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-05T14:40:31+0800
     *  @return   [type]                   [description]
     */
    /**
     * @api {post} /api/v1/auth/sms.api 发送验证码
     * @apiGroup Auth
     * @apiPermission 签名
     * @apiParam {String} phone  手机号码
     * @apiParam {Int} type 0:注册,1:找回密码
     * @apiParam {String} clientId  app唯一标示
     * @apiParam {String} time  时间戳
     * @apiParam {String} sign  path+(key=value&key=value)+appkey的md5
     * @apiVersion 0.0.1
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "验证码发送成功",
     *           "data": null
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "验证码发送失败"
     *      }
     *@apiErrorExample {json} 验证失败:
     *     {
     *           "code": 404,
     *           "message": "验证错误信息"
     *      }
     *@apiErrorExample {json} 系统失败:
     *     {
     *           "code": 500
     *           "message": "系统信息",'访问频繁'
     *      }
     */
    public function smsSend(Request $request)
    {
        return $this->service->smsSend($request);
    }
    /**
     *  [postLogin 登录]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-05T14:41:02+0800
     *  @param    UserLoginRequest         $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/auth/loginPhone.api 手机登录
     * @apiGroup Auth
     * @apiPermission 签名
     * @apiParam {String} phone  手机号码
     * @apiParam {String} password  密码
     * @apiParam {String} clientId  app唯一标示
     * @apiParam {String} time  时间戳
     * @apiParam {String} sign  path+(key=value&key=value)+appkey的md5
     * @apiVersion 0.0.1
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "登录成功",
     *           "result": {
     *               "token": "xxxx.xxxxxxx.xxxxxxxx",
     *               "id": 4,
     *               "phone": "182xxxxxxx",
     *               "avatar": "http://xxx.jpg",
     *               "nickname": "xx",
     *               "expiryTime": "1471685891", //token 过去时间,
     *               "isCoach" : '0' //1:教练，0:
     *           }
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "登录失败"
     *      }
     *@apiErrorExample {json} 验证失败:
     *     {
     *           "code": 404,
     *           "message": "验证错误信息"
     *      }
     *@apiErrorExample {json} 系统失败:
     *     {
     *           "code": 500
     *           "message": "系统信息",'访问频繁'
     *      }
     */
    public function postLoginPhone(Request $request)
    {
        return $this->service->postLoginPhone($request);
    }
    /**
     *  [postLoginClient 第三方登录]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-05T18:16:40+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/auth/loginOpenId.api 第三方登录
     * @apiGroup Auth
     * @apiPermission 签名
     * @apiParam {String} openId  密码
     * @apiParam {String} clientId  app唯一标示
     * @apiParam {String} time  时间戳
     * @apiParam {Int} accountType 登录方式 (2:QQ，3:微信)
     * @apiParam {String} sign  path+(key=value&key=value)+appkey的md5
     * @apiVersion 0.0.1
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "登录成功",
     *           "result": {
     *               "token": "xxxx.xxxxxxx.xxxxxxxx",
     *               "id": 4,
     *               "phone": "182xxxxxxx",
     *               "avatar": "http://xxx.jpg",
     *               "nickname": "xx",
     *               "expiryTime": "1471685891", //token 过去时间
     *               "isCoach" : '0' //1:教练，0:
     *           }
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "登录失败"
     *      }
     *@apiErrorExample {json} 验证失败:
     *     {
     *           "code": 404,
     *           "message": "验证错误信息"
     *      }
     *@apiErrorExample {json} 系统失败:
     *     {
     *           "code": 500
     *           "message": "系统信息",'访问频繁'
     *      }
     */
    public function postLoginClient(Request $request)
    {
        return $this->service->postLoginClient($request);
    }
    /**
     *  [postRegisterPhone 手机注册]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-05T18:29:14+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/auth/registerPhone.api 手机注册
     * @apiGroup Auth
     * @apiPermission 签名
     * @apiParam {String} phone  手机号码
     * @apiParam {String} password  密码
     * @apiParam {String} password_confirmation  确认密码
     * @apiParam {String} clientId  app唯一标示
     * @apiParam {String} time  时间戳
     * @apiParam {String} code 验证码
     * @apiParam {String} sign  path+(key=value&key=value)+appkey的md5
     * @apiVersion 0.0.1
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "注册成功",
     *           "result": {
     *               "token": "xxxx.xxxxxxx.xxxxxxxx",
     *               "id": 4,
     *               "phone": "182xxxxxxx",
     *               "avatar": "http://xxx.jpg",
     *               "nickname": "xx",
     *               "expiryTime": "1471685891", //token 过去时间,
     *               "isCoach" : '0' //1:教练，0:
     *           }
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "注册失败"
     *      }
     *@apiErrorExample {json} 验证失败:
     *     {
     *           "code": 404,
     *           "message": "验证错误信息"
     *      }
     *@apiErrorExample {json} 系统失败:
     *     {
     *           "code": 500
     *           "message": "系统信息",'访问频繁'
     *      }
     */
    public function postRegisterPhone(Request $request)
    {
        return $this->service->postRegisterPhone($request);
    }
    /**
     *  [postRegisterClient 第三方登录]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-05T18:29:38+0800
     *  @param    string                   $value [description]
     *  @return   [type]                          [description]
     */
    /**
     * @api {post} /api/v1/auth/registerOpenId.api 第三方注册
     * @apiGroup Auth
     * @apiPermission 签名
     * @apiParam {String} openId  密码
     * @apiParam {String} clientId  app唯一标示
     * @apiParam {String} time  时间戳
     * @apiParam {Int} accountType 注册方式 (2:QQ，3:微信)
     * @apiParam {String} sign  path+(key=value&key=value)+appkey的md5
     * @apiVersion 0.0.1
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "注册成功",
     *           "result": {
     *               "token": "xxxx.xxxxxxx.xxxxxxxx",
     *               "id": 4,
     *               "phone": "182xxxxxxx",
     *               "avatar": "http://xxx.jpg",
     *               "nickname": "xx",
     *               "expiryTime": "1471685891", //token 过去时间
     *               "isCoach" : '0' //1:教练，0:
     *           }
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "注册失败"
     *      }
     *@apiErrorExample {json} 验证失败:
     *     {
     *           "code": 404,
     *           "message": "验证错误信息"
     *      }
     *@apiErrorExample {json} 系统失败:
     *     {
     *           "code": 500
     *           "message": "系统信息",'访问频繁'
     *      }
     */
    public function postRegisterClient(Request $request)
    {
        return $this->service->postRegisterClient($request);
    }
    /**
     *  [passwordReset 密码找回]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-05T18:36:37+0800
     *  @return   [type]                   [description]
     */
    /**
     * @api {post} /api/v1/auth/passwordReset.api 密码找回
     * @apiGroup Auth
     * @apiPermission 签名
     * @apiParam {String} phone  手机号码
     * @apiParam {String} password  密码
     * @apiParam {String} password_confirmation  确认密码
     * @apiParam {String} clientId  app唯一标示
     * @apiParam {String} time  时间戳
     * @apiParam {String} code 验证码
     * @apiParam {String} sign  path+(key=value&key=value)+appkey的md5
     * @apiVersion 0.0.1
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "修改成功",
     *           "result": {}
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "修改失败"
     *      }
     *@apiErrorExample {json} 验证失败:
     *     {
     *           "code": 404,
     *           "message": "验证错误信息"
     *      }
     *@apiErrorExample {json} 系统失败:
     *     {
     *           "code": 500
     *           "message": "系统信息",'访问频繁'
     *      }
     */
    public function passwordReset(Request $request)
    {
        return $this->service->passwordReset($request);
    }
}
