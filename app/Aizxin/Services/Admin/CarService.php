<?php
/**
 *  车辆服务
 */
namespace Aizxin\Services\Admin;
use Aizxin\Repositories\Criteria\SearchManyCriteria;
use Aizxin\Repositories\Eloquent\CoachRepositoryEloquent;
use Aizxin\Repositories\Eloquent\SchoolRepositoryEloquent;
use Aizxin\Repositories\Eloquent\CarRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Aizxin\Validators\CarValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Cache;
class CarService
{
	protected $sValidator;
    protected $schoolRepo;
    protected $sRepo;
	public function __construct(SchoolRepositoryEloquent $schoolRepo,CarValidator $sValidator,CarRepositoryEloquent $sRepo)
	{
		$this->sValidator = $sValidator;
        $this->schoolRepo = $schoolRepo;
        $this->sRepo = $sRepo;
	}
    /**
     *  [schoolList 获取车辆列表]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-05-03T14:36:44+0800
     *  @return   [type]                   [description]
     */
    public function schoolList()
    {
        return $this->schoolRepo->schoollist();
    }
    /**
     *  [store 车辆添加]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T14:46:46+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function store($request)
    {
        $result = new Result();
        $data = $request->all();
        try {
            $this->sValidator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            try {
                $this->sRepo->storeCar($data);
                $result->message = trans('admin/alert.car.create_success');
            } catch (Exception $e) {
                $result->code = 400;
                $result->message = trans('admin/alert.car.create_error');
            }
        } catch (ValidatorException $e) {
            $result->code = 422;
            $result->message = $e->getMessageBag()->first();
        }
        return $result->toJson();
    }
    /**
     *  [index 车辆列表]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T16:38:33+0800
     *  @return   [type]                   [description]
     */
    public function index()
    {
        $result = new Result();
        $search = request()->except(['page','pageSize','s']);
        try {
            if(count($search)>0){
                $this->sRepo->pushCriteria(new SearchManyCriteria($search));
            }
            // 每页显示条数
            $pageSize = request('pageSize', config('admin.global.pagination.pageSize'));
            $result->data = $this->sRepo->index($pageSize);
        } catch (Exception $e) {
            $result->code = 1001;
            $result->message = $e;
        }
        return $result->toJson();
    }
    /**
     *  [destroy 车辆删除]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T18:59:16+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function destroy($id)
    {
        $result = new Result();
        try {
            // 批量删除
            if (!is_numeric($id)) {
                $isDestroy = $this->sRepo->multipleDestroy(explode(',', $id));
            } else {
                $isDestroy = $this->sRepo->elDelete($id);
            }
            if ($isDestroy) {
                $result->message = trans('admin/alert.car.destroy_success');
            }
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.car.destroy_error');
        }
        return $result->toJson();
    }
    /**
     *  [erwei 二维码]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-24T10:06:17+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function erwei($request)
    {
        $base64 = base64_encode(\QrCode::format('png')->size(400)->margin(1)->merge('/public/back/images/QrCode.png', .2)->generate($request->id));
        $result = new Result();
        $result->data = 'data:image/png;base64,'.$base64;
        return $result->toJson();
    }
}