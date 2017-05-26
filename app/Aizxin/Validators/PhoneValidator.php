<?php
namespace Aizxin\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class PhoneValidator extends LaravelValidator {

   /**
    *  [$rules 规则]
    *  @var [type]
    */
     protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'phone' => ['required','unique:member','zh_mobile']
        ],
        ValidatorInterface::RULE_UPDATE => [
            'phone' =>  ['required','exists:member','zh_mobile']
        ],
    ];
}