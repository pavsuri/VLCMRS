<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- enables best rendering possibility in old IE/Chrome browsers -->
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    {{ HTML::script('js/jquery.min.js'); }}
    {{ HTML::script('js/bootstrap.min.js'); }}
</head>
<body>
	<div class="admin-login-bg">
		<div class="container-fluid">
			<div class="admin-login">
				<div class="main">
					<div class="row">
{{ Form::open([
    'route' => 'signin.perform',
    'method' => 'post',
    'class' => 'form-horizontal',
    'role' => 'form'
  ]) }}
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="cms-login-page">	
                                                            {{ HTML::image("images/rounduser.png", "RoundUser") }}
								<h1>Compliance Management System</h1>
                                                                 {{ HTML::image("images/smallcircle.png", "smallcircle", ['class' => 'smallcircle']) }}
								<div class="cms-login-credentials">
									<div class="admin-credentials">
                                                                            {{ HTML::image("images/username.png", "username") }}
										<input type="text" placeholder="User Name" id="signin-email" name="email" autofocus tabindex="1"/>
										<div class="clearfix"></div>
									</div>
									<div class="admin-credentials">
                                                                            {{ HTML::image("images/password.png", "password") }}
										<input type="password" placeholder="********" id="signin-password" name="password" tabindex="2"/>
										<div class="clearfix"></div>
									</div>
									<a href="innerPage.html">Forgot Your Password?</a>
									<input type="submit" class="btn btn-primary btn-block" value="Login"/>
								</div>
								<!-- END of .cms-login-credentials -->
							</div>
							<!-- END of .cms-login-page -->
						</div>
  {{ Form::close() }}
					</div>
					<!-- END of .row -->
				</div>
				<!-- END of .main -->
				<div class="powered-by">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="valuelabs-logo">
								<p><span>Powered by</span> {{ HTML::image("images/logo.png", "valuelabs") }}</p>
							</div>	
						</div>
					</div>					
				</div><!-- END of .powered-by -->
			</div>
			<!-- END of .admin-login -->
		</div>
		<!-- END of .container-fluid -->
	</div>
	<!-- END of .admin-login-bg -->
</body>