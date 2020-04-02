<?php
/**
 * User: HS
 * Date: 2017/8/13
 * Time: 16:38
 */

namespace app\lib\exception;


use app\api\validate\BaseValidate;

class UserOperationException extends BaseException
{
    public $code = 400;
    public $msg = '两次输入密码不一样';
    public $errorCode =40003;


}