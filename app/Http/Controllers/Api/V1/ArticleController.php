<?php
namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Aizxin\Services\Api\ArticleService;

class ArticleController extends Controller
{

    protected $service;

    public function __construct(ArticleService $service)
    {
        $this->service = $service;
    }
    /**
     *  [store 数据添加接口]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-08T11:15:46+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/article/categoryArticle.api 全部分类下的所有文章
     * @apiVersion 0.0.1
     * @apiGroup Article
     * @apiPermission 签名
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": [{
     *               'id':'1',
     *               'name':'XX',
     *               'article':[
     *                   {
     *                   'id':'1'
     *                   'title':'XX'
     *                   'content':'XX'
     *                   'thumb':'图片'
     *                   }
     *                   ...
     *               ]
     *           }]
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXx"
     *      }
     */
    public function categoryArticle(Request $request)
    {
        return $this->service->articleCategoryList($request);
    }
    /**
     *  [caOne 某一个分类下的文章]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-08T17:17:33+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/article/categoryOne.api 分类下的所有文章
     * @apiVersion 0.0.1
     * @apiGroup Article
     * @apiPermission 签名
     * @apiParam {Int} id 分类Id
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": {
     *               'id':'1',
     *               'name':'XX',
     *               'article':[
     *                   {
     *                   'id':'1'
     *                   'title':'XX'
     *                   'content':'XX'
     *                   'thumb':'图片'
     *                   }
     *                   ...
     *               ]
     *           }
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXx"
     *      }
     */
    public function categoryOne(Request $request)
    {
        return $this->service->articleCategoryById($request);
    }
    /**
     *  [findById 文章详情]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-08T17:19:14+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/article/articleOne.api 文章详情
     * @apiVersion 0.0.1
     * @apiGroup Article
     * @apiPermission 签名
     * @apiParam {Int} id 文章Id
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": {
     *               'id':'1'
     *               'title':'XX'
     *               'content':'XX'
     *               'thumb':'图片'
     *               'category':[
     *                   {
     *                       'id':'1',
     *                       'name':'XX',
     *                   }
     *                   ...
     *               ]
     *           }
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "XXx"
     *      }
     */
    public function articleOne(Request $request)
    {
        return $this->service->articleOne($request);
    }
}
