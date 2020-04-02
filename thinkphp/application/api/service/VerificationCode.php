<?php
/**
 * User: redhujiao
 * Date: 2019/4/13
 * Time: 16:42
 */

namespace app\api\service;


use app\lib\exception\VerificationCodeException;
use think\Cache;
use think\Exception;
use think\exception\ValidateException;
use think\Request;

class VerificationCode
{
    public static function getVerificationCode($mobile){

        $vars=Cache::get('VerificationCode'.$mobile);
        if (!$vars)
        {
            throw new VerificationCodeException(['msg'=>'验证码已经超过时间，请重新获取']);
        }
        else{
                return $vars;
        }
    }

}