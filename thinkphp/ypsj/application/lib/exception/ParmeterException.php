<?php
/**
 * User: HS
 * Date: 2017/8/13
 * Time: 12:53
 */

namespace app\lib\exception;


class ParmeterException extends BaseException
{
    public $code = 400;
    public $msg = '参数错误';
    public $errorCode = 10000;

}