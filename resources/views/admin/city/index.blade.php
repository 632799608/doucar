@extends('layouts.admin')
@section('style')
<style type="text/css">
    .layui-tree li i {
        padding-left: 2px;
        color: #fff;
    }
</style>
@endsection
@section('content')
<div class="layui-body site-demo" id="citylist">
    <div class="layui-tab-content" style="padding: 16px;">
        <div class="container-fluid larry-wrapper">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <!--列表-->
                    <section class="panel panel-padding">
                        <div class="group-button">
                            <select class="layui-btn layui-btn-small layui-btn-primary ajax-all" v-model="search.pageSize" v-on:change="changelist()">
                                <option value="{{config('admin.global.pagination.pageSize')}}" selected>{!!trans('admin/setting.page')!!}</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                            </select>
                            @permission('city.destroy')
                            <button class="layui-btn layui-btn-small layui-btn-danger ajax-all" @click="allDelete()">
                                <i class="fa fa-trash"></i>{!!trans('admin/setting.all_delete')!!}
                            </button>
                            @endpermission
                            @permission('city.store')
                            <button @click="cityaddhtml()" class="layui-btn layui-btn-small modal-catch" data-params='{"content":"#cityaddhtml","area":"570px,400px", "title":"{!!trans("admin/city.action.create")!!}","type":"1"}' lay-filter="demo1">
                                <i class="fa fa-plus-square"></i> {!!trans('admin/city.action.create')!!}
                            </button>
                            @endpermission
                        </div>
                        <div id="list" class="layui-form">
                            <table id="example" class="layui-table lay-even">
                                <thead>
                                    <tr>
                                        <th width="30"><input type="checkbox" id="checkall" data-name="checkbox" lay-filter="allChoose" lay-skin="primary"></th>
                                        <th width="60">{!!trans('admin/city.model.id')!!}</th>
                                        <th>{!!trans('admin/city.model.name')!!}</th>
                                        <th>{!!trans('admin/city.model.key')!!}</th>
                                        <th>
                                            {!!trans('admin/city.model.province')!!}-
                                            {!!trans('admin/city.model.city')!!}
                                        </th>
                                        <th>{!!trans('admin/setting.make')!!}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="vo in citylist">
                                        <td width="30"><input type="checkbox" data-name="@{{vo.id+'checkbox'}}" value="@{{vo.id}}" lay-skin="primary" onclick="elChoose()"></td>
                                        <td width="60"><em v-text="vo.id"></em></td>
                                        <td><em v-text="vo.name"></em></td>
                                        <td><em v-text="vo.key"></em></td>
                                        <td><em v-text="vo.area_province.name"></em><em v-if="vo.area_city" v-text="'-'+vo.area_city.name"></em></td>
                                        <td width="152">
                                            <div class="layui-btn-group">
                                                <button class="layui-btn layui-btn-primary layui-btn-small" @click="edithtml(vo.id)"><i class="layui-icon"></i></button>
                                                <button class="layui-btn layui-btn-danger layui-btn-small" @click="elDelete(vo.id)"><i class="layui-icon"></i></button>
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
    </div>
    @extends('admin.city.create')
    @extends('admin.city.edit')
</div>
@endsection
@section('my-js')
<script>
    layui.extend({
        'city': 'js/city/city'
    }).use(['city']);
</script>
@endsection
