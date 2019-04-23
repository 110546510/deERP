<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2019/4/22
 * Time: 14:08
 */

namespace app\index\controller;


use app\common\ResultR;
use think\Config;

class SysConfig
{
    public function yesFile($name){
        $config = \config();
        if(!in_array($name,$config)){
            return -1;
        }
        return $config['erpconfig'];
    }

    public function getsysInfo()
    {
        $res = $this->yesFile('erpconfig');
        return ($res != -1 )?ResultR::accessResult($res['SystemInfo']):ResultR::hintResult('配置文件不存在','');

    }
    public function getAll(){
        $res = $this->yesFile('erpconfig');
        return ($res != -1 )?ResultR::accessResult($res):ResultR::hintResult('配置文件不存在','');
    }


}