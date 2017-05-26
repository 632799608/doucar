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
<div class="layui-body site-demo" id="memberapplylist">
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
                    @permission('member.apply.destroy')
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
                                <th width="15">{!!trans('admin/memberApply.model.id')!!}</th>
                                <th>{!!trans('admin/memberApply.model.member')!!}</th>
                                <th>{!!trans('admin/memberApply.model.name')!!}</th>
                                <th>{!!trans('admin/memberApply.model.school')!!}</th>
                                <th>{!!trans('admin/memberApply.model.coach')!!}</th>
                                <th>{!!trans('admin/memberApply.model.phone')!!}</th>
                                <th>{!!trans('admin/memberApply.model.type')!!}</th>
                                <th>{!!trans('admin/memberApply.model.price')!!}</th>
                                <th>{!!trans('admin/memberApply.model.created_at')!!}</th>
                                <th>{!!trans('admin/setting.make')!!}</th>
                            </tr>
                        </thead>
                        <tbody style="display: none">
                            <tr v-for="vo in memberapply">
                                <td width="30"><input type="checkbox" data-name="@{{vo.id+'checkbox'}}" value="@{{vo.id}}" lay-skin="primary" onclick="elChoose()"></td>
                                <td width="60" ><em v-text="vo.id"></em></td>
                                <td><em v-text="vo.member.nickname"></em></td>
                                <td><em v-text="vo.name"></em></td>
                                <td><em v-text="vo.school.name"></em></td>
                                <td><em v-text="vo.coach.name"></em></td>
                                <td><em v-text="vo.phone"></em></td>
                                <td><em v-text="vo.type"></em></td>
                                <td><em v-text="vo.price"></em></td>
                                <td><em v-text="vo.created_at"></em></td>
                                <td width="152">
                                    <div class="layui-btn-group">
                                    @permission('member.apply.destroy')
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
        'memberApply-index': 'js/memberApply/memberApply-index'
    }).use(['memberApply-index']);
</script>
@endsection
