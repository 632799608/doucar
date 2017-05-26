layui.define(['form', 'global', 'upload','laydate'], function(exports) {
	var form = layui.form(),
		$ = layui.jquery,
		layer = layui.layer,
		Aizxin = layui.global,
		laydate = layui.laydate,
		upload = layui.upload;
	$(function() {
        layui.upload({
            url: Aizxin.U('qiniu'),
            elem: '#purchase-upload-add', //指定原始元素，默认直接查找class="layui-upload-file"
            method: 'post', //上传接口的http类型
            success: function(res, input) {
                LAY_demo_upload_add.src = res.url;
                $("#purchase-thumb-add").show();
            }
        });
		$("#purchase-thumb-add").on('click', '.i-delete', function() {
			var _this = $(this);
			delImg(_this);
		})
		function delImg(_this) {
			var url = _this.parent().find('img').attr('src');
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
							icon: 1
						});
						_this.parent().hide();
					} else {
						layer.msg(response.data.message, {
							icon: 5
						});
					}
				}).catch(function(error) {
					console.log(error);
				});
			} else {
				layer.msg('文件不能删除');
			}
		}
		var schoolList = new Vue({
			el: '#purchaseadd',
            data: {
                school: []
            },
            created: function() {
                this.getSchoolList();
            },
            methods:{
                // 获取驾校
                getSchoolList: function() {
                    var _this = this;
                    axios.post(Aizxin.U('purchase/school'))
                        .then(function(response) {
                            _this.$set('school', response.data);
                            if($('#purchaseId').val()!=undefined){
			                	_this.getPurchase($('#purchaseId').val());
			                }
                        }).catch(function(error) {
                            console.log(error);
                        });
                },
                getPurchase:function(id){
                	var _this = this;
                	axios.get(Aizxin.U('purchase') + '/' + id)
                    .then(function(response) {
                    	var type = [];
                        for (var i = 0; i < _this.school.length; i++) {
							if(_this.school[i]['id'] == response.data.data.schoolId){
								type = _this.school[i]['price'];
							}
						}
						var conf ={
							s1:'type',
							v1:response.data.data.type
						}
						cateSelect(conf,type,$('#school-type'));
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
                }
            }
		});
		//添加团购
        form.on('submit(addpurchasestore)', function(data) {
        	data.field.id = 0;
        	if(editor.$txt.formatText() == ''){
            	layer.msg('团购详情不能为空', {
					icon: 5,shade: 0.5
				});
				return false;
            }
        	data.field.content = editor.$txt.html();
			data.field.thumb = LAY_demo_upload_add.src;
			var index = layer.load(1, {
				shade: 0.5
			});
            axios.post(Aizxin.U('purchase'),data.field).then(function(response) {
					layer.close(index);
					if (response.data.code == 200) {
						layer.msg(response.data.message, {
							time: 1000,
							shade:0.5
						}, function() {
							window.location.href = Aizxin.U('purchase');
						});
					} else {
						layer.msg(response.data.message, {
							icon: 5
						});
					}
            }).catch(function(error) {
                layer.closeAll();
            	layer.msg('系统错误', {
					icon: 5,shade: 0.5
				});
            });
        });
        //编辑团购
        form.on('submit(addpurchaseupdated)', function(data) {
        	data.field.id = $("#purchaseId").val();
        	if(editor.$txt.formatText() == ''){
            	layer.msg('团购详情不能为空', {
					icon: 5,shade: 0.5
				});
				return false;
            }
        	data.field.content = editor.$txt.html();
			data.field.thumb = LAY_demo_upload_add.src;
			var index = layer.load(1, {
				shade: 0.5
			});
			data.field.thumb = LAY_demo_upload_add.src;
			var index = layer.load(1, {
				shade: 0.5
			});
            axios.put(Aizxin.U('purchase')+'/'+data.field.id,data.field).then(function(response) {
					layer.close(index);
					if (response.data.code == 200) {
						layer.msg(response.data.message, {
							time: 1000,
							shade:0.5
						}, function() {
							window.location.href = Aizxin.U('purchase');
						});
					} else {
						layer.msg(response.data.message, {
							icon: 5,shade: 0.5
						});
					}
            })
            .catch(function(error) {
            	layer.closeAll();
            	layer.msg('系统错误', {
					icon: 5,shade: 0.5
				});
            });
            return false;
        });
		function printLog(title, info) {
			window.console && console.log(title, info);
		}
		// 初始化七牛上传
		function uploadInit() {
			var editor = this;
			var btnId = editor.customUploadBtnId;
			var containerId = editor.customUploadContainerId;
			// 创建上传对象
			var uploader = Qiniu.uploader({
				runtimes: 'html5,flash,html4', //上传模式,依次退化
				browse_button: btnId, //上传选择的点选按钮，**必需**
				uptoken_url: Aizxin.U('qiniu'),
				//Ajax请求upToken的Url，**强烈建议设置**（服务端提供）
				// uptoken : '<Your upload token>',
				//若未指定uptoken_url,则必须指定 uptoken ,uptoken由其他程序生成
				// unique_names: true,
				// 默认 false，key为文件名。若开启该选项，SDK会为每个文件自动生成key（文件名）
				save_key: true,
				// 默认 false。若在服务端生成uptoken的上传策略中指定了 `sava_key`，则开启，SDK在前端将不对key进行任何处理
				domain: 'http://' + window.conf.QINIU_DOMAINS_DEFAULT + '/',
				//bucket 域名，下载资源时用到，**必需**
				container: containerId, //上传区域DOM ID，默认是browser_button的父元素，
				max_file_size: '100mb', //最大文件体积限制
				flash_swf_url: Aizxin.U('back') + '/plugin/qiniu/js/Moxie.swf', //引入flash,相对路径
				filters: {
					mime_types: [
						//只允许上传图片文件 （注意，extensions中，逗号后面不要加空格）
						{
							title: "图片文件",
							extensions: "jpg,gif,png,bmp"
						}
					]
				},
				max_retries: 3, //上传失败最大重试次数
				dragdrop: true, //开启可拖曳上传
				drop_element: 'editor-container', //拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
				chunk_size: '4mb', //分块上传时，每片的体积
				auto_start: true, //选择文件后自动上传，若关闭需要自己绑定事件触发上传
				init: {
					'FilesAdded': function(up, files) {
						plupload.each(files, function(file) {
							// 文件添加进队列后,处理相关的事情
							// printLog('on FilesAdded');
						});
					},
					'BeforeUpload': function(up, file) {
						// 每个文件上传前,处理相关的事情
						// printLog('on BeforeUpload');
						layer.load(1, {
							shade: 0.5
						});
					},
					'UploadProgress': function(up, file) {
						// 显示进度条
						editor.showUploadProgress(file.percent);
					},
					'FileUploaded': function(up, file, info) {
						// 每个文件上传成功后,处理相关的事情
						// 其中 info 是文件上传成功后，服务端返回的json，形式如
						// {
						//    "hash": "Fh8xVqod2MQ1mocfI4S4KpRL6D98",
						//    "key": "gogopher.jpg"
						//  }
						// printLog(info);
						// 参考http://developer.qiniu.com/docs/v6/api/overview/up/response/simple-response.html

						var domain = up.getOption('domain');
						var res = $.parseJSON(info);
						var sourceLink = domain + res.key; //获取上传成功后的文件的Url
						// printLog(sourceLink);
						// 插入图片到editor
						editor.command(null, 'insertHtml', '<img src="' + sourceLink + '" style="max-width:100%;"/>')
					},
					'Error': function(up, err, errTip) {
						//上传出错时,处理相关的事情
						printLog('on Error');
					},
					'UploadComplete': function() {
						//队列文件处理完毕后,处理相关的事情
						// printLog('on UploadComplete');
						// 隐藏进度条
						editor.hideUploadProgress();
						layer.closeAll('loading');
					},
					// Key 函数如果有需要自行配置，无特殊需要请注释
					//,
					// 'Key': function(up, file) {
					//     // 若想在前端对每个文件的key进行个性化处理，可以配置该函数
					//     // 该配置必须要在 unique_names: false , save_key: false 时才生效
					//     var key = "";
					//     // do something with key here
					//     return key
					// }
				}
			});
			// domain 为七牛空间（bucket)对应的域名，选择某个空间后，可通过"空间设置->基本设置->域名设置"查看获取
			// uploader 为一个plupload对象，继承了所有plupload的方法，参考http://plupload.com/docs
		}
		// 生成编辑器
		var editor = new wangEditor('purchase-content');
		editor.config.customUpload = true;
		editor.config.customUploadInit = uploadInit;
		editor.create();
		function cateSelect(config, cateSelectData, el) {
			$form = el;
			config.v1 = config.v1 ? config.v1 : 0;
			$form.find('select[name=' + config.s1 + ']').html('<option value="0">请选择驾照类型</option>');
			$.each(cateSelectData, function(k, v) {
				appendOptionTo($form.find('select[name=' + config.s1 + ']'), v, config.v1);
			});
			form.render();
			function appendOptionTo($o, v, d) {
				var $opt = $("<option>").text(v.type).val(v.type);
				if (v.type == d) {
					$opt.attr("selected", "selected");
				}
				$opt.appendTo($o);
			}
		}
		// 驾照类型
		form.on('select(schoolId)', function(data) {
			var type = [];
			for (var i = 0; i < schoolList.school.length; i++) {
				if(schoolList.school[i]['id'] == data.value){
					type = schoolList.school[i]['price'];
				}
			}
			var conf ={
				s1:'type',
				v1:0
			}
			cateSelect(conf,type,$('#school-type'));
            form.render();
		});
	});
	exports('purchase-add', {});
});