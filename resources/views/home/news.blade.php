@extends('layouts.home')

@section('title')
    <title>{{$article->title}}--{{Config::get('web.web_name')}}</title>
    <meta name="keywords" content="{{$article->tag}}" />
    <meta name="description" content="{{$article->description}}" />
@endsection

@section('content')
    <article class="blogs">
        <h1 class="t_nav">
            <span>您当前的位置：<a href="{{url('list/'.$article->cate_id)}}" style="color: black;float: right;width: 50px">{{$article->name}}</a><a href="{{url('/')}}" style="color: black;float: right;width: 50px">首页</a>&nbsp;&nbsp;</span>
            <a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('list/'.$article->cate_id)}}" class="n2">{{$article->name}}</a></h1>
        <div class="index_about">
            <h2 class="c_titile">{{$article->title}}</h2>
            <p class="box_c"><span class="d_time">发布时间：{{$article->created_at}}</span><span>编辑：{{$article->editor}}</span><span>查看次数：{{$article->view}}</span></p>
            <ul class="infos">
                {!! $article->content !!}
            </ul>
            <div class="keybq">
                <p><span>关键字词</span>：{{$article->tag}}</p>

            </div>
            <div class="ad"> </div>
            <div class="nextinfo">
                @if($data['pre'] != null)
                    <p>上一篇：<a href="{{url('article/'.$data['pre']->id)}}">{{$data['pre']->title}}</a></p>
                @endif
                @if($data['next'] != null)
                    <p>下一篇：<a href="{{url('article/'.$data['next']->id)}}">{{$data['next']->title}}</a></p>
                @endif
            </div>
            <div class="otherlink">
                <h2>相关文章</h2>
                <ul>
                    @foreach($about_article as $value)
                    <li><a href="{{url('article/'.$value->id)}}" title="{{$value->title}}">{{$value->title}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <aside class="right">
            <!-- Baidu Button BEGIN -->
            <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
            <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
            <script type="text/javascript" id="bdshell_js"></script>
            <script type="text/javascript">
                document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
            </script>
            <!-- Baidu Button END -->
            <div class="blank"></div>
            <div class="news">
                @parent
            </div>
            <div class="visitors">
                <h3>
                    <p>最近访客</p>
                </h3>
                <ul>
                </ul>
            </div>
        </aside>
    </article>
@stop