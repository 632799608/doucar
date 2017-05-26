<?php
namespace Aizxin\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class AdValidator extends LaravelValidator {

   /**
    *  [$rules 规则]
    *  @var [type]
    */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'title' => ['required'],
            'thumb'=>['required'],
        ],
        ValidatorInterface::RULE_UPDATE => [
            'title' => ['required'],
            'thumb'=>['required'],
        ],
    ];
    /**
     *  [$messages 错误信息]
     *  @var [type]
     */
    protected $messages = [
        'title.required' => '广告名不能为空',
        'thumb.required' => '广告图片不能为空',
	];
}