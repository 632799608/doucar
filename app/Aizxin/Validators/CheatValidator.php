<?php
namespace Aizxin\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class CheatValidator extends LaravelValidator {

   /**
    *  [$rules 规则]
    *  @var [type]
    */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => ['required'],
            'cheatCategoryId'=>['required'],
            'content' => ['required']
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => ['required'],
            'cheatCategoryId'=>['required'],
            'content' => ['required']
        ],
    ];
    /**
     *  [$messages 错误信息]
     *  @var [type]
     */
    protected $messages = [
        'name.required' => '秘籍名称不能为空',
        'cheatCategoryId.required'=>'秘籍分类没有选择',
        'content.required' => '秘籍内容不能为空',
	];
}