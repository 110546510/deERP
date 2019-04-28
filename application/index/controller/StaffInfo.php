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
	
	public function lookStaffInfo($where)
    {
        return StaffInfoM::where($where)->select();
    }

    public function setStaffInfo($where,$data)
    {
        return StaffInfoM::where($where)->update($data);
    }

    public function getStaffInfo($filed,$name)
    {
        $res = $this->lookStaffInfo([$filed=>$name]);
        return ($res)?ResultR::accessResult($res):ResultR::errorResult($res->errorInfo(),'no data');
    }

    public function getStaffInfoAll()
    {
        $res = $this->lookStaffInfo('');
        return ($res)?ResultR::accessResult($res):ResultR::errorResult($res->errorInfo(),'no data');
    }

	public function postStaffInfo($id,$data)
    {
        $res = $this->setStaffInfo(['id',$id],$data);
        return ($res > 0 )?ResultR::accessResult($res):ResultR::errorResult('未知错误','no data');
    }

    public function putStaffInfo($datas)
    {
		if(!is_array($datas)){
			return ResultR::errorResult('no array','');
		}
		try{
        $res = $this->newStaffInfo($datas);
		}catch(Exception $e){
			return ResultR::errorResult("电话号码、身份证、邮箱不能重复",'no data');
		}
        return (!empty($res))?ResultR::accessResult($res):ResultR::errorResult($res,'no data');

    }

    public function newStaffInfo($data){
    
        $res = StaffInfoM::create($data);
        return $res;
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