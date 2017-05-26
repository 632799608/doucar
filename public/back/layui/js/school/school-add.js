layui.define(['form', 'global', 'upload', 'laypage'], function(exports) {
	var form = layui.form(),
		$ = layui.jquery,
		layer = layui.layer,
		Aizxin = layui.global,
		laypage = layui.laypage,
		upload = layui.upload;
	var ipth;
	var defaults = {
		s1: 'province',
		s2: 'city',
		s3: 'areaid',
		v1: $("#defaultprovince").val(),
		v2: $("#defaultcity").val(),
		v3: null,
		name: '地区'
	};
	form.verify({
		//验证可以有两种方法，一种if，一种直接判断
		phone: function(value) {
			if (!new RegExp(/^0?(13|14|15|18|17)[0-9]{9}$/).test(value)) {
				return "手机号格式不正确"
			}
		},
	});
	$(function() {
		layui.upload({
			url: Aizxin.U('qiniu'),
			elem: '#school-upload', //指定原始元素，默认直接查找class="layui-upload-file"
			method: 'post', //上传接口的http类型
			before: function(input) {
				layer.load(1, {
					shade: 0.5
				});
			},
			success: function(res) {
				layer.closeAll('loading');
				$('#thumb-upload').show();
				var html = '';
				for (var i = 0; i < res.data; i++) {
					html += '<div class="imgbox">';
					html += '<i class="fa fa-close i-delete"></i>';
					html += '<img src="' + res[i].url + '" class="img-thumbnail" />';
					html += '</div>';
				}
				$('#thumb-upload').append(html);
			}
		});
		// 驾校添加vue
		var adSchool1 = new Vue({
			el: '#schooladd',
			data: {
				pricetype: [],
				areaList: [],
			},
			created: function() {
				this.getArea();
			},
			methods: {
				// 驾校添加的open
				addAhtml: function() {
					$('#priceFrom')[0].reset();
					var _this = this;
					var indexsS = layer.load(1);
					layer.open({
						type: 1,
						title: '车型添加',
						full: false,
						shadeClose: true,
						shade: 0.3,
						content: $('#adSchoolhtml'),
						area: ['400px', '300px'],
						anim: 5,
						success: function(layero, index) {
							layer.close(indexsS);
						}
					});
				},
				delprice: function() {
					this.pricetype.pop();
				},
				// 获取全国各省市
				getArea: function() {
					var _this = this;
					axios.get(Aizxin.U('area'))
						.then(function(response) {
							_this.$set('areaList', response.data);
							Aizxin.treeSelect(defaults, _this.areaList.data, $('#schooladd'));
							form.render();
						}).catch(function(error) {
							layer.closeAll();
							layer.msg('系统错误', {
								icon: 5,
								shade: 0.5
							});
						});
				},
			}
		});
		//车型价格添加
		form.on('submit(addPrice)', function(data) {
			layer.closeAll();
			adSchool1.pricetype.push(data.field);
		});
		//添加驾校
		form.on('submit(addschoolstore)', function(data) {
			data.field.id = 0;
			if(adSchool1.pricetype.length == 0){
				layer.msg('驾校车型不能为空', {
					icon: 5,
					shade: 0.5
				});
				return false;
			}
			data.field.pricetype = adSchool1.pricetype;
			if (editor.$txt.formatText() == '') {
				layer.msg('驾校描述不能为空', {
					icon: 5,
					shade: 0.5
				});
				return false;
			}
			data.field.description = editor.$txt.html();
			var elImg = $('#thumb-upload').find('img');
			var iImg = [];
			if (elImg.length) {
				elImg.each(function(index, el) {
					iImg.push(el.src);
				});
			}
			data.field.thumb = iImg;
			var index = layer.load(1, {
				shade: 0.5
			});
			axios.post(Aizxin.U('school'), data.field).then(function(response) {
					layer.close(index);
					if (response.data.code == 200) {
						layer.msg(response.data.message, {
							time: 1000,
							shade: 0.5
						}, function() {
							window.location.href = Aizxin.U('school');
						});
					} else {
						layer.msg(response.data.message, {
							icon: 5
						});
					}
				}).catch(function(error) {
					layer.closeAll();
					layer.msg('系统错误', {
						icon: 5,
						shade: 0.5
					});
				});
		});
		//编辑驾校
		form.on('submit(addschoolupdated)', function(data) {
			data.field.id = $("#schoolId").val();
			if(adSchool1.pricetype.length == 0){
				layer.msg('驾校车型不能为空', {
					icon: 5,
					shade: 0.5
				});
				return false;
			}
			data.field.pricetype = adSchool1.pricetype;
			if (editor.$txt.formatText() == '') {
				layer.msg('驾校描述不能为空', {
					icon: 5,
					shade: 0.5
				});
				return false;
			}
			data.field.description = editor.$txt.html();
			var elImg = $('#thumb-upload').find('img');
			var iImg = [];
			if (elImg.length) {
				elImg.each(function(index, el) {
					iImg.push(el.src);
				});
			}
			data.field.thumb = iImg;
			var index = layer.load(1, {
				shade: 0.5
			});
			axios.put(Aizxin.U('school') + '/' + data.field.id, data.field).then(function(response) {
					layer.close(index);
					if (response.data.code == 200) {
						layer.msg(response.data.message, {
							time: 1000,
							shade: 0.5
						}, function() {
							window.location.href = Aizxin.U('school');
						});
					} else {
						layer.msg(response.data.message, {
							icon: 5,
							shade: 0.5
						});
					}
				}).catch(function(error) {
					layer.closeAll();
					layer.msg('系统错误', {
						icon: 5,
						shade: 0.5
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
		var editor = new wangEditor('school-content');
		editor.config.customUpload = true;
		editor.config.customUploadInit = uploadInit;
		editor.create();
		// 文件删除
		$('#thumb-upload').on('click', '.i-delete', function() {
			var _this = $(this);
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
						_this.parent().remove();
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
		});
	});
	exports('school-add', {});
});