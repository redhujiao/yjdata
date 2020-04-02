<?php
/**
 * User: HS
 * Date: 2017/8/11
 * Time: 19:03
 */

namespace app\api\service;


use app\lib\enum\ScopeEnum;
use app\lib\exception\ServerException;
use app\lib\exception\TokenException;
use app\lib\exception\WxException;
use think\Exception;
use app\api\model\User as UserModel;
class UserToken extends Token
{
    protected $id;

    function  __construct($id) //构造函数，拼接每个用户的url
    {
        $this->id=$id;
    }



    public  function  getToken(){  //发放token令牌
        $Result=[];
        $cachedValue=$this->prepareCachedValue($Result,$this->id);
        $token=self::saveTOCache($cachedValue);
        return [
            'token'=>$token
        ];



    }





    private function saveTOCache($cachedValue){   //写入缓存
        $key=self::generateToken();
        $value=json_encode($cachedValue);  //数组化
        $expire_in=config('setting.token_expire_in');
        $request=cache($key,$value,$expire_in);//写入缓存 （Token，用户信息，时效）
        if(!$request){                         //判断缓存是否写入
            throw new ServerException([
                'msg' => '服务器缓存异常',
                'errorCode' => 20005
            ]);
        }
        return $key;  //返回令牌
    }


    private function prepareCachedValue($wxResult,$uid){    //赋予权限
        $cacheValue=$wxResult;
        $cacheValue['id']=$uid;
        $cacheValue['scope']=ScopeEnum::User;               //注册用户权限16，未注册
        return $cacheValue;
    }


    private function processLoginError($wxResult)    //异常调用
    {
        throw new WxException(

            [
                'msg' => $wxResult['errmsg'],
                'errorCode' => $wxResult['errcode']
            ]);
    }
//
//
//    private function newUser($openid){   //创建新用户
//        $user = UserModel::create([
//            'openid' => $openid
//        ]);
//        return $user->id;
//    }





}