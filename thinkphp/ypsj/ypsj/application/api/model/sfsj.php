<?php
/**
 *
 * User: hs
 * Date: 2017/9/9
 * Time: 12:07
 */

namespace app\api\model;


use think\Model;

class sfsj extends Model
{
    public static function getInstryction($name){
//        $Instryction=self::where('BGBM','LIKE',$name);
        $Instryction=self::get(['BGBM'=>$name]);
        return $Instryction;

    }
}