@extends('layouts.admin')
@section('style')
<style type="text/css">
    .site-demo-upload,.site-demo-upload img ,.cargallery{
        width: 60px;
        height: 60px;
    }
    .cargallery{
        width: 90px;
        height: 60px;
    }
</style>
@endsection
@section('content')
<div class="layui-body site-demo" id="carlist">
    <div class="layui-tab-content" style="padding: 16px;">
        <div class="container-fluid larry-wrapper">
            <section class="panel panel-padding">
                <form class="layui-form" id="carsearch">
                    <div class="layui-form-item">
                        <div class="layui-input-inline city-city">
                            <select name="schoolId">
                                <option value="">请选择驾校</option>
                                @foreach($schoolList as $school)
                                    <option value="{{$school->id}}">{{$school->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="layui-inline">
                            <div class="layui-input-inline">
                                <input class="layui-input" name="license" placeholder="{!!trans('admin/car.placeholder.license')!!}">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <button class="layui-btn" lay-submit="" lay-filter="searchcar" type="button">查找</button>
                        </div>
                    </div>
                </form>
            </section>
            <!--列表-->
            <section class="panel panel-padding">
                <div class="group-button">
                    <select class="layui-btn layui-btn-small layui-btn-primary ajax-all" v-model="search.pageSize" v-on:change="changelist()">
                        <option value="{{config('admin.global.pagination.pageSize')}}" selected>{!!trans('admin/setting.page')!!}</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                    </select>
                    @permission('car.destroy')
                    <button class="layui-btn layui-btn-small layui-btn-danger ajax-all" @click="allDelete()">
                        <i class="fa fa-trash"></i>{!!trans('admin/setting.all_delete')!!}
                    </button>
                    @endpermission
                    @permission('car.create')
                    <button class="layui-btn layui-btn-small" @click="addhtml()">
                        <i class="fa fa-plus-square"></i> {!!trans('admin/setting.add')!!}
                    </button>
                    @endpermission
                </div>
                <div id="list" class="layui-form">
                    <table id="example" class="layui-table lay-even">
                        <thead>
                            <tr>
                                <th width="30"><input type="checkbox" id="checkall" data-name="checkbox" lay-filter="allChoose" lay-skin="primary"></th>
                                <th width="15">{!!trans('admin/car.model.id')!!}</th>
                                <th>{!!trans('admin/car.model.school')!!}</th>
                                <th>{!!trans('admin/car.model.license')!!}</th>
                                <th>{!!trans('admin/car.model.place')!!}</th>
                                <th>{!!trans('admin/car.model.erweima')!!}</th>
                                <th>{!!trans('admin/setting.make')!!}</th>
                            </tr>
                        </thead>
                        <tbody style="display: none;">
                            <tr v-for="vo in car">
                                <td width="30"><input type="checkbox" data-name="@{{vo.id+'checkbox'}}" value="@{{vo.id}}" lay-skin="primary" onclick="elChoose()"></td>
                                <td width="60" ><em v-text="vo.id"></em></td>
                                <td><em v-text="vo.school.name"></em><span v-if="vo.coach.name">-<em v-text="vo.coach.name"></em></span></td>
                                <td><em v-text="vo.license"></em></td>
                                <td><em v-text="vo.place"></em></td>
                                <td><em class="layui-btn layui-btn-normal" @click="carEr(vo.id)">{!!trans('admin/car.model.erweima')!!}</em></td>
                                <td width="152">
                                    <div class="layui-btn-group">
                                    @permission('car.destroy')
                                        <button class="layui-btn layui-btn-danger layui-btn-small" @click="elDelete(vo.id)"><i class="layui-icon"></i></button>
                                    @endpermission
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-right" id="page"></div>
            </section>
        </div>
    </div>
</div>
@endsection
@section('my-js')
<script>
    layui.extend({
        'car-index': 'js/car/car-index'
    }).use(['car-index']);
</script>
@endsection
