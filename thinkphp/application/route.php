<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
Route::get('api/getdrugs/:id','api/Drugs/getDrugs');
Route::get('api/text','api/Drugs/text');
Route::get('api/getuser','api/User/getUser');
Route::post('api/getdrugsinstruction','api/Drugs/getDrugsInstruction');

Route::post('api/getCollectionDrug','api/Drugs/getCollectionDrug');
Route::post('api/setCollectionDrug','api/Drugs/setCollectionDrug');
Route::post('api/getNewUser','api/User/getNUser');
Route::post('api/getDurgRisk','api/Drugs/text1');
Route::post('api/sms','api/Sms/getVerificationCode');
Route::post('api/user/signin', 'api/User/SignIn');
Route::post('api/user/RetrievePassword', 'api/User/RetrievePassword');