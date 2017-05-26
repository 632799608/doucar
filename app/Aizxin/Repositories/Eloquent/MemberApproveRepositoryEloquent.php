<?php

namespace Aizxin\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Aizxin\Repositories\Contracts\MemberApproveRepository;
use Aizxin\Models\MemberApprove;
/**
 *  学员登记接口实现
 */
class MemberApproveRepositoryEloquent extends BaseRepository implements MemberApproveRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MemberApprove::class;
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
                    'member'=>function($query){$query->select('id','nickname');},
                    'province'=>function($query){$query->select('id','name');},
                    'city'=>function($query){$query->select('id','name');}
                ])->paginate($pageSize)->toArray();
    }
        /**
     *  [multipleDestroy 登记批量删除]
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
        return $this->model->destroy($ids);
    }
    /**
     *  [elDelete 删除单个登记]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-05-02T19:41:24+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function elDelete($id)
    {
        return $this->delete($id);
    }
    /**
     *  [memberApprove 学员登记详情]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-11T17:21:30+0800
     *  @param    [type]                   $memberid [description]
     *  @return   [type]                             [description]
     */
    public function memberApprove($memberId)
    {
        $data = $this->model->with(['province'=>function($sql){
            $sql->select('id','name');
        },'city'=>function($sql){
            $sql->select('id','name');
        },'district'=>function($sql){
            $sql->select('id','name');
        }])->where(['memberId'=>$memberId])->first();
        return $data->toArray();
    }
}
