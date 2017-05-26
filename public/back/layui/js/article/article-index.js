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
        var aarticleList = new Vue({
            el: '#articlelist',
            data: {
                article: [],
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
                        shade: 0.5,
                        shade: 0.5
                    });
                    window.location.href = Aizxin.U('article/create');
                },
                changelist: function() {
                    this.search.page = 1;
                    this.list();
                },
                list: function() {
                    var index = layer.load(1, {
                        shade: 0.5,
                        shade: 0.5
                    });
                    var _this = this;
                    axios.post(Aizxin.U('article/index'), this.search)
                        .then(function(response) {
                            if (_this.pages != response.data.data.last_page) {
                                _this.$set('pages', response.data.data.last_page);
                                _this.page();
                            }
                            layer.close(index);
                            $('#list').find('tbody').css('display', 'table-row-group');
                            _this.$set('article', response.data.data.data);
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
                        layer.msg('没有删除的节点', {
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
                        title: '删除文章'
                    }, function(index) {
                        layer.close(index);
                        var indexload = layer.load(1, {
                            shade: 0.5
                        });
                        axios.delete(Aizxin.U('article') + '/' + id).then(function(response) {
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
                edithtml: function(id) {
                    var index = layer.load(1, {
                        shade: 0.5
                    });
                    window.location.href = Aizxin.U('article') + '/' + id + '/edit';
                },
            }
        });
    });
    exports('article-index', {});
});