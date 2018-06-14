@extends('layouts.admin')

@section('content')
    <link rel="stylesheet" href="{{asset('static/style/css/global.css')}}" media="all" >

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('home/info')}}">首页</a>  &raquo; 添加友情链接
    </div>
    <!--面包屑导航 结束-->
	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>文章管理</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('home/link/create')}}"><i class="fa fa-plus"></i>添加友情链接</a>
                <a href="{{url('home/link')}}"><i class="fa fa-recycle"></i>全部友情链接列表</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    <div class="result_wrap">
        <div class="result_title">
        @if(count($errors))
            <div class="mark">
                @if(is_string($errors))
                    <script>layer.msg('{{$errors}}')</script>
                @else
                    @foreach($errors->all() as $value)
                        <p>{{$value}}</p>
                    @endforeach
                @endif
            </div>
        @endif
        </div>
        <form action="{{url('home/link')}}" method="POST" >
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th>友情链接标题：</th>
                        <td>
                            <input type="text" class="lg" name="name" style="width: 100%" value="{{old('name')}}">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>友情链接地址：</th>
                        <td>
                            <input type="text" class="lg" name="url" style="width: 100%" value="{{old('url')}}">
                        </td>
                    </tr>
                    <tr>
                        <th>友情链接描述：</th>
                        <td>
                            <input type="text" class="lg" name="description" style="width: 100%" value="{{old('description')}}">
                        </td>
                    </tr>
                    <tr>
                        <th>友情链接排序：</th>
                        <td>
                            <input type="text" class="sm" name="order" value="{{old('order')}}">
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <button type="submit" class="btn btn-default">提交</button>
                            <button type="button" class="btn btn-default" onclick="history.go(-1)" >返回</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
@stop