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
use think\Exception;

class StaffInfo
{
    public function postOExcel(){
        $file = request()->file('files');
        $info = $file->validate(['size'=>102400,'ext'=>'xls,xlsx'])->move(RESOURCES. '/excel/');
        if($info){
            $dirs = new Excel(RESOURCES. '/excel/'.$info->getSaveName());
            $data = $dirs->reader('2');
            $map = [];
            $error = [];
            for ($j = 0;$j < count($data);$j++){
                $a = $data[$j];
                $map['name'] = $a[0];
                $map['age'] = $a[1];
                $map['telephone'] = $a[2];
                $map['identity_card'] = $a[3];
                $map['mail'] = $a[4];
                $map['location'] = $a[5];
                $map['h_name'] = $a[6];
                $map['h_telephone'] = $a[7];
                try{
                    StaffInfoM::create($map);
                }catch (Exception $e){
                    array_push($error,$j+1);
                }
            }
//            return ResultR::hintResult('失败新建',(count($error) > 0 )?$error:'没有');
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

    public function setHead($id)
    {
        $file = request()->file('header');
        $info = $file->validate(['size'=>102400,'ext'=>'jpg,png'])->move(RESOURCES. '/excel/');
        if($info){
            $res = StaffInfoM::where(['id'=>$id])->update(['header'=>$info->getSaveName()]);
            return ($res > 0 )?ResultR::accessResult('ok'):ResultR::errorResult('错误','no data');
        }else{
            // 上传失败获取错误信息
            return ResultR::hintResult($file->getError(),'');
        }
    }
}