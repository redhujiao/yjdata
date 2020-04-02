<?php
/**
 * User: redhujiao
 * Date: 2019/4/9
 * Time: 12:07
 */

namespace app\api\model;


use think\Model;

class BarCode1 extends Model
{
    protected $hidden=['药品编码','药品类别','助记码','通用名'
        ,'存储条件','库存上限','库存下限'];
    public static function getDrug($id){
        return self::get(['BarCode'=>$id]);
    }
}