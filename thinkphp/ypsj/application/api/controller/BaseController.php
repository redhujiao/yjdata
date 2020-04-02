<?php
/**
 * User: HS
 * Date: 2017/8/14
 * Time: 13:56
 */

namespace app\api\controller;
use think\Controller;
use app\api\service\Token as TokenService;

class BaseController extends Controller
{
    protected function checkPrimaryScope()
    {
        TokenService::needPrimaryScope();
    }

    protected function checkExclusiveScope()
    {
        TokenService::needExclusiveScope();
    }
//    protected function checkUnregisteredUser(){
//        TokenService::needNewUser();
//    }
}