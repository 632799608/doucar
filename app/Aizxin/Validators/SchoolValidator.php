<?php
namespace Aizxin\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class SchoolValidator extends LaravelValidator {

   /**
    *  [$rules 规则]
    *  @var [type]
    */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => ['required'],
            'phone'=>['required'],
            'address' => ['required'],
            'address' => ['required'],
            'overview' => ['required'],
            'description' => ['required'],
            'thumb' => ['required'],
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => ['required'],
            'phone'=>['required'],
            'address' => ['required'],
            'address' => ['required'],
            'overview' => ['required'],
            'description' => ['required'],
            'thumb' => ['required'],
        ],
    ];
    /**
     *  [$messages 错误信息]
     *  @var [type]
     */
    protected $messages = [

	];
}