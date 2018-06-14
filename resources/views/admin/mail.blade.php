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
        <i class="fa fa-home"></i> <a href="{{url('home/info')}}">首页</a>  &raquo; 发送邮件
    </div>

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
        <form method="POST" enctype="multipart/form-data" id="email">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th>收件人：</th>
                        <td>
                            <input type="text" class="lg" name="email_to" style="width: 100%" >
                        </td>
                    </tr>
                    <tr>
                        <th>发件主题：</th>
                        <td>
                            <input type="text" class="lg" name="email_subject" style="width: 100%" >
                        </td>
                    </tr>
                    <tr>
                        <th>文章内容：</th>
                        <td>
                            <script id="editor" name="email_content" type="text/plain" style="width:800px;height: 500px">{!! old('content') !!}</script>
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
        $('button[type="submit"]').click(function () {
            var data = $("#email").serialize();
            $.post("{{url('admin/mail')}}",{'data':data},function (data) {
                if(data['status'] == 0){
                    layer.msg(data['msg'], {icon: 5});
                }else{
                    layer.msg(data['msg'], {icon: 6});
                }
            });
        });
    </script>
@stop