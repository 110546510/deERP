<?php
/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 2019-04-21
 * Time: 23:36
 */

namespace app\index\controller;

use app\common\ResultR;
use app\model\ClientSupplierM;


class ClientSupplier
{
    public function lookClientSupplier($where)
    {
        return ClientSupplierM::where($where)->select();
    }

    public function setClientSupplier($where,$data)
    {
        return ClientSupplierM::where($where)->update($data);
    }

    public function getClientSupplier($filed,$name)
    {
        $res = $this->lookClientSupplier([$filed=>$name]);
        return ($res)?ResultR::accessResult($res):ResultR::errorResult($res->errorInfo(),'no data');
    }

    public function getClientSupplierAll()
    {
        $res = $this->lookClientSupplier(['1'=>'1']);
        return ($res)?ResultR::accessResult($res):ResultR::errorResult($res->errorInfo(),'no data');
    }

    public function postClientSupplier($id,$data)
    {
        $res = $this->setClientSupplier(['id',$id],$data);
        return ($res > 0 )?ResultR::accessResult($res):ResultR::errorResult('未知错误','no data');
    }

    public function putClientSupplier($data)
    {
        $res = ClientSupplierM::create($data);
        return ($res)?ResultR::accessResult($res):ResultR::errorResult($res->getError(),'no data');
    }

    public function deleteClientSupplier($id)
    {
        $res = $this->setClientSupplier(['id',$id],['status'=>1]);
        return ($res > 0 )?ResultR::accessResult($res):ResultR::errorResult('未知错误','no data');
    }
}