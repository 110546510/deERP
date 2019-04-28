<?php
/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 2019-04-16
 * Time: 21:21
 */

namespace app\index\controller;

use app\common\Excel;
use app\common\ResultR;
use app\model\OrganizationM;
use app\common\Tool;

class Organization
{
    public function lookOrganization($map)
    {
        return OrganizationM::where($map)->where('status',0)->select();
    }

    public function setOrganization($where,$data)
    {
        return OrganizationM::where($where)->update($data);
    }

    public function getOrganizationAll($who)
    {
        $map['who'] = $who;
        $res = $this->lookOrganization($map)->toArray();
        return ($res > 0)?ResultR::accessResult($res):ResultR::hintResult('没有数据','');
    }


    public function putNew()
    {
        OrganizationM::create(['id'=>config('erpconfig.'),]);
    }

    public function OrangizationS($who,$id)
    {
        $map['who'] = $who;
        $map['id'] = $id;
        $res = $this->lookOrganization($map);
        return ($res > 0)?$res:-1;
    }

    public function postOrganization($who,$id,$filed,$das)
    {
        $arr = ['belong,name'];
        in_array($filed,$arr);
        $map['who'] = $who;
        $map['id'] = $id;
        $data[$filed] = $das;
        $res = $this->setOrganization($map,$data);
        return ($res > 0)?ResultR::accessResult($res):ResultR::errorResult('修改失败','');
    }

    public function deleteOrganization($id,$who){
        $ss = $this->OrangizationS($who,$id);
        if( $ss == -1){
            return ResultR::hintResult('没有该结构','');
        }
        if($ss->toArray()['num'] != 0){
            return ResultR::hintResult('该结构还有数据','');
        }
        $map['id'] = $id;
        $map['who'] = $who;
        $res = $this->setOrganization($map,['status'=>1]);
        return ($res > 0)?ResultR::accessResult($res):ResultR::errorResult('修改失败','');
    }

    public function getOrganization($name,$belong = '',$who){
        $id = 'ST-'.substr(Tool::getSecond(),0,26);
        $res = OrganizationM::create(['id'=>$id,'name'=>$name,'belong'=>$belong,'who'=>$who]);
        return (!empty($res))?ResultR::hintResult('创建成功',$res):ResultR::errorResult('修改失败','');
    }

}