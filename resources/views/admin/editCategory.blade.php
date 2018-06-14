@extends('layouts.admin')

@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('home/info')}}">首页</a>  &raquo; 编辑文章分类
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>分类管理</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('home/category/create')}}"><i class="fa fa-plus"></i>添加分类</a>
                <a href="{{url('home/category')}}"><i class="fa fa-recycle"></i>全部分类</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    <div class="result_wrap">
        <div class="result_title">
        @if(count($errors))
            <div class="mark">
                @if(is_string($errors))
                    <p>{{$errors}}</p>
                @else
                    @foreach($errors->all() as $value)
                        <p>{{$value}}</p>
                    @endforeach
                @endif
            </div>
        @endif
        </div>
        <form action="{{url('home/category/'.$data->id)}}" method="post">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i>父级分类：</th>
                        <td>
                            <select name="pid" id="pid">
                                <option value="0">==顶级分类==</option>
                                @if(isset($datas))
                                    @foreach($datas as $value)
                                        @if($value->id == $data->pid)
                                            <option value="{{$value->id}}" selected="selected">{{$value->name}}</option>
                                            @else
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>分类：</th>
                        <td>
                            <input type="text" name="name" value="{{$data->name}}">
                            <span><i class="fa fa-exclamation-circle yellow"></i>这里是默认长度</span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>分类介绍：</th>
                        <td>
                            <input type="text" class="lg" name="title" value="{{$data->title}}">
                            <p>标题可以写30个字</p>
                        </td>
                    </tr>
                    <tr>
                        <th>ICON</th>
                        <td><input type="text" name="icon" value="{{$data->icon}}"></td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>排序：</th>
                        <td>
                            <input type="text" class="sm" name="order" value="{{$data->order}}">
                        </td>
                    </tr>
                    <tr>
                        <th>关键字描述：</th>
                        <td>
                            <textarea name="keywords">{{$data->keywords}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>详细内容描述：</th>
                        <td>
                            <textarea class="lg" name="description">{{$data->description}}</textarea>
                            <p>标题可以写30个字</p>
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
