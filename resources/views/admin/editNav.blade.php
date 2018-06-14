@extends('layouts.admin')

@section('title')
    修改自定义导航栏
@stop

@section('content')
    <link rel="stylesheet" href="{{asset('static/style/css/global.css')}}" media="all" >

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('home/info')}}">首页</a>  &raquo; 编辑自定义导航栏
    </div>
    <!--面包屑导航 结束-->
	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>自定义导航栏管理</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('home/nav/create')}}"><i class="fa fa-plus"></i>添加自定义导航</a>
                <a href="{{url('home/nav')}}"><i class="fa fa-recycle"></i>全部自定义导航列表</a>
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
        <form action="{{url('home/nav/'.$data->id)}}" method="POST" >
            {{csrf_field()}}
            {{method_field('PUT')}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th>自定义导航标题：</th>
                    <td>
                        <input type="text" class="lg" name="name" style="width: 100%" value="{{$data->name}}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>自定因导航地址：</th>
                    <td>
                        <input type="text" class="lg" name="url" style="width: 100%" value="{{$data->url}}">
                    </td>
                </tr>
                <tr>
                    <th>自定因导航别名：</th>
                    <td>
                        <input type="text" class="lg" name="alias" style="width: 100%" value="{{$data->alias}}">
                    </td>
                </tr>
                <tr>
                    <th>导航栏排序：</th>
                    <td>
                        <input type="text" class="sm" name="order" value="{{$data->order}}">
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