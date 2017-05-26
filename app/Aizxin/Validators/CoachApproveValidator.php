<?php
namespace Aizxin\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class CoachApproveValidator extends LaravelValidator {

   /**
    *  [$rules 规则]
    *  @var [type]
    */
    protected $rules = [
        'memberId' => ['required'],
        'phone'=>['required'],
        'sex' => ['required'],
        'name' => ['required'],
        'thumb' => ['required'],
        'school' => ['required'],
    ];
}