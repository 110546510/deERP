<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2019/3/7
 * Time: 14:43
 */

namespace app\common;

use PHPExcel_IOFactory;
use PHPExcel;

class Excel
{
    private $newexcel = '';

    private $Writer = '';

    private $Reader = '';

    private $dirname = '';

    private $FileType = '';

    public function __construct($dirname)
    {
        $this->FileType = \PHPExcel_IOFactory::identify($dirname);
        $this->dirname = $dirname;
    }

    public function reader($num = 1){
        $data = null;
        try{
        $objReader = PHPExcel_IOFactory::createReader($this->FileType);
        $excel = $objReader->load($this->dirname);
        $sheet = $excel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $rowData = '';
        $x = 0;
        for ($row = $num; $row <= $highestRow; $row++){
            $rowData[$x] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE)[0];
            $x++;
        }

        if($rowData == ''){
            return null;
        }

        return $rowData;
        } catch(\Exception $e) {
    //            die("加载文件发生错误：”".pathinfo($filename,PATHINFO_BASENAME)."”: ".$e->getMessage());
        return null;
        }
        return $data;
    }

    public function updateExcel($data,$num){
        $excel = new PHPExcel();
        try{
            $excel->setActiveSheetIndex(0);
            for($i = 0; $i < count($data);$i++){
                for ($j = 0; $j < count($data[$i]);$j++) {
                    $excel->getActiveSheet()->setCellValue((int)(65+$j).$i+$num,$data[$i][$j]);
                }
            }
        }catch (\PHPExcel_Exception $exception){
            return -1;
        }

        try{
            $wirte = PHPExcel_IOFactory::createWriter($excel,$this->FileType);
            $wirte->save($this->dirname);
            return 1;
        }catch (\PHPExcel_Exception $exception){
         return 0;
        }
    }

}