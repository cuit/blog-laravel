@extends('layouts.admin')

@section('content')
    <link rel="stylesheet" href="{{asset('static/style/css/global.css')}}" media="all" >
    <script type="text/javascript" charset="utf-8" src="{{asset('static/ueditor/ueditor.config.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{asset('static/ueditor/ueditor.all.min.js')}}"> </script>
    <script type="text/javascript" charset="utf-8" src="{{asset('static/style/js/jquery-1.6.4.js')}}"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="{{asset('static/ueditor/lang/zh-cn/zh-cn.js')}}"></script>

    <script type="text/javascript" src="{{asset('static/uploadify/jquery.uploadify.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('static/uploadify/uploadify.css')}}">

    <link rel="stylesheet" href="{{asset('static/zyUpload/control/css/zyUpload.css')}}" type="text/css">
    <!-- 引用核心层插件 -->
    <script src="{{asset('static/zyUpload/core/zyFile.js')}}"></script>
    <!-- 引用控制层插件 -->
    <script src="{{asset('static/zyUpload/control/js/zyUpload.js')}}"></script>
    <!-- 引用初始化JS -->
    <script src="{{asset('static/zyUpload/core/lanrenzhijia.js')}}"></script>
    {{--<script src="http://www.lanrenzhijia.com/ajaxjs/jquery.min.js"></script>--}}

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('home/info')}}">首页</a>  &raquo; 添加文章
    </div>
    <!--面包屑导航 结束-->
    {{--<script>--}}
        {{--$(document).ready(function(){--}}
            {{--$("#selectFileBtn").click(function(){--}}
                {{--$fileField = $('<input type="file" name="myFile[]" accept="image/png,image/gif,image/jpg,image/jpeg"/>');--}}
                {{--$fileField.hide();--}}
                {{--$("#attachList").append($fileField);--}}
                {{--$fileField.trigger("click");--}}
                {{--$fileField.change(function(){--}}
                    {{--$path = $(this).val();--}}
                    {{--$filename = $path.substring($path.lastIndexOf("\\")+1);--}}
                    {{--$attachItem = $('<div class="attachItem"><div class="left">a.gif</div><div class="right"><a href="#" title="删除附件">删除</a></div></div>');--}}
                    {{--$attachItem.find(".left").html($filename);--}}
                    {{--$("#attachList").append($attachItem);--}}
                {{--});--}}
            {{--});--}}
            {{--$("#attachList>.attachItem").find('a').live('click',function(obj,i){--}}
                {{--$(this).parents('.attachItem').prev('input').remove();--}}
                {{--$(this).parents('.attachItem').remove();--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>文章管理</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('home/category/create')}}"><i class="fa fa-plus"></i>添加文章</a>
                <a href="{{url('home/category')}}"><i class="fa fa-recycle"></i>全部文章列表</a>
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
        <form action="{{url('home/article')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i>文章分类：</th>
                        <td>
                            <select name="cate_id">
                                @if(isset($datas))
                                    @foreach($datas as $value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>文章标题：</th>
                        <td>
                            <input type="text" class="lg" name="title" style="width: 100%" value="{{old('title')}}">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>关键词：</th>
                        <td>
                            <input type="text" class="lg" name="tag" style="width: 100%" value="{{old('tag')}}">
                        </td>
                    </tr>
                    {{--<tr>--}}
                        {{--<th>缩略图：</th>--}}
                        {{--<td>--}}
                            {{--<div style="height: 40px;width: 120px;float: left">--}}
                                {{--<a href="javascript:void(0)" id="selectFileBtn">添加附件</a>--}}
                            {{--</div>--}}
                            {{--<div id="attachList" style="float: left"></div>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                    <tr>
                        <th>文章封面：</th>
                        <td>
                            <input type="text" size="50" style="width: 80%" name="cover" value="{{old('cover')}}">
                            <input id="file_upload" name="myFile" type="file" multiple="true">
                        </td>
                        <style>
                            .uploadify{display:inline-block;}
                            .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
                            table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
                        </style>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <img src="" alt="" id="cover" style="max-width: 350px; max-height:100px;">
                        </td>
                    </tr>
                    <tr>
                        <th>是否推荐</th>
                        <td>
                            <input type="radio" value="1" name="recommend">是&nbsp;&nbsp;
                            <input type="radio" value="0" name="recommend" checked>否
                        </td>
                    </tr>
                    {{--<tr>--}}
                        {{--<th>上传插件：</th>--}}
                        {{--<td>--}}
                            {{--<div id="demo" class="demo" style="float: left;width: 100%"></div>--}}
                            {{--<input type="hidden" name="thumb" id="thumb" value="{{old('thumb')}}">--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                    <tr>
                        <th>文章描述：</th>
                        <td>
                            <textarea name="description" style="width: 95%">{{old('description')}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>文章内容：</th>
                        <td>
                            <script id="editor" name="content" type="text/plain" style="width:800px;height: 500px">{!! old('content') !!}</script>
                            <script type="text/javascript">
                                var ue = UE.getEditor('editor');
                            </script>
                            <style>
                                .edui-default{line-height: 28px;}
                                div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                                {overflow: hidden; height:20px;}
                                div.edui-box{overflow: hidden; height:22px;}
                            </style>
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
    <script type="text/javascript">
        <?php $timestamp = time();?>
           $(function() {
                $('#file_upload').uploadify({
                    'buttonText' : '图片上传',
                    'formData'     : {
                        'timestamp' : '<?php echo $timestamp;?>',
                        '_token'     : '{{csrf_token()}}'
                    },
                    'swf'      : '{{url('static/uploadify/uploadify.swf')}}',
                    'uploader' : '{{url('home/upload')}}',
                    'onUploadSuccess' : function(file, data, response) {
                        $('input[name=cover]').val(data);
                        $('#cover').attr('src','/laravel_blog/public/'+data);
                    }
                });
            });
    </script>
@stop