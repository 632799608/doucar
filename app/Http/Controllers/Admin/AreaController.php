<?php
/**
 *  全国各区域管理
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Aizxin\Services\Admin\AreaService;

class AreaController extends Controller
{
    protected $service;

	public function __construct(AreaService $service) {
		$this->service = $service;
	}
	/**
	 *  [index 获取全国各省市]
	 *  臭虫科技
	 *  @author qingfeng
	 *  @DateTime 2017-04-19T16:09:29+0800
	 *  @return   [type]                   [description]
	 */
	public function index()
	{
		return $this->service->index();
	}
}
