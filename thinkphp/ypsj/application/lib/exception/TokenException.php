<?php
/**
 * User: HS
 * Date: 2017/8/12
 * Time: 12:32
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code = 400;
    public $msg = 'Token发放失败';
    public $errorCode =20003;

}