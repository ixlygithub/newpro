<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="<?php echo e(asset('resources')); ?>/css/styles.css">
	<link rel="stylesheet" href="<?php echo e(asset('resources')); ?>/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<!-- Fonts -->
  
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
</head>
	<body>	
		<div class="backgr_color">
		</div>
		<div class="container">
			<header class="row">
				<div class="banner">
					<img src="<?php echo e(asset('black')); ?>/img/Banner.jpg">
				</div>
			</header>
			<section class="row border">
				<div class="col-md-9 para_title">
					<h6>PRACTICE QUESTIONS TEST BANK</h6>
				</div>
				<div class="col-md-3 small_title">
					<h6>Nurses are angels in comfortable shoes</h6>
					<span>Get ready to become licensed</span>
				</div>
			</section>
			<section class="row">
				<div class="col-md-9 no_padding">
					<div class="small_title">
						<h3>sign in</h3>
					</div>
					<div class="home_signin">
						<h3>home / sign in</h3>
					</div>
					<div class="sign_form">
						<div class="col-md-4" style="margin: 0 auto;">
							<h6>SIGN IN</h6>
							<form name="signin" id="signin" class="">
								<div class="form-group">
									<label for="email">E-Mail</label>
	    							<input type="email" class="form-control" id="email" aria-describedby="emailHelp">
								</div>
								<div class="form-group">
									<label for="password">Password</label>
	    							<input type="password" class="form-control" id="password-field" aria-describedby="emailHelp">
	    							<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
								</div>
								<div class="form-group text-center">
									<input type="submit" name="" value="login" class="btn btn-warning">
								</div>
							</form>
							<div class="form-group form_link">
								<p><a href="#">Or sign in using email</a></p>
								<p><a href="#">forgot password?</a> <a>Reset it</a><p>
								<p><a href="#">Nurse Plus Academy</a></p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 bg_color">
					<ul class="list-inline">
						<li><a href="">Nursing Career Guide</a></li>
						<li><a href="">How Much Nurses Make</a></li>
						<li><a href="">How To Become a Registered Nurse</a></li>
						<li><a href="">How To Become a Nurse Practitioner</a></li>
					</ul>
				</div>
			</section>
		</div>
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-md-2">
						<h6>Site Map</h6>
						<ul class="list-inline">
							<li><a href="">Physiological</a></li>
							<li><a href="">Health Promotion</a></li>
							<li><a href="">Safe and Effective Care</a></li>
							<li><a href="">SATA</a></li>
							<li><a href="">NCLEX - RN Exam Stimulator</a></li>
						</ul>
					</div>
					<div class="col-md-3">
						<h6>NCLEX</h6>
						<ul class="list-inline">
							<li><a href="">NCLEX Practice Questions</a></li>
							<li><a href="">NCLEX Mastery Questions</a></li>
							<li><a href="">Practice Questions Test Bank</a></li>
							<li><a href="">Nursing Career Guide</a></li>
							<li><a href="">Become a Registered Nurse</a></li>
							<li><a href="">Become a Nurse Practitioner</a></li>
						</ul>
					</div>
					<div class="col-md-3">
						<h6>Canadian HQ</h6>
						<ul class="list-inline">
							<li><a>1466 Limeridge Rd East, Hamilton,</a></li>
							<li><a>ON, L8W3J9</a></li>
						</ul>
						<h6>US Office</h6>
						<ul class="list-inline">
							<li><a>4283 Express Lane, Suite 392-536,</a></li>
							<li><a>Sarasota, FL 34249</a></li>
						</ul>
					</div>
					<div class="col-md-2">
						<h6>General Inquries</h6>
						<ul class="list-inline">
							<li><a href="">Hello@nurse.plus</a></li>
							<li><a href="">Terms</a></li>
							<li><a href="">Privacy Policy</a></li>
							<li><a href="">Mobile</a></li>
						</ul>
					</div>
					<div class="col-md-2">
						<h6>Telephone</h6>
						<ul class="list-inline">
							<li><a href="">x-xxx-xxxx-xxxx</a></li>
							<li><a href="">Help Center</a></li>
						</ul>
					</div>
				</div>
				<div class="copy_right text-center">
					<span class="">&#169; Copyrights reserved 2021</span>
				</div>
			</div>
		</footer>
	</body>
</html>
<script type="text/javascript">
	$(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>