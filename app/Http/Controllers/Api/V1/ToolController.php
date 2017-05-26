<?php
namespace App\Http\Controllers\Api\V1;
use Aizxin\Tools\QiniuUpload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class ToolController extends Controller
{
    /**
     *  [uploadOne 图片上传]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2016-09-19T10:29:18+0800
     *  @return   [type]                   [description]
     */
      /**
     * @api {post} /api/v1/tool/upload.one 图片单图上传
     * @apiGroup Tool
     * @apiPermission token
     * @apiVersion 0.0.1
     * @apiParam {String} base64  图片base64编码
     * @apiParam {String} path  七牛上的文件夹
     * @apiSuccessExample {json} 响应成功:
     *     {
     *           "code": 200,
     *           "message": "上传成功",
     *           "result": {
     *               url:"http://xx.png"
     *           }
     *       }
     *@apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "返回失败"
     *      }
     */
    public function uploadOne(Request $request)
    {
        $path = $request->path;
        $img = (new QiniuUpload())->qiniuBase64($request->only('base64'),$path.'/');
            if($img == false){
                return respondApiErrors('上传图片错误',400);
            }
        return respondApiSuccess(['url'=>$img],'上传成功');
    }
    /**
     *  [uploadOne 图片上传]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2016-09-19T10:29:18+0800
     *  @return   [type]                   [description]
     */
      /**
     * @api {post} /api/v1/tool/upload.duo 图片多图上传
     * @apiGroup Tool
     * @apiPermission token
     * @apiVersion 0.0.1
     * @apiParam {Array} base64  图片base64编码(['base1','base2'])
     * @apiParam {String} path  七牛上的文件夹
     * @apiSuccessExample {json} 响应成功:
     *     {
     *           "code": 200,
     *           "message": "上传成功",
     *           "result": {
     *               url:"http://xx.png"
     *           }
     *       }
     *@apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "返回失败"
     *      }
     */
    public function uploadDuo(Request $request)
    {
        $imgPath = array();
        $base64 = $request->only('base64');
        $path = $request->path;
        for ($i=0; $i < count($base64); $i++) {
            $img = (new QiniuUpload())->qiniuBase64($base64[$i],$path.'/');
            if($img == false){
                return respondApiErrors('上传图片错误',400);
                break;
            }
            $imgPath[] = $img;
        }
        return respondApiSuccess($imgPath,'上传成功');
    }
    /**
     *  [uploadDelete description]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-02-24T14:47:30+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    /**
     * @api {post} /api/v1/tool/upload.delete 图片删除
     * @apiGroup Tool
     * @apiPermission token
     * @apiVersion 0.0.1
     * @apiParam {String} url  图片路径
     * @apiSuccessExample {json} 响应成功:
     *     {
     *           "code": 200,
     *           "message": "删除成功",
     *           "result": null
     *       }
     *@apiErrorExample {json} 响应失败:
     *     {
     *           "code": 400,
     *           "message": "删除错误"
     *      }
     */
    public function uploadDelete(Request $request)
    {
        $url = $request->url;
        if(strpos($url, env('QINIU_DOMAINS_DEFAULT')) !== false){
            $path = explode(env('QINIU_DOMAINS_DEFAULT').'/', $url);
            if((new QiniuUpload())->qiniuDelete($path[1])){
                return respondApiSuccess(null,'删除成功');
            }
            return respondApiErrors('删除错误',400);
        }
    }
}
