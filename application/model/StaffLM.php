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

    public function StaffInfoM()
    {
        return $this->hasOne('StaffInfoM','telephone','username');
    }

    public function OrganizationM(){
        return $this->hasOne('OrganizationM','id','belong');
    }
}