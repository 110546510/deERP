<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2019/4/15
 * Time: 10:21
 */

namespace app\facade;

use think\Facade;

class ResultR extends Facade
{
    protected static function getFacadeClass()
    {
        return 'app\common\ResultR';
    }
}