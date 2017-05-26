<?php
namespace Aizxin\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class CityValidator extends LaravelValidator {

   /**
    *  [$rules 规则]
    *  @var [type]
    */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => ['required'],
            'key' => ['required','alpha','min:1','max:1'],
            'province' => ['required'],
            'city' => ['required'],
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => ['required'],
            'key' =>  ['required'],
            'province' => ['required'],
            'city' => ['required'],
        ],
    ];
    /**
     *  [$messages 错误信息]
     *  @var [type]
     */
    protected $messages = [
        'name.required' => '名称不能为空',
        'province.required' => '省份不能为空',
        'city.required' => '城市不能为空',
        'key.alpha' => '城市索引必须为一个英文字母',
	];
}