<?php

namespace App\Http\Controllers\Admin;

use App\Http\Librarys\VildateCode;
use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class LoginController extends CommonController
{
    public function login(Request $request){
        if($request->isMethod('POST')){
            //把输入的数值存入一次性session中
            $request->flash();
            $code = session('code');
            $data = $request->input();
            if(strtolower($data['code']) != $code){
                return back()->with('msg','验证码错误!');
            }
            $user = User::where('username',$data['username'])->first();
            if($user){
                if($data['password'] == decrypt($user['password'])){
                    session(['user'=>$user]);
                    return redirect('admin/index');
                }else{
                    return back()->with('msg','密码输入错误!');
                }
            }else{
                return back()->with('msg','用户名输入错误!');
            }
        }
        return view('admin.login');
    }

    public function code(){
        $code = new VildateCode;
        $code->createCode();
        $codefont = $code->getCode();
        session(['code'=>$codefont]);
    }

    public function test(){
        $code = new VildateCode();
        $code = $code->getCode();
    }
}
