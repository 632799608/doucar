<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Aizxin\Services\Admin\CheatCategoryService;

class CheatCategoryController extends Controller
{

    protected $service;

    public function __construct(CheatCategoryService $service)
    {
        $this->service = $service;
    }
    /**
     *  [index 秘籍列表]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-17T15:57:13+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    public function index(Request $request)
    {
        return view('admin.cheat.category.index');
    }
    /**
     *  [store 秘籍添加操作]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-18T11:59:00+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    public function store(Request $request)
    {
        return $this->service->store($request);
    }
    /**
     *  [create 秘籍视图、获取秘籍]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-18T12:39:33+0800
     *  @return   [type]                   [description]
     */
    public function create()
    {
        return $this->service->index();
    }
    /**
     *  [destroy 秘籍删除]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-19T11:14:41+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
