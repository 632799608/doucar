@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('back/plugin/wangEditor/css/wangEditor.min.css') }}">
<style type="text/css" media="screen">
    #cheat-content{
        width: 100%;
        height: 500px;
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
        .content-cheat{
            width:50%
        }
    }
</style>
@endsection
@section('content')
@inject('menuPresenter','Aizxin\Presenters\MenuPresenter')
<div class="layui-body site-demo">
    <div class="layui-tab-content" id="addpermission" style="padding: 50px;">
        <section class="panel panel-padding">
            <div class="group-button">
                <span class="layui-btn layui-btn-small layui-btn-primary ajax-all">
                   {!!trans('admin/cheat.create')!!}
                </span>
            </div>
            <form class="layui-form" style="padding: 17px;">
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/cheat.model.articleCategoryId')!!}</label>
                    <div class="layui-input-inline">
                        <select name="cheatCategoryId" lay-verify="required" lay-search="">
                            {!!$menuPresenter->topMenuList(trans('admin/cheat.menu'),$category)!!}
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/cheat.model.name')!!}</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="{!!trans('admin/cheat.placeholder.name')!!}" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/setting.upload_img')!!}</label>
                    <div class="layui-input-block">
                        <input type="file" name="thumb[]" id="cheat-upload" multiple class="layui-upload-file">
                    </div>
                    <div class="layui-input-block" style="margin-top: 10px;" id="thumb-upload">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text" style="margin-top: 10px;">
                    <label class="layui-form-label">{!!trans('admin/cheat.model.overview')!!}</label>
                    <div class="layui-input-block">
                        <div class="content-cheat" style="margin-bottom: 20px;">
                            <textarea class="layui-textarea" name="overview" lay-verify="required"></textarea>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text" style="margin-top: 10px;">
                    <label class="layui-form-label">{!!trans('admin/cheat.model.content')!!}</label>
                    <div class="layui-input-block">
                        <div class="content-cheat" style="margin-bottom: 20px;">
                            <div id="cheat-content"></div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="addcheatstore">{!!trans('admin/setting.save')!!}</button>
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
        'cheat-add': 'js/cheat/cheat-add'
    }).use(['cheat-add']);
</script>
@endsection

