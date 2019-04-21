<?php
/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 2019-04-21
 * Time: 19:33
 */

namespace app\index\controller;

use app\common\Excel;
use app\common\ResultR;
use app\model\StaffInfoM;

class StaffInfo
{
    public function postOExcel(){
        $file = request()->file('file');
        $info = $file->validate(['size'=>102400,'ext'=>'xls,xlsx'])->move(RESOURCES. '/excel/');
        if($info){
            $dirs = new Excel(RESOURCES. '/excel/'.$info->getSaveName());
            dump($dirs->reader());
        }else{
            // 上传失败获取错误信息
            return ResultR::hintResult($file->getError(),'');
        }
    }

    public function putStaffInfo($data)
    {
        StaffInfoM::create($data);
    }

    public function setHead()
    {
        $file = request()->file('header');
        $info = $file->validate(['size'=>102400,'ext'=>'jpg,png'])->move(RESOURCES. '/excel/');
        if($info){
            $info->getSaveName();
        }else{
            // 上传失败获取错误信息
            return ResultR::hintResult($file->getError(),'');
        }
    }
}