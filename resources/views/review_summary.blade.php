<!DOCTYPE html>
<html>
<head>
	<title>QUESTION</title>
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
			<section class="row">
				<div class="col-md-9 no_padding" style="border: none;">
					<div class="para_title account_details">
						<div class="row exam_details">
						<div class="col-md-4">
							<h5>Total Questions</h5>
							<h1>10</h1>
						</div>
						<div class="col-md-4 bl_border">
							<h5>Correct Questions</h5>
							<h1>7</h1>
						</div>
						<div class="col-md-4">
							<h5>Incorrect Questions</h5>
							<h1>3</h1>
						</div>
						</div>
					</div>
					<div class="tab_content exam_tab">
						<ul class="nav nav-tabs small_title" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link" id="edit_profile-tab" data-toggle="tab" href="#edit_profile" role="tab" aria-controls="edit_profile" aria-selected="true"><span><i class="far fa-clock"></i></span>Total Time : 1:00 Hr
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="exams_left-tab" data-toggle="tab" href="#exams_left" role="tab" aria-controls="exams_left" aria-selected="false"><span><i class="fas fa-check-circle"></i></span>Correct: 7%</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="exams_list-tab" data-toggle="tab" href="#exams_list" role="tab" aria-controls="exams_list" aria-selected="false"><span><i class="fas fa-times-circle"></i></span>Incorrect : 3%</a>
							</li>
						</ul>
					</div>
					<div class="home_signin">
						<h3>HOME / Questions / Review Summary</h3>
					</div>
					<div class="bgcolour">
						<div class="row">
				            <div class="col-md-12">
				            	<div class="heading">
				            		<h6>Alternate Format Test 4</h6>
				            	</div>
				                <!-- Tabs content -->
				                <div class="tab-content" id="v-pills-tabContent">
				                    <div class="tab-pane fade shadow rounded bg-white p-5 active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
				                       <div class="table-responsive">
											<table class="table table-striped">
												<thead>
													<tr>
														<th scope="col"></th>
														<th scope="col">Question</th>
														<th scope="col">Category</th>
														<th scope="col"> Time</th>
														<th scope="col"> Review</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<th scope="row"><i class="fas fa-times-circle"></i></th>
														<th>A newborn client has a diagnosis of respiratory depression. A dose of naloxon?</th>
														<td>Safety and Infection Control</td>
														<td>00:00</td>
														<td><a href="#" type="button" class="btn btn-success">Review</a></td>
													</tr>
													<tr>
														<th scope="row"><i class="fas fa-plus-circle"></i></th>
														<th>A newborn client has a diagnosis of respiratory depression. A dose of naloxon?</th>
														<td>Safety and Infection Control</td>
														<td>00:00</td>
														<td><a href="#" type="button" class="btn btn-success">Review</a></td>
													</tr>
													<tr>
														<th scope="row"><i class="fas fa-times-circle"></i></th>
														<th>A newborn client has a diagnosis of respiratory depression. A dose of naloxon?</th>
														<td>Safety and Infection Control</td>
														<td>00:00</td>
														<td><a href="#" type="button" class="btn btn-success">Review</a></td>
													</tr>
													<tr>
														<th scope="row"><i class="fas fa-times-circle"></i></th>
														<th>A newborn client has a diagnosis of respiratory depression. A dose of naloxon?</th>
														<td>Safety and Infection Control</td>
														<td>00:00</td>
														<td><a href="#" type="button" class="btn btn-success">Review</a></td>
													</tr>
													<tr>
														<th scope="row"><i class="fas fa-minus-circle"></i></th>
														<th>A newborn client has a diagnosis of respiratory depression. A dose of naloxon?</th>
														<td>Safety and Infection Control</td>
														<td>00:00</td>
														<td><a href="#" type="button" class="btn btn-success">Review</a></td>
													</tr>
													<tr>
														<th scope="row"><i class="fas fa-minus-circle"></i></th>
														<th>A newborn client has a diagnosis of respiratory depression. A dose of naloxon?</th>
														<td>Safety and Infection Control</td>
														<td>00:00</td>
														<td><a href="#" type="button" class="btn btn-success">Review</a></td>
													</tr>
												</tbody>
											</table>
										</div>
				                    </div>
				                </div>
				            </div>
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
							<li><a href=""><span><i class="far fa-edit"></i></span>Feedback</a></li>
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
<style type="text/css">
	.table tbody th, .table tbody td {
   
    text-transform: capitalize;
}
.exam_details h1{
	margin-bottom: 30px;
}
.nav-link{
	cursor: default;
	text-transform: uppercase;
    font-family: 'Poppins-SemiBold';
}
.nav-link.active {
    background-color: #F78105 !important;
}
.heading h6 {
    text-transform: uppercase;
    margin-bottom: 20px;
    font-family: 'Poppins-SemiBold';
}
.tab-content i.fas.fa-plus-circle {
    color: lawngreen;
}
.tab-content i.fas.fa-times-circle {
    color: red;
}
.table .btn-success {
    color: #fff !important;
    background-color: #08CFD5 !important;
    border-color: #08CFD5 !important;
    padding: 4px 5px 4px 5px !important;
    font-size: 13px !important;
    font-family: 'Poppins-SemiBold' !important;
}
</style>