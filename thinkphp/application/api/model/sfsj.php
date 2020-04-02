<?php
/**
 *
 * User: redhujiao
 * Date: 2019/4/9
 * Time: 12:07
 */

namespace app\api\model;


use think\Model;

class sfsj extends Model
{
    public static function getInstryction($name){
//        $Instryction=self::where('BGBM','LIKE',$name);
        $name=iconv('GBK',"utf-8",$name);
        $Instryction=self::get(['BGBM','=',$name]);
        if(!$Instryction){
            return $name;
        }
        return $Instryction;
    }
}