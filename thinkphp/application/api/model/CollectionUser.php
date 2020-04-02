<?php
/**
 * User: redhujiao
 * Date: 2019/4/9
 * Time: 12:07
 */

namespace app\api\model;


use think\Model;

class CollectionUser extends Model
{

    public static function createDrug($drugId,$userid,$drugname,$DosageForm){
        $bool=self::create(['user_id'=>$userid,'drug_id'=>$drugId,'drug_name'=>$drugname,'pg'=>$DosageForm]);
        if(!$bool){
            throw new Exception(['msg'=>'数据库写入失败']);
        }
        return true;
    }
    public static function getDrugs($page=2,$size=1,$uid){
        $pagingData = self::where('user_id','=',$uid)->order('id','desc')->paginate($size,true,['page'=>$page]);
        return $pagingData;
    }
}