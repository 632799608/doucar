@extends('layouts.admin')
@section('style')
<style type="text/css">
    .site-demo-upload, .site-demo-upload img{
        width: 80px;
        height: 80px;        
    }
    .site-upload, .site-upload img{
        width: 50px;
        height: 50px;
        border-radius: 100%;        
    }
    #memberaddavatar,#membereditavatar{
        display: none;
        margin-top: 5px
    }
    .i-delete{
        color: red;
        font-size: 12px
    }
    #list img{

    }
</style>
@endsection
@section('content')
<div class="layui-body site-demo" id="memberlist">
    <div class="layui-tab-content" style="padding: 16px;">
        <div class="container-fluid larry-wrapper">
            <section class="panel panel-padding">
                <form class="layui-form" >
                    <div class="layui-form">
                        <div class="layui-inline">
                            <div class="layui-input-inline">
                                <input class="layui-input" name="phone" placeholder="手机号码搜索" v-model="search.phone">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <button type="button" class="layui-btn" @click="searchForm()">查找</button>
                        </div>
                    </div>
                </form>
            </section>

            <section class="panel panel-padding">
                <select class="layui-btn layui-btn-small layui-btn-primary ajax-all" v-model="search.pageSize" v-on:change="changelist(search.pageSize)">
                    <option value="{{config('admin.global.pagination.pageSize')}}" selected>{!!trans('admin/setting.page')!!}</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                </select>
                @permission('member.destroy')
                <button class="layui-btn layui-btn-small layui-btn-danger ajax-all" @click="allDelete()">
                    <i class="fa fa-trash"></i>{!!trans('admin/setting.all_delete')!!}
                </button>
                @endpermission
                @permission('member.create')
                <button class="layui-btn layui-btn-small modal-catch" data-params='{"content":"#memberaddhtml","area":"400px,500px", "title":"{!!trans("admin/member.create")!!}","type":"1"}'>
                    <i class="fa fa-plus-square"></i> {!!trans('admin/setting.add')!!}
                </button>
                @endpermission
            </div>
            <div id="list" class="layui-form">
                <table id="example" class="layui-table lay-even">
                    <thead>
                        <tr>
                            <th width="30"><input type="checkbox" id="checkall" data-name="checkbox" lay-filter="allChoose" lay-skin="primary"></th>
                            <th width="60">{!!trans('admin/member.model.id')!!}</th>
                            <th>{!!trans('admin/member.model.nickname')!!}</th>
                            <th>{!!trans('admin/member.model.phone')!!}</th>
                            <th>{!!trans('admin/member.model.headPortrait')!!}</th>
                            <th>{!!trans('admin/member.model.isCoach')!!}</th>
                            <th>{!!trans('admin/member.model.active')!!}</th>
                            <th>{!!trans('admin/member.model.accountType')!!}</th>
                            <th>{!!trans('admin/setting.make')!!}</th>
                        </tr>
                    </thead>
                    <tbody style="display: none">
                        <tr v-for="vo in member">
                            <td width="30"><input type="checkbox" name="checkbox" value="@{{vo.id}}" lay-skin="primary"></td>
                            <td width="60">@{{vo.id}}</td>
                            <td>@{{vo.nickname}}</td>
                            <td>@{{vo.phone}}</td>
                            <td>
                                <div class="site-upload">
                                  <img v-bind:src="vo.avatar" >
                                </div>
                            </td>
                            <td>
                                <span v-if="!vo.isCoach">学员</span>
                                <span v-if="vo.isCoach">教练</span>
                            </td>
                            <td class="elBox">
                                <div class="layui-unselect layui-form-switch" :class="{'layui-form-onswitch':vo.active}" @click="changeSwitch(vo)"><em>@{{vo.active?'启用':'禁用'}}</em><i></i></div>
                            </td>
                            <td>
                                <span v-if="vo.accountType == 1">手机号码</span>
                                <span v-if="vo.accountType == 2">QQ</span>
                                <span v-if="vo.accountType == 3">微信</span>
                            </td>
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
    @extends('admin.member.create')
    @extends('admin.member.edit')
</div>
@endsection
@section('my-js')
<script>
    layui.extend({
        'member': 'js/member/member',
    }).use(['member']);
</script>
</script>
@endsection
