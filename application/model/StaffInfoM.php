<?php
/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 2019-04-11
 * Time: 21:36
 */

namespace app\model;


use think\Model;

class StaffInfoM extends Model
{
    protected $name = 'staff_information';

    public function getHeaderAttr($value){
        return config('erpconfig.sample.header').$value;
    }
}