@extends('layouts.admin')

@section('title')
自定义导航栏列表
@stop

@section('content')
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('home/info')}}">首页</a> &raquo; 自定义导航管理
</div>
<!--面包屑导航 结束-->

<!--结果页快捷搜索框 开始-->
<div class="search_wrap">
    <form action="" method="post">
        <table class="search_tab">
            <tr>
                <th width="120">选择分类:</th>
                <td>
                    <select onchange="javascript:location.href=this.value;">
                        <option value="">全部</option>
                        <option value="http://www.baidu.com">百度</option>
                        <option value="http://www.sina.com">新浪</option>
                    </select>
                </td>
                <th width="70">关键字:</th>
                <td><input type="text" name="keywords" placeholder="关键字"></td>
                <td><input type="submit" name="sub" value="查询"></td>
            </tr>
        </table>
    </form>
</div>
<!--结果页快捷搜索框 结束-->
@if(session('info'))
    <script>layer.msg('{{session('info')}}',{icon: 6});</script>
@endif
<!--搜索结果页面 列表 开始-->
<form action="#" method="post">
    <div class="result_wrap">
        <!--快捷导航 开始-->
        <div class="result_title">
            <h3>友情链接列表</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('home/nav/create')}}"><i class="fa fa-plus"></i>添加自定义导航</a>
                <a href="{{url('home/nav')}}"><i class="fa fa-recycle"></i>全部导航列表</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>
    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc" width="5%">排序</th>
                    <th class="tc" width="5%">ID</th>
                    <th>导航栏名称</th>
                    <th>导航栏别名</th>
                    <th width="5%">导航栏地址</th>
                    <th>更新时间</th>
                    <th>操作</th>
                </tr>
                @foreach($datas as $data)
                <tr>
                    <td class="tc">
                        <input type="text" name="order" value="{{$data->order}}" onchange="changeOrder(this,'{{$data->id}}')">
                    </td>
                    <td class="tc">{{$data->id}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->alias}}</td>
                    <td>{{$data->url}}</td>
                    <td>{{$data->created_at}}</td>
                    <td>
                        <button type="button" class="btn btn-primary" onclick="edit('{{$data->id}}')">修改</button >
                        <button type="button" class="btn btn-danger" onclick="delNav('{{$data->id}}')">删除</button>
                    </td>
                </tr>
                @endforeach
            </table>
            <div class="page_list">
                {{$datas->links()}}
            </div>
        </div>
    </div>
</form>
<!--搜索结果页面 列表 结束-->

@stop

@section('javascript')
<script type="text/javascript">
    function changeOrder(orderId,navid){
        var order = $(orderId).val();
        $.post('{{url('home/nav/changeOrder')}}',{'_token':'{{csrf_token()}}','order':order,'navId':navid},function (data) {
            if(data['status'] == 0){
                layer.msg(data['msg'], {icon: 5});
            }else{
                window.location.reload();
                layer.msg(data['msg'], {icon: 6});
            }
        });
    }

    function delNav(id) {
        layer.confirm('确定删除该数据吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post('{{url('home/nav/')}}/'+id,{'_method':'delete','_token':'{{csrf_token()}}'},function (data) {
                if(data['status'] == 1){
                    window.location.reload();
                    layer.msg(data['msg'], {icon: 6});
                }else if(data['status'] == 1){
                    layer.msg(data['msg'], {icon: 5});
                }else if(data['status'] == 2){
                    layer.msg(data['msg'], {icon: 0});
                }
            });
        });
    }

    function edit(id) {
        window.location = "{{url('home/nav/')}}/"+id+"/edit";
    }
</script>
@stop

