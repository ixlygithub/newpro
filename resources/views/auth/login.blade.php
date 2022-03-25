@extends('layouts.front_app', ['class' => 'login-page', 'page' => __('Login Page'), 'contentClass' => 'login-page','pageSlug' => 'login'])
<!-- Fonts -->
  
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

@section('content')

        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('resources')); ?>/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('resources')); ?>/css/animate-custom.css" />
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
                     @if(session()->has('error'))
            <p class="btn btn-danger btn-block btn-sm custom_message text-left">{{ session()->get('error') }}</p>
          @endif
                     <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="sign_form animate form">
                            <div class="col-md-5" style="margin: 0 auto;">
                                <h6>SIGN IN</h6>
                                <form name="signin" id="signin" class="" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">E-Mail</label>
                                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}">
                                         @include('alerts.feedback', ['field' => 'email'])
                                         <input type="hidden" name="role" value="user">

                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" placeholder="{{ __('Password') }}" name="password" id="password-field" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                                       	<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        @include('alerts.feedback', ['field' => 'password'])
                                    </div>
                                    <div class="form-group text-center">
                                        <input type="submit" name="" value="login" class="btn btn-warning">
                                    </div>
                                   
                                </form>
                                <div class="form-group form_link">
                                    <p><a href="#toregister" class="to_register">OR Sign UP using Email</a></p>
                                    <p><a href="{{ route('password.request') }}">forgot password?</a> <a>Reset it</a><p>
                                    <p><a href="#">Nurse Plus Academy</a></p>
                                </div>
                            </div>
                        </div>
                        <div id="register" class="sign_form animate form">
                            <div class="col-md-5" style="margin: 0 auto;">
                                <h6> Sign up </h6> 
                                <form  action="{{ route('register') }}"  class="form" method="post"> 
                                 @csrf
                                    <div class="form-group"> 
                                        <label for="usernamesignup" class="uname" data-icon="u">Your username</label>
                                      <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}">
                            @include('alerts.feedback', ['field' => 'name'])
                                    </div>
                                    <div class="form-group"> 
                                        <label for="emailsignup" class="youmail" data-icon="e" > Your email</label>
                                       <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}">
                            @include('alerts.feedback', ['field' => 'email'])
                                    </div>
                                    <div class="form-group">  
                                        <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
                                    <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}">
                            @include('alerts.feedback', ['field' => 'password'])
                                   </div>
                                    <div class="form-group"> 
                                        <label for="" class="youpasswd" data-icon="p">Please confirm your password </label>
                                       <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm Password') }}">
                                   </div>
                                    <div class="form-group text-center">
                                        <input type="submit" value="Sign up" class="btn btn-warning" /> 
                                    </div>
                                   <div class="form-group form_link">
                                        <p><a href="#tologin" class="to_register">Login</a></p>
                                    </div>
                                </form>
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

@endsection

