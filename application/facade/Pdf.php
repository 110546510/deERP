<?php
/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 2019-04-08
 * Time: 23:16
 */

namespace app\facade;


use think\Facade;

class Pdf extends Facade
{
    protected static function getFacadeClass()
    {
        return 'app\common\Pdf';
    }
}