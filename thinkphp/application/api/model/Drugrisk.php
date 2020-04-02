<?php
/**
 * User: redhujiao
 * Date: 2019/4/9
 * Time: 12:08
 */

namespace app\api\model;


use think\Model;

class Drugrisk extends Model
{  
    public static function getDrugRisk($page=2,$size=1){
        $pagingData = self::order('')->order('id','desc')->paginate($size,true,['page'=>$page]);
        return $pagingData;
    }
}