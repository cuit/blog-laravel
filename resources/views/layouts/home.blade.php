<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    @yield('title')
    <link href="{{asset('static/style/css/base.css')}}" rel="stylesheet">
    <link href="{{asset('static/style/css/index.css')}}" rel="stylesheet">
    <link href="{{asset('static/style/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('static/style/css/new.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{asset('static/style/js/modernizr.js')}}"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="{{asset('static/style/navigation/css/normalize.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('static/style/navigation/css/htmleaf-demo.css')}}">
    <link rel='stylesheet' href='http://fonts.googleapis.com/icon?family=Material+Icons' type='text/css'>
    <link rel="stylesheet" href="{{asset('static/style/navigation/dist/sidenav.min.css')}}" type="text/css">
    <style type="text/css">
        div.header-left{
            position: absolute;
            left: 30px;
            top:30px;
        }
        nav{
            margin: 0 !important;
        }
        div.right{
            margin-top: 30px;
        }
    </style>
</head>
<body>
<div class="header-left">
    <nav class="sidenav" data-sidenav data-sidenav-toggle="#sidenav-toggle">
        <div class="sidenav-brand">
            栏目列表
        </div>

        <ul class="sidenav-menu">
            <?php $i=0?>
            @foreach($categories as $category)
                @if($category->pid == 0)
                <?php $i++;?>
                <li>
                    <a href="javascript:;" data-sidenav-dropdown-toggle class="active">
                        <span class="sidenav-link-icon">
                            <i class="material-icons">
                                @if($category->icon == null)
                                    story
                                    @else
                                    {{$category->icon}}
                                @endif
                            </i>
                            {{--@if($i%3==0)--}}
                                {{--<i class="material-icons">store</i>--}}
                            {{--@endif--}}
                            {{--@if($i%3==1)--}}
                                {{--<i class="material-icons">payment</i>--}}
                            {{--@endif--}}
                            {{--@if($i%3==2)--}}
                                {{--<i class="material-icons">assignment_ind</i>--}}
                            {{--@endif--}}
                        </span>
                        <span class="sidenav-link-title">{{$category->name}}</span>
                        <span class="sidenav-dropdown-icon show" data-sidenav-dropdown-icon>
                            <i class="material-icons">arrow_drop_down</i>
                        </span>
                        <span class="sidenav-dropdown-icon" data-sidenav-dropdown-icon>
                            <i class="material-icons">arrow_drop_up</i>
                        </span>
                    </a>
                    <ul class="sidenav-dropdown" data-sidenav-dropdown>
                        @foreach($categories as $child)
                            @if($child->pid == $category->id)
                                <li><a href="{{url('/list/'.$child->id)}}">{{$child->displayname}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
                @endif
            @endforeach
        </ul>
        <div class="sidenav-header">
            前端插件
        </div>

        <ul class="sidenav-menu">
            <li>
                <a href="javascript:;" data-sidenav-dropdown-toggle>
	          <span class="sidenav-link-icon">
	            <i class="material-icons">date_range</i>
	          </span>
                    <span class="sidenav-link-title">免费插件</span>
                    <span class="sidenav-dropdown-icon show" data-sidenav-dropdown-icon>
	            <i class="material-icons">arrow_drop_down</i>
	          </span>
                    <span class="sidenav-dropdown-icon" data-sidenav-dropdown-icon>
	            <i class="material-icons">arrow_drop_up</i>
	          </span>
                </a>

                <ul class="sidenav-dropdown" data-sidenav-dropdown>
                    <li><a href="http://www.htmleaf.com/">JQUERY之家</a></li>
                </ul>
            </li>
            {{--<li>--}}
                {{--<a href="javascript:;">--}}
	          {{--<span class="sidenav-link-icon">--}}
	            {{--<i class="material-icons">backup</i>--}}
	          {{--</span>--}}
                    {{--<span class="sidenav-link-title">Occaecat</span>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="javascript:;">--}}
	          {{--<span class="sidenav-link-icon">--}}
	            {{--<i class="material-icons">settings</i>--}}
	          {{--</span>--}}
                    {{--<span class="sidenav-link-title">Deserunt</span>--}}
                {{--</a>--}}
            {{--</li>--}}
        </ul>
    </nav>
    <a href="javascript:;" class="toggle" id="sidenav-toggle">
        <i class="material-icons">menu</i>
    </a>
</div>
<header>
    <div class="logo">
        <div id="logo"><a href="{{url('/')}}"></a></div>
    </div>
    <div class="right">
        <nav class="topnav" id="topnav">
            @foreach($navs as $value)
                <a href="{{$value->url}}"><span>{{$value->name}}</span><span class="en">{{$value->alias}}</span></a>
            @endforeach
        </nav>
    </div>
</header>

@section('content')
    <h3>
        <p>最新<span>文章</span></p>
    </h3>
    <ul class="rank">
        @foreach($news as $value)
            <li><a href="{{url('article/'.$value->id)}}" title="{{$value->title}}" target="_blank">{{$value->title}}</a></li>
        @endforeach
    </ul>
    <h3 class="ph">
        <p>点击<span>排行</span></p>
    </h3>
    <ul class="paih">
        @foreach($hots as $value)
            <li><a href="{{'article/'.$value->id}}" title="{{$value->title}}" target="_blank">{{$value->title}}</a></li>
        @endforeach
    </ul>
@show
<footer>
    <p>{!! Config::get('web.copyright') !!}</p>
</footer>
<script src="{{asset('static/style/js/silder.js')}}"></script>
<script src="http://cdn.bootcss.com/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
<script src="{{asset('static/style/navigation/dist/sidenav.min.js')}}"></script>
<script>$('[data-sidenav]').sidenav();</script>
</body>
</html>