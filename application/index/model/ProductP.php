<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2019/3/18
 * Time: 10:31
 */

namespace app\index\DAO;


use app\index\model\Base;

class ProductP extends Base
{

    protected $name = "product_parent";

    protected $hidden = ['status'];

    public function getproduct_parent($where = 1, $cloumn = 1)
    {
        return $this->where([$where =>$cloumn])->select()->toArray();
    }

    public function newproduct_parent($data)
    {
        return $this->save($data);
    }

    public function setproduct_parent($id,$data)
    {
        return $this->where(['id'=>$id])->update($data);
    }

    public function delproduct_parent($id)
    {
        return $this->where(['id'=>$id])->update(['status'=>'1']);
    }

    public function product()
    {
        $this->hasOne('product','id','id');
    }

    public function getProductInfo()
    {
        $list = $this->with('product')->where(['status'=> 0])->find();
        return $list ? $list->toArray():0;
    }
}