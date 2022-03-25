@extends('layouts.front_app', ['class' => 'account-page', 'page' => __('My Account Page'), 'contentClass' => 'account-page','pageSlug' => 'my-account'])
@section('content')
			<section class="row">
				<div class="col-md-9 no_padding" style="border: none;">
					<div class="para_title account_details">
						<div class="row exam_details">
							<div class="col-md-4">
								<h5>Passed Exams</h5>
								<h1><?php echo count($pass_exam_count); ?></h1>
								<p class="text-right"><a href="{{ route('exams', ['id' => 1]) }}" style="color:#fff;">View all...</a></p>
							</div>
							<div class="col-md-4 bl_border">
								<h5>Exams Left</h5>
								<h1><?php echo count($quit_exam_count); ?></h1>
								<p class="text-right"><a href="{{ route('exams', ['id' => 2]) }}" style="color:#fff;">View all...</a></p>
							</div>
							<div class="col-md-4">
								<h5>Exams List</h5>
								<h1><?php echo count($all_exam_count); ?></h1>
								<p class="text-right"><a href="{{ route('exams', ['id' => 3]) }}" style="color:#fff;padding-right: 12px;">View all...</a></p>
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
								<a class="nav-link" id="changepassword-tab" data-toggle="tab" href="#changepassword" role="tab" aria-controls="changepassword" aria-selected="true"><span><i class="fas fa-lock-open"></i></span>Change Password</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="exams_list-tab" data-toggle="tab" href="#exams_list" role="tab" aria-controls="exams_list" aria-selected="false"><span><i class="far fa-address-card"></i></span>Pan Details</a>
							</li>
						</ul>
					</div>
					<div class="home_signin">
							<h3><a href="<?php echo url('/userpage');?>">HOME </a>/ <a href="<?php echo url('/myaccount');?>">Account </a> / <a href="<?php echo url('/myaccount');?>">Edit your account </a></h3>
					</div>
					<div class="edit_profile">
					    
					 @include('alerts.success')
					 @include('alerts.success', ['key' => 'password_status'])
						<h5>Edit your account</h5>
						@if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>    
                <strong>{{ $message }}</strong>
            </div>
          @endif
						<div class="tab-content sign_form" id="myTabContent">
							<div class="tab-pane fade show " id="edit_profile" role="tabpanel" aria-labelledby="edit_profile-tab">
								<form method="post" action="{{ route('updateaccount') }}" autocomplete="off">
								 	@csrf
                            		@method('put')

                            	
								<div class="row">
									<div class="form-group col-md-6">
										<label for="name">First Name</label>
		    							<input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" value="<?php echo auth()->user()->name; ?>" name="name">
									    @include('alerts.feedback', ['field' => 'name'])
									</div>
									<div class="form-group col-md-6">
										<label for="last_name">Last Name</label>
		    							<input type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" id="last_name" value="<?php echo auth()->user()->last_name; ?>" name="last_name">
									    @include('alerts.feedback', ['field' => 'last_name'])
									</div>
								</div>
								<div class="form-group">
									<label for="address">Address</label>
	    							<input type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" id="address" value="<?php echo auth()->user()->address; ?>" name="address">
								    @include('alerts.feedback', ['field' => 'address'])
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label for="city">City</label>
		    							<input type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" id="city" value="<?php echo auth()->user()->city; ?>" name="city">
									    @include('alerts.feedback', ['field' => 'city'])
									</div>
									<div class="form-group col-md-6">
										<label for="zip_code">Zip Code</label>
		    							<input type="text" class="form-control{{ $errors->has('zip_code') ? ' is-invalid' : '' }}" id="zip_code" value="<?php echo auth()->user()->zip_code; ?>" name="zip_code">
									    @include('alerts.feedback', ['field' => 'zip_code'])
									</div>
								</div>
								<div class="form-group">
									<!--<label for="country">Country</label>-->
										<input type="hidden" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" id="country" value="USA" name="country">
	    							<!--<select class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" name="country">-->
	    							<!--	<option value="">[-Select-]</option>-->
	    							<!--	<option value="USA" <?php if (auth()->user()->country == 'USA') { echo 'selected'; } ?>>USA</option>-->
	    							<!--</select>-->
	    							@include('alerts.feedback', ['field' => 'country'])
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label for="mobile">Mobile Number</label>
		    							<input type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" id="mobile" value="<?php echo auth()->user()->mobile; ?>" name="mobile">
									@include('alerts.feedback', ['field' => 'mobile'])
									</div>
									<div class="form-group col-md-6">
										<label for="email">E-Mail</label>
		    							<input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" value="<?php echo auth()->user()->email; ?>" name="email">
									@include('alerts.feedback', ['field' => 'email'])
									</div>
								</div>
								<div class="form-group text-center">
									<button type="submit" name="" value="save" class="btn btn-warning">{{ __('Save') }}</button>
								</div>
							</form>
							</div>

							<div class="tab-pane fade show" id="changepassword" role="tabpanel" aria-labelledby="changepassword-tab">
								<form  method="post" action="{{ route('profile.change-password') }}">
								 @csrf
                                 @method('put')

                        
                                 <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">   
								
									<label for="address">Current Password</label>
	    							 <input type="password" name="old_password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required min="8">
                            @include('alerts.feedback', ['field' => 'old_password'])
								</div>
								 <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
									<label for="address">New Password</label>
	    							<input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required min="8">
                            @include('alerts.feedback', ['field' => 'password'])
								</div>
								<div class="form-group">
									<label for="address">Confirm Password</label>
	    							 <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm New Password') }}" value="" required min="8">
								</div>
								
								
								<div class="form-group text-center">
									<input type="submit" name="" value="save" class="btn btn-warning" onclick="addactive('changepassword')">
								</div>
							</form>
							</div>
							<div class="tab-pane fade" id="exams_list" role="tabpanel" aria-labelledby="exams_list-tab">
								<form method="post" action="{{ route('updatepan') }}" autocomplete="off">
								    @csrf
                                    @method('put')
									<div class="form-group">
										<label for="pan_no">Pan No</label>
		    							<input type="number" min="10" pattern="[1-9]{1}[0-9]{9}" required class="form-control" id="pan_no" value="{{auth()->user()->pan_no}}" name="pan_no">
									    @include('alerts.feedback', ['field' => 'pan_no'])
									</div>
									<div class="form-group text-center">
										<button type="submit" name="" value="save" class="btn btn-warning">{{ __('Save') }}</button>
									</div>
								</form>
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
