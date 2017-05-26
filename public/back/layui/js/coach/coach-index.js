/**
 *  公用列表
 */
layui.define(['global', 'form', 'laypage'], function(exports) {
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form(),
        Aizxin = layui.global,
        laypage = layui.laypage;
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
        var acoachList = new Vue({
            el: '#coachlist',
            data: {
                price: [],
                coach: [],
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
                getphoto: function(gallery) {
                    for (var i = 0; i < gallery.length; i++) {
                        gallery[i].src = gallery[i].gallery;
                    }
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
                },
                elDetail: function(id) {
                    var _this = this;
                    layer.open({
                        type: 1,
                        title: '教练详情',
                        full: false,
                        shadeClose: true,
                        shade: 0.3,
                        content: $('#coachdetail'),
                        area: ['600px', '400px'],
                        anim: 5,
                        success: function(layero, index) {
                            axios.get(Aizxin.U('coach') + '/' + id)
                                .then(function(response) {
                                    $("#detailoverview").html(response.data.data.overview);
                                    $("#detaildescription").html(response.data.data.description);
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
                    var html = vo.status ? '启用' : '禁用';
                    var data = {
                        id: vo.id,
                        status: vo.status
                    };
                    layer.confirm('确认是否' + html + '?', {
                        icon: 3,
                        title: '提示'
                    }, function(index) {
                        axios.post(Aizxin.U('coach/switch'), data)
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
                    axios.post(Aizxin.U('coach/index'), this.search)
                        .then(function(response) {
                            console.log(response.data);
                            if (response.data.code == 200) {
                                _this.$set('coach', response.data.data.data);
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
                        layer.msg('没有删除的教练', {
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
                        title: '删除教练'
                    }, function(index) {
                        layer.close(index);
                        var indexload = layer.load(1, {
                            shade: 0.5
                        });
                        axios.delete(Aizxin.U('coach') + '/' + id).then(function(response) {
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
                    window.location.href = Aizxin.U('coach/create');
                },
                edithtml: function(id) {
                    var index = layer.load(1, {
                        shade: 0.5
                    });
                    window.location.href = Aizxin.U('coach') + '/' + id + '/edit';
                },
            }
        });
        //搜索驾校
        form.on('submit(searchcoach)', function(data) {
            acoachList.$set('search', '');
            acoachList.search.page = 1;
            if (data.field.schoolId != '') {
                acoachList.$set('search.schoolId', data.field.schoolId);
            }
            if (data.field.name != '') {
                acoachList.$set('search.name', data.field.name);
            }
            if (data.field.phone != '') {
                acoachList.$set('search.phone', data.field.phone);
            }
            console.log(acoachList.search);
            acoachList.list();
            return false;
        });
    });
    exports('coach-index', {});
});