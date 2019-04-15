<?php
/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 2019-03-09
 * Time: 21:03
 */
namespace extend\Tool;

class Tool
{
    /**
     * 获取毫秒值
     * @return float
     */
    public static function getSecond()
    {
        list($msec, $sec) = explode(' ', microtime());
        return (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
    }

    /**
     * 中文转拼音
     * @param $string 中文
     * @param $num 截取长度
     * @return string 返回长度为$num的大写字符串
     */
    public static function pinYinB($string,$num)
    {
        $p = new Pinyin();
        return strtoupper(substr($p->output($string),0,$num));
    }

    public static function accessResponse()
    {
        
    }

    public static function errorResponse()
    {
        
    }
}