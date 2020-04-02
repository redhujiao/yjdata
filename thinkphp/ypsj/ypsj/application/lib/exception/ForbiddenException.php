<?php
/**
 * User: HS
 * Date: 2017/8/14
 * Time: 13:54
 */

namespace app\lib\exception;


class ForbiddenException extends  BaseException{
    public $code=400;
public $msg='请登录后再试~';
    public $errorCode=50003;

}