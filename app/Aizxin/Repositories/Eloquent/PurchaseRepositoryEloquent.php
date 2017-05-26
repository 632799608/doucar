<?php

namespace Aizxin\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Aizxin\Repositories\Contracts\PurchaseRepository;
use Aizxin\Models\Purchase;
use Aizxin\Models\PurchaseGallery;
use DB;
use Aizxin\Tools\QiniuUpload;
/**
 *  团购接口实现
 */
class PurchaseRepositoryEloquent extends BaseRepository implements PurchaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Purchase::class;
    }
    /**
     *  [index 团购列表]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-05-05T14:28:15+0800
     *  @param    [type]                   $pageSize [description]
     *  @return   [type]                             [description]
     */
    public function index($pageSize)
    {
        return $this->orderBy('id','desc')
                ->with(['school'=>function($query){$query->select('id','name');}
                ])->paginate($pageSize)->toArray();
    }
    /**
     *  [cheatCreate 团购添加]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T15:58:27+0800
     *  @param    string                   $value [description]
     *  @return   [type]                          [description]
     */
    public function storePurchase($data)
    {  
        return $this->create($data);
    }
    /**
     *  [updateCoach 团购编辑]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T16:52:56+0800
     *  @param    [type]                   $data [description]
     *  @return   [type]                         [description]
     */
    public function updatePurchase($data,$id)
    {
        return $this->update($data,$id);
    }
     /**
      *  [multipleDestroy 批量团购删除]
      *  臭虫科技
      *  @author qingfeng
      *  @DateTime 2017-05-05T15:03:01+0800
      *  @param    [type]                   $ids [description]
      *  @return   [type]                        [description]
      */
    public function multipleDestroy($ids)
    {
        return DB::transaction(function () use($ids){
            $purchase = $this->findWhereIn('id',$ids);
            foreach ($purchase as $sv) {
                $path = explode(env('QINIU_DOMAINS_DEFAULT').'/', $sv->thumb);
                if(count($path) > 1){
                    $img[] = $path[1];
                }
            }
            if (count($img)) {
                (new QiniuUpload())->qiniuDeleteAll(array_filter($img));
            }
            $this->model->destroy($ids);   
        });
    }
    /**
     *  [elDelete 团购单个删除]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-05-02T19:41:24+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function elDelete($id)
    {
        return DB::transaction(function () use($id){
            $purchase = $this->find($id);
            $img = [];
            $path = explode(env('QINIU_DOMAINS_DEFAULT').'/', $purchase['thumb']);
            if(count($path) > 1){
                $img[] = $path[1];
            }
            if (count($img)) {
                (new QiniuUpload())->qiniuDeleteAll(array_filter($img));
            }
            $purchase->delete();
        });
    }
    /**
     *  [show 团购详情]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-04-28T17:01:11+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function show($id)
    {
        $purchase = $this->find($id,['schoolId','type','content','id']);
        return $purchase;
    }
    /**
     *  [edit 获取团购信息]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T17:03:58+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function edit($id)
    {
        return $this->with(['school'=>function($query){$query->select('id','name');}
            ])->find($id);    
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
}
