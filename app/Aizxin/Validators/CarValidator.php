<?php
namespace Aizxin\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class CarValidator extends LaravelValidator {

   /**
    *  [$rules 规则]
    *  @var [type]
    */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'schoolId' => ['required'],
            'license'=>['required','unique:car'],
        ],
        ValidatorInterface::RULE_UPDATE => [

        ],
    ];
    /**
     *  [$messages 错误信息]
     *  @var [type]
     */
    protected $messages = [

	];
}