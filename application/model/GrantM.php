<?php
/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 2019-04-14
 * Time: 22:28
 */

namespace app\model;

use think\Model;

class GrantM extends Model
{
    protected $name = 'grant';

    protected $hidden = [];
    
    public function OrganizationM(){
        return $this->hasOne("OrganizationM",'id','id');
    }
    
    public function RoleM(){
        return $this->hasOne("RoleM",'role_id','role_id');
    }
}