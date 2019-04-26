<?php
/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 2019-04-21
 * Time: 23:39
 */

namespace app\index\controller;

use app\common\ResultR;
use app\model\ WarehouseM;
use think\Exception;


class Warehouse
{
    public function lookWarehouse($map)
    {
        return WarehouseM::where($map)->select();
    }

    public function setWarehouse($map,$data)
    {
        return WarehouseM::where($map)->update($data);
    }

    public function getAll()
    {
        $res = $this->lookWarehouse([1=>1]);
        return (!empty($res))?ResultR::accessResult($res):ResultR::errorResult($res->errorInfo(),'no data');
    }

    public function getMe($id){
        $res = $this->lookWarehouse(['id'=>$id]);
        return (!empty($res))?ResultR::accessResult($res):ResultR::errorResult($res->errorInfo(),'no data');
    }

    public function postWarehouse($id,$data)
    {
        try {
            $res = $this->setWarehouse(['id' => $id], $data);
            return ($res > 0) ? ResultR::accessResult('修改成功') : ResultR::hintResult('修改失败', '');
        }catch (Exception $e){
            return ResultR::hintResult($e->getMessage(),'');
        }
    }

    public function putWarehouse($data)
    {
            $res = WarehouseM::create($data);
            return (!empty($res))?ResultR::accessResult($res):ResultR::errorResult($res->getError(),'no data');
    }

    public function deleteWarehouse($id)
    {
        try {
            $res = $this->setWarehouse(['id', $id], ['status' => 1]);
            return ($res > 0) ? ResultR::accessResult($res) : ResultR::errorResult('未知错误', 'no data');
        }catch (Exception $e){
            return ResultR::hintResult($e->getMessage(),'');
        }
    }
}