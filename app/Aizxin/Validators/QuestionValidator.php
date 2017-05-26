<?php
namespace Aizxin\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class QuestionValidator extends LaravelValidator {

   /**
    *  [$rules 规则]
    *  @var [type]
    */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => ['required'],
            'questionCategoryId'=>['required'],
            'analysis' => ['required'],
            'questionType' => ['required'],
            // 'courseType' => ['required'],
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => ['required'],
            'questionCategoryId'=>['required'],
            'analysis' => ['required'],
            'questionType' => ['required'],
            // 'courseType' => ['required'],
        ],
    ];
    /**
     *  [$messages 错误信息]
     *  @var [type]
     */
    protected $messages = [
        'name.required' => '试题名称不能为空',
        'questionCategoryId.required'=>'试题分类没有选择',
        'analysis.required' => '试题解析不能为空',
        'questionType.required' => '试题类型不能为空',
        'courseType.required' => '试题科目不能为空',
	];
}