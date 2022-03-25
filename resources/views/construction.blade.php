<!DOCTYPE html>
<html>
<head>
	<title>CONSTRUCTION</title>
	<link rel="stylesheet" href="<?php echo e(asset('resources')); ?>/css/styles.css">
	<link rel="stylesheet" href="<?php echo e(asset('resources')); ?>/css/bootstrap.min.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<!-- Fonts -->
  	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
					<h6>NCLEX PAYMENT DETAILS</h6>
				</div>
				<div class="col-md-3 small_title" style="padding-top: 30px;">
				<span>{{auth()->user()->name}}</span><br>
                        <span>{{auth()->user()->email}}</span><br>
                        <span>{{auth()->user()->mobile}}</span>
				</div>
			</section>
			<section class="row">
				<div class="col-md-9 no_padding">
					<div class="small_title">
						<h3>NCLEX PREP > PAYMENT DETAILS</h3>
					</div>
					<div class="home_signin">
						<h3><a href="<?php echo url('/userpage');?>">HOME </a> / PAYMENT DETAILS</h3>
					</div>
					<div class="bgcolour">
						<h6 class="construction">COMMING SOON</h6>
    				</div>
				</div>
				<div class="col-md-3 bg_color sidebar">
					<ul class="list-inline">
                            <li><a href="{{ route('myaccount') }}"><span><i class="fas fa-home"></i></span>My Account</a></li>
                            <li><a href="{{ route('exam_history') }}"><span><i class="fas fa-edit"></i></span>Exam History</a></li>
                            <li><a href="{{route('construction')}}"><span><i class="fas fa-dollar-sign"></i></span>Payment Details</a></li>
                            <li><a href="{{route('examlist')}}"><span><i class="far fa-edit"></i></span>Exams</a></li>
                            <li><a href="#costumModal20" data-toggle="modal"><span><i class="fas fa-pencil-alt"></i></span>Feedback</a></li>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();"><span><i class="fas fa-sign-out-alt"></i></span>Logout</a></li>
                        </ul>
					<div class="start_exam">
						<input type="button" name="" class="btn btn-success" value="START EXAM">
					</div>
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
<style type="text/css">
	.construction {
    text-shadow: 0 1px 0 #b1a8d6, 0 2px 0 #b1a8d6, 0 3px 0 #bbb, 0 4px 0 #b9b9b9, 0 5px 0 #aaa, 0 6px 1px rgb(0 0 0 / 10%), 0 0 5px rgb(0 0 0 / 10%), 0 1px 3px rgb(0 0 0 / 30%), 0 3px 5px rgb(0 0 0 / 20%), 0 5px 10px rgb(0 0 0 / 25%), 0 10px 10px rgb(0 0 0 / 20%), 0 20px 20px rgb(0 0 0 / 15%);
    margin: 0 auto;
    text-align: center;
    bottom: 0;
    left: 0;
    right: 0;
    font-size: 65px;
    color: #fff;
    font-style: italic;
    position: absolute;
    top: 48vh;
}
.bgcolour {
    min-height: 80vh;
}
</style>
