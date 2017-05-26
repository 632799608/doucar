<?php
return [
	'title' 	=> '试题管理',
	'desc' 		=> '试题列表',
	'create' 	=> '添加试题',
	'edit' 		=> '修改试题',
	'info' 		=> '试题信息',
	'tags' 		=> '试题标签',
	'new_tags' 	=> '新增标签',
	'push' 		=> '发布试题',
	'category'  => '试题分类',
	'menu'      => '顶级分类',
	'one'=>'单断题',
	'duo'=>'多断题',
	'pduo'=>'判断题',
	'status' => '状态',
	'model' 	=> [
		'id' 				=> 'ID',
		'questionCategoryId'=> '试题分类',
		'name' 			    => '试题题目',
		'analysis' 			=> '试题解析',
		'overview' 			=> '试题摘要',
		'thumb'				=> '试题图片',
		'questionType' 		=> '试题类型',
        'content' 		    => '试题内容',
        'courseType' 		=> '试题科目',
        'created_at' 		=> '创建时间',
        'updated_at' 		=> '修改时间',
        'answer'            => '试题答案',
        'difficulty'        => '难度系数'
	],
	'placeholder' 	=> [
		'id' 			=> 'ID',
		'name' 			=> '请输入试题题目',
		'analysis' 		=> '请输入试题解析',
        'content' 		=> '请输入试题内容',
        'thumb' 		=> '请上传试题图片',
        'questionType'  => '请选择试题类型',
        'courseType' 	=> '请选择试题科目',
        'created_at' 	=> '创建时间',
        'updated_at' 	=> '修改时间',
        'difficulty'        => '请输入难度系数'
	],
	'action' => [
		'create' => '<i class="fa fa-plus"></i> 添加试题',
	],

];