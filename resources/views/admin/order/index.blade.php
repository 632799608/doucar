@extends('layouts.admin')
@section('style')
<style type="text/css">
    #detaildescription,#detailoverview{
        float: left;display: block;padding: 9px 5px;
    }
</style>
@endsection
@section('content')
<div class="layui-body site-demo" id="orderlist">
    <div class="layui-tab-content" style="padding: 16px;">
        <div class="container-fluid larry-wrapper">
            <section class="panel panel-padding">
                <form class="layui-form">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <div class="layui-input-inline">
                                <input class="layui-input" name="orderNo" placeholder="{!!trans('admin/order.orderSearch')!!}">
                            </div>
                            <div class="layui-input-inline">
                                <input class="layui-input" name="phone" placeholder="{!!trans('admin/order.phoneSearch')!!}">
                            </div>
                            <div class="layui-input-inline">
                                <input class="layui-input" name="created_at" placeholder="{!!trans('admin/order.timeSearch')!!}" onclick="layui.laydate({elem: this, istime: false, format: 'YYYY-MM-DD'})">
                            </div>
                            <div class="layui-input-inline"> 
                                <select name="orderType">
                                    <option value="">请选择订单类型</option>
                                    <option value="1">普通订单</option>
                                    <option value="2">团购订单</option>
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            <button class="layui-btn" lay-submit="" lay-filter="searchorder" type="button">查找</button>
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
                    @permission('order.destroy')
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
                                <th width="15">{!!trans('admin/order.model.id')!!}</th>
                                <th>{!!trans('admin/order.model.orderNo')!!}</th>
                                <th>{!!trans('admin/order.model.memberId')!!}</th>
                                <th>{!!trans('admin/order.model.name')!!}</th>
                                <th>{!!trans('admin/order.model.phone')!!}</th>
                                <th>{!!trans('admin/order.model.money')!!}</th>
                                <th>{!!trans('admin/order.model.purchaseId')!!}</th>
                                <th>{!!trans('admin/order.model.carType')!!}</th>
                                <th>{!!trans('admin/order.model.orderPay')!!}</th>
                                <th>{!!trans('admin/order.model.status')!!}</th>
                                <th>{!!trans('admin/order.model.created_at')!!}</th>
                                <th>{!!trans('admin/setting.make')!!}</th>
                            </tr>
                        </thead>
                        <tbody style="display: none">
                            <tr v-for="vo in order">
                                <td width="30"><input type="checkbox" data-name="@{{vo.id+'checkbox'}}" value="@{{vo.id}}" lay-skin="primary" onclick="elChoose()"></td>
                                <td width="60" ><em v-text="vo.id"></em></td>
                                <td><em v-text="vo.orderNo"></em></td>
                                <td><em v-text="vo.member.nickname"></em></td>
                                <td><em v-text="vo.name"></em></td> 
                                <td><em v-text="vo.phone"></em></td>                                
                                <td><em v-text="vo.money"></em></td>
                                <td><em v-text="vo.purchase.name"></em></td>
                                <td><em v-text="vo.carType"></em></td>
                                <td><em class="layui-btn layui-btn-normal" @click="orderPay(vo.pay)">支付记录详情</em></td>
                                <td>
                                    <em class="layui-btn-small layui-btn layui-btn-radius layui-btn-primary" v-if="vo.status == 0">未支付</em>
                                    <em class="layui-btn-small layui-btn layui-btn-radius" v-if="vo.status == 1">未付清</em>
                                    <em class="layui-btn-small layui-btn layui-btn-radius layui-btn-normal" v-if="vo.status == 2">已完成</em>
                                    <em class="layui-btn-small layui-btn layui-btn-radius layui-btn-warm" v-if="vo.status == -1">已失效</em>
                                </td>
                                <td><em v-text="vo.created_at"></em></td>
                                <td width="152">
                                    <div class="layui-btn-group">
                                    @permission('order.destroy')
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
<script id="paydetail" type="text/html">
    <table class="layui-table">
      <colgroup>
        <col width="150">
        <col width="150">
        <col width="150">
        <col width="150">
      </colgroup>
      <thead>
      @{{#  if(d.length > 0){ }}
        <tr>
          <th>{!!trans('admin/order.payOrderNo')!!}</th>
          <th>{!!trans('admin/order.payMoney')!!}</th>
          <th>{!!trans('admin/order.payPay')!!}</th>
          <th>{!!trans('admin/order.payTime')!!}</th>
        </tr>
      @{{#  } }}
      </thead>
      <tbody>
          @{{#  if(d.length === 0){ }}
              <span>{!!trans('admin/order.noPay')!!}</span>
          @{{#  } }}
          @{{#  layui.each(d, function(index, item){ }}
            <tr>
              <td>@{{ item.orderNo }}</td>
              <td><span class="ordermoney">@{{ item.money }}</span>&nbsp元</td>
              <td>
                  @{{#  if(item.payType === 1){ }}
                      {!!trans('admin/order.weixinPay')!!}
                  @{{#  } }} 
                  @{{#  if(item.payType === 2){ }}
                      {!!trans('admin/order.aliPay')!!}
                  @{{#  } }} 
              </td>
              <td>@{{ item.created_at }}</td>  
            </tr>
          @{{#  }); }}
      </tbody>
    </table>
    <div><span style="color: red;font-size: 18px">{!!trans('admin/order.payTotal')!!}：@{{  d.total }} 元</span></div>
</script>
<div id="view" style="display: none;"></div>
@endsection
@section('my-js')
<script>
    layui.extend({
        'order-index': 'js/order/order-index'
    }).use(['order-index']);
</script>
@endsection
