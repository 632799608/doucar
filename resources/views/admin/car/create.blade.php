@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('back/plugin/wangEditor/css/wangEditor.min.css') }}">
@endsection
@section('content')
@inject('menuPresenter','Aizxin\Presenters\MenuPresenter')
<div class="layui-body site-demo" id="caradd">
    <div class="layui-tab-content" style="padding: 50px;">
        <section class="panel panel-padding">
            <div class="group-button">
                <span class="layui-btn layui-btn-small layui-btn-primary ajax-all">
                   {!!trans('admin/car.create')!!}
                </span>
            </div>
            <form class="layui-form" style="padding: 17px;">
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/car.model.school')!!}</label>
                    <div class="layui-input-inline">
                      <select name="schoolId" lay-verify="required" lay-filter="schoolId">
                          <option value="">{!!trans('admin/car.select')!!}</option>
                          @foreach($schoolList as $vo)
                            <option value="{{$vo->id}}">{{$vo->name}}</option>
                          @endforeach
                      </select>
                    </div>
                    <input type="hidden" id="schoolList" name="" value="{{$schoolList}}">
                    <div id="coach" class="layui-input-inline">
                    <!-- 教练容器 -->
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/car.model.license')!!}</label>
                    <div class="layui-input-inline">
                        <input type="text" name="license" lay-verify="required|license" autocomplete="off" placeholder="{!!trans('admin/car.placeholder.license')!!}" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/car.model.place')!!}</label>
                    <div class="layui-input-inline">
                        <input type="text" name="place" lay-verify="required" autocomplete="off" placeholder="{!!trans('admin/car.placeholder.place')!!}" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="addcarstore" type="button">{!!trans('admin/setting.save')!!}</button>
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
        'car-add': 'js/car/car-add'
    }).use(['car-add']);
</script>
@endsection

