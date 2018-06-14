@extends('layouts.admin')

@section('title')
分类列表
@stop

@section('content')
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 全部分类
</div>
<!--面包屑导航 结束-->

<!--搜索结果页面 列表 开始-->
<form action="#" method="post">
    <div class="result_wrap">
        <!--快捷导航 开始-->
        <div class="result_title">
            <h3>分类管理</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('home/category/create')}}"><i class="fa fa-plus"></i>添加分类</a>
                <a href="{{url('home/category')}}"><i class="fa fa-recycle"></i>全部分类</a>
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
                    <th>分类名称</th>
                    <th width="30%">标题</th>
                    <th>点击次数</th>
                    <th width="15%" style="text-align: center">更新时间</th>
                    <th style="text-align: center">操作</th>
                </tr>
                @foreach($categorys as $data)
                <tr>
                    <td class="tc">
                        <input type="text" name="order" value="{{$data->order}}" onchange="changeOrder(this,'{{$data->id}}')">
                    </td>
                    <td class="tc">{{$data->id}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->title}}</td>
                    <td>{{$data->view}}</td>
                    <td style="text-align: center">{{$data->updated_at}}</td>
                    <td>
                        <button type="button" class="btn btn-primary" onclick="edit('{{$data->id}}')">修改</button >
                        <button type="button" class="btn btn-danger" onclick="delCategory('{{$data->id}}')">删除</button>
                    </td>
                </tr>
                @endforeach
            </table>
            <div class="page_list">
                <ul>

                </ul>
            </div>
        </div>
    </div>
</form>
<!--搜索结果页面 列表 结束-->
@if(session('flag'))
    <script>layer.alert('修改成功', {icon: 6});</script>
@endif

@stop

@section('javascript')
<script type="text/javascript">
    function changeOrder(orderId,cateId){
        var order = $(orderId).val();
        $.post('{{url('home/cate/changeOrder')}}',{'_token':'{{csrf_token()}}','order':order,'cateId':cateId},function (data) {
            if(data['status'] == 0){
                layer.msg(data['msg'], {icon: 5});
            }else{
                layer.msg(data['msg'], {icon: 6});
            }
        });
    }

    function delCategory(id) {
        layer.confirm('确定删除该数据吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post('{{url('home/category/')}}/'+id,{'_method':'delete','_token':'{{csrf_token()}}'},function (data) {
                if(data['status'] == 1){
                    layer.msg(data['msg'], {icon: 6});
                    location.reload()
                }else if(data['status'] == 1){
                    layer.msg(data['msg'], {icon: 5});
                }else if(data['status'] == 2){
                    layer.msg(data['msg'], {icon: 0});
                }
            });

        });
    }

    function edit(id) {
        window.location = "{{url('home/category/')}}/"+id+"/edit";
    }
</script>
@stop

