<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends CommonController
{
    public function index()
    {
        return view('admin.mail');
    }

    public function send(Request $request)
    {
        $data = $request->all();
        // laravel的闭包函数可以使用 use 来使用外部变量
        $result = Mail::send('mail',['msg'=>$data['email_content']],function ($message) use ($data){
            $message->to($data['email_to']);
            $message->subject($data['email_subject']);
        });
        dd($result);
        if($result){
            $data = [
                'status'=>1,
                'msg' =>'邮件发送成功!'
            ];
        }else{
            $data = [
                'status'=>0,
                'msg' =>'邮件发送失败!'
            ];
        }
        return $data;
    }
}
