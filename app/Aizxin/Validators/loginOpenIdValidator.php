<?php
namespace Aizxin\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class loginOpenIdValidator extends LaravelValidator {

   /**
    *  [$rules 规则]
    *  @var [type]
    */
    protected $rules = [
    	ValidatorInterface::RULE_CREATE => [
            'openId' => ['required','unique:member'],
            'accountType'=>['required']
        ],
        ValidatorInterface::RULE_UPDATE => [
            'openId' =>  ['required','exists:member'],
            'accountType'=>['required']
        ],
    ];
}