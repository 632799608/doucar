@extends('layouts.admin')
@section('style')
<style type="text/css">
    #detaildescription,#detailoverview{
        float: left;display: block;padding: 9px 5px;
    }
</style>
@endsection
@section('content')
<div class="layui-body site-demo" id="schoollist">
    <div class="layui-tab-content" style="padding: 16px;">
        <div class="container-fluid larry-wrapper">
            <section class="panel panel-padding">
                <form class="layui-form" id="schoolsearch">
                    <div class="layui-form-item">
                        <div class="layui-input-inline">
                            <select name="province" id="province" lay-filter="province" v-on:change="province()">
                                <option value="">请选择省</option>
                            </select>
                        </div>
                        <div class="layui-input-inline city-city">
                            <select name="city" id="city" lay-filter="city">
                                <option value="">请选择市</option>
                            </select>
                        </div>
                        <div class="layui-inline">
                            <div class="layui-input-inline">
                                <input class="layui-input" name="name" placeholder="{!!trans('admin/school.model.name')!!}">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <button class="layui-btn" lay-submit="" lay-filter="searchSchool" type="button">查找</button>
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
                    @permission('school.destroy')
                    <button class="layui-btn layui-btn-small layui-btn-danger ajax-all" @click="allDelete()">
                        <i class="fa fa-trash"></i>{!!trans('admin/setting.all_delete')!!}
                    </button>
                    @endpermission
                    @permission('school.create')
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
                                <th width="15">{!!trans('admin/school.model.id')!!}</th>
                                <th>{!!trans('admin/school.model.name')!!}</th>
                                <th>{!!trans('admin/school.model.phone')!!}</th>
                                <th>{!!trans('admin/school.model.thumb')!!}</th>
                                <th>{!!trans('admin/school.model.district')!!}</th>
                                <th>{!!trans('admin/school.model.address')!!}</th>
                                <th>{!!trans('admin/school.model.status')!!}</th>
                                <th>{!!trans('admin/setting.make')!!}</th>
                            </tr>
                        </thead>
                        <tbody style="display: none">
                            <tr v-for="vo in school">
                                <td width="30"><input type="checkbox" data-name="@{{vo.id+'checkbox'}}" value="@{{vo.id}}" lay-skin="primary" onclick="elChoose()"></td>
                                <td width="60" ><em v-text="vo.id"></em></td>
                                <td><em v-text="vo.name"></em></td>
                                <td><em v-text="vo.phone"></em></td>
                                <td  @click="getphoto(vo.id)"><img v-bind:src="vo.thumb+'?imageView2/2/h/50'"></td>
                                <td><em v-text="vo.area_province.name"></em><em v-text="vo.area_city.name"></em></td>
                                <td><em v-text="vo.address"></em></td>
                                <td><div class="layui-unselect layui-form-switch" :class="{'layui-form-onswitch':vo.status}" @click="changeSwitch(vo)"><em>@{{vo.status?'上架':'下架'}}</em><i></i></div></td>
                                <td width="152">
                                    <div class="layui-btn-group">
                                     @permission('school.show')
                                        <button class="layui-btn layui-btn-small" @click="elDetail(vo.id)">详情</button>
                                    @endpermission
                                    @permission('school.edit')
                                        <button @click="edithtml(vo.id)" class="layui-btn layui-btn-primary layui-btn-small"><i class="layui-icon"></i></button>
                                    @endpermission
                                    @permission('school.destroy')
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
<div id="schooldetail" style="display: none;">
    <div class="layui-form-item layui-form-text" style="margin-top: 10px;display: flex;">
        <div style="width: 125px;">
            <label class="layui-form-label" style="">{!!trans('admin/school.model.price')!!}</label>
        </div>
        <div class="layui-form">
            <table id="example" class="layui-table lay-even">
                <thead>
                    <tr>
                        <th width="100">车型</th>
                        <th width="100">价格</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <div class="layui-form-item layui-form-text" style="margin-top: 10px;display: flex;">
        <div style="width: 125px;">
            <label class="layui-form-label">{!!trans('admin/school.model.overview')!!}</label>
        </div>
        <div style="flex:1;">
            <div id="detailoverview"></div>
        </div>
    </div>
    <div class="layui-form-item layui-form-text" style="margin-top: 10px;display: flex;">
        <div style="width: 125px;">
            <label class="layui-form-label" style="">{!!trans('admin/school.model.description')!!}</label>
        </div>
        <div style="flex:1">
            <div id="detaildescription">
            </div>
        </div>
    </div>
</div>
@endsection
@section('my-js')
<script>
    layui.extend({
        'school-index': 'js/school/school-index'
    }).use(['school-index']);
</script>
@endsection
