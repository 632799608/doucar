<?php

namespace Aizxin\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Aizxin\Repositories\Contracts\AdRepository;
use Aizxin\Models\Ad;
use Aizxin\Tools\QiniuUpload;
/**
 *  接口实现
 */
class AdRepositoryEloquent extends BaseRepository implements AdRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Ad::class;
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
        return \DB::transaction(function () use($ids){
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
            $this->model->destroy($ids);
        });
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
        return \DB::transaction(function () use($id){
            $thumb = $this->find($id,['thumb']);
            $path = explode(env('QINIU_DOMAINS_DEFAULT').'/', $thumb->thumb);
            if (count($path)>1) {
                (new QiniuUpload())->qiniuDelete($path[1]);
            }
            $this->model->destroy($id);
        });
    }
}
