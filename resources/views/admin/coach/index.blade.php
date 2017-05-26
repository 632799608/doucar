@extends('layouts.admin')
@section('style')
<style type="text/css">
    .site-demo-upload,.site-demo-upload img ,.coachgallery{
        width: 60px;
        height: 60px;
    }
    .coachgallery{
        width: 90px;
        height: 60px;
    }
</style>
@endsection
@section('content')
<div class="layui-body site-demo" id="coachlist">
    <div class="layui-tab-content" style="padding: 16px;">
        <div class="container-fluid larry-wrapper">
            <section class="panel panel-padding">
                <form class="layui-form" id="coachsearch">
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
                                <input class="layui-input" name="name" placeholder="{!!trans('admin/coach.model.name')!!}">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <div class="layui-input-inline">
                                <input class="layui-input" name="phone" placeholder="{!!trans('admin/coach.model.phone')!!}">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <button class="layui-btn" lay-submit="" lay-filter="searchcoach" type="button">查找</button>
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
                    @permission('coach.destroy')
                    <button class="layui-btn layui-btn-small layui-btn-danger ajax-all" @click="allDelete()">
                        <i class="fa fa-trash"></i>{!!trans('admin/setting.all_delete')!!}
                    </button>
                    @endpermission
                    @permission('coach.create')
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
                                <th width="15">{!!trans('admin/coach.model.id')!!}</th>
                                <th>{!!trans('admin/coach.model.name')!!}</th>
                                <th>{!!trans('admin/coach.model.phone')!!}</th>
                                <th>{!!trans('admin/coach.model.avatar')!!}</th>
                                <th>{!!trans('admin/coach.model.sex')!!}</th>
                                <th>{!!trans('admin/coach.model.gallery')!!}</th>
                                <th>{!!trans('admin/coach.model.school')!!}</th>
                                <th>{!!trans('admin/coach.model.status')!!}</th>
                                <th>{!!trans('admin/setting.make')!!}</th>
                            </tr>
                        </thead>
                        <tbody style="display: none;">
                            <tr v-for="vo in coach">
                                <td width="30"><input type="checkbox" data-name="@{{vo.id+'checkbox'}}" value="@{{vo.id}}" lay-skin="primary" onclick="elChoose()"></td>
                                <td width="60" ><em v-text="vo.id"></em></td>
                                <td><em v-text="vo.name"></em></td>
                                <td><em v-text="vo.phone"></em></td>
                                <td>
                                    <div class="site-demo-upload">
                                      <img v-bind:src="vo.avatar+'?imageView2/2/h/50'">
                                    </div>
                                </td>
                                <td><span v-if="vo.sex == 1">男</span><span v-if="vo.sex == 2">女</span></td>
                                <td  @click="getphoto(vo.gallery)"><img class="coachgallery" v-bind:src="vo.gallery[0]['gallery']"></td>
                                <td><em v-text="vo.school.name"></em></td>
                                <td><div class="layui-unselect layui-form-switch" :class="{'layui-form-onswitch':vo.status}" @click="changeSwitch(vo)"><em>@{{vo.status?'启用':'禁用'}}</em><i></i></div></td>
                                <td width="152">
                                    <div class="layui-btn-group">
                                     @permission('coach.show')
                                        <button class="layui-btn layui-btn-small" @click="elDetail(vo.id)">详情</button>
                                    @endpermission
                                    @permission('coach.edit')
                                        <button @click="edithtml(vo.id)" class="layui-btn layui-btn-primary layui-btn-small"><i class="layui-icon"></i></button>
                                    @endpermission
                                    @permission('coach.destroy')
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
<div id="coachdetail" style="display: none;">
    <div class="layui-form-item layui-form-text" style="margin-top: 10px;">
        <div style="width: 125px;">
            <label class="layui-form-label">{!!trans('admin/coach.model.overview')!!}</label>
        </div>
        <div style="flex:1">
            <div id="detailoverview" style="float: left;display: block;padding: 9px 15px;"></div>
        </div>
    </div>
    <div class="layui-form-item layui-form-text" style="margin-top: 10px;display: flex;">
        <div style="width: 125px;">
            <label class="layui-form-label" style="">{!!trans('admin/coach.model.description')!!}</label>
        </div>
        <div style="flex:1">
            <div id="detaildescription" style="float: left;display: block;padding: 9px 15px;">
            </div>
        </div>
    </div>
</div>
@endsection
@section('my-js')
<script>
    layui.extend({
        'coach-index': 'js/coach/coach-index'
    }).use(['coach-index']);
</script>
@endsection
