@extends('layouts.admin')
@section('style')
<style type="text/css">
    .site-demo-upload,.site-demo-upload img ,.purchasegallery{
        width: 60px;
        height: 60px;
    }
    .purchasegallery{
        width: 90px;
        height: 60px;
    }
    tbody img{
        width: 90px;
        height: 60px;
    }
</style>
@endsection
@section('content')
<div class="layui-body site-demo" id="purchaselist">
    <div class="layui-tab-content" style="padding: 16px;">
        <div class="container-fluid larry-wrapper">
            <section class="panel panel-padding">
                <form class="layui-form" id="purchasesearch">
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
                                <input class="layui-input" name="name" placeholder="{!!trans('admin/purchase.placeholder.title')!!}">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <button class="layui-btn" lay-submit="" lay-filter="searchpurchase" type="button">查找</button>
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
                    @permission('purchase.destroy')
                    <button class="layui-btn layui-btn-small layui-btn-danger ajax-all" @click="allDelete()">
                        <i class="fa fa-trash"></i>{!!trans('admin/setting.all_delete')!!}
                    </button>
                    @endpermission
                    @permission('purchase.create')
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
                                <th width="15">{!!trans('admin/purchase.model.id')!!}</th>
                                <th>{!!trans('admin/purchase.model.school')!!}</th>
                                <th>{!!trans('admin/purchase.model.title')!!}</th>
                                <th>{!!trans('admin/purchase.model.number')!!}</th>
                                <th>{!!trans('admin/purchase.model.type')!!}</th>
                                <th>{!!trans('admin/purchase.model.price')!!}</th>
                                <th>{!!trans('admin/purchase.model.thumb')!!}</th>
                                <th>{!!trans('admin/purchase.model.status')!!}</th>
                                <th>{!!trans('admin/setting.make')!!}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="vo in purchase">
                                <td width="30"><input type="checkbox" data-name="@{{vo.id+'checkbox'}}" value="@{{vo.id}}" lay-skin="primary" onclick="elChoose()"></td>
                                <td width="60" ><em v-text="vo.id"></em></td>
                                <td><em v-text="vo.school[0].name"></em></td>
                                <td><em v-text="vo.name"></em></td>
                                <td><em v-text="vo.number"></em></td>
                                <td><em v-text="vo.type"></em></td>
                                <td><em v-text="vo.price"></em></td>
                                <td>
                                    <img v-bind:src="vo.thumb">
                                </td>
                                <td><div class="layui-unselect layui-form-switch" :class="{'layui-form-onswitch':vo.status}" @click="changeSwitch(vo)"><em>@{{vo.status?'上架':'下架'}}</em><i></i></div></td>
                                <td width="152">
                                    <div class="layui-btn-group">
                                    @permission('purchase.show')
                                        <button class="layui-btn layui-btn-small" @click="elDetail(vo.id)">详情</button>
                                    @endpermission
                                    @permission('purchase.edit')
                                        <button @click="edithtml(vo.id)" class="layui-btn layui-btn-primary layui-btn-small"><i class="layui-icon"></i></button>
                                    @endpermission
                                    @permission('purchase.destroy')
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
<div id="purchasedetail" style="display: none;">
    <div class="layui-form-item layui-form-text" style="margin-top: 10px;display: flex;">
        <div style="flex:1">
            <div id="detailcontent" style="float: left;display: block;padding: 9px 15px;">
            </div>
        </div>
    </div>
</div>
@endsection
@section('my-js')
<script>
    layui.extend({
        'purchase-index': 'js/purchase/purchase-index'
    }).use(['purchase-index']);
</script>
@endsection
