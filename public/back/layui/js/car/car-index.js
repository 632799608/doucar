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
        var acarList = new Vue({
            el: '#carlist',
            data: {
                car: [],
                search: {
                    pageSize: 15
                },
                pages: 10,
            },
            created: function() {
                this.list();
            },
            methods: {
                changelist: function() {
                    this.search.page = 1;
                    this.list();
                },
                list: function() {
                    var index = layer.load(1, {
                        shade: 0.5
                    });
                    var _this = this;
                    axios.post(Aizxin.U('car/index'), this.search)
                        .then(function(response) {
                            if (response.data.code == 200) {
                                _this.$set('car', response.data.data.data);
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
                        layer.msg('没有删除的车辆', {
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
                        title: '删除车辆'
                    }, function(index) {
                        layer.close(index);
                        var indexload = layer.load(1, {
                            shade: 0.5
                        });
                        axios.delete(Aizxin.U('car') + '/' + id).then(function(response) {
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
                    window.location.href = Aizxin.U('car/create');
                },
                carEr: function(id) {
                    axios.post(Aizxin.U('car/erwei'), {
                        id: id
                    }).then(function(response) {
                        console.log(response);
                        var gallery = [];
                        gallery.push({
                            src: response.data.data
                        });
                        var photo = {
                            "title": "", //相册标题
                            "id": 123, //相册id
                            "start": 0, //初始显示的图片序号，默认0
                            "data": gallery,
                        }
                        layer.photos({
                            photos: photo,
                            tab: function(pic, layero) {

                            }
                        });
                    }).catch(function(error) {
                        console.log(error);
                    });
                }
            }
        });
        //搜索驾校
        form.on('submit(searchcar)', function(data) {
            acarList.$set('search', '');
            acarList.search.page = 1;
            if (data.field.schoolId != '') {
                acarList.$set('search.schoolId', data.field.schoolId);
            }
            if (data.field.license != '') {
                acarList.$set('search.license', data.field.license);
            }
            console.log(acarList.search);
            acarList.list();
            return false;
        });
    });
    exports('car-index', {});
});