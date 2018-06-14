<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="{{asset('static/style/css/ch-ui.admin.css')}}">
	<link rel="stylesheet" href="{{asset('static/style/font/css/font-awesome.min.css')}}">
	<style>
		.login_box h1{
			margin: 0 !important;
			padding-top: 100px;
		}
		.login_box .form {
			width: 410px;
		}
		.login_box .form ul li input.text{
			width: 400px;
		}
		.login_box .form ul li input.code{
			width:290px;
		}
		.login_box .form ul li input[type='submit']{
			width: 410px;
		}
	</style>
</head>
<body style="background:#F3F3F4;">
	<div class="login_box">
		<h1>Blog</h1>
		<h2>欢迎使用博客管理平台</h2>
		<div class="form">
			@if(session('msg'))
				<p style="color:red">{{session('msg')}}</p>
			@endif
			<form action="" method="post">
				{{csrf_field()}}
				<ul>
					<li>
					<input type="text" name="username" class="text" value="{{old('username')}}"/>
						<span><i class="fa fa-user"></i></span>
					</li>
					<li>
						<input type="password" name="password" class="text" value="{{old('password')}}"/>
						<span><i class="fa fa-lock"></i></span>
					</li>
					<li>
						<input type="text" class="code" name="code"/>
						<span><i class="fa fa-check-square-o"></i></span>
						<img src="{{url('/home/code')}}" alt="验证码" onclick="this.src='{{url('home/code')}}?tm='+Math.random()">
					</li>
					<li>
						<input type="submit" value="立即登陆"/>
					</li>
				</ul>
			</form>
			<p><a href="#">返回首页</a> &copy; 2016 Powered by XSC</p>
		</div>
	</div>
</body>
</html>