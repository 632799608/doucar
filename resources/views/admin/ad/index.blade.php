@extends('layouts.admin')
@section('style')
<style type="text/css">

    .layui-tree li i {
        padding-left: 2px;
        color: #fff;
    }
    .ad-upload img{
        width: 200px;
        height: 120px
    }
    #list img{
        width: 100px;
        height: 50px
    }
</style>
@endsection
@section('content')
<div class="layui-body site-demo" id="adlist">
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
                            @permission('ad.destroy')
                            <button class="layui-btn layui-btn-small layui-btn-danger ajax-all" @click="allDelete()">
                                <i class="fa fa-trash"></i>{!!trans('admin/setting.all_delete')!!}
                            </button>
                            @endpermission
                            @permission('ad.create')
                            <button class="layui-btn layui-btn-small modal-catch" data-params='{"content":"#adaddhtml","area":"400px,400px", "title":"{!!trans("admin/ad.create")!!}","type":"1"}'>
                                <i class="fa fa-plus-square"></i> {!!trans('admin/ad.create')!!}
                            </button>
                            @endpermission
                        </div>
                        <div id="list" class="layui-form">
                            <table id="example" class="layui-table lay-even">
                                <thead>
                                    <tr>
                                        <th width="30"><input type="checkbox" id="checkall" data-name="checkbox" lay-filter="allChoose" lay-skin="primary"></th>
                                        <th width="60">{!!trans('admin/ad.model.id')!!}</th>
                                        <th>{!!trans('admin/ad.model.title')!!}</th>
                                        <th>{!!trans('admin/ad.model.url')!!}</th>
                                        <th>{!!trans('admin/ad.model.thumb')!!}</th>
                                        <th>{!!trans('admin/setting.make')!!}</th>
                                    </tr>
                                </thead>
                                <tbody style="display: none">
                                    <tr v-for="vo in ad">
                                        <td width="30"><input type="checkbox" data-name="@{{vo.id+'checkbox'}}" value="@{{vo.id}}" lay-skin="primary" onclick="elChoose()"></td>
                                        <td width="60"><em v-text="vo.id"></em></td>
                                        <td><em v-text="vo.title"></em></td>
                                        <td><em v-text="vo.url"></em></td>
                                        <td><img v-bind:src="vo.thumb+'?imageView2/2/h/50'"></td>
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
    @extends('admin.ad.create')
    @extends('admin.ad.edit')
</div>
@endsection
@section('my-js')
<script>
    layui.extend({
        'ad': 'js/ad/ad'
    }).use(['ad']);
</script>
@endsection
