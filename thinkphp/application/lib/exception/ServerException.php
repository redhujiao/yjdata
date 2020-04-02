<?php
/**
 * User: HS
 * Date: 2017/8/13
 * Time: 12:37
 */

namespace app\lib\exception;


class ServerException extends BaseException
{
    public $code = 400;
    public $msg = '服务器异常';
    public $errorCode =30003;

}