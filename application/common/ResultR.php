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
    private static $result = null;

    public static function result($code,$result,$message,$data)
    {
        self::$result['code'] = $code;
        self::$result['result']= $result;
        self::$result['message']= $message;
        self::$result['data']= $data;
        return self::$result;
    }

    public static function accessResult($data)
    {
        return self::result('2000','access','ok',$data);
    }

    public static function errorResult($message,$data)
    {
        return self::result('4004','error',$message,$data);
    }
}