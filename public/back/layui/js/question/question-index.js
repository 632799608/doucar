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
        var aquestionList = new Vue({
            el: '#questionlist',
            data: {
                question: [],
                search: {
                    pageSize: 15
                },
                pages: 10
            },
            created: function() {
                this.list()
            },
            methods: {
                addhtml: function() {
                    var index = layer.load(1, {
                        shade: 0.5
                    });
                    window.location.href = Aizxin.U('question/create');
                },
                changelist: function(vo) {
                    this.$set('search', {});
                    this.$set('search.pageSize', vo);
                    this.search.page = 1;
                    this.list();
                },
                list: function() {
                    var index = layer.load(1, {
                        shade: 0.5
                    });
                    var _this = this;
                    axios.post(Aizxin.U('question/index'), this.search)
                        .then(function(response) {
                            if (_this.pages != response.data.data.last_page) {
                                _this.$set('pages', response.data.data.last_page);
                                _this.page();
                            }
                            layer.close(index);
                            $('#list').find('tbody').css('display', 'table-row-group');
                            _this.$set('question', response.data.data.data);
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
                searchList: function() {
                    this.search.page = 1;
                    this.list();
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
                        layer.msg('没有删除的试题', {
                            icon: 5,
                            shade: 0.5
                        });
                        return;
                    };
                    this.elDelete(ids.join(","));
                },
                elDelete: function(id) {
                    var _this = this;
                    layer.confirm('确认是否删除', {
                        icon: 1,
                        title: '删除试题'
                    }, function(index) {
                        layer.close(index);
                        var indexload = layer.load(1, {
                            shade: 0.5
                        });
                        axios.delete(Aizxin.U('question') + '/' + id).then(function(response) {
                                if (response.data.code == 200) {
                                    layer.close(indexload);
                                    layer.msg(response.data.message, {
                                        icon: 6,
                                        shade: 0.5
                                    });
                                    _this.list();
                                } else {
                                    layer.close(indexload);
                                    layer.msg(response.data.message, {
                                        icon: 5,
                                        shade: 0.5
                                    });
                                }
                            })
                            .catch(function(error) {
                                layer.close(indexload);
                                layer.msg('系统错误', {
                                    icon: 5,
                                    shade: 0.5
                                });
                            });
                    });
                },
                edithtml: function(id) {
                    var index = layer.load(1, {
                        shade: 0.5
                    });
                    window.location.href = Aizxin.U('question') + '/' + id + '/edit';
                },
                allChange: function(i) {
                    var data = {
                        status: i
                    };
                    var ids = [];
                    var child = $('#list').find('tbody input[type="checkbox"]');
                    child.each(function(index, item) {
                        if (item.checked) {
                            ids.push(item.value)
                        }
                    });
                    if (!ids.length) {
                        layer.msg(i ? '没有启用的试题' : '没有禁用的试题', {
                            icon: i ? 6 : 5,
                            shade: 0.5
                        });
                        return;
                    };
                    this.changeSwitch(ids.join(","), data, 1);
                },
                elChange: function(vo) {
                    this.changeSwitch(vo.id, vo, 0);
                },
                changeSwitch: function(id, vo, i) {
                    var _this = this;
                    var html = vo.status ? '禁用' : '启用';
                    var data = {
                        id: id,
                        status: vo.status ? 0 : 1
                    };
                    layer.confirm('确认是否' + html + '?', {
                        icon: 3,
                        title: '提示'
                    }, function(index) {
                        layer.close(index);
                        var indexload = layer.load(1, {
                            shade: 0.5
                        });
                        axios.post(Aizxin.U('question/switch'), data)
                            .then(function(response) {
                                layer.close(indexload);
                                if (response.data.code == 200) {
                                    if (i) {
                                        _this.list();
                                    } else {
                                        vo.status = vo.status == 1 ? 0 : 1;
                                    }
                                }
                                layer.msg(response.data.message, {
                                    shade: 0.5
                                });
                            }).catch(function(error) {
                                layer.closeAll();
                                layer.msg('系统错误', {
                                    icon: 5,
                                    shade: 0.5
                                });
                            });
                    }, function(index) {
                        layer.close(index);
                    });
                },
            }
        });
        form.on('select(questionCategoryId)', function(data) {
            aquestionList.$set('search.questionCategoryId', data.value);
            form.render('select');
        });
    });
    exports('question-index', {});
});