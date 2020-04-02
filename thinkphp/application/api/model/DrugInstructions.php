<?php
/**
 * User: redhujiao
 * Date: 2019/4/9
 * Time: 12:08
 */

namespace app\api\model;


use think\Model;

class DrugInstructions extends Model
{  public static function getInstryction($name){
    $Instryction=self::get(['BGBM'=>$name]);
    return $Instryction;

}
}