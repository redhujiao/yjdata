<?php
/**
 * User: HS
 * Date: 2017/8/10
 * Time: 10:55
 */

namespace app\api\validate;


use app\lib\exception\BaseException;
use app\lib\exception\ParmeterException;
use think\Exception;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    /*
     * 验证器基类
     */
    public function goCheck()  //验证方法
    {
        $request=Request::instance();
        $params=$request->param();//拿到所有http传入参数
        $result=$this->batch()->check($params);//进行校验
        if(!$result){
            $e=new BaseException([
                'msg'=>$this->error,
                'errorCode'=>40000
            ]);
            throw $e;
        }
        else{
            return true;
        }
    }
    protected function isPositiveInteger($value,$rule=''     //验证是否为正整数
        , $data='',$field=''){
        if(is_numeric($value)&&is_int($value+0)&&($value+0)>0){
            return true;
        }
        else{
            return false;
        }
    }
    protected function isNotEmpty($value,$rule=''    //验证是否不存在
        , $data='',$field=''){
        if(empty($value)){
            return false;
        }
        else{
            return true;
        }
    }
    protected function isMobile($value)  //验证手机号是否正确
    {
        $rule = '^1(3|4|5|7|8)[0-9]\d{8}$^';
        $result = preg_match($rule, $value);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    protected function isPassword($value)  //验证密码
    {
        $rule='/^[a-z\d]*$/i';
        $result = preg_match($rule, $value);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function isVerificationCode($value){  //验证验证码
        $rule='^\d{6}^';
        $result = preg_match($rule, $value);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function getDataByRule($arrays)  //防止恶意操作
    {
        if (array_key_exists('user_id', $arrays) |
            array_key_exists('uid', $arrays)
        )
        {
            // 不允许包含user_id或者uid，防止恶意覆盖user_id外键
            throw new ParmeterException(
                [
                    'msg' => '参数中包含有非法的参数名user_id或者uid'
                ]);
        }
        $newArray = [];


        foreach ($this->rule as $key => $value)
        {
            $newArray[$key] = $arrays[$key];
        }
        return $newArray;
    }





}