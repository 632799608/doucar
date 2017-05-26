layui.define(['layer', 'form', 'element', 'modal'], function(exports) {
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form(),
        modal = layui.modal,
        device = layui.device(),
        jqGlobal = function() {};
    var Aizxin = Aizxin || {};

    //阻止IE7以下访问
    if (device.ie && device.ie < 8) {
        layer.alert('Layui最低支持ie8，您当前使用的是古老的 IE' + device.ie + '，你丫的肯定不是程序猿！');
    }


    //搜索组件
    form.on('select(component)', function(data) {
        var value = data.value;
        location.href = '/doc/' + value;
    });


    //首页banner
    setTimeout(function() {
        $('.site-zfj').addClass('site-zfj-anim');
        setTimeout(function() {
            $('.site-desc').addClass('site-desc-anim')
        }, 5000)
    }, 100);


    for (var i = 0; i < $('.adsbygoogle').length; i++) {
        (adsbygoogle = window.adsbygoogle || []).push({});
    }



    //展示当前版本
    $('.site-showv').html(layui.v);

    // //固定Bar
    // util.fixbar({
    //     bar1: true,
    //     click: function(type) {
    //         if (type === 'bar1') {
    //             location.href = '/';
    //         }
    //     }
    // });
    //窗口scroll
    ;
    ! function() {
        var main = $('.site-tree').parent(),
            scroll = function() {
                var stop = $(window).scrollTop();
                if ($(window).width() <= 750) {
                    var bottom = $('.footer').offset().top - $(window).height();
                    if (stop > 61 && stop < bottom) {
                        if (!main.hasClass('site-fix')) {
                            main.addClass('site-fix');
                        }
                        if (main.hasClass('site-fix-footer')) {
                            main.removeClass('site-fix-footer');
                        }
                    } else if (stop >= bottom) {
                        if (!main.hasClass('site-fix-footer')) {
                            main.addClass('site-fix site-fix-footer');
                        }
                    } else {
                        if (main.hasClass('site-fix')) {
                            main.removeClass('site-fix').removeClass('site-fix-footer');
                        }
                    }
                    stop = null;
                };

            };
        scroll();
        $(window).on('scroll', scroll);
    }();
    // 留言
    // ;! function(){
    //     var layerSteward;   //管家窗口
    //     var isStop = false; //是否停止提醒

    //     getNotReplyLeaveMessage();

    //     var interval = setInterval(function () {
    //         getNotReplyLeaveMessage();
    //     }, 60000);  //1分钟提醒一次

    //     function getNotReplyLeaveMessage() {
    //         clearInterval(interval); //停止计时器
    //         var content = '<p>目前有<span>12</span>条留言未回复</p>';
    //         content += '<div class="notnotice" ><a href="javascript:layer.msg(\'跳转到相应页面\')">点击查看</a></div>';
    //         layerSteward = layer.open({
    //             type: 1,
    //             title: '管家提醒',
    //             shade: 0,
    //             resize: false,
    //             area: ['200px', '100px'],
    //             time: 10000, //10秒后自动关闭
    //             skin: 'steward',
    //             closeBtn: 1,
    //             anim: 2,
    //             content: content,
    //             end: function () {
    //                 if (!isStop) {
    //                     interval = setInterval(function () {
    //                         if (!isStop) {
    //                             clearInterval(interval);
    //                             getNotReplyLeaveMessage();
    //                         }
    //                     }, 60000);
    //                 }
    //             }
    //         });
    //         $('.steward').click(function (e) {
    //             event.stopPropagation();    //阻止事件冒泡
    //         });
    //         $('.notnotice').click(function () {
    //             isStop = true;
    //             layer.close(layerSteward);
    //             $('input[lay-filter=steward]').siblings('.layui-form-switch').removeClass('layui-form-onswitch');
    //             $('input[lay-filter=steward]').prop("checked", false);
    //         });
    //         form.on('switch(steward)', function (data) {
    //             if (data.elem.checked) {
    //                 isStop = false;
    //                 clearInterval(interval);
    //                 runSteward();
    //             } else {
    //                 isStop = true;
    //                 layer.close(layerSteward);
    //             }
    //         })
    //     }
    // }();

    //手机设备的简单适配
    var treeMobile = $('.site-tree-mobile'),
        shadeMobile = $('.site-mobile-shade')

    treeMobile.on('click', function() {
        $('body').addClass('site-mobile');
    });

    shadeMobile.on('click', function() {
        $('body').removeClass('site-mobile');
    });
    jqGlobal.prototype.init = function() {
            modal.init();
        }
        /**
         * 解析URL
         * @param  {string} url 被解析的URL
         * @return {object}     解析后的数据
         */
    Aizxin.parse_url = function(url) {
        var parse = url.match(/^(?:([a-z]+):\/\/)?([\w-]+(?:\.[\w-]+)+)?(?::(\d+))?([\w-\/]+)?(?:\?((?:\w+=[^#&=\/]*)?(?:&\w+=[^#&=\/]*)*))?(?:#([\w-]+))?$/i);
        parse || $.error("url格式不正确！");
        return {
            "scheme": parse[1],
            "host": parse[2],
            "port": parse[3],
            "path": parse[4],
            "query": parse[5],
            "fragment": parse[6]
        };
    }
    Aizxin.parse_str = function(str) {
        var value = str.split("&"),
            vars = {},
            param;
        for (var i = 0; i < value.length; i++) {
            param = value[i].split("=");
            vars[param[0]] = param[1];
        }
        return vars;
    }
    Aizxin.U = function(url, vars) {
        if (!url || url == '') return '';
        var info = this.parse_url(url),
            path = [],
            reg;
        /* 验证info */
        info.path || $.error("url格式错误！");
        url = info.path;
        /* 解析URL */
        path = url.split("/");
        // path = [path.pop(), path.pop(), path.pop()].reverse();
        // path[1] || $.error("Aizxin.U(" + url + ")没有指定控制器");

        /* 解析参数 */
        if (typeof vars === "string") {
            vars = Aizxin.parse_str(vars);
        }
        /* 解析URL自带的参数 */
        info.query && $.extend(vars, this.parse_str(info.query));
        // if (false !== Aizxin.conf.SUFFIX) {
        //  url += "." + Aizxin.conf.SUFFIX;
        // }
        if ($.isPlainObject(vars)) {
            url += "?" + $.param(vars);
        }
        //url = url.replace(new RegExp("%2F","gm"),"+");
        url = window.conf.APP + "/" + url;
        return url;
    };
    //注册弹出方法
    Aizxin.layerOpen = function(title, url, w, h, type, form, index) {
        if (title == null || title == '') {
            title = false;
        };
        if (w == null || w == '') {
            w = 800;
        };
        if (h == null || h == '') {
            h = ($(window).height() - 300);
        };
        layer.open({
            type: type,
            area: [w + 'px', h + 'px'],
            fix: false,
            maxmin: true,
            shade: false,
            title: title,
            content: url,
            success: function(layero) {
                Aizxin.layerClose(index)
                if (type === 1) {
                    form.render()
                }
            }
        });
    };
    /**
     * 关闭弹出框口
     */
    Aizxin.layerClose = function(index) {
        layer.close(index);
    };
    // 地区选择
    Aizxin.treeSelect = function(config, threeSelectData, el) {
        $form = el;
        $form.find('select[name=' + config.s1 + ']').html('<option value="0">请选择' + config.name + '</option>');
        $.each(threeSelectData, function(k, v) {
            appendOptionTo($form.find('select[name=' + config.s1 + ']'), v, config.v1);
        });
        $form.find('select[name=' + config.s2 + ']').parent().hide();
        $form.find('select[name=' + config.s3 + ']').parent().hide();
        form.render();
        if (config.v2 > 0) {
            cityEvent(config);
        }
        if (config.v3 > 0) {
            areaEvent(config);
        }
        form.on('select(' + config.s1 + ')', function(data) {
            cityEvent(data);
            form.on('select(' + config.s2 + ')', function(data) {
                areaEvent(data);
            });
        });

        function cityEvent(data) {
            $form.find('select[name=' + config.s2 + ']').parent().hide();
            $form.find('select[name=' + config.s2 + ']').html('<option value="0">请选择' + config.name + '</option>');
            config.v1 = data.value ? data.value : config.v1;
            $.each(threeSelectData, function(k, v) {
                if (v.id == config.v1) {
                    if (v.child.length > 0) {
                        $form.find('select[name=' + config.s2 + ']').parent().show();
                        $.each(v.child, function(kt, vt) {
                            appendOptionTo($form.find('select[name=' + config.s2 + ']'), vt, config.v2);
                        });
                    }
                }
            });
            form.render();
            config.v2 = $('select[name=' + config.s2 + ']').val();
            areaEvent(config);
        }

        function areaEvent(data) {
            $form.find('select[name=' + config.s3 + ']').parent().hide();
            $form.find('select[name=' + config.s3 + ']').html('<option value="0">请选择' + config.name + '</option>');
            config.v2 = data.value ? data.value : config.v2;
            $.each(threeSelectData, function(k, v) {
                if (v.val == config.v1) {
                    if (v.child.length > 0) {
                        $.each(v.child, function(kt, vt) {
                            if (vt.val == config.v2) {
                                if (vt.child.length > 0) {
                                    $form.find('select[name=' + config.s3 + ']').parent().show();
                                    $.each(vt.child, function(ka, va) {
                                        appendOptionTo($form.find('select[name=' + config.s3 + ']'), ka, va, config.v3);
                                    });
                                }
                            }
                        });
                    }
                }
            });
            form.render();
            form.on('select(' + config.s3 + ')', function(data) {});
        }

        function appendOptionTo($o, v, d) {
            var $opt = $("<option>").text(v.name).val(v.id);
            if (v.id == d) {
                $opt.attr("selected", "selected")
            }
            $opt.appendTo($o);
        }
    };
    //删除七牛图片
    Aizxin.deleQiniu = function(url, el) {
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
                    elthis.parent().hide();
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
    };
    // 图片上传
    Aizxin.uploadQiniu = function(el, elt, eldel) {
        layui.upload({
            url: Aizxin.U('qiniu'),
            elem: el,
            method: 'post',
            before: function(input) {
                layer.load(1, {
                    shade: 0.5
                });
            },
            success: function(res) {
                layer.closeAll('loading');
                $("#" + elt).parent().show();
                $("#" + elt).show();
                $("#" + elt).attr('src', res.url);
                eldel.show();
            }
        });
    };
    //全选
    form.on('checkbox(allChoose)', function(data) {
        var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]');
        child.each(function(index, item) {
            item.checked = data.elem.checked;
        });
        form.render('checkbox');
    });
    var global = new jqGlobal();
    global.init();
    exports('global', Aizxin);
});