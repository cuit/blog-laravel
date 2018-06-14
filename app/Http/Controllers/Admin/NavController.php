<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Nav;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NavController extends CommonController
{
    public function index()
    {
        $datas =Nav::orderBy('order','asc')->paginate(10);
        return view('admin.listAllNav',compact('datas'));
    }

    public function changeOrder(Request $request)
    {
        $in = $request->all();
        $Nav = Nav::find($in['navId']);
        if($Nav){
            $Nav->order = $in['order'];
            $result = $Nav->update();
            if($result){
                $data = [
                    'status'=>1,
                    'msg' =>'自定义导航排序修改成功!'
                ];
            }else{
                $data = [
                    'status'=>0,
                    'msg' =>'分自定义导航排序修改失败!'
                ];
            }
            return $data;
        }
    }

    public function create()
    {
        return view('admin.addNav');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|min:2|max:10',
            'alias'=>'required',
            'url'=>'required'
        ],[
            'required'=>':attribute 是必须填写的',
            'min'=>':attribute 不得小于2位',
            'max'=>':attribute 不得大于6位'
        ],[
            'name'=>'导航栏标题',
            'alias'=>'别名',
            'url'=>'链接地址'
        ]);
        $input = $request->except('_token');
        $result = Nav::create($input);
        if($result){
            return redirect('home/nav')->with('info','自定义导航添加成功!');
        }else{
            return back()->with('errors','自定义导航添加失败！');
        }
    }

    public function edit($id)
    {
        $data = Nav::find($id);
        return view('admin.editNav')->with('data',$data);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name'=>'required|min:2|max:10',
            'alias'=>'required',
            'url'=>'required'
        ],[
            'required'=>':attribute 是必须填写的',
            'min'=>':attribute 不得小于2位',
            'max'=>':attribute 不得大于6位'
        ],[
            'name'=>'自定义导航名称',
            'alias'=>'别名',
            'url'=>'链接地址'
        ]);
        $input = $request->except('_token','_method');
        $result = Nav::where('id',$id)->update($input);
        if($result){
            return redirect('home/nav')->with('info','自定义导航修改成功!');
        }else{
            return back()->with('errors','自定义导航修改失败!');
        }
    }

    public function destroy($id)
    {
        $result = Nav::where('id',$id)->delete();
        if($result){
            $data =[
                'status'=>1,
                'msg'=>'自定义导航删除成功!'
            ];
        }else{
            $data = [
                'status'=>0,
                'msg'=>'自定义导航删除失败!'
            ];
        }
        return $data;
    }
}
