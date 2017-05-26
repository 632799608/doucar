<?php
/**
 *  签到签退服务
 */
namespace Aizxin\Services\Api;
use Aizxin\Repositories\Eloquent\MemberSignRepositoryEloquent;
use Aizxin\Repositories\Eloquent\CoachSignRepositoryEloquent;
use Aizxin\Validators\PhoneValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Aizxin\Tools\Result;
use Exception;
use Cache;
class SignService
{
	protected $mRepo;
	protected $cRepo;
	protected $sValidator;
	public function __construct(MemberSignRepositoryEloquent $mRepo
		,CoachSignRepositoryEloquent $cRepo,PhoneValidator $sValidator)
	{
		$this->mRepo = $mRepo;
		$this->cRepo = $cRepo;
		$this->sValidator = $sValidator;
	}
	/**
	 *  [coach 教练签到签退]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-05-11T15:19:37+0800
	 *  @param    string                   $value [description]
	 *  @return   [type]                          [description]
	 */
	public function coach($request)
	{
		$result = new Result();
		$type = $request->input('type');
		$data = $request->all();
		try {
			if($type > 2){
				$this->sValidator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			}
	        try {
	            $result->result = $this->cRepo->coach($request);
	            $result->message = $type = 1?trans('admin/alert.sign.in_success'):trans('admin/alert.sign.out_success');
	        } catch (Exception $e) {
	            $result->code = 400;
	            $result->message = $type = 1?trans('admin/alert.sign.in_error'):trans('admin/alert.sign.out_error');
	        }
        }catch (ValidatorException $e) {
            $result->code = 422;
            $result->message = '该手机号码未注册会员';
            
        }
        return $result->toJson();
	}
	/**
	 *  [member 学员签到签退]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-05-11T17:04:32+0800
	 *  @param    [type]                   $request [description]
	 *  @return   [type]                            [description]
	 */
	public function member($request)
	{
		$result = new Result();
		$type = $request->input('type');
		$data = $request->all();
		try {
			if($type > 2){
				$this->sValidator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			}
	        try {
	            $result->result = $this->mRepo->member($request);
	            $result->message = $type = 1?trans('admin/alert.sign.in_success'):trans('admin/alert.sign.out_success');
	        } catch (Exception $e) {
	            $result->code = 400;
	            $result->message = $type = 1?trans('admin/alert.sign.in_error'):trans('admin/alert.sign.out_error');
	        }
    	}catch (ValidatorException $e) {
            $result->code = 422;
            $result->message = '该手机号码未注册会员';
            
        }
        return $result->toJson();
	}
}