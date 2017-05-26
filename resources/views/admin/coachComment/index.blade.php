@extends('layouts.admin')
@section('style')
<style type="text/css">
    #detaildescription,#detailoverview{
        float: left;display: block;padding: 9px 5px;
    }
</style>
@endsection
@section('content')
<div class="layui-body site-demo" id="commentcoachlist">
    <div class="layui-tab-content" style="padding: 16px;">
        <div class="container-fluid larry-wrapper">
            <section class="panel panel-padding">
                <form class="layui-form" id="schoolsearch">
                    <div class="layui-form-item">
                        <div class="layui-input-inline city-city">
                            <select name="schoolId" lay-filter="coach">
                                <option value="">请选择驾校</option>
                                @foreach($schoolList as $school)
                                    <option value="{{$school->id}}">{{$school->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="coach" class="layui-input-inline city-city">
                        <!-- 教练容器    -->
                        </div>
                        <div class="layui-inline">
                            <button class="layui-btn" lay-submit="" lay-filter="searchCoachComment" type="button">查找</button>
                        </div>
                    </div>
                    <input type="hidden" id="coachdata" value="{{$schoolList}}">
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
                                <th width="15">{!!trans('admin/coachComment.model.id')!!}</th>
                                <th>{!!trans('admin/coachComment.model.coach')!!}</th>
                                <th>{!!trans('admin/coachComment.model.member')!!}</th>
                                <th>{!!trans('admin/coachComment.model.comment')!!}</th>
                                <th>{!!trans('admin/coachComment.model.check')!!}</th>
                                <th>{!!trans('admin/setting.make')!!}</th>
                            </tr>
                        </thead>
                        <tbody style="display: none">
                            <tr v-for="vo in coachcomment">
                                <td width="30"><input type="checkbox" data-name="@{{vo.id+'checkbox'}}" value="@{{vo.id}}" lay-skin="primary" onclick="elChoose()"></td>
                                <td width="60" ><em v-text="vo.id"></em></td>
                                <td><em v-text="vo.coach[0].name"></em></td>
                                <td><em v-text="vo.member[0].nickname"></em></td>
                                <td><em v-text="vo.comment"></em></td>                                <td><div class="layui-unselect layui-form-switch" :class="{'layui-form-onswitch':vo.status}" @click="changeSwitch(vo)"><em>@{{vo.status?'通过':'禁用'}}</em><i></i></div></td>
                                <td width="152">
                                    <div class="layui-btn-group">
                                    @permission('comment.coach.destroy')
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
        'coachComment-index': 'js/coachComment/coachComment-index'
    }).use(['coachComment-index']);
</script>
@endsection
