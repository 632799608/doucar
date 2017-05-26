<?php
namespace Aizxin\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class MemberPhoneValidator extends LaravelValidator {

   /**
    *  [$rules 规则]
    *  @var [type]
    */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'phone' => ['required','unique:member','zh_mobile'],
            'password' => ['required','confirmed','between:6,12'],
            'password_confirmation'=>['required','between:6,12'],
            'code' => ['required'],
        ],
        ValidatorInterface::RULE_UPDATE => [
            'phone' =>  ['required','exists:member','zh_mobile'],
            'password' => ['required'],
        ],
    ];
}