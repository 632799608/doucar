<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Aizxin\Services\Admin\CheatService;

class CheatController extends Controller
{

    protected $service;

    public function __construct(CheatService $service)
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
        if($request->ajax()){
            return $this->service->index();
        }
        return view('admin.cheat.cheat.index');
    }
    /**
     *  [show 秘籍详情]
     *  chouchong.com
     *  @author Sow
     *  @DateTime 2017-04-22T17:38:35+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function show($id)
    {

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
        $category = $this->service->cheatCategory();
        return view('admin.cheat.cheat.create',compact('category'));
    }
    /**
     *  [edit 秘籍更新视图]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T17:05:25+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function edit($id)
    {
        $category = $this->service->cheatCategory();
        $cheat = $this->service->edit($id);
        return view('admin.cheat.cheat.edit',compact('category','cheat'));
    }
    /**
     *  [update 秘籍更新操作]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T17:46:13+0800
     *  @param    Request                  $request [description]
     *  @param    [type]                   $id      [description]
     *  @return   [type]                            [description]
     */
    public function update(Request $request, $id)
    {
        return $this->service->update($request,$id);
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
