<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2019/3/18
 * Time: 11:01
 */

namespace app\index\DAO;

use app\index\model\Base;

class Client extends Base
{
    protected $name = "client";

    protected $hidden = ['status'];

    public function getclient($where = 1, $cloumn = 1)
    {
        return $this->where([$where => $cloumn])->select()->toArray();
    }

    public function newclient($data)
    {
        return $this->save($data);
    }

    public function setclient($id,$data)
    {
        return $this->where(['id'=>$id])->update($data);
    }

    public function delclient($id)
    {
        return $this->where(['id'=>$id])->update(['status'=>'1']);
    }
}