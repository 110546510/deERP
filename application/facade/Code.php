<?php
namespace app\facade;

use think\Facade;

class Code extends Facade
{
    protected static function getFacadeClass()
    {
        return 'app\common\Code';
    }
}