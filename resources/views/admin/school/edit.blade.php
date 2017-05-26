@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('back/plugin/wangEditor/css/wangEditor.min.css') }}">
<style type="text/css" media="screen">
    #school-content{
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
    @media screen and (min-width: 750px){
        .content-school{
            width:50%
        }
    }
    .ana-label{
        text-align: center;
        border-bottom: 1px solid;
    }
    #adSchoolhtml input{
        width: 150px
    }
    .layui-icon-color{
        color: red;
        font-size: 25px
    }
</style>
@endsection
@section('content')
@inject('menuPresenter','Aizxin\Presenters\MenuPresenter')
<div class="layui-body site-demo" id="schooladd">
    <div class="layui-tab-content" style="padding: 50px;">
        <section class="panel panel-padding">
            <div class="group-button">
                <span class="layui-btn layui-btn-small layui-btn-primary ajax-all">
                   {!!trans('admin/school.edit')!!}
                </span>
            </div>
            <form class="layui-form" style="padding: 17px;">
                <input type="hidden" value="{!!$school->province!!}" id="defaultprovince">
                <input type="hidden" value="{!!$school->city!!}" id="defaultcity">
                <input type="hidden" name="id" id="schoolId" value="{{$school->id}}">
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/school.model.name')!!}</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" lay-verify="required" autocomplete="off" class="layui-input" value="{!!$school->name!!}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/school.model.phone')!!}</label>
                    <div class="layui-input-inline">
                        <input type="text" name="phone" lay-verify="required|phone" autocomplete="off" class="layui-input" value="{!!$school->phone!!}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/city.action.selectPC')!!}</label>
                    <div class="layui-input-inline">
                        <select name="province" id="province" lay-filter="province">
                            <option value="">请选择省</option>
                        </select>
                    </div>
                    <div class="layui-input-inline city-city">
                        <select name="city" id="city" lay-filter="city">
                            <option value="">请选择市</option>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/school.model.address')!!}</label>
                    <div class="layui-input-inline">
                        <input type="text" name="address" lay-verify="required" autocomplete="off" class="layui-input" value="{!!$school->address!!}">
                    </div>
                </div>            
                <div class="layui-form-item">
                    <label class="layui-form-label">上传图片</label>
                    <div class="layui-input-block">
                        <input type="file" name="thumb[]" id="school-upload" multiple class="layui-upload-file">
                    </div>
                    <div class="layui-input-block" style="margin-top: 10px;" id="thumb-upload">
                        @foreach ($school->gallery as $vo)
                        <div class="imgbox">
                            <i class="fa fa-close i-delete"></i>
                            <img src="{{ $vo->gallery }}" width="202" height="152">
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="layui-form-item layui-form-text" style="margin-top: 10px;">
                    <label class="layui-form-label">{!!trans('admin/school.model.overview')!!}</label>
                    <div class="layui-input-block">
                        <div class="content-school" style="margin-bottom: 20px;">
                            <textarea class="layui-textarea" name="overview">{!!$school->overview!!}</textarea>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text" style="margin-top: 10px;">
                    <label class="layui-form-label">{!!trans('admin/school.model.description')!!}</label>
                    <div class="layui-input-block">
                        <div class="content-school" style="margin-bottom: 20px;">
                            <textarea id="school-content">{!!$school->description!!}</textarea >
                        </div>
                    </div>
                </div>
                <fieldset class="layui-elem-field layui-field-title" >
                    <legend>车型
                        <div class="layui-btn layui-btn-small" @click="addAhtml()">
                            <i class="fa fa-plus-square"></i> 添加
                        </div>
                    </legend>
                    <div class="layui-form-item" v-for="ko in pricetype">
                        <div class="layui-inline">
                            <label class="layui-form-label">车型</label>
                            <div class="layui-input-inline">
                                <input class="layui-input" v-bind:value="ko.type">
                            </div>
                        </div>                 
                        <div class="layui-inline">
                            <label class="layui-form-label">价格</label>
                            <div class="layui-input-inline">
                                <input class="layui-input" v-bind:value="ko.price">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <i class="layui-icon layui-icon-color" @click="delprice()"></i>
                        </div>
                    </div>
                </fieldset>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="addschoolupdated" type="button">{!!trans('admin/setting.save')!!}</button>
                        <button type="reset" class="layui-btn layui-btn-primary">{!!trans('admin/setting.reset')!!}</button>
                        <a onclick="window.history.go(-1)" class="layui-btn layui-btn-primary">{!!trans('admin/setting.goback')!!}</a>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
<div id="adSchoolhtml" style="display: none">
    <section class="panel panel-padding">
        <form class="layui-form" id="priceFrom">
            <div class="layui-form-item answer-text">
                <label class="layui-form-label">车型</label>
                <div class="layui-input-block">
                    <input type="text" name="type" lay-verify="required" autocomplete="off" placeholder="{!!trans('admin/school.placeholder.type')!!}" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item answer-text">
                <label class="layui-form-label">价格</label>
                <div class="layui-input-block">
                    <input type="text" name="price" lay-verify="required" autocomplete="off" placeholder="{!!trans('admin/school.placeholder.price')!!}" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="addPrice" type="button">{!!trans('admin/setting.save')!!}</button>
                    <button type="reset" class="layui-btn layui-btn-primary">{!!trans('admin/setting.reset')!!}</button>
                </div>
            </div>
        </form>
    </section>
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
        'school-add': 'js/school/school-add'
    }).use(['school-add']);
</script>
@endsection

