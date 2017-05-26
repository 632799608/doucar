<?php
/**
 *  驾校服务
 */
namespace Aizxin\Services\Api;
use Aizxin\Repositories\Eloquent\CoachRepositoryEloquent;
use Aizxin\Repositories\Eloquent\CoachApproveRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Cache;
use Aizxin\Validators\CoachApproveValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
class CoachService
{
	protected $cRepo;
    protected $cValidator;
    protected $approveRepo;
	public function __construct(
        CoachRepositoryEloquent $cRepo,
        CoachApproveValidator $cValidator,
        CoachApproveRepositoryEloquent $approveRepo)
	{
        $this->cRepo = $cRepo;
        $this->cValidator = $cValidator;
		$this->approveRepo = $approveRepo;

	}
    /**
     *  [coach 教练详情]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-10T16:40:40+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function coach($request)
    {
        $result = new Result();
        try {
            $parm = $request->except(['s']);
            $key = sha1Url($request->url(),$parm);
            $list = Cache::remember($key, config('admin.global.cache.time'), function () use($parm){
                return $this->cRepo->coachApi($parm['id']);
            });
            $result->result = $list;
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.coach.index_error');
        }
        return $result->toJson();
    }
    /**
     *  [coachApprove 教练认证]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-11T12:05:44+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function coachApprove($request)
    {
        $result = new Result();
        $data = $request->except(['s','token','sign','time','clientId']);
        try {
            $this->cValidator->with($data)->passesOrFail();
            try {
                $this->approveRepo->create($data);
                $result->message = trans('admin/alert.school.approve_success');
            } catch (Exception $e) {
                $result->code = 400;
                $result->message = trans('admin/alert.school.approve_error');
            }
        } catch (ValidatorException $e) {
            $result->code = 422;
            $result->message = $e->getMessageBag()->first();
        }
        return $result->toJson();
    }
}