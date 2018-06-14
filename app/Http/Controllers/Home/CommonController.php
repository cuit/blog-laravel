<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Nav;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    public function __construct()
    {
        //最新发布的8篇
        $news = Article::orderBy('created_at','desc')->take(8)->get();
        //点击量最高的5篇
        $hots = Article::orderBy('view','desc')->take(5)->get();
        $navs = Nav::all();
        $category = Category::all();
        $Common = new \App\Http\Controllers\Admin\CommonController();
        $category = $Common->getTree($category);
        View::share('categories',$category);
        View::share('navs',$navs);
        View::share('news',$news);
        View::share('hots',$hots);
    }
}
