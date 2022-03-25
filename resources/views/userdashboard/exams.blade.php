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
					
						<h3><a href="<?php echo url('/userpage');?>">HOME </a>/ <a href="<?php echo url('/myaccount');?>">MY ACCOUNT </a>/<a href="<?php echo url()->full();?>">Exams </a> </h3>
					</div>
					<div class="bgcolour">
                    <div class="panel">
                        <div class="panel-body table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Test Name</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach ($exams as $exam) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $exam->test_name; ?></td>
                                            <td><?php echo $exam->test_result; ?></td>
                                            <td><?php echo date('d-m-Y',strtotime($exam->created_at)); ?></td>
                                        </tr>
                                    <?php $i++;} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
				</div>
				@include('layouts.profile_sidebar')
			</section>
		</div>
		@endsection