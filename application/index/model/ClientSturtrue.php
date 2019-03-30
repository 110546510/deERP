<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2019/3/18
 * Time: 11:13
 */

namespace app\index\DAO;

use app\index\model\Base;

class ClientSturtrue extends Base
{
    protected $name = 'client_sturtrue';

    protected $hidden = ['status'];

    public function getclient_sturtrue($where = 1, $cloumn = 1)
    {
        return $this->where([$where => $cloumn])->select()->toArray();
    }

    public function newclient_sturtrue($data)
    {
        return $this->save($data);
    }

    public function setclient_sturtrue($id, $data)
    {
        return $this->where(['id' => $id])->update($data);
    }

    public function delclient_sturtrue($id)
    {
        return $this->where(['id' => $id])->update(['status' => '1']);
    }
}