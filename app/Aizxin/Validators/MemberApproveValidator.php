<?php
namespace Aizxin\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class MemberApproveValidator extends LaravelValidator {

   /**
    *  [$rules 规则]
    *  @var [type]
    */
    protected $rules = [
        'memberId' => ['required'],
        'phone'=>['required','zh_mobile'],
        'name' => ['required'],
        // 'district' => ['required'],
        'type' => ['required'],
        // 'province' => ['required'],
        // 'city' => ['required'],
        'address' => ['required'],
    ];
}