<?php
/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 2019-03-09
 * Time: 21:03
 */
namespace app\common;

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
        return strtoupper(substr(Pinyin::getPinyin()->output($string),0,$num));
    }

    public static function TimeT($hourC,$minC){
        if($hourC > 0){
            return 1;
        }
        if($hourC == 0){
            return ($minC < 0)?0:1;
        }
        return 0;
    }

    public static function TimeE($hourC,$minC)
    {
        if($hourC < 0){
            return 1;
        }
        if($hourC == 0){
            return ($minC >= 0)?0:1;
        }
        return 0;
    }

    public static function workTime($date,$explod,$status)
    {
        $timeY = explode($explod,$date);
        $hourC = $timeY[0]-date("h");
        $minC = $timeY[1]-date("i");
        return ($status == 0)?self::TimeT($hourC,$minC):self::TimeE($hourC,$minC);
    }
}