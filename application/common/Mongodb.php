<?php
/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 2019-04-15
 * Time: 22:23
 */

namespace app\common;

use think\Db;
use think\facade\Config;

class Mongodb
{
    public function gets()
    {
        Db::connect(Config::pull('mongodb'));
    }
}