layui.define(['form', 'global'], function(exports) {
	var form = layui.form(),
		$ = layui.jquery,
		layer = layui.layer,
		Aizxin = layui.global;
    form.verify({
        //验证可以有两种方法，一种if，一种直接判断
        license: function(value) {
            if (!new RegExp(/^[\u4e00-\u9fa5][a-zA-Z][0-9a-zA-Z]{5}[\u4e00-\u9fa5]?$/).test(value)) {
                return "车牌号格式不正确"
            }
        },
    });
	$(function() {
        // 车辆添加vue
        var adcar1 = new Vue({
            el: '#caradd',
            data: {
                pricetype:[],
                areaList:[],
            },
            created: function() {

            },
            methods: {

            }
        });
        function cateSelect(config, cateSelectData, el) {
			$form = el;
			config.v1 = config.v1 ? config.v1 : 0;
			$form.find('select[name=' + config.s1 + ']').html('<option value="0">请选择教练</option>');
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
		form.on('select(schoolId)', function(data) {
			var type = [];
			var school = JSON.parse($("#schoolList").val());
			for (var i = 0; i < school.length; i++) {
				if(school[i]['id'] == data.value){
					coach = school[i]['coach'];
				}
			}
			var option = '';
			var html = '';
			for (var i = 0; i < coach.length; i++) {
				option += '<option value="'+coach[i]['id']+'">'+coach[i]['name']+'</option>';
			}
			html =  '<select name="coachId">'+
                       '<option value="">请选择教练</option>'
                        +option+
                    '</select>';
            $("#coach").html(html);
            form.render();
		});
		//添加车辆
        form.on('submit(addcarstore)', function(data) {
        	data.field.id = 0;
			var index = layer.load(1, {
				shade: 0.5
			});
            axios.post(Aizxin.U('car'),data.field).then(function(response) {
					layer.close(index);
					if (response.data.code == 200) {
						layer.msg(response.data.message, {
							time: 1000,
							shade:0.5
						}, function() {
							window.location.href = Aizxin.U('car');
						});
					} else {
						layer.msg(response.data.message, {
							icon: 5
						});
					}
            })
            .catch(function(error) {
                layer.closeAll();
            	layer.msg('系统错误', {
					icon: 5,shade: 0.5
				});
            });
        });
	});
	exports('car-add', {});
});