<?php
namespace Aizxin\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class PurchaseValidator extends LaravelValidator {

   /**
    *  [$rules 规则]
    *  @var [type]
    */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => ['required'],
            'type'=>['required'],
            'price' => ['required'],
            'number' => ['required'],
            'schoolId' => ['required'],
            'content' => ['required'],
            'startTime' => ['required'],
            'endTime' => ['required'],
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => ['required'],
            'type'=>['required'],
            'price' => ['required'],
            'number' => ['required'],
            'schoolId' => ['required'],
            'content' => ['required'],
            'startTime' => ['required'],
            'endTime' => ['required'],
        ],
    ];
    /**
     *  [$messages 错误信息]
     *  @var [type]
     */
    protected $messages = [

	];
}