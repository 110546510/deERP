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
    public function setClientSupplier()
    {
        return ClientSupplierM::where()->select();
    }

    public function lookClientSupplier()
    {
        return ClientSupplierM::where()->update();
    }

    public function getClientSupplier()
    {

    }

    public function postClientSupplier()
    {

    }

    public function putClientSupplier()
    {

    }

    public function deleteClientSupplier()
    {

    }
}