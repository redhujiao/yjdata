<?php
/**
 * 可界版权所有.
 * User: HS
 * Date: 2017/8/13
 * Time: 15:11
 */

namespace app\lib\exception;


class VerificationCodeException extends BaseException
{
    public $code = 400;
    public $msg = '业务限流';
    public $errorCode =30003;
}