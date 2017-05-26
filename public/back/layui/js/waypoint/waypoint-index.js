/**
 *  公用列表
 */
layui.define(['global', 'form', 'laypage', 'upload', 'layedit'], function(exports) {
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form(),
        Aizxin = layui.global,
        upload = layui.upload,
        layedit = layui.layedit,
        laypage = layui.laypage;
    $(function() {
        // 图片上传
        Aizxin.uploadQiniu('#point-upload', 'LAY_point_upload', $('.i-delete'));
        //自定义工具栏
        var layeditPointAdd = layedit.build('point-content-add', {
            tool: ['unlink'],
            height: 100,
        });
        var awaypointList = new Vue({
            el: '#waypointlist',
            data: {
                point: [],
                search: {
                    pageSize: 15
                },
                pages: 10,
                category: []
            },
            created: function() {
                this.list();
                this.cataList();
            },
            methods: {
                cataList: function() {
                    var _this = this;
                    axios.get(Aizxin.U('waypoint/category/create'))
                        .then(function(response) {
                            _this.$set('category', response.data.data);
                            var _con = {
                                v1: 0,
                                v2: 0,
                                s1: 'wc1Id',
                                s2: 'wc2Id',
                                name: '分类'
                            };
                            Aizxin.treeSelect(_con, _this.category, $('#searchPointHtml'));
                        }).catch(function(error) {
                            layer.msg('系统错误', {
                                icon: 5,
                                shade: 0.5
                            });
                        });
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
                    axios.post(Aizxin.U('waypoint/index'), this.search)
                        .then(function(response) {
                            if (_this.pages != response.data.data.last_page) {
                                _this.$set('pages', response.data.data.last_page);
                                _this.page();
                            }
                            layer.close(index);
                            $('#list').find('tbody').css('display', 'table-row-group');
                            _this.$set('point', response.data.data.data);
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
                        layer.msg('没有删除的秘籍', {
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
                        title: '删除路标'
                    }, function(index) {
                        layer.close(index);
                        var indexload = layer.load(1, {
                            shade: 0.5
                        });
                        axios.delete(Aizxin.U('waypoint') + '/' + id).then(function(response) {
                                if (response.data.code == 200) {
                                    layer.close(indexload);

                                    layer.msg(response.data.message, {
                                        icon: 6,
                                        shade: 0.5
                                    });
                                    _this.list();
                                    layer.close(indexload);
                                } else {
                                    layer.close(indexload);

                                    layer.msg(response.data.message, {
                                        icon: 5,
                                        shade: 0.5
                                    });
                                    layer.close(indexload);
                                }
                            })
                            .catch(function(error) {
                                layer.closeAll();
                                layer.msg('系统错误', {
                                    icon: 5,
                                    shade: 0.5
                                });
                                console.log(error);
                            });
                    });
                },
                addhtml: function() {
                    var _this = this;
                    var indexsS = layer.load(1, {
                        shade: 0.5
                    });
                    layer.open({
                        type: 1,
                        title: '路标添加',
                        full: false,
                        shadeClose: true,
                        shade: 0.3,
                        content: $('#waypointAddhtml'),
                        area: ['600px', '500px'],
                        anim: 5,
                        success: function(layero, index) {
                            $('#waypointAddhtml').find('form')[0].reset();
                            layer.close(indexsS);
                            var _con = {
                                v1: 0,
                                v2: 0,
                                s1: 'wc1Id',
                                s2: 'wc2Id',
                                name: '分类'
                            };
                            $('#LAY_point_upload').parent().hide();
                            $('#LAY_point_upload').attr('src', Aizxin.U('back') + '/images/no-image.png');
                            Aizxin.treeSelect(_con, _this.category, $('#waypointAddhtml'));
                        }
                    });
                },
                edithtml: function(id) {
                    var _this = this;
                    var indexsS = layer.load(1, {
                        shade: 0.5
                    });
                    layer.open({
                        type: 1,
                        title: '路标添加',
                        full: false,
                        shadeClose: true,
                        shade: 0.3,
                        content: $('#waypointAddhtml'),
                        area: ['600px', '500px'],
                        anim: 5,
                        success: function(layero, index) {
                            axios.get(Aizxin.U('waypoint') + '/' + id + '/edit').then(function(response) {
                                if (response.data.code == 200) {
                                    var _con = {
                                        v1: response.data.data.wc1Id,
                                        v2: response.data.data.wc2Id,
                                        s1: 'wc1Id',
                                        s2: 'wc2Id',
                                        name: '分类'
                                    };
                                    $('#waypointAddhtml').find('input[name="id"]').val(response.data.data.id);
                                    $('#waypointAddhtml').find('input[name="name"]').val(response.data.data.name);
                                    $('#LAY_point_upload').parent().show();
                                    $('#LAY_point_upload').show();
                                    $('.i-delete').show();
                                    $('#LAY_point_upload').attr('src', response.data.data.thumb);
                                    $(window.frames["LAY_layedit_1"].document).find('body').html(response.data.data.content);
                                    Aizxin.treeSelect(_con, _this.category, $('#waypointAddhtml'));
                                    layer.close(indexsS);
                                }
                            });
                        }
                    });
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
                        layer.msg(i ? '没有启用的路标' : '没有禁用的路标', {
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
                        axios.post(Aizxin.U('waypoint/switch'), data)
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
                }
            }
        });
        // 文章分类添加
        form.on('submit(waypointAdd)', function(data) {
            var index = layer.load(1, {
                shade: 0.5
            });
            var url = LAY_point_upload.src;
            data.field.thumb = url.indexOf(window.conf.QINIU_DOMAINS_DEFAULT) > 0 ? url : '';
            data.field.content = layedit.getContent(layeditPointAdd);
            if (!layedit.getText(layeditPointAdd)) {
                layer.close(index);
                layer.msg('路标的内容不能为空', {
                    icon: 5,
                    shade: 0.5
                });
                return false;
            };
            axios.post(Aizxin.U('waypoint'), data.field)
                .then(function(response) {
                    layer.close(index);
                    if (response.data.code == 200) {
                        layer.msg(response.data.message, {
                            time: 1000,
                            shade: 0.5,
                            icon: 6
                        }, function() {
                            awaypointList.list();
                            layer.closeAll();
                            $('#waypointAddhtml').find('input[name="id"]').val(0);
                            $('#waypointAddhtml').find('form')[0].reset();
                            $('#waypointAddhtml').find('.ad-upload').hide();
                        });
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
        // 文章分类添加
        form.on('submit(searchPoint)', function(data) {
            awaypointList.$set('search', {});
            awaypointList.search.page = 1;
            if (data.field.wc1Id != 0) {
                awaypointList.$set('search.wc1Id', data.field.wc1Id);
            }
            if (data.field.wc2Id != 0) {
                awaypointList.$set('search.wc2Id', data.field.wc2Id);
            }
            if (data.field.name != '') {
                awaypointList.$set('search.name', data.field.name);
            }
            awaypointList.list();
            return false;
        });
        // 文件删除
        $('.ad-upload').on('click', 'i', function() {
            var url = LAY_point_upload.src;
            Aizxin.deleQiniu(url, $("#LAY_point_upload"));
        });
    });
    exports('waypoint-index', {});
});