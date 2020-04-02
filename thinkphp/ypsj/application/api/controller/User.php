<?php
/**
 * User: HS
 * Date: 2017/8/13
 * Time: 15:40
 */

namespace app\api\controller;


use app\api\service\UserToken;
use app\api\service\VerificationCode;

use app\api\validate\RetrievePasswordValidate;
use app\api\validate\SignInValidate;
use app\api\validate\UserValidate;

use app\api\service\Token as TokenService;
use app\lib\enum\ScopeEnum;
use app\lib\exception\UserException;
use app\lib\exception\UserOperationException;
use app\lib\exception\VerificationCodeException;

use think\Request;
use app\api\model\User as UserModel;

class User extends BaseController
{
//    protected $beforeActionList = [
//        'checkUnregisteredUser' => ['only' => 'getNUser,SignIn']
//    ];
    public function getNUser(){
        $validate=new UserValidate();
        $validate->goCheck();//验证提交信息格式

        $array=Request::instance()->post(false);
        $dataArray=$validate->getDataByRule($array);
        if($dataArray['password']!=$dataArray['Repeatpassword']){  //判断两次密码是否正确
            throw new UserOperationException();
        }

        $number=VerificationCode::getVerificationCode($dataArray['mobile']);//拿到验证码
        $userNumber=(string)$dataArray['VerificationCode'];

        if($userNumber==$number){//判断手机验证码
            //$uid=TokenService::getCurrentTokenVar('uid');

            $bool=UserModel::CreateUser($dataArray);
            $ur=new UserToken($bool['id']);
            $token=$ur->getToken();
            $value['scope']=ScopeEnum::User;//赋予权限
            return [
                'token'=>$token,
                'bool'=>$bool
            ];
        }
        else
        {
            throw new VerificationCodeException(['msg'=>'验证码不正确，请重新输入']);
        }
    }
    public function SignIn(){
        $validate=new SignInValidate();
        $validate->goCheck();
        $array=Request::instance()->post(false);
        $dataArray=$validate->getDataByRule($array);


        $bool=UserModel::SignInUser($dataArray);
        if(!$bool){
            throw new UserException(['msg'=>'手机号或密码错误']);
        }

        return $bool;
    }
    public  function RetrievePassword(){
        $validate=new RetrievePasswordValidate();
        $validate->goCheck();
        $array=Request::instance()->post(false);
        $dataArray=$validate->getDataByRule($array);
        if($dataArray['password']!=$dataArray['Repeatpassword']){  //判断两次密码是否正确
            throw new UserOperationException();
        }
        $number=VerificationCode::getVerificationCode($dataArray['mobile']);//拿到验证码
        $userNumber=(string)$dataArray['VerificationCode'];
        if($userNumber==$number){//判断手机验证码

            $bool=UserModel::RetrievePasswordModel($dataArray);

            return ['bool'=>$bool];
        }
        else
        {
            throw new VerificationCodeException(['msg'=>'验证码不正确，请重新输入']);
        }

    }

}