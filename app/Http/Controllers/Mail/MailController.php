<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Home\CommonController;
use Illuminate\Support\Facades\Mail;

class MailController extends CommonController
{
    public function mail()
    {
        //发送纯文本
        /*Mail::raw('邮件内容content 测试',function ($message){
            $message->from('1635585052@qq.com','竹影随心');
            $message->subject('邮件主题 测试');
            $message->to('157098484@qq.com');
        });*/

        //发送带http模板
        // send() 第一个参数为模板地址，第二个参数为模板注入内容
        Mail::send('mail', ['msg'=>'这是模板内容哦'], function ($message){
            $message->to('157098484@qq.com');
        });
    }
}