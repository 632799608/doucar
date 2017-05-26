/**
 *  公用列表
 */
layui.define(['global', 'form', 'laypage'], function(exports) {
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form(),
        Aizxin = layui.global,
        laypage = layui.laypage;
    $(function() {
        var apurchaseList = new Vue({
            el: '#purchaselist',
            data: {
                price: [],
                purchase: [],
                search: {
                    pageSize: 15
                },
                pages: 10,
                areaList: []
            },
            created: function() {
                this.list();
            },
            methods: {
                elDetail: function(id) {
                    var _this = this;
                    layer.open({
                        type: 1,
                        title: '团购详情',
                        full: false,
                        shadeClose: true,
                        shade: 0.3,
                        content: $('#purchasedetail'),
                        area: ['600px', '400px'],
                        anim: 5,
                        success: function(layero, index) {
                            axios.get(Aizxin.U('purchase') + '/' + id)
                                .then(function(response) {
                                    $("#detailcontent").html(response.data.data.content);
                                })
                                .catch(function(error) {
                                    console.log(error);
                                });
                        }
                    });
                },
                changeSwitch: function(vo) {
                    var _this = this;
                    vo.status = vo.status == 1 ? 0 : 1;
                    var html = vo.status ? '上架' : '下架';
                    var data = {
                        id: vo.id,
                        status: vo.status
                    };
                    layer.confirm('确认是否' + html + '?', {
                        icon: 3,
                        title: '提示'
                    }, function(index) {
                        axios.post(Aizxin.U('purchase/switch'), data)
                            .then(function(response) {
                                layer.msg(response.data.message, {
                                    shade: 0.5
                                });
                            }).catch(function(error) {
                                layer.msg('系统错误', {
                                    shade: 0.5
                                });
                            });
                        layer.close(index);
                    }, function(index) {
                        vo.status = !vo.status;
                        layer.close(index);
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
                    axios.post(Aizxin.U('purchase/index'), this.search)
                        .then(function(response) {
                            console.log(response.data);
                            if (response.data.code == 200) {
                                _this.$set('purchase', (response.data.data.data));
                            }
                            if (_this.pages != response.data.data.last_page) {
                                _this.$set('pages', response.data.data.last_page);
                                _this.page();
                            }
                            layer.close(index);
                            $('#list').find('tbody').css('display', 'table-row-group');
                        })
                        .catch(function(error) {
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
                        layer.msg('没有删除的团购', {
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
                        title: '删除团购'
                    }, function(index) {
                        layer.close(index);
                        var indexload = layer.load(1, {
                            shade: 0.5
                        });
                        axios.delete(Aizxin.U('purchase') + '/' + id).then(function(response) {
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
                            })
                            .catch(function(error) {
                                layer.closeAll();
                                layer.msg('系统错误', {
                                    icon: 5,
                                    shade: 0.5
                                });
                            });
                    });
                },
                addhtml: function() {
                    var index = layer.load(1, {
                        shade: 0.5
                    });
                    window.location.href = Aizxin.U('purchase/create');
                },
                edithtml: function(id) {
                    var index = layer.load(1, {
                        shade: 0.5
                    });
                    window.location.href = Aizxin.U('purchase') + '/' + id + '/edit';
                },
            }
        });
        //搜索驾校
        form.on('submit(searchpurchase)', function(data) {
            apurchaseList.$set('search', '');
            apurchaseList.search.page = 1;
            if (data.field.schoolId != '') {
                apurchaseList.$set('search.schoolId', data.field.schoolId);
            }
            if (data.field.name != '') {
                apurchaseList.$set('search.name', data.field.name);
            }
            apurchaseList.list();
            return false;
        });
    });
    exports('purchase-index', {});
});