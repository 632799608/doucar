<?php

namespace Aizxin\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Aizxin\Repositories\Contracts\CheatRepository;
use Aizxin\Models\Cheat;
use Aizxin\Models\CheatGallery;
use Aizxin\Tools\QiniuUpload;

/**
 *  秘籍接口实现
 */
class CheatRepositoryEloquent extends BaseRepository implements CheatRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Cheat::class;
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
            $img = [];
            $cheat = $this->findWhereIn('id',$ids);
            foreach ($cheat as $v) {
                $gallery = $v->gallery()->get(['id','thumb']);
                foreach ($gallery as $vg) {
                    $path = explode(env('QINIU_DOMAINS_DEFAULT').'/', $vg->thumb);
                    if(count($path) > 1){
                        $img[] = $path[1];
                    }
                }
                $v->gallery()->delete();
            }
            if (count($img)) {
                (new QiniuUpload())->qiniuDeleteAll(array_filter($img));
            }
            $this->model->destroy($ids);
        });
    }
    /**
     *  [elDelete 秘籍删除]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-28T17:34:18+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function elDelete($id)
    {
        return \DB::transaction(function () use($id){
            $cheat = $this->find($id);
            $gallery = $cheat->gallery()->get(['id','thumb']);
            $img = [];
            foreach ($gallery as $v) {
                $path = explode(env('QINIU_DOMAINS_DEFAULT').'/', $v->thumb);
                if(count($path) > 1){
                    $img[] = $path[1];
                }
            }
            if (count($img)) {
                (new QiniuUpload())->qiniuDeleteAll(array_filter($img));
            }
            $cheat->gallery()->delete();
            $cheat->delete();
        });
    }
    /**
     *  [cheatCreate 秘籍添加]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T15:58:27+0800
     *  @param    string                   $value [description]
     *  @return   [type]                          [description]
     */
    public function cheatCreate($data,$thumb)
    {
        return \DB::transaction(function () use($data,$thumb){
            $data['thumb'] = count($thumb['thumb'])?$thumb['thumb'][0]:'';
            $cheat = $this->model->create($data);
            $gallery = array();
            if(count($thumb['thumb']) > 0){
                foreach ($thumb['thumb'] as $v) {
                    $gallery[] = new CheatGallery(['thumb' => $v]);
                }
                $cheat->gallery()->saveMany($gallery);
            }
        });
    }
    /**
     *  [index 秘籍index]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T16:52:56+0800
     *  @param    [type]                   $data [description]
     *  @return   [type]                         [description]
     */
    public function index($data)
    {
        return $this->model
            ->with(['category'=>function($query){
                $query->select('id','name');
            }])
            ->orderBy("id",'desc')
            ->paginate($data,['id','name','cheatCategoryId'])
            ->toArray();
    }
    /**
     *  [cheatUpdate 秘籍更新]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T17:50:34+0800
     *  @param    [type]                   $data  [description]
     *  @param    [type]                   $thumb [description]
     *  @param    [type]                   $id    [description]
     *  @return   [type]                          [description]
     */
    public function cheatUpdate($data,$thumb, $id)
    {
        return \DB::transaction(function () use($data,$thumb, $id){
            $data['thumb'] = count($thumb['thumb'])?$thumb['thumb'][0]:'';
            $cheat = $this->update($data,$id);
            $cheat->gallery()->delete();
            $gallery = array();
            if(count($thumb['thumb']) > 0){
                foreach ($thumb['thumb'] as $v) {
                    $gallery[] = new CheatGallery(['thumb' => $v]);
                }
                $cheat->gallery()->saveMany($gallery);
            }
        });
    }
}
