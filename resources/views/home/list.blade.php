@extends('layouts.home')

@section('title')
    <title>{{$category->name}}--{{Config::get('web.web_name')}}</title>
    <meta name="keywords" content="{{$category->keywords}}" />
    <meta name="description" content="{{$category->description}}" />
@endsection
@section('content')
    <article class="blogs">
        <h1 class="t_nav"><span>{{$category->description}}</span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('list/'.$category->id)}}" class="n2">{{$category->name}}</a></h1>
        <div class="newblog left">
            @foreach($articles as $value)
            <h2>{{$value->title}}</h2>
            <p class="dateview"><span>发布时间：{{$value->created_at}}</span><span>作者：{{$value->editor}}</span><span>分类：[<a href="{{url('list/'.$category->id)}}">{{$category->name}}</a>]</span></p>
            <figure><img src="@if($value->cover != null){{url($value->cover)}}@else{{url(Config::get('web.default_image'))}}@endif"></figure>
            <ul class="nlist">
                <p>{{$value->description}}</p>
                <a title="{{$value->title}}" href="{{url('article/'.$value->id)}}" target="_blank" class="readmore">阅读全文>></a>
            </ul>
            <div class="line"></div>
            @endforeach

            <div class="blank"></div>
            <div class="page">
                <ul class="pagination">
                    {{$articles->links()}}
                </ul>
            </div>
        </div>
        <aside class="right">
            @if($sub_categories->all())
            <div class="rnav">
                <ul>
                    @foreach($sub_categories as $key=>$value)
                    <li class="rnav{{$key+1}}"><a href="{{url('list/'.$value->id)}}" >{{$value->name}}</a></li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="news">
                @parent
            </div>
            <div class="visitors">
                <h3><p>最近访客</p></h3>
                <ul>

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