/**
 *  公用列表
 */
layui.define(['global', 'form', 'laypage','laytpl','laydate'], function(exports) {
    var $ = layui.jquery,
        laytpl = layui.laytpl,
        layer = layui.layer,
        form = layui.form(),
        Aizxin = layui.global,
        laydate = layui.laydate,
        laypage = layui.laypage;
    $(function() {
        var aorderList = new Vue({
            el: '#orderlist',
            data: {
                order:[],
                search: {
                    pageSize: 15
                },
                pages: 10,
            },
            created: function() {
                this.list();
            },
            methods: {
                orderPay: function(data) {
                    var _this = this;
                    layer.open({
                        type: 1,
                        title: '订单支付记录',
                        full: false,
                        shadeClose: true,
                        shade: 0.3,
                        content: $('#view'),
                        area: ['700px', '400px'],
                        anim: 5,
                        success: function(layero, index) {
                            var total = 0;
                            console.log(data);
                            layui.each(data,function(i,va){
                                total+=parseFloat(va.money);
                            });
                            data.total = total;
                            laytpl(paydetail.innerHTML).render(data, function(html){
                                view.innerHTML = html;
                            });  
                            // var price = 0;
                        }
                    });
                },
                changelist: function() {
                    this.search.page = 1;
                    this.list();
                },
                list: function() {
                    var index = layer.load(1, {
                        shade: 0.5
                    });
                    var _this = this;
                    axios.post(Aizxin.U('order/index'), this.search)
                        .then(function(response) {
                            if (response.data.code == 200) {
                                _this.$set('order', response.data.data.data);
                            }
                            console.log(aorderList.order);
                            if (_this.pages != response.data.data.last_page) {
                                _this.$set('pages', response.data.data.last_page);
                                _this.page();
                            }
                            layer.close(index);
                            $('#list').find('tbody').css('display', 'table-row-group');
                        }).catch(function(error) {
                            console.log(error);
                        });
                    form.render('checkbox');
                },
                page: function() {
                    var _this = this;
                    laypage({
                        cont: 'page',
                        pages: this.pages,
                        skip: true,
                        jump: function(obj, first) {
                            if (!first) {
                                _this.search.page = obj.curr;
                                _this.list();
                            }
                        }
                    });
                },
                allDelete: function() {
                    var ids = [];
                    var child = $('#list').find('tbody input[type="checkbox"]');
                    child.each(function(index, item) {
                        if (item.checked) {
                            ids.push(item.value)
                        }
                    });
                    if (!ids.length) {
                        layer.msg('没有删除的订单', {
                            icon: 5
                        });
                        return;
                    };
                    this.elDelete(ids.join(","));
                },
                elDelete: function(id) {
                    var _this = this;
                    layer.confirm('确认是否删除', {
                        icon: 1,
                        title: '删除订单'
                    }, function(index) {
                        layer.close(index);
                        var indexload = layer.load(1, {
                            shade: 0.5
                        });
                        axios.delete(Aizxin.U('order') + '/' + id).then(function(response) {
                            if (response.data.code == 200) {
                            layer.close(indexload);
                                layer.msg(response.data.message, {
                                    icon: 6,
                                    shade: 0.5
                                })
                                _this.list();
                            } else {
                                layer.close(indexload);
                                
                                layer.msg(response.data.message, {
                                    icon: 5,
                                    shade: 0.5
                                })
                            }
                        }).catch(function(error) {
                            layer.closeAll();
                            layer.msg('系统错误', {
                                icon: 5,
                                shade: 0.5
                            });
                        });
                    });
                },
            }
        });
        //搜索订单
        form.on('submit(searchorder)', function(data) {
            aorderList.$set('search', {});
            if (data.field.orderNo != '') {
                aorderList.$set('search.orderNo', data.field.orderNo);
            }
            if (data.field.phone != '') {
                aorderList.$set('search.phone', data.field.phone);
            }
            if (data.field.created_at != '') {
                aorderList.$set('search.created_at', data.field.created_at);
            }
            if (data.field.orderType != '') {
                aorderList.$set('search.orderType', data.field.orderType);
            }
            aorderList.list();
            return false;
        });
    });
    exports('order-index', {});
});