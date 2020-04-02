<?php
/**
 * User: hs
 * Date: 2017/9/9
 * Time: 12:08
 */

namespace app\api\model;


use think\Model;

class DrugInstructions extends Model
{  public static function getInstryction($name){
//    $Instryction=self::where('中文名','LIKE',$name);
    $Instryction=self::get(['BGBM'=>$name]);
    return $Instryction;

}
}