@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('back/plugin/wangEditor/css/wangEditor.min.css') }}">
<style type="text/css" media="screen">
    #coach-content{
        width: 100%;
        height: 250px;
    }
    .layui-input-block {
        margin-left: 130px;
        min-height: 36px;
    }
    .imgbox img{
        width: 200px;
        height: 150px;
        border: 1px solid #ccc;
    }
    .imgbox .i-delete {
        position: absolute;
        margin-left: 186px;
        font-size: 18px;
        color: red;
        cursor: pointer;
    }
    .wangEditor-fullscreen {
        position: fixed;
        top: 60px;
        left: 200px;
        bottom: 82px;
    }
    #thumb-upload{
        display: none;
    }
    @media screen and (min-width: 750px){
        .content-coach{
            width:50%
        }
    }
    .ana-label{
        text-align: center;
        border-bottom: 1px solid;
    }
    #adcoachhtml input{
        width: 150px
    }
    .layui-icon-color{
        color: red;
        font-size: 25px
    }
    #coach-avatar-add{
        display: none;
    }
    .site-demo-upload,#LAY_demo_upload_add{
        width: 80px;
        height: 80px;
    }
    .i-delete{
        color: red;
    }
</style>
@endsection
@section('content')
@inject('menuPresenter','Aizxin\Presenters\MenuPresenter')
<div class="layui-body site-demo" id="coachadd">
    <div class="layui-tab-content" style="padding: 50px;">
        <section class="panel panel-padding">
            <div class="group-button">
                <span class="layui-btn layui-btn-small layui-btn-primary ajax-all">
                   {!!trans('admin/coach.create')!!}
                </span>
            </div>
            <form class="layui-form" style="padding: 17px;">
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/coach.model.school')!!}</label>
                    <div class="layui-input-inline">
                      <select name="schoolId" lay-verify="required">
                          <option value="">{!!trans('admin/coach.select')!!}</option>
                          @foreach($schoolList as $vo)
                            <option value="{{$vo->id}}">{{$vo->name}}</option>
                          @endforeach
                      </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/coach.model.name')!!}</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="{!!trans('admin/coach.placeholder.name')!!}" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/coach.model.phone')!!}</label>
                    <div class="layui-input-inline">
                        <input type="text" name="phone" lay-verify="required|phone" autocomplete="off" placeholder="{!!trans('admin/coach.placeholder.phone')!!}" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item" pane="">
                    <label class="layui-form-label">单选框</label>
                    <div class="layui-input-block">
                      <input type="radio" name="sex" value="1" title="男" checked="checked">
                      <input type="radio" name="sex" value="2" title="女">
                    </div>
                </div>  
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/coach.model.avatar')!!}</label>
                    <div class="layui-input-inline">
                        <div class="site-demo-upbar">
                            <input type="file" name="thumb" class="layui-upload-file" id="coach-upload-add">
                        </div>
                        <div id="coach-avatar-add">
                            <i class="fa fa-close i-delete"></i>
                            <div class="site-demo-upload">
                              <img id="LAY_demo_upload_add" src="{{ asset('back/images/no-image.png') }}">
                            </div>
                        </div>
                    </div>
                </div>   
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/coach.model.gallery')!!}</label>
                    <div class="layui-input-block">
                        <input type="file" name="thumb[]" id="coach-gallery-upload" multiple class="layui-upload-file">
                    </div>
                    <div class="layui-input-block" style="margin-top: 10px;" id="gallery-upload">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text" style="margin-top: 10px;">
                    <label class="layui-form-label">{!!trans('admin/coach.model.overview')!!}</label>
                    <div class="layui-input-block">
                        <div class="content-coach" style="margin-bottom: 20px;">
                            <textarea class="layui-textarea" name="overview" lay-verify="required"></textarea>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text" style="margin-top: 10px;">
                    <label class="layui-form-label">{!!trans('admin/coach.model.description')!!}</label>
                    <div class="layui-input-block">
                        <div class="content-coach" style="margin-bottom: 20px;">
                            <div id="coach-content"></div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="addcoachstore" type="button">{!!trans('admin/setting.save')!!}</button>
                        <button type="reset" class="layui-btn layui-btn-primary">{!!trans('admin/setting.reset')!!}</button>
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
        'coach-add': 'js/coach/coach-add'
    }).use(['coach-add']);
</script>
@endsection

