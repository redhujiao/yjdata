<?php
/**
 * User: redhujiao
 * Date: 2019/4/13
 * Time: 12:14
 */

namespace app\api\controller;
use app\api\controller\BaseController;
use app\api\service\Aliyun;
use app\api\validate\MobileValidate;
use app\api\service\Token as TokenService;
use app\lib\exception\ServerException;
use app\lib\exception\VerificationCodeException;
use think\Request;

class Sms extends BaseController
{
    protected $beforeActionList = [
        'checkEveryone' => ['only' => 'createOrUpdateAddress']  //前置验证
    ];
    public function getVerificationCode(){
        $validate=new MobileValidate();
        $validate->goCheck();

        $array=Request::instance()->post(false);
        $dataArray=$validate->getDataByRule($array);  //验证
        $mobile=$dataArray['mobile'];  //电话
        $number=getRandNumber(6);  //随机验证码
       $a= new Aliyun();
       $bn=$a->send_verify($mobile,$number);
       if(!$bn)
       {
           throw new VerificationCodeException(['msg'=>$a->error]);
       }
        $token=Request::instance()->header('token');
        $VerificationCode='VerificationCode'.$mobile;
        $number=(string)$number;
        $a=cache($VerificationCode,$number,config('setting.VerificationCode'));
        if(!$a){                         //判断缓存是否写入
            throw new VerificationCodeException( [
                'msg' => '服务器缓存异常',
                'errorCode' => 30005
            ]);
        }
        return $number;
    }
}