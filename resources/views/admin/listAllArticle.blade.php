@extends('layouts.admin')

@section('title')
文章列表
@stop

@section('content')
<style>
    .result_content ul li span{
        font-size: 15px;
        padding: 6px 12px;
    }
</style>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 文章管理
</div>
<!--面包屑导航 结束-->

<!--结果页快捷搜索框 开始-->
<div class="search_wrap">
    <form action="{{url('home/search')}}" method="post">
        {{csrf_field()}}
        <table class="search_tab">
            <tr>
                <th width="120">选择分类:</th>
                <td>
                    <select name="cate_id">
                        <option value="0">全部</option>
                        @foreach($categories as $value)
                            @if(isset($cate_id))
                                @if($cate_id == $value->id)
                                    <option value="{{$value->id}}" selected="selected">{{$value->name}}</option>
                                    @else
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endif
                            @else
                                <option value="{{$value->id}}">{{$value->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </td>
                <th width="70">关键字:</th>
                <td><input type="text" name="keywords" @if(isset($keywords)) value="{{$keywords}}" @endif placeholder="关键字"></td>
                <td><button type="submit" class="btn btn-default">提交</button></td>
            </tr>
        </table>
    </form>
</div>
<!--结果页快捷搜索框 结束-->
@if(session('info'))
    <script>layer.msg('{{session('info')}}',{icon: 6})</script>
@endif
<!--搜索结果页面 列表 开始-->
    <div class="result_wrap">
        <!--快捷导航 开始-->
        {{--<div class="result_title">--}}
            {{--<h3>文章列表</h3>--}}
        {{--</div>--}}
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('home/article/create')}}"><i class="fa fa-plus"></i>添加文章</a>
                <a href="{{url('home/article')}}"><i class="fa fa-recycle"></i>全部文章列表</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc" width="5%">ID</th>
                    <th>标题</th>
                    <th>编辑者</th>
                    <th>关键字</th>
                    <th>浏览次数</th>
                    <th style="width: 10%">发布时间</th>
                    <th>是否推荐</th>
                    <th>操作</th>
                </tr>
                @foreach($articles as $data)
                <tr>
                    <td class="tc">{{$data->id}}</td>
                    <td>{{$data->title}}</td>
                    <td>{{$data->editor}}</td>
                    <td>{{$data->tag}}</td>
                    <td>{{$data->view}}</td>
                    <td style="width: 15%;overflow: hidden">{{$data->created_at}}</td>
                    <td>{{$data->recommend}}</td>
                    <td>
                        <button type="button" class="btn btn-primary" onclick="edit('{{$data->id}}')">修改</button >
                        <button type="button" class="btn btn-danger" onclick="delArticle('{{$data->id}}')">删除</button>
                    </td>
                </tr>
                @endforeach
            </table>
            <div class="page_list">
                @if(isset($keywords) && isset($cate_id))
                    {{$articles->appends(['keywords'=>$keywords,'cate_id'=>$cate_id])->links()}}
                    @else
                    {{$articles->links()}}
                @endif
            </div>
        </div>
    </div>
<!--搜索结果页面 列表 结束-->
@if(session('flag'))
    <script>layer.alert('修改成功', {icon: 6});</script>
@endif

@stop

@section('javascript')
<script type="text/javascript">

    function delArticle(id) {
        layer.confirm('确定删除该数据吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post('{{url('home/article/')}}/'+id,{'_method':'delete','_token':'{{csrf_token()}}'},function (data) {
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
        window.location = "{{url('home/article/')}}/"+id+"/edit";
    }
</script>
@stop

