layui.define(['form', 'global', 'upload', 'layedit'], function(exports) {
	var form = layui.form(),
		$ = layui.jquery,
		layer = layui.layer,
		upload = layui.upload,
		Aizxin = layui.global,
		layedit = layui.layedit;
	var ipth;

	$(function() {
		//自定义工具栏
		var layeditIndex = layedit.build('article-content', {
			tool: ['face', 'link', 'unlink', '|', 'left', 'center', 'right'],
			height: 100,
		});
		var editAnhtml1 = new Vue({
			el: '#editAnhtml',
			data: {
				answerList: [],
				questionType: 0,
				category: [],
				question: {}
			},
			created: function() {
				this.list();
			},
			methods: {
				// 列表
				list: function() {
					var _this = this;
					axios.get(Aizxin.U('question') + '/' + $('#questionId').val()).then(function(response) {
						if (response.data.code == 200) {
							_this.$set('answerList', response.data.data.answer);
							_this.$set('question', response.data.data);
							_this.$set('questionType', response.data.data.questionType == 1 ? 2 : 4);
							if (response.data.data.thumb) {
								$('.question-upload').show();
							}
						}
						axios.get(Aizxin.U('question/category/create'))
							.then(function(response) {
								_this.$set('category', response.data.data);
								var _con = {
									v1: _this.question.questionCategoryId,
									s1: 'questionCategoryId',
									type: _this.question.courseType
								};
								cateSelect(_con, _this.category, $('#questionCategory'));
							}).catch(function(error) {
								layer.msg('系统错误', {
									icon: 5,
									shade: 0.5
								});
							});
					}).catch(function(error) {
						console.log(error);
					});
				},
				// 广告修改的open
				addAhtml: function() {
					if (this.questionType == 0) {
						layer.msg('请选择试题类型', {
							icon: 2,
							shade: 0.3
						});
						return;
					}
					if (this.answerList.length == this.questionType) {
						layer.msg('试题答案为' + this.questionType + '个答案', {
							icon: 2,
							shade: 0.3
						});
						return;
					}
					var _this = this;
					var indexsS = layer.load(1);
					layer.open({
						type: 1,
						title: '答案添加',
						full: false,
						shadeClose: true,
						shade: 0.3,
						content: $('#editAnswerhtml'),
						area: ['500px', '400px'],
						anim: 5,
						success: function(layero, index) {
							$('#answerFrom')[0].reset();
							layer.close(indexsS);
						}
					});
				},
				delAnswer: function(index) {
					this.answerList.splice(index, 1);
				}
			}
		});
		layui.upload({
			url: Aizxin.U('qiniu'),
			elem: '#question-upload', //指定原始元素，默认直接查找class="layui-upload-file"
			method: 'post', //上传接口的http类型
			data: {
				path: 'question'
			},
			before: function(input) {
				layer.load(1, {
					shade: 0.5
				});
				$('.question-upload').show();
				ipth = LAY_question_upload.src;
			},
			success: function(res) {
				layer.closeAll('loading');
				LAY_question_upload.src = res.url;
				$('.i-delete').show();
			}
		});
		layui.upload({
			url: Aizxin.U('qiniu'),
			elem: '#answer-upload', //指定原始元素，默认直接查找class="layui-upload-file"
			method: 'post', //上传接口的http类型
			before: function(input) {
				layer.load(1, {
					shade: 0.5
				});
				$('.answer-upload').show();
			},
			success: function(res) {
				layer.closeAll('loading');
				LAY_answer_upload.src = res.url;
			}
		});
		// 文件删除
		$('.answer-upload').on('click', '.i-delete', function() {
			var url = LAY_answer_upload.src;
			deleteThumb(url, LAY_answer_upload, 'answer-upload');
		});
		$('.question-upload').on('click', '.i-delete', function() {
			var url = LAY_question_upload.src;
			deleteThumb(url, LAY_question_upload, 'question-upload');
		});

		function deleteThumb(url, elImg, clName) {
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
							shade: 0.3
						});
						elImg.src = Aizxin.U('back') + '/images/no-image.png';
						$('.' + clName).hide();
					} else {
						layer.msg(response.data.message, {
							icon: 5,
							shade: 0.3
						});
					}
				}).catch(function(error) {
					console.log(error);
				});
			} else {
				layer.msg('文件不能删除');
			}
		};
		// 文章添加
		form.on('submit(editquestionupdate)', function(data) {
			var url = LAY_question_upload.src;
			data.field.thumb = url.indexOf(window.conf.QINIU_DOMAINS_DEFAULT) > 0 ? url : '';
			data.field.analysis = layedit.getContent(layeditIndex);
			data.field.answer = editAnhtml1.answerList;
			if (editAnhtml1.answerList.length != editAnhtml1.questionType) {
				layer.msg('试题答案为' + editAnhtml1.questionType + '个答案', {
					icon: 2,
					shade: 0.3
				});
				return false;
			}
			var index = layer.load(1, {
				shade: 0.5
			});
			axios.put(Aizxin.U('question') + '/' + data.field.id, data.field)
				.then(function(response) {
					layer.close(index);
					if (response.data.code == 200) {
						layer.msg(response.data.message, {
							time: 1000,
							shade: 0.5
						}, function() {
							window.location.href = Aizxin.U('question');
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
		var answerSelectType = 0;
		// 答案方式
		form.on('select(answerSelect)', function(data) {
			if (data.value == 1) {
				$('.answer-thumb').hide();
				$('.answer-text').show();
				answerSelectType = 1;
			}
			if (data.value == 2) {
				$('.answer-text').hide();
				$('.answer-thumb').show();
				answerSelectType = 2;
			}
		});
		// 答案方式
		form.on('select(questionType)', function(data) {
			if (data.value == 0) {
				layer.msg('请正确选择', {
					icon: 5,
					shade: 0.3
				});
			} else {
				editAnhtml1.$set('questionType', data.value == 1 ? 2 : 4);
			}
		});
		//答案添加
		form.on('submit(answeradd)', function(data) {
			var url = LAY_answer_upload.src;
			if (answerSelectType == 1) {
				data.field.thumb = '';
				deleteThumb(url, LAY_answer_upload, 'answer-upload');
			} else {
				data.field.thumb = url.indexOf(window.conf.QINIU_DOMAINS_DEFAULT) > 0 ? url : '';
			}
			data.field.content = answerSelectType == 2 ? '' : data.field.content;
			data.field.isAnswer = data.field.isAnswer != undefined ? 1 : 0;
			layer.closeAll();
			editAnhtml1.answerList.push(data.field);
			return false;
		});
		// 科目方式
		form.on('select(courseType)', function(data) {
			var _con = {
				v1: editAnhtml1.questionCategoryId,
				s1: 'questionCategoryId',
				type: data.value
			};
			cateSelect(_con, editAnhtml1.category, $('#questionCategory'));
		});

		function cateSelect(config, cateSelectData, el) {
			$form = el;
			config.v1 = config.v1 ? config.v1 : 0;
			$form.find('select[name=' + config.s1 + ']').html('<option value="0">请选择科目类型</option>');
			$.each(cateSelectData, function(k, v) {
				appendOptionTo($form.find('select[name=' + config.s1 + ']'), v, config.v1, config.type);
			});
			form.render();

			function appendOptionTo($o, v, d, s) {
				if (s == v.type) {
					var $opt = $("<option>").text(v.name).val(v.id);
					if (v.id == d) {
						$opt.attr("selected", "selected");
					}
					$opt.appendTo($o);
				}
			}
		}
	});
	exports('question-save', {});
});