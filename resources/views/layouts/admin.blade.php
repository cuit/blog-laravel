<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('static/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('static/style/font/css/font-awesome.min.css')}}">
    <script type="text/javascript" src="{{asset('static/style/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('static/style/js/ch-ui.admin.js')}}"></script>
    <script type="text/javascript" src="{{asset('static/layer/layer.js')}}"></script>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <title>BLOG 博客系统</title>
    <style>
        h1,h2,h3{
            margin-top: 10px !important;
        }
    </style>
    @section('style')

    @show
</head>
<body>
@yield('content')

@section('javascript')

@show
</body>
</html>