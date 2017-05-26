<?php
namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Aizxin\Services\Api\QuestionService;

class QuestionController extends Controller
{

    protected $service;

    public function __construct(QuestionService $service)
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
     * @api {post} /api/v1/question/question.store 试题添加
     * @apiVersion 0.0.1
     * @apiPermission 签名
     * @apiGroup Question
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "添加成功",
     *           "result": {
     *               'questionCategoryId':'关联分类表id',
     *               'name':'试题名称',
     *               'analysis':'答案解析',
     *               'questionType':'1:单选题,2:判断题,3:多选题',
     *               'courseType':'1:科目1,4：科目4',
     *               'difficulty':'难度系数',
     *               'thumb':'图片路径',
     *               'answer':[
     *                   {
     *                   'type':'0:文字答案，1:图片答案'
     *                   'isAnswer':'0:不是正确答案,1:正确答案'
     *                   'content':'答案内容'
     *                   'thumb':'图片'
     *                   }
     *                   ...
     *               ]
     *           }
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "添加失败"
     *      }
     */
    public function store(Request $request)
    {
        return $this->service->apiCreateQuestion($request);
    }
    /**
     *  [category 试题分类]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-09T12:25:23+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/question/category.api 试题分类
     * @apiVersion 0.0.1
     * @apiPermission 签名
     * @apiGroup Question
     * @apiParam {Int} type 分类类型(1:科目一,4:科目四)
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": [{
     *               'id':'1',
     *               'name':'XX',
     *               'question_count':'试题总数'
     *                }
     *                ...
     *           ]
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "添加失败"
     *      }
     */
    public function category(Request $request)
    {
        return $this->service->category($request);
    }
    /**
     *  [categoryQuestion 分类下的试题]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-09T12:49:54+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/question/categoryQuestion.api 分类下的试题
     * @apiVersion 0.0.1
     * @apiGroup Question
     * @apiPermission 签名
     * @apiParam {Int} id 分类Id
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": {
     *               'id':'1',
     *               'name':'XX',
     *               'question':[{
     *                   'questionCategoryId':'关联分类表id',
     *                   'name':'试题名称',
     *                   'analysis':'答案解析',
     *                   'questionType':'1:单选题,2:判断题,3:多选题',
     *                   'courseType':'1:科目1,4：科目4',
     *                   'difficulty':'难度系数',
     *                   'thumb':'图片路径',
     *                   'answer':[
     *                       {
     *                       'type':'0:文字答案，1:图片答案'
     *                       'isAnswer':'0:不是正确答案,1:正确答案'
     *                       'content':'答案内容'
     *                       'thumb':'图片'
     *                       }
     *                        ...
     *                        ]
     *               }
     *               ...
     *               ]
     *           }
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "添加失败"
     *      }
     */
    public function categoryQuestion(Request $request)
    {
        return $this->service->categoryQuestion($request);
    }
    /**
     *  [question 试题详情]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-09T12:54:48+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/question/question.api 试题详情
     * @apiVersion 0.0.1
     * @apiGroup Question
     * @apiPermission 签名
     * @apiParam {Int} id 试题id
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": {
     *               'id':'11',
     *               'questionCategoryId':'关联分类表id',
     *               'name':'试题名称',
     *               'analysis':'答案解析',
     *               'questionType':'1:单选题,2:判断题,3:多选题',
     *               'courseType':'1:科目1,4：科目4',
     *               'difficulty':'难度系数',
     *               'thumb':'图片路径',
     *               'answer':[
     *                   {
     *                   'type':'0:文字答案，1:图片答案'
     *                   'isAnswer':'0:不是正确答案,1:正确答案'
     *                   'content':'答案内容'
     *                   'thumb':'图片'
     *                   }
     *                   ...
     *               ]
     *           }
     *       }
     * @apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "添加失败"
     *      }
     */
    public function question(Request $request)
    {
        return $this->service->question($request);
    }
    /**
     *  [questionList 试题列表]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-09T12:55:23+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/question/questionList.api 试题列表
     * @apiVersion 0.0.1
     * @apiGroup Question
     * @apiPermission 签名
     * @apiParam {Int} courseType 试题类型('1:科目1,4：科目4'),
     * @apiSuccessExample {json} 成功响应:
     *     {
     *           "code": 200,
     *           "message": "XXX",
     *           "result": [{
     *               'id':'11',
     *               'questionCategoryId':'关联分类表id',
     *               'name':'试题名称',
     *               'analysis':'答案解析',
     *               'questionType':'1:单选题,2:判断题,3:多选题',
     *               'courseType':'1:科目1,4：科目4',
     *               'difficulty':'难度系数',
     *               'thumb':'图片路径',
     *               'answer':[
     *                   {
     *                   'type':'0:文字答案，1:图片答案'
     *                   'isAnswer':'0:不是正确答案,1:正确答案'
     *                   'content':'答案内容'
     *                   'thumb':'图片'
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
     *           "message": "添加失败"
     *      }
     */
    public function questionList(Request $request)
    {
        return $this->service->questionList($request);
    }
}
