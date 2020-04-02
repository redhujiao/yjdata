<?php
/**
 * Created by 可界公司.
 * User: redhujiao
 * Date: 2019/4/17
 * Time: 23:05
 */

namespace app\api\validate;


class RetrievePasswordValidate extends BaseValidate
{
    protected $message=[
        'mobile'=>'手机号码不正确'
    ];
    protected $rule=[
        'mobile' => 'require|isMobile',
        'password'=>'require|isPassword',
        'Repeatpassword' => 'require|isPassword',
        'VerificationCode' => 'require|isVerificationCode'
    ];

}