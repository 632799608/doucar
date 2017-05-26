/**
 *  公用列表
 */
layui.define(['global', 'form', 'laypage', 'upload'], function(exports) {
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form(),
        Aizxin = layui.global,
        laypage = layui.laypage;
    $(function() {
        form.verify({
            nickname: function(value) {
                if (!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)) {
                    return '会员名不能有特殊字符';
                }
                if (/(^\_)|(\__)|(\_+$)/.test(value)) {
                    return '会员名首尾不能出现下划线\'_\'';
                }
                if (/^\d+\d+\d$/.test(value)) {
                    return '会员名不能全为数字';
                }
            },
            pass: [/(.+){6,12}$/, '密码必须6到12位'],
            phone: [/^1\d{10}$/, '请输入正确手机号码']
        });
        layui.upload({
            url: Aizxin.U('qiniu'),
            elem: '#member-upload-add' //指定原始元素，默认直接查找class="layui-upload-file"
                ,
            method: 'post' //上传接口的http类型
                ,
            success: function(res, input) {
                LAY_demo_upload_add.src = res.url;
                $("#memberaddavatar").show();
            }
        });
        layui.upload({
            url: Aizxin.U('qiniu'),
            elem: '#member-upload-edit' //指定原始元素，默认直接查找class="layui-upload-file"
                ,
            method: 'post' //上传接口的http类型
                ,
            success: function(res, input) {
                LAY_demo_upload_edit.src = res.url;
                $("#memberaddavatar").show();
            }
        });
        //触发删除时间
        $('#memberaddavatar').on('click', '.i-delete', function() {
            var url = LAY_demo_upload_add.src;
            deleQiniu(url, $("#LAY_demo_upload_add"))
        });
        //触发删除时间
        $('#membereditavatar').on('click', '.i-delete', function() {
            var url = LAY_demo_upload_edit.src;
            deleQiniu(url, $("#LAY_demo_upload_edit"))
        });
        //删除七牛图片
        function deleQiniu(url, el) {
            var elthis = el;
            if (url.indexOf(window.conf.QINIU_DOMAINS_DEFAULT) > 0) {
                var index = layer.load(1, {
                    shade: 0.5
                });
                axios.put(Aizxin.U('qiniu') + '/' + 1, {
                    urlPath: url
                }).then(function(response) {
                    layer.close(index);
                    if (response.data.code == 200) {
                        layer.msg(response.data.message, {
                            icon: 1,
                            shade: 0.5
                        });
                        elthis.show();
                        elthis.attr('src', Aizxin.U('back') + '/images/no-image.png');
                        $('.i-delete').hide();
                    } else {
                        layer.msg(response.data.message, {
                            icon: 5,
                            shade: 0.5
                        });
                    }
                }).catch(function(error) {
                    console.log(error);
                });
            } else {
                layer.msg('文件不能删除');
            }
        }
        // 管理袁列表vue
        var memberList = new Vue({
            el: '#memberlist',
            data: {
                member: [],
                search: {
                    pageSize: 3,
                },
                pages: 15
            },
            created: function() {
                this.list();
            },
            methods: {
                changeSwitch: function(vo) {
                    var _this = this;
                    vo.active = vo.active == 1 ? 0 : 1;
                    var html = vo.active ? '启用' : '禁用';
                    var data = {
                        id: vo.id,
                        active: vo.active
                    };
                    layer.confirm('确认是否' + html + '?', {
                        icon: 3,
                        title: '提示'
                    }, function(index) {
                        axios.post(Aizxin.U('member/switch'), data)
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
                        vo.active = !vo.active;
                        layer.close(index);
                    });
                },
                switchsubmit: function(data) {
                    axios.post(Aizxin.U('member/switch'), data)
                        .then(function(response) {
                            layer.msg(response.data.message, {
                                shade: 0.5
                            });
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                // 页数
                changelist: function(vo) {
                    this.$set('search', {});
                    this.$set('search.pageSize', vo);
                    this.search.page = 1;
                    this.list();
                },
                // 列表
                list: function() {
                    var index = layer.load(1, {
                        shade: 0.5
                    });
                    var _this = this;
                    axios.post(Aizxin.U('member/index'), this.search)
                        .then(function(response) {
                            if (_this.pages != response.data.data.last_page) {
                                _this.$set('pages', response.data.data.last_page);
                                _this.page();
                            }
                            layer.close(index);
                            $('#list').find('tbody').css('display', 'table-row-group');
                            _this.$set('member', response.data.data.data);
                            form.render('checkbox');
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                // 搜索
                searchForm: function() {
                    this.search.page = 1;
                    this.list();
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
                        layer.msg('没有删除的会员', {
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
                        title: '删除会员'
                    }, function(index) {
                        layer.close(index);
                        var indexload = layer.load(1, {
                            shade: 0.5
                        });
                        axios.delete(Aizxin.U('member') + '/' + id).then(function(response) {
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
                                layer.closeAll();
                                layer.msg('系统错误', {
                                    icon: 5,
                                    shade: 0.5
                                });
                            });
                    });
                },
                // 会员修改的open
                edithtml: function(id) {
                    var _this = this;
                    var indexsS = layer.load(1);
                    layer.open({
                        type: 1,
                        title: '会员修改',
                        full: false,
                        shadeClose: true,
                        shade: 0.3,
                        content: $('#memberedithtml'),
                        area: ['400px', '500px'],
                        anim: 5,
                        success: function(layero, index) {
                            axios.get(Aizxin.U('member') + "/" + id + "/edit").then(function(response) {
                                    console.log(response.data.data);
                                    $("#memberEditId").val(response.data.data.id);
                                    $("#memberEditnickname").val(response.data.data.nickname);
                                    $("#memberEditphone").val(response.data.data.phone);
                                    $("#memberEditpassword").val(response.data.data.password);
                                    $("#LAY_demo_upload_edit").attr('src', response.data.data.avatar);
                                    $("#membereditavatar").show();
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
        //会员添加 监听提交
        form.on('submit(memberadd)', function(data) {
            var index = layer.load(1, {
                shade: 0.5
            });
            data.field.id = 0;
            data.field.avatar = LAY_demo_upload_add.src;
            axios.post(Aizxin.U('member'), data.field)
                .then(function(response) {
                    layer.close(index);
                    if (response.data.code == 200) {
                        layer.msg(response.data.message, {
                            time: 1000,
                            shade: 0.5
                        }, function() {
                            memberList.list();
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
        //角色修改 监听提交
        form.on('submit(memberedit)', function(data) {
            data.field.avatar = LAY_demo_upload_edit.src;
            var index = layer.load(1, {
                shade: 0.5
            });
            axios.post(Aizxin.U('member'), data.field)
                .then(function(response) {
                    layer.close(index);
                    if (response.data.code == 200) {
                        layer.msg(response.data.message, {
                            time: 1000,
                            shade: 0.5
                        }, function() {
                            memberList.list();
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
    exports('member', {});
});