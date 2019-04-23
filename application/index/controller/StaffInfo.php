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
        $file = request()->file('files');
        $info = $file->validate(['size'=>102400,'ext'=>'xls,xlsx'])->move(RESOURCES. '/excel/');
        if($info){
            $dirs = new Excel(RESOURCES. '/excel/'.$info->getSaveName());
            $data = $dirs->reader('2');
            $map = array();
            for($i = 0;$i++;$i < count($data)){
                $map['name'] = $data[i][0];
                $map['age'] = $data[i][1];
                $map['telephone'] = $data[i][2];
                $map['identity_card'] = $data[i][3];
                $map['mail'] = $data[i][4];
                $map['location'] = $data[i][5];
                $map['h_name'] = $data[i][6];
                $map['h_telephone'] = $data[i][7];
            }
            return ResultR::accessResult();
        }else{
            // 上传失败获取错误信息
            return ResultR::hintResult($file->getError(),'');
        }
    }

    public function putStaffInfo($data)
    {
        $res = $this->newStaffInfo($data);
        return (!is_string($res))?ResultR::accessResult('新建成功'):ResultR::errorResult($res,'no data');
    }

    public function newStaffInfo($data){
        if(is_array($data)){
            return "不是数组";
        }
        $res = StaffInfoM::create($data);
        if(!empty($res)){
            return $res->getNumRows();
        }
        return "新建失败";
    }

    public function setHead()
    {
        $file = request()->file('header');
        $info = $file->validate(['size'=>102400,'ext'=>'jpg,png'])->move(RESOURCES. '/excel/');
        if($info){
            return $info->getSaveName();
        }else{
            // 上传失败获取错误信息
            return $file->getError();
        }
    }
}