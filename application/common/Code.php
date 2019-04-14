<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2019/3/7
 * Time: 15:32
 */

namespace app\common;
use Endroid\QrCode\Response\QrCodeResponse;
use think\Exception;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\ErrorCorrectionLevel;

class Code
{
    protected $location = RESOURCES.'/code/';

    protected $newFile = false;

    public function QrcodeD()
    {
        $qrCode = new QrCode('http://baidu.com');
        header('Content-Type: '.$qrCode->getContentType());
        $qrCode->writeString();
//        $qrCode->writeFile($this->location.'/qrcode.png');
        $repson = new QrCodeResponse($qrCode);
        unset($qrCode);
        return $repson;
//        return $this->location.'/qrcode.png';
    }

    public function Qrcodes($set_log =null,$txt){
        $qrCode = new QrCode($txt);
        if($set_log != null){
            $qrCode->setLogoPath($this->location+$set_log);
            $qrCode->setLogoWidth(130);
        }
//            $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH);
            $name = rand(1,99999999).time();
            $path =$this->location.$name.'.png';
            $qrCode->writeFile($path);

//        header('Content-Type: '.$qrCode->getContentType());
        return $this->location.$name.'.png';;
    }

    /**
     * 判断条形码格式
     * @param $code 内容
     * @return bool|string
     */
    public function IsFormat($code){
        try{
            if (!is_numeric($code)) throw new Exception('不是数字');
            if (strlen($code) < 12 || strlen($code) > 13) throw new Exception('条码长度不正确');
            if (strlen($code) == 12) {
                // 计算校验位
                $lsum = 0;
                $rsum = 0;
                for($i=1; $i<=strlen($code); $i++) {
                    if($i % 2) {
                        $lsum += (int)$code[$i-1];
                    }else{
                        $rsum += (int)$code[$i-1];
                    }
                }
                $tsum = $lsum + $rsum * 3;
                $chkdig = 10 - ($tsum % 10);
                if ($chkdig == 10) $chkdig = 0;
                $code .= $chkdig;
            }
            return true;
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * 条形码编码
     * @param $code 编号
     * @return string 条形码数值
     */
    public function EAN13($code)
    {
        // 定义起始付
        $start = '101';
        // 定义中止符
        $end = '101';
        // 定义中间分隔符
        $center = '01010';
        // 定义左资料码
        $Guide = array(0=>'AAAAAA','AABABB','AABBAB','AABBBA','ABAABB','ABBAAB','ABBBAA','ABABAB','ABABBA','ABBABA');
        // 定义左侧码，分为“A”、“B”两种
        $Lencode = array("A" => array('0001101','0011001','0010011','0111101','0100011','0110001','0101111','0111011','0110111','0001011'),
            "B" => array('0100111','0110011','0011011','0100001','0011101','0111001','0000101','0010001','0001001','0010111'));
        // 定义右侧码，统一为“C”编码
        $Rencode = array('1110010','1100110','1101100','1000010','1011100','1001110','1010000','1000100','1001000','1110100');
        // 编码起始符
        $barcode = $start;
        // 编码左资料位
        for($i=1; $i<=6; $i++) {
            $barcode .= $Lencode[$Guide[$code[0]][($i-1)]][$code[$i]];
        }
        // 编码中间分隔符
        $barcode .= $center;
        // 编码右资料位
        for($i=7; $i<13; $i++) {
            $barcode .= $Rencode[$code[($i)]];
        }
        // 编码中止符
        $barcode .= $end;
        return $barcode;
    }

    /**
     * 一维码生成
     * @param $code 输入码
     * @param $address 存放地址
     * @return bool|int 返回错误或条形码生成失败
     */
    public function OneCode($code,$address)
    {
        if($c = $this->IsFormat($code)!= true){
            return $c;
        }
        if ($code != "") {
            // 定义每个条码单元的宽度和高度，单位是像素
            $width = 2;
            $height = 40;
            // 定义起始符、中止符、中间分隔符的高度增量
            $increment = 10;
            // 创建方形（×95是因为整个条码共95个单元，+60和+30是给条码图片周围留空白边框）
            $img = ImageCreate($width*95+60,$height+30);  // 目前这个方形是透明的
            // “1”的颜色（黑）与“0”的颜色（白）
            $fg = ImageColorAllocate($img, 0, 0, 0);
            $bg = ImageColorAllocate($img, 255, 255, 255);
            // 以“0”的颜色（白色），填充整个方形
            ImageFilledRectangle($img, 0, 0, $width*95+60, $height+30, $bg);
            // 循环编码后的每一个单元，输出条码图形
            $barcode = $this->EAN13($code);
            for ($x=0; $x<strlen($barcode); $x++) {
                // ($x<4) 为起始符，($x>=92)为中止符，($x>=45 && $x<50)为中间分隔符
                // 这3个需要将高度增加
                if (($x<4) || ($x>=45 && $x<50) || ($x>=92)) {
                    $increment = 10;
                } else {
                    $increment = 0;
                }
                // 当编码值为“1”时，输出黑色；当编码值为“0”时，输出白色
                if ($barcode[$x] == '1') {
                    $color = $fg;
                } else {
                    $color = $bg;
                }
                ImageFilledRectangle($img, ($x*$width)+30,5,($x+1)*$width+29,$height+$increment,$color);
            }

            ImageString($img, 5, 20, $height+5, $code[0], $fg);
            for ($x=0; $x<6; $x++) {
                // 左侧识别码
                ImageString($img, 5, $width*(8+$x*6)+30, $height+5, $code[$x+1], $fg);
                // 右侧识别码
                ImageString($img, 5, $width*(53+$x*6)+30, $height+5, $code[$x+7], $fg);
            }
            header("Content-Type: image/jpeg");
            ImageJPEG($img, $address, 100);
            return file_exists($address);
        }
    }
}