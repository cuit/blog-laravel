<?php
/**
 * Created by PhpStorm.
 * User: XSC
 * Date: 2017/4/9
 * Time: 11:31
 */

namespace App\Http\Librarys;

class VildateCode
{
    private $charset = "abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789";
    private $codeLen = 4;
    private $width = 130;
    private $height = 50;
    private $fontSize = 26;
    private $code;
    private $img;
    private $fontColor;
    private $font;

    //生成随机码
    private function makeCode(){
        for ($i=0;$i<$this->codeLen;$i++){
            $len = strlen($this->charset)-1;
            $this->code .=$this->charset[mt_rand(0,$len)];
        }
        //$_SESSION['code'] = strtolower($this->code);
        return $this->code;
    }

    //生成背景
    private function createBg(){
        //创建图像
        $this->img = imagecreatetruecolor($this->width,$this->height);
        //生成颜色
        $color = imagecolorallocate($this->img,mt_rand(157, 255),mt_rand(157, 255),mt_rand(157, 255));
        //画一矩形并填充
        imagefilledrectangle($this->img,0, $this->height, $this->width, 0,$color);
    }

    //在画布上写上文字
    private function createFont(){
        $x=($this->width-1)/$this->codeLen;
        $this->font = "static/style/font/Elephant.ttf";
        for($i=0;$i<$this->codeLen;$i++){
            $this->fontColor=imagecolorallocate($this->img, mt_rand(0, 120), mt_rand(0, 120), mt_rand(0, 120));
            imagettftext($this->img, $this->fontSize, mt_rand(-30, 30), $x*$i+mt_rand(3, 5), $this->height/1.3, $this->fontColor, $this->font, $this->code[$i]);
        }
    }

    //生成干扰雪花
    private function createLine(){
        for ($i=0;$i<100;$i++){
            $color = imagecolorallocate($this->img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
            imagestring($this->img,mt_rand(1,5),mt_rand(0,$this->width),mt_rand(0,$this->height),"*",$color);
        }
    }

    //输出图形
    private function outPut(){
        header("Content-type:image/png");
        imagepng($this->img);
        imagedestroy($this->img);
    }

    //对外生成
    public function createCode(){
        $this->createBg();
        $this->createLine();
        $this->makeCode();
        $this->createFont();
        $this->outPut();
    }

    //获取验证码
    public function getCode(){
        return strtolower($this->code);
        //return $_SESSION['code'];
    }
}