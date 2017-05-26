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
        var aschoolList = new Vue({
            el: '#schoollist',
            data: {
                price: [],
                school: [],
                search: {
                    pageSize: 15
                },
                pages: 10,
                areaList: []
            },
            created: function() {
                this.list();
                this.getArea();
            },
            methods: {
                // 获取全国各省市
                getArea: function() {
                    var _this = this;
                    axios.get(Aizxin.U('area'))
                        .then(function(response) {
                            _this.$set('areaList', response.data);
                            Aizxin.treeSelect(defaults, _this.areaList.data, $('#schoolsearch'));
                            form.render();
                        }).catch(function(error) {
                            layer.closeAll();
                            layer.msg('系统错误', {
                                icon: 5,
                                shade: 0.5
                            });
                        });
                },
                getphoto: function(id) {
                    axios.get(Aizxin.U('school') + '/' + id)
                    .then(function(response) {
                        var gallery = response.data.data.gallery
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
                    }).catch(function(error) {
                        console.log(error);
                    });
                },
                elDetail: function(id) {
                    var _this = this;
                    layer.open({
                        type: 1,
                        title: '驾校详情',
                        full: false,
                        shadeClose: true,
                        shade: 0.3,
                        content: $('#schooldetail'),
                        area: ['600px', '400px'],
                        anim: 5,
                        success: function(layero, index) {
                            axios.get(Aizxin.U('school') + '/' + id)
                                .then(function(response) {
                                    console.log(response.data.data);
                                    var price = response.data.data.price;
                                    var pricehtml = '';
                                    for (var i = 0; i < price.length; i++) {
                                        pricehtml += '<tr><td>' + price[i].type + '</td><td>' + price[i].price + '</td></tr>';
                                    }
                                    $("#schooldetail tbody").html(pricehtml);
                                    $("#detailoverview").html(response.data.data.overview);
                                    $("#detaildescription").html(response.data.data.description);
                                })
                                .catch(function(error) {
                                    console.log(error);
                                });
                        }
                    });
                },
                addhtml: function() {
                    var index = layer.load(1, {
                        shade: 0.5
                    });
                    window.location.href = Aizxin.U('school/create');
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
                        axios.post(Aizxin.U('school/switch'), data)
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
                    axios.post(Aizxin.U('school/index'), this.search)
                        .then(function(response) {

                            if (response.data.code == 200) {
                                _this.$set('school', (response.data.data.data));
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
                        layer.msg('没有删除的驾校', {
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
                        title: '删除驾校'
                    }, function(index) {
                        layer.close(index);
                        var indexload = layer.load(1, {
                            shade: 0.5
                        });
                        axios.delete(Aizxin.U('school') + '/' + id).then(function(response) {
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
                edithtml: function(id) {
                    var index = layer.load(1, {
                        shade: 0.5
                    });
                    window.location.href = Aizxin.U('school') + '/' + id + '/edit';
                },
            }
        });
        //编辑驾校
        form.on('submit(searchSchool)', function(data) {
            aschoolList.$set('search', {});
            aschoolList.search.page = 1;
            if (data.field.province != 0) {
                aschoolList.$set('search.province', data.field.province);
            }
            if (data.field.city != 0) {
                aschoolList.$set('search.city', data.field.city);
            }
            if (data.field.name != '') {
                aschoolList.$set('search.name', data.field.name);
            }
            aschoolList.list();
            return false;
        });
    });
    exports('school-index', {});
});