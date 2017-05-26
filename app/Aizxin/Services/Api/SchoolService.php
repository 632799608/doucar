<?php
/**
 *  驾校服务
 */
namespace Aizxin\Services\Api;
use Aizxin\Repositories\Eloquent\SchoolRepositoryEloquent;
use Aizxin\Repositories\Eloquent\SchoolApproveRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Cache;
use Aizxin\Validators\SchoolApproveValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
class SchoolService
{
	protected $sRepo;
    protected $sValidator;
    protected $approveRepo;
	public function __construct(
        SchoolRepositoryEloquent $sRepo,
        SchoolApproveRepositoryEloquent $approveRepo,
        SchoolApproveValidator $sValidator)
	{
		$this->sRepo = $sRepo;
        $this->approveRepo = $approveRepo;
        $this->sValidator = $sValidator;
	}
    /**
     *  [schoolList 驾校列表]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-10T11:43:07+0800
     *  @param    string                   $value [description]
     *  @return   [type]                          [description]
     */
    public function schoolList($request)
    {
        $result = new Result();
        try {
            $parm = $request->except(['s']);
            $key = sha1Url($request->url(),$parm);
            $list = Cache::remember($key, config('admin.global.cache.time'), function (){
                return $this->sRepo->schoollistApi();
            });
            $result->result = $list;
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.school.index_error');
        }
        return $result->toJson();
    }
    /**
     *  [school 驾校详情]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-10T15:26:41+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function school($request)
    {
        $result = new Result();
        try {
            $parm = $request->except(['s']);
            $key = sha1Url($request->url(),$parm);
            $list = Cache::remember($key, config('admin.global.cache.time'), function () use($parm){
                return $this->sRepo->schoolApi($parm['id']);
            });
            $result->result = $list;
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.school.index_error');
        }
        return $result->toJson();
    }
    /**
     *  [schoolApprove 驾校认证]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-11T11:15:32+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function schoolApprove($request)
    {
        $result = new Result();
        $data = $request->except(['s','token','sign','time','clientId']);
        try {
            $this->sValidator->with($data)->passesOrFail();
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