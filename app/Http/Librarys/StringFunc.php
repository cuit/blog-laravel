<?php
/**
 * Created by PhpStorm.
 * User: XSC
 * Date: 2017/4/12
 * Time: 20:12
 */

namespace App\Http\Librarys;

class StringFunc
{
    public static function getUniqName(){
        $date = date("YmdHis",time());
        $micro = @end(explode(".", microtime(true)));
        return $date.$micro;
    }

    public static function getExtName($filename){
        return @strtolower(end(explode(".", $filename)));
    }

}