<?php
/**
 *  登记服务
 */
namespace Aizxin\Services\Api;
use Aizxin\Repositories\Eloquent\MemberApplyRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Aizxin\Validators\MemberApplyValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Cache;
class MemberApplyService
{
	protected $mApplyRepo;
	protected $mApplyValidator;
	public function __construct(
		MemberApplyRepositoryEloquent $mApplyRepo,
		MemberApplyValidator $mApplyValidator)
	{
		$this->mApplyRepo = $mApplyRepo;
		$this->mApplyValidator = $mApplyValidator;
	}
	/**
	 *  [memberApplyAdd 学员登记]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-05-11T15:19:37+0800
	 *  @param    string                   $value [description]
	 *  @return   [type]                          [description]
	 */
	public function memberApplyAdd($request)
	{
		$result = new Result();
        $data = $request->except(['s','token','sign','time','clientId','pay']);
        $pay = $request->pay;
        try {
            $this->mApplyValidator->with($data)->passesOrFail();
            try {
                $result->result = $this->mApplyRepo->createApply($data,$pay);
                $result->message = trans('admin/alert.member.apply_success');
            } catch (Exception $e) {
                $result->code = 400;
                $result->message = trans('admin/alert.member.apply_error');
            }
        } catch (ValidatorException $e) {
            $result->code = 422;
            $result->message = $e->getMessageBag()->first();
        }
        return $result->toJson();
	}
	/**
	 *  [MemberApply 学员报名列表]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-05-11T17:04:32+0800
	 *  @param    [type]                   $request [description]
	 *  @return   [type]                            [description]
	 */
	public function memberApply($request)
	{
		$result = new Result();
        try {
            $result->result = $this->mApplyRepo->memberApply($request->memberId);
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.member.apply_index');
        }
        return $result->toJson();
	}
}