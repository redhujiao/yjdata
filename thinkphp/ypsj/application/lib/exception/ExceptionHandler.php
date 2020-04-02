<?php
/**
 * Created by 可界公司.
 * User: hs
 * Date: 2017/9/9
 * Time: 11:48
 */

namespace app\lib\exception;


use Exception;
use think\Log;
use think\exception\Handle;
use think\Request;

class ExceptionHandler extends Handle
{
    /*
     * 全局异常处理类
     */
    private $code; //错误http代码
    private $msg;//错误消息
    private $errorCode;//自定义错误代码
    public function render(\Exception $e)//  \Exception 是包括http异常的父类
    {
        if($e instanceof BaseException){   //自定义异常抛出自定义代码
            $this->code=$e->code;
            $this->msg=$e->msg;
            $this->errorCode=$e->errorCode;
        }
        else{
            if(config('app_debug')){  //调试开关
                return parent::render($e);
            }
            else{
                $this->code = 500;
                $this->msg = '服务器内部错误';  //一般返回服务器内部错误
                $this->errorCode = 999;
                $this->recordErrorLog($e);  //写入日志
            }
        }


        $request=Request::instance();
        $result=[
            'code'=>$this->code,
            'msg'=>$this->msg,
            'error_code'=>$this->errorCode,
        ];
        return json($result,$this->code);
    }
    public function recordErrorLog(\Exception $e){    //写入日志函数
        Log::init([
            'type'=>'File',
            'path'=>LOG_PATH,
            'level'=>['error']
        ]);
        Log::record($e->getMessage(),'error');
    }


}