<?php
/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 2019-04-14
 * Time: 22:34
 */

namespace app\model;

use think\Model;

class WarehouseM extends Model
{
    protected $name = 'warehouse';

    protected $hidden = [];

    public function getStatusAttr($value)
    {
        $res = ['存在','移除'];
        return $res[$value];
    }
}