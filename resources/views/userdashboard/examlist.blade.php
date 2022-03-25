@extends('layouts.front_app', ['class' => 'account-page', 'page' => __('My Account Page'), 'contentClass' => 'account-page','pageSlug' => 'examlist'])
@section('content')
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('resources')); ?>/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('resources')); ?>/css/animate-custom.css" />

            <section class="row border">
                <div class="col-md-9 no_padding" style="border-right:none">
                    <div class="para_title">
                        <h6>Exam List</h6>
                    </div>
                    <div class="small_title" style="border-right: 1px solid #fff;border-top: 1px solid #fff;">
						<h3>Exam List</h3>
					</div>
                    <div class="home_signin">
                          <h3><a href="<?php echo url('/userpage');?>">HOME </a>/ <a href="<?php echo url('/examlist');?>">Exam list </a> </h3>
                    </div>
                     @if(session()->has('error'))
            <p class="btn btn-danger btn-block btn-sm custom_message text-left">{{ session()->get('error') }}</p>
          @endif
                     
                    <div id="wrapper" class="bgcolour">
           
  <table class="table" id="exam">
    <thead>
      <tr>
        <th>id</th>
        <th>Test</th>
        <th>Hours</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      
    </tbody>
  </table>
                        
                    </div>
                </div>
              @include('layouts.profile_sidebar')
            </section>
   
@endsection
<style type="text/css">
      .tab-content>.active {
    display: block;
    opacity: 1;
}
.dataTable .btn-success {
    color: #fff !important;
    background-color: #08CFD5 !important;
    border-color: #08CFD5 !important;
    padding: 4px 5px 4px 5px !important;
    font-size: 13px !important;
    font-family: 'Poppins-SemiBold' !important;
}
    </style>


   
  
