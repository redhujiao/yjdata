<?php
/**
 * User: redhujiao
 * Date: 2019/4/13
 * Time: 16:11
 */

namespace app\api\validate;


class UserValidate extends BaseValidate
{
protected $rule = [
    'nickname' => 'require|isNotEmpty',
    'mobile' => 'require|isMobile',
    'password' => 'require|isPassword',
    'Repeatpassword' => 'require|isPassword',
    'VerificationCode' => 'require|isVerificationCode'
];
}