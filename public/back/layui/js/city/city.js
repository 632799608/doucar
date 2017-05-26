/**
 *  公用列表
 */
layui.define(['global', 'form', 'laypage'], function(exports) {
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form(),
        laypage = layui.laypage,
        Aizxin = layui.global;
    var defaults = {
        s1: 'province',
        s2: 'city',
        s3: 'areaid',
        v1: 530000,
        v2: null,
        v3: null,
        name: '地区'
    };

    $(function() {
        // 城市添加vue
        var citylist1 = new Vue({
            el: '#citylist',
            data: {
                province: [],
                areaList: [],
                city: [],
                citylist: [],
                search: {
                    pageSize: 15
                },
                pages: 10
            },
            created: function() {
                this.getArea();
                this.getList();
            },
            methods: {
                // 获取全国各省市
                getArea: function() {
                    var _this = this;
                    axios.get(Aizxin.U('area'))
                        .then(function(response) {
                            _this.$set('areaList', response.data);
                        }).catch(function(error) {
                            console.log(error);
                        });
                },
                //获取用户添加的区域列表
                getList: function() {
                    var index = layer.load(1, {
                        shade: 0.5
                    });
                    var _this = this;
                    axios.post(Aizxin.U('web/city/index'), _this.search)
                        .then(function(response) {
                            layer.close(index);
                            if (_this.pages != response.data.data.last_page) {
                                _this.$set('pages', response.data.data.last_page);
                                _this.page();
                            }
                            _this.$set('citylist', response.data.data.data);
                        })
                        .catch(function(error) {
                            layer.close(index);
                            console.log(error);
                        });
                },
                // 分页
                page: function() {
                    var _this = this;
                    laypage({
                        cont: 'page',
                        pages: this.pages,
                        skip: true,
                        jump: function(obj, first) {
                            if (!first) {
                                _this.search.page = obj.curr;
                                _this.getList();
                            }
                        }
                    });
                },
                // 页数
                changelist: function() {
                    this.search.page = 1;
                    this.getList();
                },
                // 城市修改的open
                edithtml: function(id) {
                    var _this = this;
                    var indexsS = layer.load(1, {
                        shade: 0.5,
                        shade: 0.5
                    });
                    layer.open({
                        type: 1,
                        title: '城市修改',
                        full: false,
                        shadeClose: true,
                        shade: 0.3,
                        content: $('#cityedithtml'),
                        area: ['570px', '400px'],
                        anim: 5,
                        success: function(layero, index) {
                            axios.get(Aizxin.U('web/city') + "/" + id + "/edit")
                                .then(function(response) {
                                    var defauls = {
                                        s1: 'province',
                                        s2: 'city',
                                        s3: 'areaid',
                                        v1: response.data.data.province,
                                        v2: response.data.data.city,
                                        v3: null,
                                        name: '地区'
                                    };
                                    Aizxin.treeSelect(defauls, _this.areaList.data, $('#cityeditreset'));
                                    form.render();
                                    $('#cityeditid').val(id);
                                    $('#editname').val(response.data.data.name);
                                    $('#editkey').val(response.data.data.key);
                                    layer.close(indexsS);
                                })
                                .catch(function(error) {
                                    console.log(error);
                                });
                        }
                    });
                },
                // 批量删除
                allDelete: function() {
                    var ids = [];
                    var child = $('#list').find('tbody input[type="checkbox"]');
                    child.each(function(index, item) {
                        if (item.checked) {
                            ids.push(item.value)
                        }
                    });
                    if (!ids.length) {
                        layer.msg('没有删除的城市', {
                            icon: 5
                        });
                        return;
                    };
                    this.elDelete(ids.join(","));
                },
                // 单删除
                elDelete: function(id) {
                    var _this = this;
                    layer.confirm('确认是否删除', {
                        icon: 1,
                        title: '删除城市'
                    }, function(index) {
                        layer.close(index);
                        var indexload = layer.load(1, {
                            shade: 0.5
                        });
                        axios.delete(Aizxin.U('web/city') + '/' + id).then(function(response) {
                                if (response.data.code == 200) {
                                    layer.close(indexload);
                                    layer.msg(response.data.message, {
                                        icon: 6,
                                        shade: 0.5
                                    })
                                    _this.getList();
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
                cityaddhtml: function() {
                    Aizxin.treeSelect(defaults, this.areaList.data, $('#cityaddform'));
                },
            }
        });
        //城市添加
        form.on('submit(cityadd)', function(data) {
            var index = layer.load(1, {
                shade: 0.5
            });
            data.field.key = data.field.key.toUpperCase();
            axios.post(Aizxin.U('web/city'), data.field)
                .then(function(response) {
                    layer.close(index);
                    if (response.data.code == 200) {
                        layer.msg(response.data.message, {
                            time: 1000,
                            shade: 0.5
                        }, function() {
                            citylist1.getList();
                            layer.closeAll();
                        })
                    } else {
                        layer.msg(response.data.message, {
                            icon: 5,
                            shade: 0.5
                        });
                    }
                }).catch(function(error) {
                    layer.close(index);
                    layer.msg('系统错误', {
                        icon: 5,
                        shade: 0.5
                    });
                });
            return false;
        });
        //城市修改
        form.on('submit(cityedit)', function(data) {
            var index = layer.load(1, {
                shade: 0.5
            });
            data.field.key = data.field.key.toUpperCase();
            axios.put(Aizxin.U('web/city') + "/" + data.field.id, data.field)
                .then(function(response) {
                    layer.close(index);
                    if (response.data.code == 200) {
                        layer.msg(response.data.message, {
                            time: 1000,
                            shade: 0.5
                        }, function() {
                            citylist1.getList();
                            layer.closeAll();
                        })
                    } else {
                        layer.msg(response.data.message, {
                            icon: 5,
                            shade: 0.5
                        });
                    }
                }).catch(function(error) {
                    layer.close(index);
                    layer.msg('系统错误', {
                        icon: 5,
                        shade: 0.5
                    });
                });
            return false;
        });
    });
    exports('city', {});
});