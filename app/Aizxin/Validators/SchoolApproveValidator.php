<?php
namespace Aizxin\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class SchoolApproveValidator extends LaravelValidator {

   /**
    *  [$rules 规则]
    *  @var [type]
    */
    protected $rules = [
        'memberId' => ['required'],
        'phone'=>['required'],
        'address' => ['required'],
        'name' => ['required'],
        'thumb' => ['required'],
    ];
}