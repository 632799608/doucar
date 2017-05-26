<?php

namespace Aizxin\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Aizxin\Repositories\Contracts\SchoolRepository;
use Aizxin\Models\School;
use Aizxin\Models\SchoolGallery;
use Aizxin\Models\SchoolType;
use DB;
use Aizxin\Tools\QiniuUpload;
/**
 *  驾校接口实现
 */
class SchoolRepositoryEloquent extends BaseRepository implements SchoolRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return School::class;
    }
    /**
     *  [cheatCreate 驾校添加]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T15:58:27+0800
     *  @param    string                   $value [description]
     *  @return   [type]                          [description]
     */
    public function storeSchool($data,$schoolgalley,$schoolPrice)
    {  
        $school = $data;
        $school['thumb'] = $schoolgalley[0];
        $school['status'] = 0;
        return DB::transaction(function () use($school,$schoolgalley,$schoolPrice){
            $scho = $this->create($school);
            $gallery = [];
            $price = [];
            foreach ($schoolgalley as $v) {
                $gallery[] = new SchoolGallery(['gallery' => $v]);
            }
            foreach ($schoolPrice as $v) {
                $price[] = new SchoolType([
                    'type'=>$v['type'],
                    'price'=>$v['price']
                ]);
            }
            $scho->gallery()->saveMany($gallery);
            $scho->price()->saveMany($price);
        });
    }
    /**
     *  [index 驾校index]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T16:52:56+0800
     *  @param    [type]                   $data [description]
     *  @return   [type]                         [description]
     */
    public function updateSchool($data,$schoolgalley,$schoolPrice,$id)
    {
        $school = $data;
        $school['thumb'] = $schoolgalley[0];
        $school['status'] = 0;
        return DB::transaction(function () use($school,$schoolgalley,$schoolPrice,$id){
            $scho = $this->find($id);
            $scho->price()->delete();
            $scho->gallery()->delete();
            $this->update($school,$id);
            $gallery = [];
            $price = [];
            foreach ($schoolgalley as $v) {
                $gallery[] = new SchoolGallery(['gallery' => $v]);
            }
            foreach ($schoolPrice as $v) {
                $price[] = new SchoolType([
                    'type'=>$v['type'],
                    'price'=>$v['price']
                ]);
            }
            $scho->gallery()->saveMany($gallery);
            $scho->price()->saveMany($price);
        });
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
                ->with(['areaProvince'=>function($query){
                    $query->select('id','name');
                },'areaCity'=>function($query){
                    $query->select('id','name');
                }])->paginate($pageSize,['id','name','phone','address','province','city','thumb','status'])->toArray();
    }
    /**
     *  [multipleDestroy 秘籍更新]
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
        return DB::transaction(function () use($ids){
            $school = $this->findWhereIn('id',$ids);
            foreach ($school as $sv) {
                $gallery = $sv->gallery()->get(['id','gallery']);
                foreach ($gallery as $v) {
                    $path = explode(env('QINIU_DOMAINS_DEFAULT').'/', $v->gallery);
                    if(count($path) > 1){
                        $img[] = $path[1];
                    }
                }
                $sv->gallery()->delete();
                $sv->price()->delete();
            }
            if (count($img)) {
                (new QiniuUpload())->qiniuDeleteAll(array_filter($img));
            }
            $this->model->destroy($ids);   
        });
    }
    /**
     *  [elDelete 驾校删除]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-05-02T19:41:24+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function elDelete($id)
    {
        return DB::transaction(function () use($id){
            $school = $this->find($id);
            $gallery = $school->gallery()->get(['id','gallery']);
            $img = [];
            foreach ($gallery as $v) {
                $path = explode(env('QINIU_DOMAINS_DEFAULT').'/', $v->gallery);
                if(count($path) > 1){
                    $img[] = $path[1];
                }
            }
            if (count($img)) {
                (new QiniuUpload())->qiniuDeleteAll(array_filter($img));
            }
            $school->gallery()->delete();
            $school->price()->delete();
            $school->delete();
        });
    }
    /**
     *  [show 驾校详情]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-04-28T17:01:11+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function show($id)
    {
        $school = $this->find($id,['overview','description','id','name']);
        $school->gallery = $school->gallery()->get(['id','gallery']);
        $school->price = $school->price()->get(['id','type','price']);
        return $school;
    }
    /**
     *  [edit 获取驾校信息]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-05-02T11:00:53+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function edit($id)
    {
        return $this->with([
            'areaProvince'=>function($query){$query->select('id','name');},
            'areaCity'=>function($query){$query->select('id','name');},
            'gallery'=>function($query){$query->select('schoolId','gallery');},
            'price'=>function($query){$query->select('schoolId','type','price');}
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
    /**
     *  [schoollist 驾校列表]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-05-03T14:30:34+0800
     *  @return   [type]                   [description]
     */
    public function schoollist()
    {
        return $this->with([
            'price'=>function($sql){
                $sql->select('id','schoolId','type');},
            'coach'=>function($sql){
                $sql->select('id','schoolId','name');}
            ])->all(['id','name']);
    }
    /**
     *  [schoollist 驾校列表]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-05-03T14:30:34+0800
     *  @return   [type]                   [description]
     */
    public function schoollistApi()
    {
        $list = $this->model->with(['price'=>function($sql){
            $sql->select(['id','type','price','schoolId'])->get();
        }])->where(['status'=>1])->get(['id','name','address','thumb']);
        for ($i=0; $i < count($list); $i++) {
            $star = $list[$i]->comment()->avg('star');
            $list[$i]->score = $star > 0 ? round($star ,2) : 5;
        }
        return $list->toArray();
    }
    /**
     *  [schoolApi 驾校详情]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-10T15:49:51+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function schoolApi($id)
    {
        $school = $this->find($id,['id','name','thumb','description','phone','address']);
        $school->comment = $school->comment()->with(['member'=>function($query){
            $query->select(['id','nickname','avatar']);
        }])->get(['id','comment','star','created_at','memberId']);
        $school->gallery = $school->gallery()->get(['id','gallery']);
        $school->price = $school->price()->get(['id','type','price']);
        $school->coach = $school->coach()->get(['id','name','avatar']);
        for ($i=0; $i < count($school->coach); $i++) {
            $star = $school->coach[$i]->comment()->avg('star');
            $school->coach[$i]->score = $star > 0 ? round($star ,2) : 5;
        }
        return $school->toArray();
    }
}
