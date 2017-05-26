<?php

namespace Aizxin\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Aizxin\Repositories\Contracts\OrderRepository;
use Aizxin\Models\Order;
use Prettus\Repository\Criteria\RequestCriteria;
/**
 *  订单接口实现
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }
    /**
     *  [index description]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-04-21T11:50:51+0800
     *  @param    string                   $value [description]
     *  @return   [type]                          [description]
     */
    public function index($pageSize)
    {
        return $this->orderBy('id','desc')
                ->with([
                	'purchase'=>function($query){$query->select('id','name');},
                	'member'=>function($query){$query->select('id','nickname');},
                	'pay'=>function($query){$query->select('id','orderId','orderNo','money','payType','created_at');}
                ])->paginate($pageSize)->toArray();
    }
    /**
     *  [boot 加载搜索功能]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-04-26T18:06:00+0800
     *  @return   [type]                   [description]
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
        /**
     *  [multipleDestroy 评论批量删除]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T17:50:34+0800
     *  @param    [type]                   $data  [description]
     *  @param    [type]                   $thumb [description]
     *  @param    [type]                   $id    [description]
     *  @return   [type]                          [description]
     */
    public function multipleDestroy($ids)
    {
        return \DB::transaction(function () use($ids){
        	foreach ($ids as $k => $v) {
        		$order = $this->find($v);
	        	$order->delete();
	        	$order->pay()->delete();
        	}
        });
    }
    /**
     *  [elDelete 删除单个评论]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-05-02T19:41:24+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function elDelete($id)
    {
        return \DB::transaction(function () use($id){
        	$order = $this->find($id);
        	$order->delete();
        	$order->pay()->delete();
        });
    }
    /**
     *  [memberRelation 学员关联的驾校教练]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-12T16:36:39+0800
     *  @return   [type]                   [description]
     */
    public function memberRelation($memberId)
    {
        $list = $this->with([
            'apply'=>function($sql) use ($memberId){
                $sql->select(['id','schoolId','coachId'])->with([
                  'school'=>function($query) use ($memberId){
                    $query->with(['comment'=>function($sqll) use ($memberId){
                        $sqll->where(['memberId'=>$memberId]);
                    }])->select(['id','name','address','thumb']);
                },'coach'=>function($query) use ($memberId){
                    $query->select(['id','name','avatar','schoolId'])->with(['school'=>function($sqll){
                        $sqll->select(['id','name']);
                    },'comment'=>function($sqll) use ($memberId){
                        $sqll->where(['memberId'=>$memberId]);
                    }]);
                }]);
            },
            'purchase'=>function($sql) use ($memberId){
                $sql->select(['id','schoolId'])->with([
                  'school'=>function($query) use ($memberId){
                    $query->with(['comment'=>function($sqll) use ($memberId){
                        $sqll->where(['memberId'=>$memberId]);
                    }])->select(['id','name','address','thumb']);
                }]);
            }
        ])->findWhere(['memberId'=>$memberId,['status','>',0]],['id','memberApplyId','purchaseId','memberId']);
        return  $list;
    }
}
