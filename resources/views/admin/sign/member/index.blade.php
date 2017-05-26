@extends('layouts.admin')
@section('style')
<style type="text/css">
    #detaildescription,#detailoverview{
        float: left;display: block;padding: 9px 5px;
    }
</style>
@endsection
@section('content')
<div class="layui-body site-demo" id="membersignlist">
    <div class="layui-tab-content" style="padding: 16px;">
        <div class="container-fluid larry-wrapper">
            <section class="panel panel-padding">
                <form class="layui-form">
                    <div class="layui-form">
                        <div class="layui-inline">
                            <div class="layui-input-inline">
                                <input class="layui-input" name="phone" placeholder="{!!trans('admin/memberSign.placeholder')!!}" v-model="search.phone">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <button  class="layui-btn" lay-submit lay-filter="searchMemberSign">查找</button>
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
                </div>
                <div id="list" class="layui-form">
                    <table id="example" class="layui-table lay-even">
                        <thead>
                            <tr>
                                <th width="30"><input type="checkbox" id="checkall" data-name="checkbox" lay-filter="allChoose" lay-skin="primary"></th>
                                <th width="15">{!!trans('admin/memberSign.model.id')!!}</th>
                                <th>{!!trans('admin/memberSign.model.member')!!}</th>
                                <th>{!!trans('admin/memberSign.model.name')!!}</th>
                                <th>{!!trans('admin/memberSign.model.phone')!!}</th>
                                <th>{!!trans('admin/memberSign.model.license')!!}</th>
                                <th>{!!trans('admin/memberSign.model.address')!!}</th>
                                <th>{!!trans('admin/memberSign.model.type')!!}</th>
                                <th>{!!trans('admin/memberSign.model.time')!!}</th>
                                <th>{!!trans('admin/memberSign.model.check')!!}</th>
                                <th>{!!trans('admin/setting.make')!!}</th>
                            </tr>
                        </thead>
                        <tbody style="display: none">
                            <tr v-for="vo in membersign">
                                <td width="30"><input type="checkbox" data-name="@{{vo.id+'checkbox'}}" value="@{{vo.id}}" lay-skin="primary" onclick="elChoose()"></td>
                                <td width="60" ><em v-text="vo.id"></em></td>
                                <td><em v-text="vo.member_phone.nickname"></em></td>
                                <td><em v-text="vo.name"></em></td>
                                <td><em v-text="vo.phone"></em></td>                                
                                <td><em v-text="vo.license"></em></td>
                                <td><em v-text="vo.address"></em></td>
                                <td>
                                    <em v-if="vo.type == 1" class="layui-btn layui-btn-mini layui-btn-normal" >签到</em>
                                    <em v-if="vo.type == 2" class="layui-btn layui-btn-mini">签退</em>
                                    <em v-if="vo.type == 3" class="layui-btn layui-btn-mini  layui-btn-warm">
                                    会员姓名：@{{vo.member_id.nickname}} 电话：@{{vo.member_id.phone}}代签到</em>
                                    <em v-if="vo.type == 4" class="layui-btn layui-btn-mini  layui-btn-danger">
                                    会员姓名：@{{vo.member_id.nickname}} 电话：@{{vo.member_id.phone}}代签退</em>
                                </td>
                                <td><em v-text="vo.created_at"></em></td>
                                <td><div class="layui-unselect layui-form-switch" :class="{'layui-form-onswitch':vo.status}" @click="changeSwitch(vo)"><em>@{{vo.status?'有效':'无效'}}</em><i></i></div></td>
                                <td width="152">
                                    <div class="layui-btn-group">
                                    @permission('sign.member.destroy')
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
        'member-index': 'js/sign/member-index'
    }).use(['member-index']);
</script>
@endsection
