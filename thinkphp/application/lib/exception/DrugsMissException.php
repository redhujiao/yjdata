<?php
/**
 * User: hs
 * Date: 2017/9/9
 * Time: 12:01
 */

namespace app\lib\exception;


class DrugsMissException extends BaseException
{
    public $code=400;
    public $msg='传入条形码';
    public $errorCode=10004;

}