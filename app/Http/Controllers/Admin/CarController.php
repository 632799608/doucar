<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Aizxin\Services\Admin\CarService;

class CarController extends Controller
{

    protected $service;
    public function __construct(CarService $service)
    {
        $this->service = $service;
    }
    /**
     *  [index 车辆列表]
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
        $schoolList = $this->service->schoolList();
        return view('admin.car.index',compact('schoolList'));
    }
    /**
     *  [index 车辆详情]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-17T15:57:13+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    public function show($id)
    {

    }
    /**
     *  [store 车辆添加操作]
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
     *  [create 车辆视图]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-18T12:39:33+0800
     *  @return   [type]                   [description]
     */
    public function create()
    {
        $schoolList = $this->service->schoolList();
        return view('admin.car.create',compact('schoolList'));
    }
    /**
     *  [edit 车辆更新视图]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T17:05:25+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function edit($id)
    {

    }
    /**
     *  [update 车辆更新操作]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T17:46:13+0800
     *  @param    Request                  $request [description]
     *  @param    [type]                   $id      [description]
     *  @return   [type]                            [description]
     */
    public function update(Request $request)
    {
      
    }
    /**
     *  [destroy 车辆删除]
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
    /**
     *  [erwei 车辆二维码]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-24T10:03:38+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    public function erwei(Request $request)
    {
        return $this->service->erwei($request);
    }
}
