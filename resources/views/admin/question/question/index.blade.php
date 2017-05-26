@extends('layouts.admin')
@section('style')
@endsection
@section('content')
@inject('menuPresenter','Aizxin\Presenters\MenuPresenter')
<div class="layui-body site-demo" id="questionlist">
    <div class="layui-tab-content" style="padding: 16px;">
        <div class="container-fluid larry-wrapper">
            <!--头部搜索-->
            <section class="panel panel-padding">
                <form class="layui-form" >
                    <div class="layui-form">
                        <div class="layui-inline">
                            <select name="questionCategoryId" id="questionCategoryId" lay-filter="questionCategoryId" v-model="search.questionCategoryId" lay-verify="required">
                                {!!$menuPresenter->topMenuList(trans('admin/question.menu'),$category)!!}
                            </select>
                        </div>
                        <div class="layui-inline">
                            <div class="layui-input-inline">
                                <input class="layui-input" name="keyword" placeholder="{!!trans('admin/question.model.name')!!}" v-model="search.name">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <button type="button" class="layui-btn" @click="searchList()">查找</button>
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
                    @permission('question.destroy')
                    <button class="layui-btn layui-btn-small layui-btn-danger ajax-all" @click="allDelete()">
                        <i class="fa fa-trash"></i>{!!trans('admin/setting.all_delete')!!}
                    </button>
                    @endpermission
                    @permission('question.edit')
                    <button class="layui-btn layui-btn-small layui-btn-normal ajax-all" @click="allChange(0)">
                        <i class="fa fa-check"></i>{!!trans('admin/setting.up')!!}
                    </button>
                    <button class="layui-btn layui-btn-small layui-btn-warm ajax-all" @click="allChange(1)">
                        <i class="fa fa-close"></i>{!!trans('admin/setting.down')!!}
                    </button>
                    @endpermission
                    @permission('question.create')
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
                                <th width="60">{!!trans('admin/question.model.id')!!}</th>
                                <th>{!!trans('admin/question.model.name')!!}</th>
                                <th>{!!trans('admin/question.category')!!}</th>
                                <th>{!!trans('admin/question.status')!!}</th>
                                <th>{!!trans('admin/setting.make')!!}</th>
                            </tr>
                        </thead>
                        <tbody style="display: none">
                            <tr v-for="vo in question">
                                <td width="30"><input type="checkbox" data-name="@{{vo.id+'checkbox'}}" value="@{{vo.id}}" lay-skin="primary" onclick="elChoose()"></td>
                                <td width="60"><em v-text="vo.id"></em></td>
                                <td><em v-text="vo.name"></em></td>
                                <td><em v-text="vo.category.name"></em></td>
                                <td>
                                    <div class="layui-unselect layui-form-switch" :class="{'layui-form-onswitch':vo.status}" @click="elChange(vo)"><em>@{{vo.status?'{!!trans('admin/setting.up')!!}':'{!!trans('admin/setting.down')!!}'}}</em><i></i></div>
                                </td>
                                <td width="152">
                                    <div class="layui-btn-group">
                                    @permission('question.edit')
                                        <button @click="edithtml(vo.id)" class="layui-btn layui-btn-primary layui-btn-small"><i class="layui-icon"></i></button>
                                    @endpermission
                                    @permission('question.destroy')
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
        'question-index': 'js/question/question-index'
    }).use(['question-index']);
</script>
@endsection
