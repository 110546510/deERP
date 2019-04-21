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


class ProductWarehouse
{
    public function setProductWarehouse()
    {
        return ProductInventroyM::where()->select();
    }

    public function lookProductWarehouse()
    {
        return ProductInventroyM::where()->update();
    }

    public function getProductWarehouse()
    {

    }

    public function postProductWarehouse()
    {

    }

    public function putProductWarehouse()
    {

    }

    public function deleteProductWarehouse()
    {

    }
}