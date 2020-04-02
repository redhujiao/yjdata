<?php
/**
 * Created by PhpStorm.
 * User: 娃娃鱼
 * Date: 2017/9/9
 * Time: 11:35
 */
namespace app\lib\exception;

use think\Exception;

class BaseExceprion extends Exception
{
    public $code=400;
    public $msg='参数错误';
    public $errorCode=10000;

    public function __construct($params=[])
    {
        if (!is_array($params)) {         //是否为数组（字典）
            return;
        }
        if (array_key_exists('code', $params)) {   //有没有code，有则赋值
            $this->code = $params['code'];
        }
        if (array_key_exists('msg', $params)) {
            $this->msg = $params['msg'];
        }
        if (array_key_exists('errorCode', $params)) {
            $this->errorCode = $params['errorCode'];
        }
    }

}