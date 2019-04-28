<?php
/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 2019-04-21
 * Time: 23:39
 */

namespace app\index\controller;

use app\common\ResultR;
use app\model\ ProductInventroyM;
use app\model\ProductM;


class ProductWarehouse
{
    public function lookProductWarehouse($map)
    {
        return ProductInventroyM::where($map)->select();
    }

    public function setProductWarehouse($map,$data)
    {
        return ProductInventroyM::where($map)->update($data);
    }

    public function getAll()
    {
        $res = $this->lookProductWarehouse([1=>1]);
        return (!empty($res))?ResultR::accessResult($res):ResultR::errorResult($res->errorInfo(),'no data');
    }

    public function getMe($filed,$id){
        $res = $this->lookProductWarehouse([$filed =>$id]);
        return (!empty($res))?ResultR::accessResult($res):ResultR::errorResult($res->errorInfo(),'no data');
    }

    public function postWarehouse($pid,$wid,$data)
    {
        try {
            $res = $this->setProductWarehouse(['p_id' => $pid,'w_id'=>$wid], $data);
            return ($res > 0) ? ResultR::accessResult('修改成功') : ResultR::hintResult('修改失败', '');
        }catch (Exception $e){
            return ResultR::hintResult($e->getMessage(),'');
        }
    }

    public function putWarehouse($data)
    {
        $res = ProductInventroyM::create($data);
        return (!empty($res))?ResultR::accessResult($res):ResultR::errorResult($res->getError(),'no data');
    }

    public function deleteStatus($pid,$wid)
    {
        try {
            $res = $this->setProductWarehouse(['p_id'=>$pid,'w_id'=>$wid], ['status' => 1]);
            return ($res > 0) ? ResultR::accessResult($res) : ResultR::errorResult('未知错误', 'no data');
        }catch (Exception $e){
            return ResultR::hintResult($e->getMessage(),'');
        }
    }
}