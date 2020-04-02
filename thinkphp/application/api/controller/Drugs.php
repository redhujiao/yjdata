<?php
/**
 * User: redhujiao
 * Date: 2019/4/9
 * Time: 12:00
 */

namespace app\api\controller;


use app\api\service\Token;

use app\api\controller\BaseController;
use app\api\controller\User;
use app\api\model\BarCode1;
use app\api\model\BarCode2;
use app\api\model\CollectionUser;
use think\Request;
use app\api\model\Drugrisk;
use app\api\model\sfsj;
use app\lib\exception\DrugsMissException;
use think\model\Collection;

class Drugs extends BaseController
{
    public function getDrugs($id){
        if(!$id){
            throw new DrugsMissException();
        }
        $drug=self::getDataDrug($id);
        return $drug;
    }

    public function getDataDrug($id){
        $drugs=BarCode2::getDrug($id);
        if(!$drugs){
            $drugs=BarCode1::getDrug($id);
            if(!$drugs){
                throw new DrugsMissException(["msg"=>"查找药品不存在"]);
            }
        }
        return $drugs;
    }

    public function setCollectionDrug(){
        $array=Request::instance()->post(false);
        $data=Token::getCurrentUser();
        $bool=CollectionUser::createDrug($array['drugid'],$data['id'],$array['drugname'],$array['from']);
        return true;
    }

    public function getCollectionDrug(){
        $array=Request::instance()->post(false);
        $data=Token::getCurrentUser();
        $data=CollectionUser::getDrugs($array['page'],$array['size'],$data['id']);
        return $data;
    }

    public function getDrugsInstruction(){
        $array=Request::instance()->post(false);
        $data=$array['name'];
        $Instruction=sfsj::getInstryction($data);
        return $Instruction;
    }

    public function text(){
        return 1;
    }

    public function text1(){
        $array=Request::instance()->post(false);
        $size=$array['size'];
        $page=$array['page'];
        $data=Drugrisk::getDrugRisk($size,$page);
        return $data;
    }
}