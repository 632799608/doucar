<?php
/**
 *  管理员服务
 */
namespace Aizxin\Services\Api;

use Aizxin\Repositories\Eloquent\MemberRepositoryEloquent;
use Aizxin\Tools\Result;
use Cache;
use Exception;
use Aizxin\Validators\MemberPhoneValidator;
use Aizxin\Validators\PhoneValidator;
use Aizxin\Validators\loginOpenIdValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Support\Facades\Validator;
use PhpSms;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
class AuthService {
	protected $userRepo;
	protected $upValidator;
    protected $oValidator;
    protected $pValidator;
	public function __construct(
		MemberRepositoryEloquent $userRepo,
		MemberPhoneValidator $upValidator,
        loginOpenIdValidator $oValidator,
        PhoneValidator $pValidator)
    {
        $this->userRepo = $userRepo;
        $this->upValidator = $upValidator;
        $this->pValidator = $pValidator;
        $this->oValidator = $oValidator;
	}
	/**
	 *  [smsSend 短信发送]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-05-05T14:44:27+0800
	 *  @param    [type]                   $request [description]
	 *  @return   [type]                            [description]
	 */
	public function smsSend($request)
    {
        $result = new Result();
        try {
            $this->pValidator->with( $request->all() )->passesOrFail( $request->type == 1 ? ValidatorInterface::RULE_UPDATE:ValidatorInterface::RULE_CREATE);
            $phone = $request->phone;
            // 获取验证码
            $randNum = $this->makeRandString(6, 'NUMBER');
            // // 缓存5分钟
            $expiresAt = 5;
            Cache::put($phone, $randNum, $expiresAt);
            // 短信模版
            $templates = [
                'YunPian' => '1',
            ];
            // 模版数据
            $tempData = [
                'code' => $randNum
            ];
            // 短信内容
            $content = '【'.config("phpsms.agents.YunPian.sign").'】您的验证码是'.$tempData['code'];
            $data = PhpSms::make()->to($phone)
                 ->template($templates)
                 ->data($tempData)
                 ->content($content)
                 ->send();
            if ($data['logs'][0]['result']['code'] == 000000) {
                $result->message = '验证码发送成功';
            }else {
                $result->code = 400;
                $result->message = '验证码发送失败';
            }

        } catch (ValidatorException $e) {
            $result->code = 404;
            $result->message = $e->getMessageBag()->first();
        }
        return $result->toJson();
    }
    /**
     *  [postLoginPhone 手机登录]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-08T13:07:35+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function postLoginPhone($request)
    {
        $result = new Result();
        $data = $request->only(['phone','password']);
        try {
            $this->upValidator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            try {
                Auth::guard('member')->attempt($data);
                // 认证通过...
                $member = Auth::guard('member')->user();
                $result->result = $this->memberInfo($member);
                $result->message = trans('admin/alert.user.login_success');
            }catch(Exception $e){
                $result->code = 400;
                $result->message = trans('admin/alert.user.login_error');
            }
        } catch (ValidatorException $e) {
            $result->code = 404;
            $result->message = $e->getMessageBag()->first();
        }
        return $result->toJson();
    }
    /**
     *  [loginOpenId 第三方登录]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-08T13:31:34+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function postLoginClient($request)
    {
        $result = new Result();
        $data = $request->only(['openId']);
        try {
            $this->oValidator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            try {
                $res = $this->userRepo->findWhere($data)[0];
                $result->message = trans('admin/alert.member.openId_success');
                $result->result = $this->memberInfo($res);
            }catch(Exception $e){
                $result->code = 400;
                $result->message = trans('admin/alert.member.openId_error');
            }
        } catch (ValidatorException $e) {
            $result->code = 404;
            $result->message = $e->getMessageBag()->first();
        }
        return $result->toJson();
    }
    /**
     *  [postRegisterPhone 手机注册]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-08T14:13:06+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function postRegisterPhone($request)
    {
        $result = new Result();
        try {
            $this->upValidator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $data = array(
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
                'nickname'=>rand(1000,9999),
                'isCoach'=>0,
                'avatar'=>env('APP_URL').'/back/images/tx.png',
                'accountType'=>1
            );
            //验证手机验证码
            if (Cache::has($data['phone'])) {
               $code = Cache::get($data['phone']);
               if ($code != $request->code) {
                    $result->code = 400;
                    $result->message = trans('admin/alert.member.code_error');
                    return $result->toJson();
               }
            } else {
                $result->code = 400;
                $result->message = trans('admin/alert.member.code_error');
                return $result->toJson();
            }
            try {
                $res = $this->userRepo->create($data);
                $result->message = trans('admin/alert.member.register_success');
                $result->result = $this->memberInfo($res);
                Cache::forget($data['phone']);
            }catch(Exception $e){
                $result->code = 400;
                $result->message = trans('admin/alert.member.register_error');
            }
        } catch (ValidatorException $e) {
            $result->code = 404;
            $result->message = $e->getMessageBag()->first();
        }
        return $result->toJson();
    }
    /**
     *  [postRegisterClient 第三方注册]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-08T14:34:11+0800
     *  @param    string                   $value [description]
     *  @return   [type]                          [description]
     */
    public function postRegisterClient($request)
    {
        $result = new Result();
        $data = $request->only(['openId']);
        try {
            $this->oValidator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            try {
                $data = array(
                    'phone' => rand(1000,9999),
                    'password' => bcrypt(rand(1000,9999)),
                    'nickname'=>rand(1000,9999),
                    'isCoach'=>0,
                    'openId'=>$data['openId'],
                    'avatar'=>env('APP_URL').'/back/images/tx.png',
                    'accountType'=>$data['accountType']
                );
                $res = $this->userRepo->create($data);
                $result->message = trans('admin/alert.member.openId_success');
                $result->result = $this->memberInfo($res);
            }catch(Exception $e){
                $result->code = 400;
                $result->message = trans('admin/alert.member.openId_error');
            }
        } catch (ValidatorException $e) {
            $result->code = 404;
            $result->message = $e->getMessageBag()->first();
        }
        return $result->toJson();
    }
    /**
     *  [passwordReset 密码找回]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-08T15:09:32+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function passwordReset($request)
    {
        $result = new Result();
        $data = $request->all();
        Cache::put($request->phone, '123456', 5);
        $memberPhone = $request->only(['phone']);
        try {
            $this->upValidator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            try {
                //验证手机验证码
                if (Cache::has($memberPhone['phone'])) {
                   $code = Cache::get($memberPhone['phone']);
                   if ($code != $request->code) {
                        $result->code = 400;
                        $result->message = trans('admin/alert.member.code_error');
                        return $result->toJson();
                   }
                } else {
                    $result->code = 400;
                    $result->message = trans('admin/alert.member.code_error');
                    return $result->toJson();
                }
                $res = $this->userRepo->findWhere($memberPhone)[0];
                $res->password = bcrypt($request->password);
                $res->save();
                Cache::forget($memberPhone['phone']);
                $result->message = trans('admin/alert.member.reset_success');
            }catch(Exception $e){
                $result->code = 400;
                $result->message = trans('admin/alert.member.reset_error');
            }
        } catch (ValidatorException $e) {
            $result->code = 404;
            $result->message = $e->getMessageBag()->first();
        }
        return $result->toJson();
    }
    /**
     *  [auth 登录授权]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-02-20T16:07:11+0800
     *  @param    [type]                   $data [description]
     *  @return   [type]                         [description]
     */
    private function auth($data)
    {
        $mem = array();
        if (Auth::guard('member')->attempt($data)) {
            // 认证通过...
            $member = Auth::guard('member')->user();
            $mem = $this->memberInfo($member);
        }
        return $mem;
    }
    /**
     *  [memberInfo description]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-08T14:03:17+0800
     *  @param    [type]                   $data [description]
     *  @return   [type]                         [description]
     */
    private function memberInfo($member)
    {
        $mem = array();
        $mem['token'] = JWTAuth::fromUser($member);
        $mem['id'] = $member->id;
        $mem['phone'] = $member->phone;
        $mem['nickname'] = $member->nickname;
        $mem['isCoach'] = $member->isCoach;
        $mem['avatar'] = $member->avatar;
        // // token 有效时间
        $mem['expiryTime'] = (string)(Carbon::now()->timestamp + config('jwt.ttl') * 60);
        return $mem;
    }
    /**
     * 生成随机数
     * @param int $len 随机数长度
     * @param string $format 格式
     * @return string
     */
    private function makeRandString($len = 6, $format = 'ALL')
    {
        switch ($format) {
            case 'ALL':
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~';
                break;
            case 'CHAR':
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-@#~';
                break;
            case 'NUMBER':
                $chars = '0123456789';
                break;
            default :
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~';
                break;
        }
        $password = "";
        $_len = strlen($chars) - 1;
        for ($i = 0;$i < $len;++$i) {
            $password .= $chars[mt_rand(0, $_len)];
        }
        return $password;
    }
}