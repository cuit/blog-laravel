<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BLOG系统后台登陆</title>
	<link rel="stylesheet" type="text/css" href="{{asset('static/login/css/normalize.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('static/login/css/htmleaf-demo.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('static/quietflow/demo/style/index.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('static/quietflow/demo/style/prism.css')}}">
	<script src="http://cdn.bootcss.com/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
	<script>window.jQuery || document.write('<script src="{{asset('static/quietflow/js/jquery-1.11.0.min.js')}}"><\/script>')</script>
	<script type="text/javascript" src="{{asset('static/quietflow/lib/quietflow.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('static/quietflow/demo/js/index.js')}}"></script>
	<script type="text/javascript" src="{{asset('static/quietflow/demo/js/prism.js')}}"></script>
	<style type="text/css">
		.login-page {
		  width: 360px;
		  padding: 8% 0 0;
		  margin: auto;
		}
		.form {
		  position: relative;
		  z-index: 1;
		  background: #FFFFFF;
		  max-width: 360px;
		  margin: 0 auto 100px;
		  padding: 45px;
		  text-align: center;
		  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
		}
		.form input {
		  font-family: "Roboto", sans-serif;
		  outline: 0;
		  background: #f2f2f2;
		  width: 100%;
		  border: 0;
		  margin: 0 0 15px;
		  padding: 15px;
		  box-sizing: border-box;
		  font-size: 14px;
		}
		.form button {
		  font-family: "Microsoft YaHei","Roboto", sans-serif;
		  text-transform: uppercase;
		  outline: 0;
		  background: #4CAF50;
		  width: 100%;
		  border: 0;
		  padding: 15px;
		  color: #FFFFFF;
		  font-size: 14px;
		  -webkit-transition: all 0.3 ease;
		  transition: all 0.3 ease;
		  cursor: pointer;
		}
		.form button:hover,.form button:active,.form button:focus {
		  background: #43A047;
		}
		.form .message {
		  margin: 15px 0 0;
		  color: #b3b3b3;
		  font-size: 12px;
		}
		.form .message a {
		  color: #4CAF50;
		  text-decoration: none;
		}
		.form .register-form {
		  display: none;
		}
		.container {
		  position: relative;
		  z-index: 1;
		  max-width: 300px;
		  margin: 0 auto;
		}
		.container:before, .container:after {
		  content: "";
		  display: block;
		  clear: both;
		}
		.container .info {
		  margin: 50px auto;
		  text-align: center;
		}
		.container .info h1 {
		  margin: 0 0 15px;
		  padding: 0;
		  font-size: 36px;
		  font-weight: 300;
		  color: #1a1a1a;
		}
		.container .info span {
		  color: #4d4d4d;
		  font-size: 12px;
		}
		.container .info span a {
		  color: #000000;
		  text-decoration: none;
		}
		.container .info span .fa {
		  color: #EF3B3A;
		}
		body {
		  background: #76b852; /* fallback for old browsers */
		  background: -webkit-linear-gradient(right, #76b852, #8DC26F);
		  background: -moz-linear-gradient(right, #76b852, #8DC26F);
		  background: -o-linear-gradient(right, #76b852, #8DC26F);
		  background: linear-gradient(to left, #76b852, #8DC26F);
		  font-family: "Roboto", sans-serif;
		  -webkit-font-smoothing: antialiased;
		  -moz-osx-font-smoothing: grayscale;      
		}
		.shake_effect{
		 	-webkit-animation-name: shake;
  			animation-name: shake;
  			-webkit-animation-duration: 1s;
  			animation-duration: 1s;
		}
		@-webkit-keyframes shake {
		  from, to {
		    -webkit-transform: translate3d(0, 0, 0);
		    transform: translate3d(0, 0, 0);
		  }

		  10%, 30%, 50%, 70%, 90% {
		    -webkit-transform: translate3d(-10px, 0, 0);
		    transform: translate3d(-10px, 0, 0);
		  }

		  20%, 40%, 60%, 80% {
		    -webkit-transform: translate3d(10px, 0, 0);
		    transform: translate3d(10px, 0, 0);
		  }
		}

		@keyframes shake {
		  from, to {
		    -webkit-transform: translate3d(0, 0, 0);
		    transform: translate3d(0, 0, 0);
		  }

		  10%, 30%, 50%, 70%, 90% {
		    -webkit-transform: translate3d(-10px, 0, 0);
		    transform: translate3d(-10px, 0, 0);
		  }

		  20%, 40%, 60%, 80% {
		    -webkit-transform: translate3d(10px, 0, 0);
		    transform: translate3d(10px, 0, 0);
		  }
		}
		p.center{
			color: #fff;font-family: "Microsoft YaHei";
		}
	</style>
	<!--[if IE]>
		<script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="htmleaf-container">
		<div id="wrapper" class="login-page">
		  <div id="login_form" class="form">
			  <form class="register-form"  method="POST" action="{{ url('/register') }}">
				  {{ csrf_field() }}
				  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					  <div class="col-md-6">
						  <input id="name" type="text" placeholder="用户名" class="form-control" name="name" value="{{ old('name') }}">
						  @if ($errors->has('name'))
							  <span class="help-block">
								  <strong>{{ $errors->first('name') }}</strong>
							  </span>
						  @endif
					  </div>
				  </div>
				  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					  <div class="col-md-6">
						  <input id="email" type="email" placeholder="电子邮件" class="form-control" name="email" value="{{ old('email') }}">
						  @if ($errors->has('email'))
							  <span class="help-block">
								  <strong>{{ $errors->first('email') }}</strong>
							  </span>
						  @endif
					  </div>
				  </div>
				  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					  <div class="col-md-6">
						  <input id="password" type="password" placeholder="密码" class="form-control" name="password">
						  @if ($errors->has('password'))
							  <span class="help-block">
								  <strong>{{ $errors->first('password') }}</strong>
							  </span>
						  @endif
					  </div>
				  </div>
				  <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
					  <div class="col-md-6">
						  <input id="password-confirm" placeholder="确认密码" type="password" class="form-control" name="password_confirmation">
						  @if ($errors->has('password_confirmation'))
							  <span class="help-block">
								  <strong>{{ $errors->first('password_confirmation') }}</strong>
							  </span>
						  @endif
					  </div>
				  </div>
				  <div class="form-group">
					  <div class="col-md-6 col-md-offset-4">
						  <button type="submit" class="btn btn-primary">
							  <i class="fa fa-btn fa-user"></i> Register
						  </button>
					  </div>
				  </div>
				  <p class="message">已经有了一个账户? <a href="#">立刻登录</a></p>
			  </form>

		    {{--<form class="register-form">--}}
		      {{--<input type="text" placeholder="用户名" id="r_user_name"/>--}}
		      {{--<input type="password" placeholder="密码" id="r_password" />--}}
		      {{--<input type="text" placeholder="电子邮件" id="r_emial"/>--}}
		      {{--<button id="create">创建账户</button>--}}
		      {{--<p class="message">已经有了一个账户? <a href="#">立刻登录</a></p>--}}
		    {{--</form>--}}

			  <form class="login-form" method="POST" action="{{ url('/login') }}">
				  {{csrf_field()}}
				  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					  <div class="col-md-6">
						  <input id="email" type="email" placeholder="邮箱" class="form-control" name="email" value="{{ old('email') }}">
						  @if ($errors->has('email'))
							  <span class="help-block">
								  <strong>{{ $errors->first('email') }}</strong>
							  </span>
						  @endif
					  </div>
				  </div>
				  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					  <div class="col-md-6">
						  <input id="password" type="password" placeholder="密码" class="form-control" name="password">
						  @if ($errors->has('password'))
							  <span class="help-block">
								  <strong>{{ $errors->first('password') }}</strong>
							  </span>
						  @endif
					  </div>
				  </div>
				  <div class="form-group">
					  <div class="col-md-6 col-md-offset-4">
						  <div class="checkbox">
							  <label>
								  <input type="checkbox" name="remember"> Remember Me
							  </label>
						  </div>
					  </div>
				  </div>
				  <div class="form-group">
					  <div class="col-md-6 col-md-offset-4">
						  <button type="submit" class="btn btn-primary">
							  <i class="fa fa-btn fa-user"></i> 登　录
						  </button>
					  </div>
				  </div>
				  <p class="message">还没有账户? <a href="#">立刻创建</a></p>
				  <p class="message">忘记密码? <a href="{{url('password/reset')}}">邮箱找回密码</a></p>
			  </form>
		  </div>
		</div>
	</div>
	
	{{--<script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>--}}
	<script>window.jQuery || document.write('<script src="/static/login/js/jquery-2.1.1.min.js"><\/script>')</script>
	<script type="text/javascript">
		var flag = false;
		@if(count($errors))
			flag = true;
		@endif
		if(flag){
            $("#login_form").removeClass('shake_effect');
            setTimeout(function()
            {
                $("#login_form").addClass('shake_effect')
            },1);
        }

	$(function(){
		$('.message a').click(function () {
		    $('form').animate({
		        height: 'toggle',
		        opacity: 'toggle'
		    }, 'slow');
		});
	})
	</script>
<script>
    $("body").quietflow({
        theme : "vortex",
        miniRadii : 40
    })
</script>
</body>
</html>