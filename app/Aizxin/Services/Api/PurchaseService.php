<?php
/**
 *  团购服务
 */
namespace Aizxin\Services\Api;

use Aizxin\Repositories\Eloquent\PurchaseRepositoryEloquent;
use Aizxin\Repositories\Eloquent\OrderRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Cache;
class PurchaseService
{
	protected $pRepo;
    protected $oRepo;
	public function __construct(
        PurchaseRepositoryEloquent $pRepo,
        OrderRepositoryEloquent $oRepo)
	{
		$this->pRepo = $pRepo;
        $this->oRepo = $oRepo;
	}
    /**
     *  [index 团购详情]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-17T15:57:13+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    public function purchase($request)
    {
        $result = new Result();
        try {
            $parm = $request->except(['s']);
            $key = sha1Url($request->url(),$parm);
            $purInfo = Cache::remember($key, config('admin.global.cache.time'), function () use($parm) {
                $purInfo = $this->pRepo->find($parm['id']);
                return $purInfo;
            });
            $purInfo->number = $purInfo->number - $purInfo->order()->count();
            $result->result = $purInfo->toArray();
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.purchase.index_error');
        }
        return $result->toJson();
    }
    /**
     *  [purchaseList 团购列表]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-15T15:43:52+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function purchaseList($request)
    {
        $result = new Result();
        try {
            $parm = $request->except(['s']);
            $key = sha1Url($request->url(),$parm);
            $purInfo = Cache::remember($key, config('admin.global.cache.time'), function () {
                return $this->pRepo->scopeQuery(function($query){
                    return $query->orderBy('id','desc')->limit(1);
                })->findWhere(['status'=>1],['id','name','price','thumb','startTime']);
            });
            $result->result = $purInfo;
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.purchase.index_error');
        }
        return $result->toJson();
    }
    /**
     *  [purchasePay 团购报名]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-15T16:07:43+0800
     *  @param    [type]                   $request [description]
     *  @return   [type]                            [description]
     */
    public function purchasePay($request)
    {
        $result = new Result();
        $data = $request->except(['s']);
        try {
            $data['orderType'] = 2;
            $data['orderNo'] = 'B'.buildOrderNo();
            $order = $this->oRepo->create($data);
            $result->result = $order->id;
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.purchase.index_error');
        }
        return $result->toJson();
    }
}