<?php
namespace Aizxin\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class MemberApplyValidator extends LaravelValidator {

   /**
    *  [$rules 规则]
    *  @var [type]
    */
    protected $rules = [
        'memberId' => ['required'],
        'schoolId'=>['required'],
        // 'coachId' => ['required'],
        'carType' => ['required'],
        'price' => ['required'],
        'name' => ['required'],
        'phone' => ['required'],
    ];
}