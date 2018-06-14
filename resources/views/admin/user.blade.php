@extends('layouts.admin')
@section('content')
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
    <i class="fa fa-home"></i> <a href="{{url('home/info')}}">首页</a> &raquo; 个人中心
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>修改密码</h3>
    </div>
</div>
<!--结果集标题与导航组件 结束-->
<div class="result_wrap">
    <form id="password_form">
        <table class="add_tab">
            {{csrf_field()}}
            <tbody>
            <tr>
                <th width="120"><i class="require">*</i>原密码：</th>
                <td>
                    <input type="password" name="password_o" id="password_o"> </i>请输入原始密码</span>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>新密码：</th>
                <td>
                    <input type="password" name="password" id="password"> </i>新密码6-20位</span>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>确认密码：</th>
                <td>
                    <input type="password" name="password_confirmation" id="password_confirmation"> </i>再次输入密码</span>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <button type="button" onclick="changePassword()" class="btn btn-default">提交</button>
                    <button type="button" class="btn btn-default" onclick="history.go(-1)" >返回</button>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
<div class="result_wrap">
    <div class="result_title">
        <h3>基本设置</h3>
    </div>
</div>
<!--结果集标题与导航组件 结束-->
<div class="result_wrap">
    <form id="userinfo">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th><i class="require">*</i>联系电话：</th>
                <td>
                    <input type="text" name="telphone">
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>地址：</th>
                <td>
                    <input  type="text" name="address">
                </td>
            </tr>
            <tr>
            <th>上传插件：</th>
                <td>
                    <div id="demo" class="demo" style="float: left"></div>
                    <input type="hidden" name="avater" id="avater">
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <button type="button" onclick="changeUserInfo()" class="btn btn-default">提交</button>
                    <button type="button" class="btn btn-default" onclick="history.go(-1)" >返回</button>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
<script>
    function changePassword() {
        var data = $("#password_form").serializeArray();
        $.ajax({
            url: "{{url('home/user/password')}}",
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (data) {
                if(data.success){
                    layer.msg(data.message.password[0],{icon: 6});
                }else {
                    var msg= '';
                    for(var i = 0;i<data.message.password.length;i++){
                        msg += data.message.password[i]+"　";
                    }
                    layer.msg(msg,{icon: 5});
                }
            }
        });
    }

    function changeUserInfo() {
        var data = $("#userinfo").serializeArray();
        $.ajax({
            url:'{{url('home/user/info')}}',
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {
                if(data.success){
                    layer.msg(data.message,{icon: 6});
                }else{
                    var msg= '';
                    for (var i=0;i<data.message.length;i++){
                        msg += data.message[i];
                    }
                    layer.msg(msg,{icon: 5});
                }
            }
        });
    }
</script>
@endsection
