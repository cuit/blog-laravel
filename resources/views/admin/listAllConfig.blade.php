@extends('layouts.admin')

@section('title')
配置项列表
@stop

@section('content')
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('home/info')}}">首页</a> &raquo; 配置项管理
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
    <div class="result_wrap">
        <!--快捷导航 开始-->
        <div class="result_title">
            <h3>配置项列表</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('home/config/create')}}"><i class="fa fa-plus"></i>添加配置项</a>
                <a href="{{url('home/config')}}"><i class="fa fa-recycle"></i>全部配置项列表</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>
    <div class="result_wrap">
        <div class="result_content">
            <form action="{{url('home/config/changeContent')}}" method="post">
            {{csrf_field()}}
            <table class="list_tab">
                <tr>
                    <th class="tc" width="3%">排序</th>
                    <th class="tc" width="3%">ID</th>
                    <th>标题</th>
                    <th>名称</th>
                    {{--<th>描述</th>--}}
                    <th>字段类型</th>
                    {{--<th>字段值</th>--}}
                    <th>内容</th>
                    <th>新增时间</th>
                    <th>操作</th>
                </tr>
                @foreach($datas as $data)
                <tr>
                    <td class="tc">
                        <input type="text" name="order" value="{{$data->order}}" onchange="changeOrder(this,'{{$data->id}}')">
                    </td>
                    <td class="tc">{{$data->id}}</td>
                    <td>{{$data->title}}</td>
                    <td>{{$data->name}}</td>
                    {{--<td>{{$data->tips}}</td>--}}
                    <td>{{$data->filed_type}}</td>
                    {{--<td>{{$data->filed_value}}</td>--}}
                    <td>{!! $data->_html !!}</td>
                    <td>{{$data->created_at}}</td>
                    <input type="hidden" name="id[]" value="{{$data->id}}">
                    <td>
                        <button type="button" class="btn btn-primary" onclick="edit('{{$data->id}}')">修改</button >
                        <button type="button" class="btn btn-danger" onclick="delConfig('{{$data->id}}')">删除</button>
                    </td>
                </tr>
                @endforeach
            </table>
            <div class="btn_group">
                <input type="submit" value="提交">
                <input type="button" class="back" onclick="history.go(-1)" value="返回" >
            </div>
            </form>

            <div class="page_list">
                {{$datas->links()}}
            </div>
        </div>
    </div>
<!--搜索结果页面 列表 结束-->

@stop

@section('javascript')
<script type="text/javascript">
    function changeOrder(orderId,navid){
        var order = $(orderId).val();
        $.post('{{url('home/config/changeOrder')}}',{'_token':'{{csrf_token()}}','order':order,'configId':navid},function (data) {
            if(data['status'] == 0){
                layer.msg(data['msg'], {icon: 5});
            }else{
                layer.msg(data['msg'], {icon: 6});
                window.location.reload();
            }
        });
    }

    function delConfig(id) {
        layer.confirm('确定删除该数据吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post('{{url('home/config/')}}/'+id,{'_method':'delete','_token':'{{csrf_token()}}'},function (data) {
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
        window.location = "{{url('home/config/')}}/"+id+"/edit";
    }
</script>
@stop

