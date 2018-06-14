<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Link;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LinkController extends CommonController
{
    public function index()
    {
        $datas = Link::orderBy('order','asc')->paginate(10);
        return view('admin.listAllLink',compact('datas'));
    }

    public function changeOrder(Request $request)
    {
        $in = $request->all();
        $link = Link::find($in['linkId']);
        if($link){
            $link->order = $in['order'];
            $result = $link->update();
            if($result){
                $data = [
                    'status'=>1,
                    'msg' =>'友情链接排序修改成功!'
                ];
            }else{
                $data = [
                    'status'=>0,
                    'msg' =>'分友情链接排序修改失败!'
                ];
            }
            return $data;
        }
    }

    public function create()
    {
        return view('admin.addLink');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|min:2|max:10',
            'description'=>'required',
            'url'=>'required'
        ],[
            'required'=>':attribute 是必须填写的',
            'min'=>':attribute 不得小于2位',
            'max'=>':attribute 不得大于6位'
        ],[
            'name'=>'链接标题',
            'description'=>'描述',
            'url'=>'链接地址'
        ]);
        $input = $request->except('_token');
        $result = Link::create($input);
        if($result){
            return redirect('admin/link')->with('info','友情链接添加成功!');
        }else{
            return back()->with('errors','友情链接添加失败！');
        }
    }

    public function edit($id)
    {
        $data = Link::find($id);
        return view('admin.editLink')->with('data',$data);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name'=>'required|min:2|max:10',
            'description'=>'required',
            'url'=>'required'
        ],[
            'required'=>':attribute 是必须填写的',
            'min'=>':attribute 不得小于2位',
            'max'=>':attribute 不得大于6位'
        ],[
            'name'=>'链接标题',
            'description'=>'描述',
            'url'=>'链接地址'
        ]);
        $input = $request->except('_token','_method');
        $result = Link::where('id',$id)->update($input);
        if($result){
            return redirect('admin/link')->with('info','友情链接修改成功!');
        }else{
            return back()->with('errors','友情链接修改失败!');
        }
    }

    public function destroy($id)
    {
        $result = Link::where('id',$id)->delete();
        if($result){
            $data =[
                'status'=>1,
                'msg'=>'友情链接删除成功!'
            ];
        }else{
            $data = [
                'status'=>0,
                'msg'=>'友情链接删除失败!'
            ];
        }
        return $data;
    }
}
