<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Link;

class IndexController extends CommonController
{
    public function index()
    {
        //推荐6篇
        $recommends = Article::where('recommend',1)->orderBy('created_at','desc')->take(6)->get();
        //首页文章5篇带分页
        $articles = Article::orderBy('created_at','desc')->paginate(5);
        //友情链接
        $links = Link::orderBy('order','asc')->get();

        return view('home.index',compact('recommends','articles','links'));
    }

    public function lists($id)
    {
        //点击量增加
        Category::where('id',$id)->increment('view');
        $ids = [];
        array_push($ids,(integer)$id);
        $categories = Category::where('pid',$id)->select('id')->get();
        foreach ($categories as $key=>$value){
            array_push($ids,$value->id);
        }
        $category = Category::find($id);
        $articles = Article::whereIn('cate_id',$ids)->orderBy('created_at','desc')->paginate(5);
        $sub_categories = Category::where('pid',$id)->get();
        return view('home.list',compact('category','articles','sub_categories'));
    }

    public function news($id)
    {
        $article = Article::leftJoin('categories','articles.cate_id','=','categories.id')->where('articles.id',$id)->select('articles.*','categories.name')->first();
        $data['pre'] = Article::where([['cate_id','=',$article->cate_id],['id','<',$id]])->orderBy('created_at','desc')->first();
        $data['next'] = Article::where([['cate_id','=',$article->cate_id],['id','>',$id]])->orderBy('created_at','asc')->first();

        $about_article = Article::where('cate_id','=',$article->cate_id)->take(6)->get();

        //点击量增加
        Article::where('id',$id)->increment('view');

        return view('home.news',compact('article','data','about_article'));
    }
}
