<?php

namespace App\Http\Controllers\Admin;

use App\Http\Librarys\UploadFile;
use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ArticleController extends CommonController
{
    public function index(Request $request)
    {
        $articles = Article::orderBy('id','desc')->paginate(10);
        $categorys = Category::orderBy('order')->get();
        $categories = $this->getTree($categorys);
        return view('admin.listAllArticle',compact('articles','categories'));
    }

    public function create()
    {
        $categorys = Category::orderBy('order')->get();
        $datas = $this->getTree($categorys);
        return view('admin.addArticle')->with('datas',$datas);
    }

    public function store(Request $request)
    {
        $request->flash();
        $this->validate($request,[
            'title'=>'required|min:6|max:100',
            'tag'=>'required',
            'description'=>'required|max:255',
            'content'=>'required'
        ],[
            'required'=>':attribute 为必须字段',
            'min'=>':attribute 最少不得小于6位',
            'max'=>':attribute 长度过长'
        ],[
            'title'=>'标题',
            'tag'=>'关键字',
            'description'=>'文章描述',
            'content'=>'文章内容',
            'cover'=>'文章封面'
        ]);
        $input = $request->except('_token');
        $input['editor'] = Auth::user()['name'];
        $result = Article::create($input);
        if ($result){
            return redirect('home/article');
        }else{
            return back()->with('errors','分类新增失败！');
        }
    }

    public function edit($id)
    {
        $categorys = Category::orderBy('order')->get();
        $datas = $this->getTree($categorys);
        $article = Article::find($id);
        return view('admin.editArticle')->with('data',$article)->with('datas',$datas);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'title'=>'required|min:6|max:100',
            'tag'=>'required',
            'description'=>'required|max:255',
            'content'=>'required'
        ],[
            'required'=>':attribute 为必须字段',
            'min'=>':attribute 最少不得小于6位',
            'max'=>':attribute 长度过长'
        ],[
            'title'=>'标题',
            'tag'=>'关键字',
            'description'=>'文章描述',
            'content'=>'文章内容',
            'cover'=>'文章封面'
        ]);
        $input = Input::except('_token','_method');
        $result = Article::where('id',$id)->update($input);
        if($result){
            return redirect('home/article')->with('info','文章修改成功！');
        }else{
            return back()->with('errors','文章修改失败！');
        }
    }

    public function destroy($id)
    {
        $result = Article::where('id',$id)->delete();
        if($result){
            $data = [
                'status'=>1,
                'msg'=>'文章删除成功!'
            ];
        }else{
            $data = [
                'status'=>0,
                'msg'=>'文章删除失败!'
            ];
        }
        return $result;
    }
    
    public function upload()
    {
        if (isset($_FILES['Filedata'])) {
            $path = UploadFile::multipleUpload('Filedata');
            $realpath = $path['Filedata']['filepath'];
        } elseif (isset($_FILES['fileList'])) {
            $path = UploadFile::multipleUpload('fileList');
            $realpath = $path['fileList']['filepath'];
        }
        return $realpath;
    }

    public function search(Request $request)
    {
        $cate_id = $request->input('cate_id');
        $keywords = $request->input('keywords');
        if(isset($cate_id)){
            if($cate_id == 0){
                $articles = Article::where('title','like','%'.$keywords.'%')->orderBy('created_at','desc')->paginate(10);
                $categorys = Category::orderBy('order')->get();
                $categories = $this->getTree($categorys);
                return view('admin.listAllArticle',compact('articles','categories','keywords','cate_id'));
            }
        }
        $articles = Article::where([
            ['title','like','%'.$keywords.'%'],
            ['cate_id','=',$cate_id]
        ])->orderBy('created_at','desc')->paginate(10);
        $categorys = Category::orderBy('order')->get();
        $categories = $this->getTree($categorys);
        return view('admin.listAllArticle',compact('articles','categories','keywords','cate_id'));
    }
}
