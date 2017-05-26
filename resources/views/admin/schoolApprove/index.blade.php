@extends('layouts.admin')
@section('style')
<style type="text/css">
    #detaildescription,#detailoverview{
        float: left;display: block;padding: 9px 5px;
    }
    tbody img{
        width: 80px;
        height: 60px
    }
</style>
@endsection
@section('content')
<div class="layui-body site-demo" id="approveschoollist">
    <div class="layui-tab-content" style="padding: 16px;">
        <div class="container-fluid larry-wrapper">
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
                </div>
                <div id="list" class="layui-form">
                    <table id="example" class="layui-table lay-even">
                        <thead>
                            <tr>
                                <th width="30"><input type="checkbox" id="checkall" data-name="checkbox" lay-filter="allChoose" lay-skin="primary"></th>
                                <th width="15">{!!trans('admin/schoolApprove.model.id')!!}</th>
                                <th>{!!trans('admin/schoolApprove.model.member')!!}</th>
                                <th>{!!trans('admin/schoolApprove.model.name')!!}</th>
                                <th>{!!trans('admin/schoolApprove.model.address')!!}</th>
                                <th>{!!trans('admin/schoolApprove.model.phone')!!}</th>
                                <th>{!!trans('admin/schoolApprove.model.thumb')!!}</th>
                                <th>{!!trans('admin/schoolApprove.model.created_at')!!}</th>
                                <th>{!!trans('admin/setting.make')!!}</th>
                            </tr>
                        </thead>
                        <tbody style="display: none">
                            <tr v-for="vo in schoolapprove">
                                <td width="30"><input type="checkbox" data-name="@{{vo.id+'checkbox'}}" value="@{{vo.id}}" lay-skin="primary" onclick="elChoose()"></td>
                                <td width="60" ><em v-text="vo.id"></em></td>
                                <td><em v-text="vo.member.nickname"></em></td>
                                <td><em v-text="vo.name"></em></td>
                                <td><em v-text="vo.address"></em></td>
                                <td><em v-text="vo.phone"></em></td>
                                <td @click="getphoto(vo.thumb)"><em><img v-bind:src="vo.thumb[0]"></em></td>
                                <td><em v-text="vo.created_at"></em></td>
                                <td width="152">
                                    <div class="layui-btn-group">
                                    @permission('approve.school.destroy')
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
        'schoolApprove-index': 'js/schoolApprove/schoolApprove-index'
    }).use(['schoolApprove-index']);
</script>
@endsection
