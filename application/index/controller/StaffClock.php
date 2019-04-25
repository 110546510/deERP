<?php
/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 2019-04-21
 * Time: 23:40
 */

namespace app\index\controller;

use app\common\ResultR;
use app\common\Tool;
use app\model\ StaffClockM;
use app\model\StaffInfoM;
use think\Db;
use think\Exception;


class StaffClock
{
    /**
     * @param $map
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function lookStaffClock($map)
    {
        return StaffClockM::where($map)->select();
    }

    /**
     * @param $map
     * @param $data
     * @return int|string
     * @throws Exception
     * @throws \think\exception\PDOException
     */
    public function setStaffClock ($map,$data)
    {
        return StaffClockM::where($map)->update($data);
    }

    public function getMe($staffid)
    {
        try{
            $res = $this->lookStaffClock(['staff_id'=>$staffid]);
            return (!empty($res))?ResultR::accessResult($res):ResultR::errorResult($res->errorInfo(),'no data');
        }catch (Exception $e){
            return ResultR::hintResult($e->getMessage(),'');
        }
    }

    public function getAll()
    {
        $res = Db::name('staff_clock')->group('staff_id')->select();
        return (!empty($res))?ResultR::accessResult('ok'):ResultR::errorResult($res->errorInfo(),'no data');
    }

    public function postWorktime($staffid,$status)
    {
        $date = date("Y-m-d h:i:s");
        $workst = ['to_work','off_work'];
        $workin = ['to_work_info','off_work_info'];
        try{
            $res = $this->setStaffClock(['staff_id',$staffid],[$workst[$status]=>$date,$workin[$status]=>Tool::workTime(config('erpconfig.worktime.'.$status),':',$status)]);
            return ($res > 0)?ResultR::accessResult($res):ResultR::errorResult('签到失败','no data');
        }catch (Exception $e){
            return ResultR::hintResult($e->getMessage(),'');
        }

    }

    public function postStaffC($staffid)
    {
        try{
            $res = $this->setStaffClock([],['to_work_info'=>'','off_work_info'=>'']);
            return ($res > 0)?ResultR::accessResult($res):ResultR::errorResult('修改失败','no data');
        }catch (Exception $e){
               return ResultR::hintResult($e->getMessage(),'');
        }
    }
}