<?php

namespace Aizxin\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Aizxin\Repositories\Contracts\MemberSignRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Aizxin\Models\MemberSign;
/**
 *  学员签到签退接口实现
 */
class MemberSignRepositoryEloquent extends BaseRepository implements MemberSignRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MemberSign::class;
    }
    /**
     *  [member 会员签到签退]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-12T14:27:42+0800
     *  @param    [type]                   $data [description]
     *  @param    [type]                   $pay  [description]
     *  @return   [type]                         [description]
     */
    public function member($request)
    {
        return $this->create($request->all());
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
     *  [multipleDestroy 批量删除]
     *  chouchong.com
     *  @author Sow
     *  @DateTime 2017-04-03T13:05:29+0800
     *  @param    [type]                   $ids [数组]
     *  @return   [type]                        [ture/false]
     */
    public function multipleDestroy($ids)
    {
        return $this->model->destroy($ids);
    }
    /**
     *  [elDelete 单个删除]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-04-25T15:07:32+0800
     *  @param    string                   $value [description]
     *  @return   [type]                          [description]
     */
    public function elDelete($id)
    {
        return $this->delete($id);
    }
    /**
     *  [memberSignRecord 获取学员签到记录]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-05-26T11:06:38+0800
     *  @param    [type]                   $memberId [description]
     *  @return   [type]                             [description]
     */
    public function memberSignRecord($phone)
    {
        $sign = $this->orderBy('created_at','desc')->with(['memberId'=>function($sql){
            $sql->select(['id','nickname','phone']);
        }])->findWhere(['phone'=>$phone,['created_at','like',date("Y-m-d")."%"]])->toArray();
        return $sign;
    }
}
