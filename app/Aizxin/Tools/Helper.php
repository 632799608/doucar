<?php
/**
 *  递归迭代无限级分类
 */
if (! function_exists('sort_parent')) {
    /**
     *  [sort_parent description]
     */
    function sort_parent($menus,$pid=0)
    {
        $arr = [];
        if (empty($menus)) {
            return '';
        }
        foreach ($menus as $key => $v) {
            if ($v['parent_id'] == $pid) {
                $v['child'] = sort_parent($menus,$v['id']);
                $arr[] = $v;
            }
        }
        return $arr;
    }
}
/**
 *  递归迭代无限级分类
 */
if (! function_exists('area_sort_parent')) {
    /**
     *  [area_sort_parent description]
     */
    function area_sort_parent($menus,$pid=0)
    {
        $arr = [];
        if (empty($menus)) {
            return '';
        }
        foreach ($menus as $key => $v) {
            if ($v['parent_id'] == $pid) {
                $v['children'] = area_sort_parent($menus,$v['code']);
                $arr[] = $v;
            }
        }
        return $arr;
    }
}
/**
 *  aizxin_paginate
 */
if (! function_exists('aizxin_paginate')) {
    /**
     *  [aizxin_paginate description]
     */
    function aizxin_paginate($results)
    {
        $response = [
            'pagination' => [
                'total' => $results['total'],
                'per_page' => $results['per_page'],
                'current_page' => $results['current_page'],
                'last_page' => $results['last_page'],
                'from' => $results['from'],
                'to' => $results['to']
            ],
            'data' => $results['data']
        ];
        return $response;
    }
}
/**
 *  qiniu_by_curl
 */
if (! function_exists('qiniu_by_curl')) {
    /**
     *  [qiniu_by_curl description]
     */
    function qiniu_by_curl($remote_server,$post_string,$upToken) {
        $headers = array();
        $headers[] = 'Content-Type:image/png';
        $headers[] = 'Authorization:UpToken '.$upToken;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$remote_server);
        //curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER ,$headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}
/**
 * 响应成功
 * @param string $message
 * @return \Illuminate\Http\Response
 */
if (! function_exists('respondWithSuccess')) {
    /**
     *  [qiniu_by_curl description]
     */
    function respondWithSuccess($data, $message = '', $code = 200, $status = 'success')
    {
        return response()->json([
            'status' => $status,
            'code' => $code,
            'message' => $message,
            'result' => $data,
        ]);
    }
}
/**
 * 响应成功
 * @param string $message
 * @return \Illuminate\Http\Response
 */
if (! function_exists('respondApiSuccess')) {
    /**
     *  [qiniu_by_curl description]
     */
    function respondApiSuccess($data, $message = '', $code = 200)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'result' => $data,
        ]);
    }
}
/**
 * 响应错误
 * @param string $message
 * @param int $code
 * @param string $status
 * @return Response
 */
if (! function_exists('respondWithErrors')) {

    function respondWithErrors($message = '', $code = 422, $status = 'error')
    {
        return response()->json([
            'status' => $status,
            'code' => $code,
            'message' => $message,
        ]);
    }
}
/**
 * 响应错误
 * @param string $message
 * @param int $code
 * @param string $status
 * @return Response
 */
if (! function_exists('respondApiErrors')) {

    function respondApiErrors($message = '', $code = 422)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
        ]);
    }
}
/**
 * 响应所有的validation验证错误
 * @param  \Illuminate\Validation\Validator $validator the validator that failed to pass
 * @return \Illuminate\Http\Response the Aizxinropriate response containing the error message
 */
if (! function_exists('respondWithFailedValidation')) {

    function respondWithFailedValidation(\Illuminate\Validation\Validator $validator)
    {
        return respondWithErrors($validator->messages()->first(), 422);
    }
}
/** 时间校验 */
if (! function_exists('checkTime')) {

    function checkTime($time)
    {
        // strtotime($time)
        $Time_difference = abs(time()-$time);
        if($Time_difference > env('API_OUTTIME',30)){
           return false;
        }
        return true;
    }
}
/**
 * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
 * @param $para 需要拼接的数组
 * return 拼接完成以后的字符串
 */
if (! function_exists('createLinkstring')) {
    function createLinkstring($para) {
        $para = argSort($para);
        $arg  = "";
        while (list ($key, $val) = each ($para)) {
            $arg.=$key."=".characet($val,"UTF-8")."&";
        }
        //去掉最后一个&字符
        $arg = substr($arg,0,count($arg)-2);

        //如果存在转义字符，那么去掉转义
        if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}

        return $arg;
    }
}
/**
 * 对数组排序
 * @param $para 排序前的数组
 * return 排序后的数组
 */
if (! function_exists('argSort')) {
    function argSort($para) {
        ksort($para);
        reset($para);
        return $para;
    }
}
/**
 *  缓存加密的key
 */
if(! function_exists('sha1Url')){
    function sha1Url($url,$queryParams){
        ksort($queryParams);
        $queryString = http_build_query($queryParams);
        $fullUrl = "{$url}?{$queryString}";
        return sha1($fullUrl);
    }
}
/**
 * 生成唯一订单号
 * @author chouchong
 */
if (! function_exists('buildOrderNo')) {
    function buildOrderNo(){
        return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }
}

/**
 * 转换字符集编码
 * @param $data
 * @param $targetCharset
 * @return string
 */
if (! function_exists('characet')) {
    function characet($data, $targetCharset) {
        if (!empty($data)) {
            $fileType = "UTF-8";
            if (strcasecmp($fileType, $targetCharset) != 0) {
                $data = mb_convert_encoding($data, $targetCharset, $fileType);
            }
        }
        return $data;
    }
}


