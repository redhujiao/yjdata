<?php
/**
 * User: HS
 * Date: 2017/8/11
 * Time: 19:28
 */

namespace app\lib\exception;


use app\api\validate\BaseValidate;

class WxException extends BaseException
{
    public $code = 400;
    public $msg = '微信服务器接口调用失败';
    public $errorCode = 999;
}