<?php
namespace Aizxin\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class MemberAmendValidator extends LaravelValidator {

   /**
    *  [$rules 规则]
    *  @var [type]
    */
    protected $rules = [
        'avatar' => ['required'],
        'nickname'=>['required'],
        // 'password' => ['required','between:6,16'],
    ];    
}