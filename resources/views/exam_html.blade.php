@extends('layouts.front_app', ['class' => 'account-page', 'page' => __('My Account Page'), 'contentClass' => 'account-page','pageSlug' => 'my-account'])
@section('content')
	
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
		
			<section class="row border">
				<div class="col-md-9 no_padding">
					<div class="para_title" style="border-right: none;">
						<h6>Exams</h6>
					</div>
					<div class="small_title">
						<h3>NCLEX PREP > Exams</h3>
					</div>
					<div class="home_signin">
						<h3>HOME / Exams </h3>
					</div>
					<div class="bgcolour">
                    <div class="panel">
                        <div class="panel-body table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Test Name</th>
                                        <th>Mark</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>May - I - 2021</td>
                                        <td>100</td>
                                        <td>Pass</td>
                                        <td>12-05-2021</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>May - I - 2021</td>
                                        <td>100</td>
                                        <td>Pass</td>
                                        <td>12-05-2021</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>May - I - 2021</td>
                                        <td>100</td>
                                        <td>Pass</td>
                                        <td>12-05-2021</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>May - I - 2021</td>
                                        <td>100</td>
                                        <td>Pass</td>
                                        <td>12-05-2021</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>May - I - 2021</td>
                                        <td>100</td>
                                        <td>Pass</td>
                                        <td>12-05-2021</td>
                                    </tr>
                                </tbody>
                            </table>
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
							<li><a href=""><span><i class="fas fa-sign-out-alt"></i></span>Logout</a></li>
						</ul>
						<div class="start_exam det_exam">
						<input type="button" name="" class="btn btn-success" value="START EXAM">
						</div>
					</div>
				</div>
			</section>
		</div>
		@endsection