@extends('layouts.front_app', ['class' => 'account-page', 'page' => __('My Account Page'), 'contentClass' => 'account-page','pageSlug' => 'examlist'])
@section('content')
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('resources')); ?>/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('resources')); ?>/css/animate-custom.css" />
        <script type="text/javascript">
        $(document).ready(function (){
    var reviewsummary = $('#reviewsummary').DataTable({
       // dom: 'lrtip'
    });
    
    $('.resultans').on('change', function(){

       reviewsummary.search(this.value).draw();   
    });
});
  
        	
        </script>
        
<section class="row border">
<div class="col-md-9 no_padding" style="border: none;">
					<div class="para_title account_details">
						<div class="row exam_details">
						<div class="col-md-4">
							<h5>Total Questions</h5>
							<h1><?php echo $total=count($taketest);?></h1>
						</div>
						<div class="col-md-4 bl_border">
							<h5>Correct Questions</h5>
							<h1><?php echo $correct;?></h1>
						</div>
						<div class="col-md-4">
							<h5>Incorrect Questions</h5>
							<h1><?php echo $incorrect;?></h1>
						</div>
						</div>
					</div>
					<div class="tab_content exam_tab">
						<ul class="nav nav-tabs small_title" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link" id="edit_profile-tab" data-toggle="tab" href="#edit_profile" role="tab" aria-controls="edit_profile" aria-selected="true"><span><i class="far fa-clock"></i></span>Total Time : <?php echo $tests->hours;?><br>
								<span><i class="far fa-clock"></i></span>
								Time  Taken: <?php echo $usertest->time_taken;
								?>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="exams_left-tab" data-toggle="tab" href="#exams_left" role="tab" aria-controls="exams_left" aria-selected="false"><span><i class="fas fa-check-circle"></i></span>Correct: <?php echo round($correct/$total*100);?>%</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="exams_list-tab" data-toggle="tab" href="#exams_list" role="tab" aria-controls="exams_list" aria-selected="false"><span><i class="fas fa-times-circle"></i></span>Incorrect : <?php echo round($incorrect/$total*100);?></a>
							</li>
						</ul>
					</div>
					<div class="home_signin">
						
						<h3><a href="<?php echo url('userpage')?>">HOME</a> /<a href="<?php echo url('examlist')?>">Exam</a> /<a href="<?php echo url("/review_summary/{$usertest->id}");?>">REVIEW SUMMARY</a> </h3>
					</div>
					<div class="bgcolour">
						<div class="row">
				            <div class="col-md-12">
				            	<div class="heading">
				            		<h6><?php echo $tests->test_name;?></h6>
				            	</div>
				                <!-- Tabs content -->
				                <div class="tab-content" id="v-pills-tabContent">
				                    <div class="tab-pane fade shadow rounded bg-white p-5 active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
				                       <div class="table-responsive">
				                       <div class="row">
				            <div class="col-md-6">Question Result 
				                       <select class="form-control resultans" >
				                       <option value="">select</option>
				                       	<option value="right">Right</option>
				                       	<option value="wrong">Wrong</option>
				                       	<option value="notanswer">notanswer</option>
				                       </select>
				                       </div>
				                       </div>
											<table class="table table-striped" id="reviewsummary">
												<thead>
													<tr>
														<th scope="col"></th>
														<th scope="col">Question</th>
														<th scope="col">Category</th>
														<th scope="col">Question status</th>
														<th scope="col"> Review</th>
													</tr>
												</thead>
												<tbody>
												<?php foreach($taketest as $val){?>

														<tr>
														<?php
													$result = $val['question_result'];

													switch ($result) {
													  case "right":
													    echo '<th scope="row"><i class="fas fa-plus-circle"></i></th>';
													    break;
													  case "wrong":
													     echo '<th scope="row"><i class="fas fa-times-circle"></i></th>';
													    break;
													  case "notanswer":
													   echo '<th scope="row"><i class="fas fa-minus-circle"></i></th>';
													    break;
													 
													}
													?>
														
														<th><?php echo $val['questions'];?>?</th>
														<td><?php echo $val['category'];?></td>
														<td><?php echo $val['question_result'];?></td>
														<td><a href="<?php echo url("/question_summary/{$usertest->id}/{$val['question_id']}");?>" type="button" class="btn btn-success">Review</a></td>
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
 @endsection
 
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