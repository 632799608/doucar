@extends('layouts.admin')
@section('style')
@endsection
@section('content')
<div class="layui-body site-demo" id="waypointlist">
    <div class="layui-tab-content" style="padding: 16px;">
        <div class="container-fluid larry-wrapper">
            <!--头部搜索-->
            <section class="panel panel-padding">
                <form class="layui-form" id="searchPointHtml">
                    <div class="layui-form">
                        <div class="layui-input-inline">
                            <select name="wc1Id" lay-filter="wc1Id">
                                <option value="0">{!!trans('admin/category.waypoint')!!}</option>
                            </select>
                        </div>
                        <div class="layui-input-inline" style="display: none">
                            <select name="wc2Id" lay-filter="wc2Id">
                                <option value="0">{!!trans('admin/category.waypoint')!!}</option>
                            </select>
                        </div>
                        <div class="layui-inline">
                            <div class="layui-input-inline">
                                <input class="layui-input" name="name" placeholder="{!!trans('admin/waypoint.model.name')!!}">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <button class="layui-btn" lay-submit="" lay-filter="searchPoint" type="button">{!!trans('admin/setting.select')!!}</button>
                        </div>
                    </div>
                </form>
            </section>
            <!--列表-->
            <section class="panel panel-padding">
                <div class="group-button">
                    <select class="layui-btn layui-btn-small layui-btn-primary ajax-all" v-model="search.pageSize" v-on:change="changelist(search.pageSize)">
                        <option value="{{config('admin.global.pagination.pageSize')}}" selected>{!!trans('admin/setting.page')!!}</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                    </select>
                    @permission('waypoint.destroy')
                    <button class="layui-btn layui-btn-small layui-btn-danger ajax-all" @click="allDelete()">
                        <i class="fa fa-trash"></i>{!!trans('admin/setting.all_delete')!!}
                    </button>
                    @endpermission
                    @permission('waypoint.edit')
                    <button class="layui-btn layui-btn-small layui-btn-normal ajax-all" @click="allChange(0)">
                        <i class="fa fa-check"></i>{!!trans('admin/setting.up')!!}
                    </button>
                    <button class="layui-btn layui-btn-small layui-btn-warm ajax-all" @click="allChange(1)">
                        <i class="fa fa-close"></i>{!!trans('admin/setting.down')!!}
                    </button>
                    @endpermission
                    @permission('waypoint.create')
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
                                <th width="60">{!!trans('admin/waypoint.model.id')!!}</th>
                                <th>{!!trans('admin/waypoint.model.name')!!}</th>
                                <th>{!!trans('admin/waypoint.model.thumb')!!}</th>
                                <th>{!!trans('admin/waypoint.category')!!}</th>
                                <th>{!!trans('admin/waypoint.status')!!}</th>
                                <th>{!!trans('admin/setting.make')!!}</th>
                            </tr>
                        </thead>
                        <tbody style="display: none">
                            <tr v-for="vo in point">
                                <td width="30"><input type="checkbox" data-name="@{{vo.id+'checkbox'}}" value="@{{vo.id}}" lay-skin="primary" onclick="elChoose()"></td>
                                <td width="60"><em v-text="vo.id"></em></td>
                                <td><em v-text="vo.name"></em></td>
                                <td><img :src="vo.thumb" alt="@{{vo.name}}" style="width: 30px;height: 30px"></td>
                                <td><em v-text="vo.category1.name"></em><em v-if="vo.category2.name" v-text="'&nbsp;>>&nbsp;'+vo.category2.name"></em></td>
                                <td>
                                    <div class="layui-unselect layui-form-switch" :class="{'layui-form-onswitch':vo.status}" @click="elChange(vo)"><em>@{{vo.status?'{!!trans('admin/setting.up')!!}':'{!!trans('admin/setting.down')!!}'}}</em><i></i></div>
                                </td>
                                <td width="152">
                                    <div class="layui-btn-group">
                                    @permission('waypoint.edit')
                                        <button @click="edithtml(vo.id)" class="layui-btn layui-btn-primary layui-btn-small"><i class="layui-icon"></i></button>
                                    @endpermission
                                    @permission('waypoint.destroy')
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
@extends('admin.waypoint.waypoint.create')
@endsection
@section('my-js')
<script>
    layui.extend({
        'waypoint-index': 'js/waypoint/waypoint-index'
    }).use(['waypoint-index']);
</script>
@endsection
