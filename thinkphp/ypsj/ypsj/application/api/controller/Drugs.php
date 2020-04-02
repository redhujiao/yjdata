<?php
/**
 * User: hs
 * Date: 2017/9/9
 * Time: 12:00
 */

namespace app\api\controller;


use app\api\model\BarCode1;
use app\api\model\BarCode2;
use app\api\model\sfsj;
use app\lib\exception\DrugsMissException;

class Drugs
{
    public function getDrugs($id){

        if(!$id){
            throw new DrugsMissException();
        }
        $drugs=BarCode2::getDrug($id);
        if(!$drugs){
            $drugs=BarCode1::getDrug($id);
            if(!$drugs){
                throw new DrugsMissException(["msg"=>"查找药品不存在"]);
            }
        }
        return $drugs;

    }
    public function getDrugsInstruction($id){
        if(!$id){
            throw new DrugsMissException(["msg"=>"请输入药品名"]);
        }
        $Instruction=sfsj::getInstryction($id);
        return $Instruction;
    }
    public function  text(){
        return 1;
    }


}