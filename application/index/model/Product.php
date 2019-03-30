<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2019/3/18
 * Time: 8:49
 */

namespace app\index\DAO;
use app\index\model\Base;

class Product extends Base
{
    protected $name = "product";

     protected $hidden = ['status'];

     public function getproduct($where = 1,$cloumn = 1)
     {
         return $this->where([$where=>$cloumn])->select()->toArray();
     }

     public function newproduct($data)
     {
         return $this->save($data);
     }

     public function setproduct($id,$data)
     {
         return $this->where(['id'=>$id])->update($data);
     }

     public function delproduct($id,$status)
     {
         return $this->where(['id'=>$id])->update(['status'=>$status]);
     }


}