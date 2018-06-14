@extends('layouts.admin')

@section('title')
    修改自定义导航栏
@stop

@section('content')
    <link rel="stylesheet" href="{{asset('static/style/css/global.css')}}" media="all" >

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('home/info')}}">首页</a>  &raquo; 编辑配置项
    </div>
    <!--面包屑导航 结束-->
	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>配置项管理</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('home/nav/create')}}"><i class="fa fa-plus"></i>添加配置项</a>
                <a href="{{url('home/nav')}}"><i class="fa fa-recycle"></i>全部配置项列表</a>
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
        <form action="{{url('home/config/'.$data->id)}}" method="POST" >
            {{csrf_field()}}
            {{method_field('PUT')}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th>标题：</th>
                    <td>
                        <input type="text" class="lg" name="title" style="width: 100%" value="{{$data->title}}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>名称：</th>
                    <td>
                        <input type="text" class="lg" name="name" style="width: 100%" value="{{$data->name}}">
                    </td>
                </tr>
                <tr>
                    <th>类型：</th>
                    <td>
                        <input type="radio" name="filed_type" value="input" @if($data->filed_type == 'input')checked @endif onclick="changeType()">input&nbsp;&nbsp;
                        <input type="radio" name="filed_type" value="textarea" @if($data->filed_type == 'textarea')checked @endif onclick="changeType()">textarea&nbsp;&nbsp;
                        <input type="radio" name="filed_type" value="radio" @if($data->filed_type == 'radio')checked @endif onclick="changeType()">radio&nbsp;&nbsp;
                    </td>
                </tr>
                <tr class="filed_value" style="display: none">
                    <th>类型值：</th>
                    <td>
                        <input type="text" class="lg" name="filed_value" style="width: 100%" value="{{$data->filed_value}}">
                    </td>
                </tr>
                <tr>
                    <th>描述：</th>
                    <td>
                        <input type="text" style="width: 100%" name="tips" class="lg" value="{{$data->tips}}">
                    </td>
                </tr>
                <tr>
                    <th>内容：</th>
                    <td>
                        <textarea name="content" style="width: 100%" cols="30" rows="10">{{$data->content}}</textarea>
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
    <script>
        //        changeType();
        function changeType() {
            var type = $('input[name="filed_type"]:checked').val();
            if(type == 'radio'){
                $(".filed_value").show();
            }else{
                $(".filed_value").hide();
            }
        };
    </script>
@stop