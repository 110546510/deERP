<?php
/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 2019-04-14
 * Time: 22:32
 */

namespace app\model;

use think\Model;

class RoleM extends Model
{
    protected $name = 'role';

    protected $hidden = [];

    public function ModelM(){
        return $this->hasOne("ModelM",'id','m_id');
    }
}