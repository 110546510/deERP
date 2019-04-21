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


class Warehouse
{
    public function setWarehouse()
    {
        return WarehouseM::where()->select();
    }

    public function lookWarehouse()
    {
        return WarehouseM::where()->update();
    }

    public function getWarehouse()
    {

    }

    public function postWarehouse()
    {

    }

    public function putWarehouse()
    {

    }

    public function deleteWarehouse()
    {

    }
}