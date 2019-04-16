<?php
/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 2019-04-10
 * Time: 22:00
 */

namespace app\model;

use think\Model;

class StaffLM extends Model
{
    protected $name = 'staff_login';

    protected $hidden = ['password'];

    public function StaffInfoM()
    {
        return $this->hasOne('StaffInfoM','telephone','username');
    }

    public function OrganizationM(){
        return $this->hasOne('OrganizationM','id','belong');
    }

    public function getStatusAttr($value)
    {
        $res = ['实习期','在职','离职'];
        return $res[$value];
    }
}