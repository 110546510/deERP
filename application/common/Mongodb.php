<?php
/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 2019-04-15
 * Time: 22:23
 */

namespace app\common;

use think\mongo\Connection;

class Mongodb
{
    private $connection = null;

    public function __construct()
    {
        $this->connection = Connection::instance(Config::pull('mongodb'));
    }

    public function gets()
    {
        $this->connection->insert();
    }
}