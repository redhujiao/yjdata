<?php
/**
 * User: redhujiao
 * Date: 2019/4/11
 * Time: 19:03
 */

namespace app\api\service;




use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\TokenException;
use app\lib\exception\UserException;
use think\Cache;
use think\Exception;
use think\Request;
use app\api\model\User as UserModel;
class Token
{
    public static function generateToken(){
        $randChars=getRandChar(32);
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT']; //当前时间戳
        $salt=config('secure.token_salt');  //加盐
        return md5($randChars . $timestamp . $salt);
    }

    public static function getCurrentTokenall(){  //拿到所有缓存
        $token=Request::instance()->header('token');
        $vars=Cache::get($token);
        if (!$vars)
        {
            throw new TokenException(['msg'=>'您还没有登陆或者请重新登陆']);
        }
        else{
            if(!is_array($vars)){
                $vars=json_decode($vars,true);
        }
            return $vars;
        }
    }
    public static function getIsUser(){
        $token=Request::instance()->header('token');
        $vars=Cache::get($token);
        if (!$vars){
            return 0;
        }
        if(!is_array($vars)){
            $vars=json_decode($vars,true);
        }
        $id=$vars['id'];
        return $id;
    }
    public static function getCurrentTokenVar($key){  //拿到缓存中的一条数据
        $vars=self::getCurrentTokenall();
        if(array_key_exists($key,$vars))
        {
            return $vars[$key];
        }
        else{
            throw new Exception('尝试获取Token变量不存在');
        }

    }
    public static function getCurrentUser()
    {
        $uid=self::getCurrentTokenVar('id');
        $user=UserModel::get($uid);
        if (!$user)
        {
            throw new UserException();
        }
        return $user;
    }

    //用户管理员均可调用
    public static function needPrimaryScope()
    {
    $scope = self::getCurrentTokenVar('scope');
    if ($scope)
    {
        if ($scope >= ScopeEnum::User)
        {
            return true;
        }
        else
        {
            throw new ForbiddenException();
        }
    }
    else
    {
        throw new TokenException();
    }
}

    // 只有用户才能访问的接口权限
    public static function needExclusiveScope()
    {
        $scope = self::getCurrentTokenVar('scope');
        if ($scope)
        {
            if ($scope == ScopeEnum::User)
            {
                return true;
            }
            else
            {
                throw new ForbiddenException();
            }
        }
        else
        {
            throw new TokenException();
        }
    }
    //未注册调用
    public static function needNewUser()
    {
        $scope = self::getCurrentTokenVar('scope');
        if ($scope)
        {
            return 2;
            //throw new TokenException();
        }
        else
        {
            return true;
        }
    }



    public static function isValidOperate($checkedUID)
    {
        if (!$checkedUID)
        {
            throw new Exception('检查UID时必须传入一个被检查的UID');
        }
        $currentOperateUID = self::getCurrentTokenVar('uid');
        if($currentOperateUID == $checkedUID){
            return true;
        }
        return false;
    }


}