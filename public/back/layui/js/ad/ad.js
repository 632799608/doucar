/**
 *  公用列表
 */
layui.define(['global', 'form', 'laypage', 'upload'], function(exports) {
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form(),
        laypage = layui.laypage,
        Aizxin = layui.global;
    $(function() {
        // 图片上传
        Aizxin.uploadQiniu('#ad-upload', 'LAY_demo_upload', $('.i-delete'));
        // 图片上传
        Aizxin.uploadQiniu('#ad-upload_edit', 'LAY_demo_upload_edit', $('.i-delete'));
        // 文件删除
        $('#adadddel').on('click', function() {
            var url = LAY_demo_upload.src;
            Aizxin.deleQiniu(url, $("#LAY_demo_upload"));
        });
        $('#adeditdel').on('click', function() {
            var url = LAY_demo_upload_edit.src;
            Aizxin.deleQiniu(url, $("#LAY_demo_upload_edit"));
        });
        // 广告列表vue
        var adList = new Vue({
            el: '#adlist',
            data: {
                ad: [],
                search: {
                    pageSize: 5
                },
                pages: 10
            },
            created: function() {
                this.list();
            },
            methods: {
                // 页数
                changelist: function() {
                    this.search.page = 1;
                    this.list();
                },
                // 列表
                list: function() {
                    var index = layer.load(1, {
                        shade: 0.5
                    });
                    var _this = this;
                    axios.post(Aizxin.U('web/ad/index'), this.search)
                        .then(function(response) {
                            if (_this.pages != response.data.data.last_page) {
                                _this.$set('pages', response.data.data.last_page);
                                _this.page();
                            }
                            layer.close(index);
                            $('#list').find('tbody').css('display', 'table-row-group');
                            _this.$set('ad', response.data.data.data);
                        })
                        .catch(function(error) {
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
                                _this.list();
                            }
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
                        layer.msg('没有删除的广告', {
                            icon: 5,
                            shade: 0.5
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
                        title: '删除广告'
                    }, function(index) {
                        layer.close(index);
                        var indexload = layer.load(1, {
                            shade: 0.5
                        });
                        axios.delete(Aizxin.U('web/ad') + '/' + id).then(function(response) {
                            if (response.data.code == 200) {
                                layer.msg(response.data.message, {
                                    icon: 6,
                                    shade: 0.5
                                });
                                layer.close(indexload);
                                _this.list();
                            } else {
                                layer.msg(response.data.message, {
                                    icon: 5,
                                    shade: 0.5
                                });
                                layer.close(indexload);
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
                // 广告修改的open
                edithtml: function(id) {
                    var _this = this;
                    var indexsS = layer.load(1);
                    layer.open({
                        type: 1,
                        title: '广告修改',
                        full: false,
                        shadeClose: true,
                        shade: 0.3,
                        content: $('#adedithtml'),
                        area: ['400px', '400px'],
                        anim: 5,
                        success: function(layero, index) {
                            axios.get(Aizxin.U('web/ad') + "/" + id + "/edit").then(function(response) {
                                    $("#adEditId").val(response.data.data.id);
                                    $("#adEditTitle").val(response.data.data.title);
                                    $("#adEditUrl").val(response.data.data.url);
                                    $("#LAY_demo_upload_edit").attr('src', response.data.data.thumb);
                                    $('.i-delete').show();
                                    layer.close(indexsS);
                                })
                                .catch(function(error) {
                                    console.log(error);
                                });
                        }
                    });
                },
            }
        });
        //广告添加 监听提交
        form.on('submit(adadd)', function(data) {
            data.field.id = 0;
            data.field.thumb = LAY_demo_upload.src;
            var index = layer.load(1, {
                shade: 0.5
            });
            axios.post(Aizxin.U('web/ad'), data.field)
                .then(function(response) {
                    layer.close(index);
                    if (response.data.code == 200) {
                        layer.msg(response.data.message, {
                            time: 2000,
                            shade: 0.5
                        }, function() {
                            LAY_demo_upload.src = Aizxin.U('back') + '/images/no-image.png';
                            $("#LAY_demo_upload").hide();
                            $('.i-delete').hide();
                            adList.list();
                            layer.closeAll();
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
                        icon: 5
                    });
                });
            return false;
        });
        //广告修改 监听提交
        form.on('submit(adedit)', function(data) {
            data.field.thumb = LAY_demo_upload_edit.src;
            var index = layer.load(1, {
                shade: 0.5
            });
            axios.post(Aizxin.U('web/ad'), data.field)
                .then(function(response) {
                    layer.close(index);
                    if (response.data.code == 200) {
                        layer.msg(response.data.message, {
                            time: 2000
                        }, function() {
                            $('.i-delete').hide();
                            adList.list();
                            layer.closeAll();
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
    });
    exports('ad', {});
});