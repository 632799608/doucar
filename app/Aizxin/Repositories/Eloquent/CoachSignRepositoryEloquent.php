<?php

namespace Aizxin\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Aizxin\Repositories\Contracts\CoachSignRepository;
use Aizxin\Models\CoachSign;
use Prettus\Repository\Criteria\RequestCriteria;
use Aizxin\Tools\QiniuUpload;
/**
 *  教练签到签退接口实现
 */
class CoachSignRepositoryEloquent extends BaseRepository implements CoachSignRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CoachSign::class;
    }
    /**
     *  [coach 教练签到签退]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-12T14:27:42+0800
     *  @param    [type]                   $data [description]
     *  @param    [type]                   $pay  [description]
     *  @return   [type]                         [description]
     */
    public function coach($request)
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
        $thumb = $this->findWhereIn('id',$ids,['thumb']);
        $img = [];
        foreach ($thumb as $v) {
            $path = explode(env('QINIU_DOMAINS_DEFAULT').'/', $v->thumb);
            if(count($path) > 1){
                $img[] = $path[1];
            }
        }
        if (count($img)) {
            (new QiniuUpload())->qiniuDeleteAll(array_filter($img));
        }
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
        $thumb = $this->find($id,['thumb']);
        $path = explode(env('QINIU_DOMAINS_DEFAULT').'/', $thumb->thumb);
        if (count($path)>1) {
            (new QiniuUpload())->qiniuDelete($path[1]);
        }
        return $this->delete($id);
    }
    /**
     *  [coachSignRecord 获取教练签到记录]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-05-26T11:06:38+0800
     *  @param    [type]                   $memberId [description]
     *  @return   [type]                             [description]
     */
    public function coachSignRecord($phone)
    {
        $sign = $this->orderBy('created_at','desc')->with(['memberId'=>function($sql){
            $sql->select(['id','nickname','phone']);
        }])->findWhere(['phone'=>$phone,['created_at','like',date("Y-m-d")."%"]])->toArray();
        for ($i=0; $i < count($sign); $i++) {
            if ($i < count($sign) - 1) {
                $sign[$i]['distance'] = $sign[$i]['mileage']-$sign[$i+1]['mileage'];
            }
        }
        return $sign;
    }
}
