@extends('layouts.home')

@section('title')
  <title>{{Config::get('web.web_name')}}</title>
  <meta name="keywords" content="{{Config::get('web.keywords')}}" />
  <meta name="description" content="{{Config::get('web.description')}}" />
@stop

@section('content')
<div class="banner">
  <section class="box">
    <ul class="texts">
      <p>打了死结的青春，捆死一颗苍白绝望的灵魂。</p>
      <p>为自己掘一个坟墓来葬心，红尘一梦，不再追寻。</p>
      <p>加了锁的青春，不会再因谁而推开心门。</p>
    </ul>
    <div class="avatar"><a href="{{url('/home')}}"><img src="@if(Auth::check()) {{url(Auth::user()->avater)}}  @else {{url('static/style/images/photos.jpg')}} @endif" style="width: 100%;height: auto"><span> @if(Auth::check()) {{Auth::user()->name}} @else 请登录 @endif</span></a> </div>
  </section>
</div>
<div class="template">
  <div class="box">
    <h3>
      <p><span>站长推荐</span>Recommend</p>
    </h3>
    <ul>
      @foreach($recommends as $value)
      <li><a href="{{url('article/'.$value->id)}}"  target="_blank"><img src="@if($value->cover != null){{url($value->cover)}}@else{{url(Config::get('web.default_image'))}}@endif"></a><span>{{$value->title}}</span></li>
      @endforeach
    </ul>
  </div>
</div>
<article>
  <h2 class="title_tj">
    <p>文章<span>推荐</span></p>
  </h2>
  <div class="bloglist left">
    @foreach($articles as $value)
    <h3>{{$value->title}}</h3>
    <figure><img src="@if($value->cover != null){{url($value->cover)}}@else{{url(Config::get('web.default_image'))}}@endif"></figure>
    <ul>
      <p>{{$value->description}}</p>
      <a title="{{$value->title}}" href="{{url('article/'.$value->id)}}" target="_blank" class="readmore">阅读全文>></a>
    </ul>
    <p class="dateview"><span>{{$value->created_at}}</span><span>作者：后盾</span><span>个人博客：[<a href="/news/life/">程序人生</a>]</span></p>
    @endforeach
      <div class="page">
        <ul class="pagination">
          {{$articles->links()}}
        </ul>
      </div>
  </div>
  <aside class="right">
    <div class="weather"><iframe width="250" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=1"></iframe></div>
    <div class="news">
        @parent
    <h3 class="links">
      <p>友情<span>链接</span></p>
    </h3>
    <ul class="website">
      @foreach($links as $value)
      <li><a href="{{$value->url}}">{{$value->name}}</a></li>
      @endforeach
    </ul> 
    </div>  
    <!-- Baidu Button BEGIN -->
    <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script> 
    <script type="text/javascript" id="bdshell_js"></script> 
    <script type="text/javascript">
        document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
    </script>
    <!-- Baidu Button END -->   
    </aside>
</article>
@stop
