@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('back/plugin/wangEditor/css/wangEditor.min.css') }}">
<style type="text/css" media="screen">
    #purchase-content{
        width: 100%;
        height: 250px;
    }
    .layui-input-block {
        margin-left: 130px;
        min-height: 36px;
    }
    .wangEditor-fullscreen {
        position: fixed;
        top: 60px;
        left: 200px;
        bottom: 82px;
    }
    @media screen and (min-width: 750px){
        .content-purchase{
            width:50%
        }
    }
    .ana-label{
        text-align: center;
        border-bottom: 1px solid;
    }
    .layui-icon-color{
        color: red;
        font-size: 25px
    }
    #LAY_demo_upload_add{
        width: 250px;
        height: 150px;
    }
    .i-delete{
        color: red;
    }
</style>
@endsection
@section('content')
@inject('menuPresenter','Aizxin\Presenters\MenuPresenter')
<div class="layui-body site-demo" id="purchaseadd">
    <div class="layui-tab-content" style="padding: 50px;">
        <section class="panel panel-padding">
            <div class="group-button">
                <span class="layui-btn layui-btn-small layui-btn-primary ajax-all">
                   {!!trans('admin/purchase.edit')!!}
                </span>
            </div>
            <form class="layui-form" style="padding: 17px;">
                <input type="hidden" name="id" id="purchaseId" value="{{$purchase->id}}">
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/purchase.model.school')!!}</label>
                    <div class="layui-input-inline">
                      <select name="schoolId" lay-verify="required" lay-filter="schoolIdEdit">
                          <option value="">{!!trans('admin/purchase.select')!!}</option>
                          @foreach($schoolList as $vo)
                          <option value="{{$vo->id}}" 
                            @if($vo->id === $purchase->schoolId)
                                selected="selected"
                            @endif>{{$vo->name}}
                          </option>
                          @endforeach
                      </select>
                    </div>
                    <div class="layui-input-inline" id="school-type">
                    <!-- 驾校的驾照类型容器 -->
                        <select name="type" lay-verify="required" lay-filter="type">
                            <option value="0">驾照类型</option>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/purchase.model.title')!!}</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="{!!trans('admin/purchase.placeholder.title')!!}" class="layui-input" value="{{$purchase->name}}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/purchase.model.price')!!}</label>
                    <div class="layui-input-inline">
                        <input type="number" name="price" lay-verify="required" autocomplete="off" placeholder="{!!trans('admin/purchase.placeholder.price')!!}" class="layui-input" value="{{$purchase->price}}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/purchase.model.number')!!}</label>
                    <div class="layui-input-inline">
                        <input type="number" name="number" lay-verify="required" autocomplete="off" placeholder="{!!trans('admin/purchase.placeholder.number')!!}" class="layui-input" value="{{$purchase->number}}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/purchase.model.time')!!}</label>
                    <div class="layui-input-inline">
                        <input class="layui-input start-date" name="startTime" onclick="layui.laydate({elem: this, istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" placeholder="开始日" value="{{$purchase->startTime}}">
                    </div>
                    <div class="layui-input-inline">
                        <input class="layui-input end-date" name="endTime" onclick="layui.laydate({elem: this, istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" placeholder="截止日" value="{{$purchase->endTime}}">
                    </div>
                </div>   
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/purchase.model.thumb')!!}</label>
                    <div class="layui-input-inline">
                        <div class="site-demo-upbar">
                            <input type="file" name="thumb" class="layui-upload-file" id="purchase-upload-add">
                        </div>
                        <div id="purchase-thumb-add">
                            <i class="fa fa-close i-delete"></i>
                            <img id="LAY_demo_upload_add" src="{{$purchase->thumb}}">
                        </div>
                    </div>
                </div>   
                <div class="layui-form-item layui-form-text" style="margin-top: 10px;">
                    <label class="layui-form-label">{!!trans('admin/purchase.model.description')!!}</label>
                    <div class="layui-input-block">
                        <div class="content-purchase" style="margin-bottom: 20px;">
                            <div id="purchase-content">{!!$purchase->content!!}</div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="addpurchaseupdated" type="button">{!!trans('admin/setting.save')!!}</button>
                        <a onclick="window.history.go(-1)" class="layui-btn layui-btn-primary">{!!trans('admin/setting.goback')!!}</a>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection
@section('my-js')
<script type="text/javascript" src="{{ asset('back/plugin/wangEditor/js/lib/jquery-1.10.2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('back/plugin/wangEditor/js/wangEditor.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('back/plugin/qiniu/js/plupload.full.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('back/plugin/qiniu/js/i18n/zh_CN.js') }}"></script>
<script type="text/javascript" src="{{ asset('back/plugin/qiniu/qiniu.js') }}"></script>
<script>
    layui.extend({
        'purchase-add': 'js/purchase/purchase-add'
    }).use(['purchase-add']);
</script>
@endsection

