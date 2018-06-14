<?php
/**
 * Created by PhpStorm.
 * User: XSC
 * Date: 2017/4/20
 * Time: 19:40
 */

namespace App\Http\Controllers\Admin;


use App\Http\Model\User;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class UserController extends CommonController
{
    public function index()
    {
        return view('admin.user');
    }

    public function password()
    {
        $data = Input::all();
        if(!Auth::attempt(['password'=>$data['password_o']])){
            $msg = [
                'success' => false,
                'message'=>['password'=>['原密码有误!']]
            ];
            return response()->json($msg);
        }
        $rules = [
            'password'=>'required|min:6|max:20|confirmed'
        ];
        $message = [
            'password.required'=>'密码必须填写!',
            'password.min'=>'密码最少6位!',
            'password.max'=>'密码最多20位!',
            'password.confirmed'=>'密码确认有误!',
        ];
        $validator = Validator::make($data, $rules, $message);
        if($validator->passes()){
            $password = bcrypt($data['password']);
            $num = User::where('name',Auth::user()['name'])->update(['password'=>$password]);
            if($num){
                session('user')['password'] = $password;
                $msg = [
                    'success' => true,
                    'message'=>['password'=>['密码重置成功!']]
                ];
                return response()->json($msg);
            }
        }else{
            $errors = $validator->errors();
            $errors =  json_decode($errors);
            return response()->json([
                'success' => false,
                'message' => $errors,
            ]);
        }
    }

    public function info()
    {
        $data = Input::all();
        $rule = [
            'telphone'=>'numeric',
            'address'=>'max:100',
            'avater'=>'required'
        ];
        $msg = [
            'numeric'=>':attribute 必须是数字',
            'max'=>':attribute 长度不得超过100位',
            'required'=>':attribute 是必须上传的'
        ];
        $property = [
            'telphone'=>'联系电话',
            'address'=>'联系地址',
            'avater'=>'个人头像'
        ];
        $validate = Validator::make($data,$rule,$msg,$property);
        $data = Input::except('_token');
        if($validate->passes()){
            //存入数据库
            $result = User::where('id',Auth::id())->update($data);
            if($result){
                return response()->json([
                    'success'=>true,
                    'message'=>'个人信息新增成功!'
                ]);
            }
        }else{
            $errors = $validate->errors()->all();
            return response()->json([
                'success'=>false,
                'message'=>$errors
            ]);
        }
    }
}