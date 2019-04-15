<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2019/4/15
 * Time: 11:16
 */

namespace app\model;

use think\Model;

class ProductM extends Model
{
    protected $name = 'product';

    protected $hidden = [];
    
    public function OrganizationM(){
        return $this->hasOne("OrganizationM",'id','belong');
    }
}