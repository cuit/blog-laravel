<?php
/**
 * Created by PhpStorm.
 * User: XSC
 * Date: 2017/4/9
 * Time: 10:43
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommonController extends Controller
{
    public function getTree($data,$tag = '└',$html='─── ',$pid = null,$level=0)
    {
        static $array = array();
        foreach ($data as $key=>$value){
            if($value->pid == $pid){
                $value['sort'] = $level;
                if($level != 0){
                    $value['displayname'] = $value['name'];
                    $value['name'] = $tag.str_repeat($html,$level).$value['name'];
                }
                $array[]= $value;
                $this->getTree($data,$tag,$html,$value['id'],$level+1);
            }
        }
        return $array;
    }
}