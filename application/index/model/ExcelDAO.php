<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2019/3/7
 * Time: 14:43
 */

namespace app\index\DAO;

use extend\Tool\Tool;
use phpDocumentor\Reflection\Types\Integer;
use think\Exception;

//import('PHPExcel',EXTEND_PATH.'/phpoffice/phpexcel/Classes','.php');

class ExcelDAO
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
        try{
        $objReader = \PHPExcel_IOFactory::createReader($this->FileType);
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
        $excel = new \PHPExcel();
        $excel->setActiveSheetIndex(0);
        for($i = 0; $i < count($data);$i++){
            for ($j = 0; $j < count($data[$i]);$j++) {
                $excel->getActiveSheet()->setCellValue((int)(65+$j).$i+$num,$data[$i][$j]);
            }
        }
        try{
            $wirte = \PHPExcel_IOFactory::createWriter($excel,$this->FileType);
            $wirte->save($this->dirname);
            return 1;
        }catch (Exception $exception){
         return 0;
        }
    }

}