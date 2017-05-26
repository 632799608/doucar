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
        var memberSignList = new Vue({
            el: '#membersignlist',
            data: {
                membersign:[],
                search: {
                    pageSize: 15
                },
                pages: 10,
            },
            created: function() {
                this.list();
            },
            methods: {
                changeSwitch: function(vo) {
                    var _this = this;
                    vo.status = vo.status == 1 ? 0 : 1;
                    var html = vo.status ? '有效' : '无效';
                    var data = {
                        id: vo.id,
                        status: vo.status
                    };
                    layer.confirm('确认是否' + html + '?', {
                        icon: 3,
                        title: '提示'
                    }, function(index) {
                        axios.post(Aizxin.U('sign/member/switch'), data)
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
                    axios.post(Aizxin.U('sign/member/index'), this.search)
                        .then(function(response) {
                            if (response.data.code == 200) {
                                _this.$set('membersign', response.data.data.data);
                            }
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
                        layer.msg('没有删除的签到信息', {
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
                        title: '删除签到信息'
                    }, function(index) {
                        layer.close(index);
                        var indexload = layer.load(1, {
                            shade: 0.5
                        });
                        axios.delete(Aizxin.U('sign/member') + '/' + id).then(function(response) {
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
        //手机号码搜索
        form.on('submit(searchMemberSign)', function(data) {
            memberSignList.$set('search', {});
            if (data.field.phone == '') {
                layer.msg('请输入会员手机号后再查询！', {
                    icon: 5,
                    shade: 0.5
                });
            }
            memberSignList.$set('search.phone', data.field.phone);
            memberSignList.list();
            return false;
        });
    });
    exports('member-index', {});
});