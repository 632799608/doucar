<?php
namespace Aizxin\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class MemberValidator extends LaravelValidator {

   /**
    *  [$rules 规则]
    *  @var [type]
    */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nickname' => ['required'],
            'phone' => ['required','unique:member'],
            'password' => ['required'],
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nickname' => ['required'],
            'phone' =>  ['required'],
            'password' => ['required'],
        ],
    ];
    /**
     *  [$messages 错误信息]
     *  @var [type]
     */
    protected $messages = [
        'nickname.required' => '昵称不能为空',
        'phone.required' => '电话号码不能为空',
        'phone.unique' => '该号码已经注册过',
        'password.required' => '密码不能为空',
	];
}