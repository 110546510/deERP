<?php
/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 2019-04-21
 * Time: 23:34
 */

namespace app\index\controller;

use app\common\ResultR;
use app\model\ProductM;


class Product
{
    public function lookProduct($map)
    {
        return ProductM::where($map)->select();
    }

    public function setProduct($map,$data)
    {
        return ProductM::where($map)->update($data);
    }

    public function getProduct()
    {
        $res = $this->lookProduct($map[1] = 1);
        return (!empty($res))?ResultR::accessResult($res):;
    }

    public function postProduct($filed,$where)
    {
        $arr = ['name','location','status'];
        if(!in_array($filed,$arr)){
            return ResultR::hintResult('没有此项选择','');
        }
    }

    public function putProduct()
    {

    }

    public function deleteProduct()
    {

    }
}