<?php
/**
 *  城市控制器
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Aizxin\Services\Admin\CityService;

class CityController extends Controller
{
    protected $service;

	public function __construct(CityService $service) {
		$this->service = $service;
	}
	/**
	 *  [index 城市列表]
	 *  臭虫科技
	 *  @author zzh
	 *  @DateTime 2017-04-18T15:38:31+0800
	 *  @return   [type]                   [description]
	 */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->index();
        }
        return view('admin.city.index');
    }
    /**
     *  [store 城市添加操作]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-18T15:51:43+0800
     *  @return   [type]                   [description]
     */
    public function store()
    {
       return $this->service->store();
    }
    /**
     *  [update 城市编辑操作]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-18T15:56:43+0800
     *  @return   [type]                   [description]
     */
    public function update(Request $request,$id)
    {
       return $this->service->update($request,$id);
    }
    /**
     *  [destroy 城市删除操作]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-18T15:57:34+0800
     *  @return   [type]                   [description]
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
    /**
     *  [edit 获取编辑的城市信息]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-21T14:39:43+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function edit($id)
    {
        return $this->service->edit($id);
    }
}
