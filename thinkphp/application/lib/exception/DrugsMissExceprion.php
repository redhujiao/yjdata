<?php
/**
 * Created by 可界公司.
 * User: hs
 * Date: 2017/9/9
 * Time: 12:01
 */

namespace app\lib\exception;


class DrugsMissExceprion extends BaseExceprion
{
    public $code=400;
    public $msg='传入条形码';
    public $errorCode=10004;

}