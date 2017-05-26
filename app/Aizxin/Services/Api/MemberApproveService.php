<?php
/**
 *  登记服务
 */
namespace Aizxin\Services\Api;
use Aizxin\Repositories\Eloquent\MemberApproveRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Aizxin\Validators\MemberApproveValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Cache;
class MemberApproveService
{
	protected $mApproveRepo;
	protected $mApproveValidator;
	public function __construct(
		MemberApproveRepositoryEloquent $mApproveRepo,
		MemberApproveValidator $mApproveValidator)
	{
		$this->mApproveRepo = $mApproveRepo;
		$this->mApproveValidator = $mApproveValidator;
	}
	/**
	 *  [memberApproveAdd 学员登记]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-05-11T15:19:37+0800
	 *  @param    string                   $value [description]
	 *  @return   [type]                          [description]
	 */
	public function memberApproveAdd($request)
	{
		$result = new Result();
        $data = $request->except(['s','token','sign','time','clientId']);
        try {
            $this->mApproveValidator->with($data)->passesOrFail();
            try {
            	$daMeApprove = $this->mApproveRepo->findWhere(['memberId'=>$data['memberId']]);
            	if (count($daMeApprove) > 0) {
            		$result->code = 400;
                	$result->message = trans('admin/alert.member.approve_out');
            		return $result->toJson();
            	}
                $this->mApproveRepo->create($data);
                $result->message = trans('admin/alert.member.approve_success');
            } catch (Exception $e) {
                $result->code = 400;
                $result->message = trans('admin/alert.member.approve_error');
            }
        } catch (ValidatorException $e) {
            $result->code = 422;
            $result->message = $e->getMessageBag()->first();
        }
        return $result->toJson();
	}
	/**
	 *  [memberApprove 学员登记详情]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-05-11T17:04:32+0800
	 *  @param    [type]                   $request [description]
	 *  @return   [type]                            [description]
	 */
	public function memberApprove($request)
	{
		$result = new Result();
        try {
        	$daMeApprove = $this->mApproveRepo->findWhere(['memberId'=>$request->memberId]);
        	if (count($daMeApprove) == 0) {
        		$result->result = [];
        		return $result->toJson();
        	}
        	$parm = $request->except(['s']);
			$key = sha1Url($request->url(),$parm);
			$list = Cache::remember($key, config('admin.global.cache.time'), function () use($parm) {
            	return $this->mApproveRepo->memberApprove($parm['memberId']);
        	});
			$result->result = $list;
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.member.approve_index');
        }
        return $result->toJson();
	}
}