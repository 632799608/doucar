<?php
namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Aizxin\Services\Api\CheatService;

class CheatController extends Controller
{

    protected $service;

    public function __construct(CheatService $service)
    {
        $this->service = $service;
    }
    /**
     *  [category 秘籍分类]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-09T11:53:55+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/cheat/category.api 秘籍分类
     * @apiVersion 0.0.1
     * @apiPermission 签名
     * @apiGroup Cheat
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": [{
     *               'id':'1',
     *               'name':'XX',
     *               'child':[
     *                   {
     *                   'id':'1'
     *                   'name':'XX'
     *                   }
     *                   ...
     *               ]
     *           }
     *           ...
     *           ]
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXx"
     *      }
     */
    public function category(Request $request)
    {
        return $this->service->category($request);
    }
    /**
     *  [categoryCheat 秘籍分类下的秘籍]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-17T15:57:13+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/cheat/categoryCheat.api 秘籍分类下的秘籍
     * @apiVersion 0.0.1
     * @apiPermission 签名
     * @apiGroup Cheat
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": [{
     *               'id':'1',
     *               'name':'XX',
     *               'child':[
     *                   {
     *                   'id':'1'
     *                   'name':'XX'
     *                   }
     *                   ...
     *               ]
     *               'cheat':[{
     *                   'id':'1',
     *                   'name':'xxx',
     *                   ...,
     *                   gallery:[{
     *                       id:'1',
     *                       'thumb':url
     *                       ...
     *                   }]
     *               }]
     *           }
     *           ...
     *           ]
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXx"
     *      }
     */
    public function categoryCheat(Request $request)
    {
        return $this->service->categoryCheat($request);
    }
    /**
     *  [categoryCheatOne 获取某一个分类下的秘籍]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-09T11:52:17+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/cheat/categoryCheatOne.api 获取某一个分类下的秘籍
     * @apiVersion 0.0.1
     * @apiPermission 签名
     * @apiParam {Int} id 秘籍分类Id
     * @apiGroup Cheat
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": [{
     *               'id':'1',
     *               'name':'XX',
     *               'cheat':[{
     *                   'id':'1',
     *                   'name':'xxx',
     *                   ...,
     *                   gallery:[{
     *                       id:'1',
     *                       'thumb':url
     *                       ...
     *                   }]
     *               }]
     *           }
     *           ...
     *           ]
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXx"
     *      }
     */
    public function categoryCheatOne(Request $request)
    {
        return $this->service->categoryCheatOne($request);
    }
    /**
     *  [cheat 秘籍详情]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-09T11:53:19+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/cheat/cheat.api 秘籍详情
     * @apiVersion 0.0.1
     * @apiPermission 签名
     * @apiGroup Cheat
     * @apiParam {Int} id 秘籍Id
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": {
     *               'id':'1',
     *               'name':'XX',
     *               'gallery':[{
     *                   'id':'1',
     *                   'thumb':url
     *               }]
     *           }
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXx"
     *      }
     */
    public function cheat(Request $request)
    {
        return $this->service->cheat($request);
    }
}
