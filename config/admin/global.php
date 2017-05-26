<?php
return [
	// 分页配置
	'pagination' => [
		'pgae' => 1,
		'pageSize' => 15,
		'column' => 'id',
		'order' => 'asc',
	],
	'cache' => [
		'time'=>60*60, // 缓存一天
		'permission' => 'permission',
		'role' => 'role',
		'userpermission'=>'userpermission',
		'articlecategory'=>'articlecategory',
		'area'=>'area',
		'articlecategory_add'=>'articlecategory_add',
		'city'=>'city',
		'cheatcategory_add'=>'cheatcategory_add',
		'ad'=>'ad',
		'questioncategory'=>'questioncategory',
		'questioncategory_add' => 'questioncategory_add',
		'member' => 'member',
		'waypointcategory'=>'waypointcategory'
	],
	'imagePath' =>[
		'article'=>'article'
	],
	'pay'=>[
		'wxpay'=>[
			'key'=>'2t76HgI1AtSKUq7JGuj0E7Agpj9Zhqtv'
		],
		'alipay'=>[
			'key_RSA'=>'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCnxj/9qwVfgoUh/y2W89L6BkRAFljhNhgPdyPuBV64bfQNN1PjbCzkIM6qRdKBoLPXmKKMiFYnkd6rAoprih3/PrQEB/VsW8OoM8fxn67UDYuyBTqA23MML9q1+ilIZwBC2AQ2UBVOrFXfFl75p6/B5KsiNG9zpgmLCUYuLkxpLQIDAQAB'
		]
	]
];