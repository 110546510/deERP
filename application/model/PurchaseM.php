<?php
/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 2019-04-14
 * Time: 22:31
 */

namespace app\model;

use think\Model;

class PurchaseM extends Model
{
    protected $name = 'purchase';

    protected $hidden = [];
    
    public function ClientSupplierM(){
        return $this->hasOne("ClientSupplierM",'id','client_id');
    }

    public function getStatusAttr($value)
    {
        $res = ['已完成','已付款','已作废'];
        return $res[$value];
    }

    public function getPaymentAttr($value)
    {
        $res = ['现付'];
        return $res[$value];
    }
}