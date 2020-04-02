<?php
/**
 * User: HS
 * Date: 2017/8/13
 * Time: 12:49
 */

namespace app\lib\exception;


class UserException extends BaseException
{
    public $code = 400;
    public $msg = '用户不存在';
    public $errorCode =30003;


}