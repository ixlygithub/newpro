<!DOCTYPE html>
<html>
<head>
	<title>MY ACCOUNT</title>
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
			<section class="row">
				<div class="col-md-9 no_padding" style="border: none;">
					<div class="para_title account_details">
						<div class="row exam_details">
						<div class="col-md-4">
							<h5>Passed Exams</h5>
							<h1>9</h1>
							<p class="text-right"><a>View all...</a></p>
						</div>
						<div class="col-md-4 bl_border">
							<h5>Exams Left</h5>
							<h1>2</h1>
							<p class="text-right"><a>View all...</a></p>
						</div>
						<div class="col-md-4">
							<h5>Exams List</h5>
							<h1>11</h1>
							<p class="text-right"><a style="padding-right: 12px;">View all...</a></p>
						</div>
						</div>
					</div>
					<div class="tab_content exam_tab">
						<ul class="nav nav-tabs small_title" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link" id="edit_profile-tab" data-toggle="tab" href="#edit_profile" role="tab" aria-controls="edit_profile" aria-selected="true"><span><i class="far fa-user"></i></span>Edit Account
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="exams_left-tab" data-toggle="tab" href="#exams_left" role="tab" aria-controls="exams_left" aria-selected="false"><span><i class="fas fa-lock-open"></i></span>Change Password</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="exams_list-tab" data-toggle="tab" href="#exams_list" role="tab" aria-controls="exams_list" aria-selected="false"><span><i class="far fa-address-card"></i></span>Pan Details</a>
							</li>
						</ul>
					</div>
					<div class="home_signin">
						<h3>HOME / account / Edit your account</h3>
					</div>
					<div class="edit_profile">
						<h5>Edit your account</h5>
						<div class="tab-content sign_form" id="myTabContent">
							<div class="tab-pane fade show active" id="edit_profile" role="tabpanel" aria-labelledby="edit_profile-tab">
								<form name="edit_profile" id="edit_profile" class="">
								<div class="row">
									<div class="form-group col-md-6">
										<label for="email">First Name</label>
		    							<input type="fname" class="form-control" id="fname" aria-describedby="emailHelp">
									</div>
									<div class="form-group col-md-6">
										<label for="fname">Last Name</label>
		    							<input type="email" class="form-control" id="fname" aria-describedby="emailHelp">
									</div>
								</div>
								<div class="form-group">
									<label for="address">Address</label>
	    							<input type="text" class="form-control" id="address" aria-describedby="emailHelp">
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label for="email">City</label>
		    							<input type="fname" class="form-control" id="fname" aria-describedby="emailHelp">
									</div>
									<div class="form-group col-md-6">
										<label for="fname">Zip Code</label>
		    							<input type="email" class="form-control" id="fname" aria-describedby="emailHelp">
									</div>
								</div>
								<div class="form-group">
									<label for="address">Country</label>
	    							<select class="form-control">
	    								<option value="">[-Select-]</option>
	    								<option value="">INDIA</option>
	    							</select>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label for="email">Phone Number</label>
		    							<input type="fname" class="form-control" id="fname" aria-describedby="emailHelp">
									</div>
									<div class="form-group col-md-6">
										<label for="fname">E-Mail</label>
		    							<input type="email" class="form-control" id="fname" aria-describedby="emailHelp">
									</div>
								</div>
								<div class="form-check text-center">
  									<label class="form-check-label">
    									<input type="checkbox" class="form-check-input" value="">Use this address for Billing

  									</label>
								</div>
								<div class="form-group text-center">
									<input type="submit" name="" value="save" class="btn btn-warning">
								</div>
							</form>
							</div>
							<div class="tab-pane fade" id="exams_left" role="tabpanel" aria-labelledby="exams_left-tab"></div>
							<div class="tab-pane fade" id="exams_list" role="tabpanel" aria-labelledby="exams_list-tab">...</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 no_padding">
					<div class="small_title" style="padding-top: 30px;padding-bottom: 28px;">
						<span>John Deo</span><br>
						<span>demo@demo.com</span><br>
						<span>+44 654 321 0789</span>
					</div>
					<div class="bg_color sidebar">
						<ul class="list-inline">
							<li><a href=""><span><i class="fas fa-home"></i></span>My Account</a></li>
							<li><a href=""><span><i class="fas fa-edit"></i></span>Exam History</a></li>
							<li><a href=""><span><i class="fas fa-dollar-sign"></i></span>Payment Details</a></li>
							<li><a href=""><span><i class="far fa-edit"></i></span>Exams</a></li>
							<li><a href=""><span><i class="fas fa-sign-out-alt"></i></span>Logout</a></li>
						</ul>
						<div class="start_exam det_exam">
						<input type="button" name="" class="btn btn-success" value="START EXAM">
						</div>
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