@extends('layouts.front_app', ['class' => 'account-page', 'page' => __('My Account Page'), 'contentClass' => 'account-page','pageSlug' => 'my-account'])
@section('content')
 <!--   <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>-->
	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>-->
			<section class="row">
				<div class="col-md-9 no_padding" style="border: none;">
					
					<div class="para_title border" style="border-right: 1px solid #fff !important;">
					<h6>NCLEX MASTERY QUESTIONS</h6>
				</div>
				
					<div class="small_title" style="border-right: 1px solid #fff;">
						<h3>NCLEX PREP > NCLEX MASTERY QUESTIONS</h3>
					</div>
					<div class="home_signin">
						<h3><a href="<?php echo url('/userpage');?>">HOME </a>/ QUESTIONS / NCLEX MASTERY QUESTIONS</h3>
					</div>
					@if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>    
                <strong>{{ $message }}</strong>
            </div>
            @endif
					<div class="bgcolour">
						<div class="row">
				            <div class="col-md-3">
				                <!-- Tabs nav -->
				                <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
				                    <a class="nav-link active mb-3 p-3 shadow" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
				                        <i class="fa fa-file-text mr-2"></i>
				                        <span class="font-weight-bold small text-uppercase">UNANSWERED</span></a>

				                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
				                        <i class="fa fa-calendar-minus-o mr-2"></i>
				                        <span class="font-weight-bold small text-uppercase">ANSWERED</span></a>

				                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
				                        <i class="fa fa-star mr-2"></i>
				                        <span class="font-weight-bold small text-uppercase">Wrong</span></a>

				                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">
				                        <i class="fa fa-check mr-2"></i>
				                        <span class="font-weight-bold small text-uppercase">Correct</span></a>
				                    </div>
				            </div>

				            <div class="col-md-9">
				                <!-- Tabs content -->
				                <div class="tab-content" id="v-pills-tabContent">
				                    <div class="tab-pane fade shadow rounded bg-white p-5 active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
				                       <div class="table-responsive">
											<table class="table table-striped">
												<thead>
													<tr>
														<th scope="col">Count Of Questions</th>
														<th scope="col">Category</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($unanswers as $key => $unanswer) { ?>
														<tr>
															<th scope="row"><?php echo $unanswer->num_items; ?></th>
															<td><?php echo $unanswer->category_name; ?></td>
														</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
				                    </div>
				                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
				                       <div class="table-responsive">
											<table class="table table-striped">
												<thead>
													<tr>
														<th scope="col">Count Of Questions</th>
														<th scope="col">Category</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($answers as $key => $answer) { ?>
														<tr>
															<th scope="row"><?php echo $answer->num_items; ?></th>
															<td><?php echo $answer->category_name; ?></td>
														</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
				                    </div>
				                    
				                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
				                     	<div class="table-responsive">
											<table class="table table-striped">
												<thead>
													<tr>
														<th scope="col">Count Of Questions</th>
														<th scope="col">Category</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($wrong_ans as $key => $wrong_an) { ?>
														<tr>
															<th scope="row"><?php echo $wrong_an->num_items; ?></th>
															<td><?php echo $wrong_an->category_name; ?></td>
														</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
				                    </div>
				                    
				                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
				                    	<div class="table-responsive">
											<table class="table table-striped">
												<thead>
													<tr>
														<th scope="col">Count Of Questions</th>
														<th scope="col">Category</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($correct_ans as $key => $correct_an) { ?>
														<tr>
															<th scope="row"><?php echo $correct_an->num_items; ?></th>
															<td><?php echo $correct_an->category_name; ?></td>
														</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
				                    </div>
				                    
				                </div>
				            </div>
        				</div>
    				</div>
				</div>
				@include('layouts.profile_sidebar')
			</section>
		</div>
		<style type="text/css">
			.tab-content>.active {
    display: block;
    opacity: 1;
}
		</style>
		@endsection
