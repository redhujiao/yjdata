<?php
/**
 * User: HS
 * Date: 2017/8/13
 * Time: 12:16
 */

namespace app\api\validate;


class MobileValidate extends BaseValidate
{
    protected $message=[
        'mobile'=>'手机号码不正确'
    ];
    protected $rule=[
        'mobile'=>'require|isMobile'
    ];


}//require|