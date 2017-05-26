<?php

namespace Aizxin\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Aizxin\Repositories\Contracts\CoachApproveRepository;
use Aizxin\Models\CoachApprove;
use Aizxin\Tools\QiniuUpload;
/**
 *  教练认证接口实现
 */
class CoachApproveRepositoryEloquent extends BaseRepository implements CoachApproveRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CoachApprove::class;
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
        $data = $this->orderBy('id','desc')->with(['member'=>function($query){
            $query->select('id','nickname');
        }])->paginate($pageSize)->toArray();
        foreach ($data['data'] as $k => $v) {
            $data['data'][$k]['thumb'] = explode(',', $v['thumb']);
        }
        return $data;
    }
        /**
     *  [multipleDestroy 认证批量删除]
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
        $approve = $this->findWhereIn('id',$ids);
        foreach ($approve as $v) {
            $galley = explode(',', $v['thumb']);
            foreach ($galley as $key => $value) {
                $path = explode(env('QINIU_DOMAINS_DEFAULT').'/', $value);
                if(count($path) > 1){
                    $img[] = $path[1];
                }
            }
        }
        if (count($img)) {
            (new QiniuUpload())->qiniuDeleteAll(array_filter($img));
        }
        return $this->model->destroy($ids);
    }
    /**
     *  [elDelete 删除单个认证]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-05-02T19:41:24+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function elDelete($id)
    {
        $approve = $this->find($id);
        $galley = explode(',', $approve['thumb']);
        foreach ($galley as $key => $value) {
            $path = explode(env('QINIU_DOMAINS_DEFAULT').'/', $value);
            if(count($path) > 1){
                $img[] = $path[1];
            }
        }
        if (count($img)) {
            (new QiniuUpload())->qiniuDeleteAll(array_filter($img));
        }
        return $this->delete($id);
    }
}
