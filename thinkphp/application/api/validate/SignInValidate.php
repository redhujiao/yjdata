<?php
/**
 * User: redhujiao
 * Date: 2019/4/13
 * Time: 18:10
 */

namespace app\api\validate;


class SignInValidate extends BaseValidate
{
public $rule=['mobile' => 'require|isMobile',
'password'=>'require|isPassword'];
}