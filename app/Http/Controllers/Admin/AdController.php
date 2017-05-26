<?php
/**
 *  广告控制器
 */
namespace App\Http\Controllers\Admin;

use Aizxin\Services\Admin\AdService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdController extends Controller
{
	protected $service;

	public function __construct(AdService $service) {
		$this->service = $service;
	}
	/**
	 *  [index 广告列表]
	 *  臭虫科技
	 *  @author zzh
	 *  @DateTime 2017-04-18T15:38:31+0800
	 *  @return   [type]                   [description]
	 */
    public function index(Request $request)
    {
    	if($request->ajax()){
            return $this->service->index();
        }
        return view('admin.ad.index');
    }
    /**
     *  [create 广告添加视图]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-18T15:50:00+0800
     *  @return   [type]                   [description]
     */
    public function create()
    {
        
    }
    /**
     *  [store 广告添加操作]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-18T15:51:43+0800
     *  @return   [type]                   [description]
     */
    public function store(Request $request)
    {
       return $this->service->store($request);
    }
    /**
     *  [edit 广告编辑视图]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-18T15:52:42+0800
     *  @return   [type]                   [description]
     */
    public function edit($id)
    {
        return $this->service->edit($id);
    }
    /**
     *  [update 广告编辑操作]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-18T15:56:43+0800
     *  @return   [type]                   [description]
     */
    public function update()
    {
       
    }
    /**
     *  [destroy 广告删除操作]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-04-18T15:57:34+0800
     *  @return   [type]                   [description]
     */
    public function destroy($id)
    {
       return $this->service->destroy($id);
    }

}
