<?php
/**
 *  会员资料修改服务
 */
namespace Aizxin\Services\Api;
use Aizxin\Repositories\Eloquent\MemberAmendRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Aizxin\Validators\MemberAmendValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Cache;
class MemberAmendService
{
	protected $mAmendRepo;
	protected $mAmendValidator;
	public function __construct(
		MemberAmendRepositoryEloquent $mAmendRepo,
		MemberAmendValidator $mAmendValidator)
	{
		$this->mAmendRepo = $mAmendRepo;
		$this->mAmendValidator = $mAmendValidator;
	}
	/**
	 *  [MemberAmend 学员资料修改列表]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-05-11T17:04:32+0800
	 *  @param    [type]                   $request [description]
	 *  @return   [type]                            [description]
	 */
	public function memberAmend($request)
	{
		$result = new Result();
		$data = $request->except(['memberId']);
		try {
			$this->mAmendValidator->with($data)->passesOrFail();
	        try {
	            $result->result = $this->mAmendRepo->memberAmend($request->memberId,$data);
	            $result->message = trans('admin/alert.membermend.index_success');
	        } catch (Exception $e) {
	            $result->code = 400;
	            $result->message = trans('admin/alert.membermend.index_error');
	        }
        } catch (ValidatorException $e) {
            $result->code = 422;
            $result->message = $e->getMessageBag()->first();
        }
        return $result->toJson();
	}
}