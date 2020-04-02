<?php
/**
 * User: HS
 * Date: 2017/8/11
 * Time: 20:22
 */

namespace app\api\model;


use app\api\service\UserToken;
use app\lib\exception\ParmeterException;
use think\Exception;
use think\Model;
use think\Request;
use app\api\model\User as UserModel;
class User extends Model
{
//    public function address()
//    {
//        return $this->hasOne('UserAddress', 'user_id', 'id');
//    }





    public static function CreateUser($dataArray){  //用户注册
        $tokensalt=config('secure.token_salt');
        $salt=getRandChar(10);

        $password=md5($dataArray['password'].$tokensalt.$salt);
        $mobile=self::where('mobile','=',$dataArray['mobile']);
        if(!$mobile){
            throw new Exception(['msg'=>'数据库写入失败']);
        }
        $bool=self::create(['nickname'=>$dataArray['nickname'],'mobile'=>$dataArray['mobile'],
            'password'=>$password,'salt'=>$salt]);
        if(!$bool){
            throw new Exception(['msg'=>'数据库写入失败']);
        }
        return $bool;
    }

    public static function SignInUser($dataArray){   //登录

        $signInUser=UserModel::get(['mobile'=>$dataArray['mobile']]);
        if(!$signInUser){
            throw new ParmeterException(['msg'=>'用户不存在']);
        }
        $tokensalt=config('secure.token_salt');
        $password=md5($dataArray['password'].$tokensalt.$signInUser['salt']);
        if($password==$signInUser['password']){
            $user=new UserToken($signInUser['id']);
            $token=$user->getToken();
            return $token;
        }
        else{
            throw new ParmeterException(['msg'=>'密码错误']);
        }
    }
    public static function RetrievePasswordModel($dataArray){
        $signInUser=UserModel::get(['mobile'=>$dataArray['mobile']]);
        $salt=$signInUser['salt'];
        $tokenSalt=config('secure.token_salt');
        $newPassword=md5($dataArray['password'].$tokenSalt.$salt);
        $bool=self::where('id',$signInUser['id'])->update(['password'=>$newPassword]);
        return $bool;

    }

}