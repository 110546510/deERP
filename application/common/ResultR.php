<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2019/4/15
 * Time: 10:20
 */

namespace app\common;

class ResultR
{
    private $result = null;

    public function result($code,$result,$message,$data)
    {
        $this->result['code'] = $code;
        $this->result['result']= $result;
        $this->result['message']= $message;
        $this->result['data']= $data;
    }

    public function accessResult($data)
    {
        return $this->result('2000','access','ok',$data);
    }

    public function errorResult($message,$data)
    {
        return $this->result('4004','error',$message,$data);
    }
}