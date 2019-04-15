<?php
/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 2019-04-14
 * Time: 22:30
 */

namespace app\model;

use think\Model;

class ProductInventroyM extends Model
{
    protected $name = 'ProductInventroyM';

    protected $hidden = [];

    public function WarehouseM(){
        return $this->hasOne("WarehouseM",'id','w_id');
    }

    public function prouduct(){
        return $this->hasOne("prouduct",'id','p_id');
    }
}