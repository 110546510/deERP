<?php
/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 2019-04-14
 * Time: 22:09
 */

namespace app\model;


use think\Model;

class ClientSupplierM extends Model
{
    protected $name = 'client_supplier';

    protected $hidden = [];

    public function OrganizationM(){
        return $this->hasOne("OrganizationM",'belong','belong');
    }
}