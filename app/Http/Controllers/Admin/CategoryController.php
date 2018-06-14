<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends CommonController
{
    //查询 显示全部信息
    public function index()
    {
        $categorys = Category::orderBy('order')->get();
        $data = $this->getTree($categorys);
        //dd($data);
        return view('admin.listAllCategory')->with('categorys',$data);
    }

    public function changeOrder(Request $request)
    {
        $in = $request->all();
        $cate = Category::find($in['cateId']);
        if($cate){
            $cate->order = $in['order'];
            $result = $cate->update();
            if($result){
                $data = [
                    'status'=>1,
                    'msg' =>'分类排序修改成功!'
                ];
            }else{
                $data = [
                    'status'=>0,
                    'msg' =>'分类排序修改失败!'
                ];
            }
            return $data;
        }
    }

    //新增分类
    public function create()
    {
        $categorys = Category::orderBy('order')->get();
        $datas = $this->getTree($categorys,'─');
        return view('admin.addCategory')->with('datas',$datas);
    }

    //新增保存
    public function store(Request $request)
    {
        $request->flash();
        $this->validate($request,[
            'name'=>'required|min:2|max:50',
            'title'=>'required|max:255',
            'keywords'=>'required|max:255',
            'description'=>'required',
            'order'=>'required|numeric',
            'pid'=>'numeric'
        ],[
            'required'=>':attribute 为必须填写的！',
            'min'=>':attribute 最少2位',
            'max'=>':attribute 最多50位',
            'numeric'=>':attribute 必须为数值',
        ],[
            'name'=>'分类名',
            'title'=>'分类描述',
            'keywords'=>'分类关键字',
            'description'=>'详细内容描述',
            'order'=>'排序',
            'pid'=>'父级类别'
        ]);
        $input = $request->except('_token');
        $result = Category::create($input);
        if($result){
            return redirect('home/category');
        }else{
            return back()->with('errors','分类新增失败！');
        }
    }

    //修改分类
    public function edit($cateId)
    {
        $category = Category::find($cateId);
        if($category){
            $categorys = Category::orderBy('order')->get();
            $datas = $this->getTree($categorys,'-');
            return view('admin.editCategory')->with(['data'=>$category,'datas'=>$datas]);
        }else{
            return back();
        }
    }
    
    //把修改分类保存到数据库
    public function update(Request $request,$id)
    {
         $input = $request->except(['_token','_method']);
         $result = Category::where('id',$id)->update($input);
         if($result){
             return redirect('home/category')->with('flag',true);
         }else{
             return back()->with('errors',"数据修改失败!");
         }
    }

    public function destroy($id)
    {
        $childCate = Category::where('pid',$id)->count();
        if($childCate > 0){
            $data = [
                'status'=>2,
                'msg'=>'该分类下还有子分类，请先删除该分类下的子类!'
            ];
        }else{
            $result = Category::where('id',$id)->delete();
            if ($result){
                $data = [
                    'status'=>1,
                    'msg'=>'分类删除成功!'
                ];
            }else{
                $data = [
                    'status'=>0,
                    'msg'=>'分类删除失败!'
                ];
            }
        }
        return $data;
    }
}
