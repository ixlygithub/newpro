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
    
                    <div id="wrapper">
                        <div id="login" class="sign_form animate form">
                            <div class="col-md-5" style="margin: 0 auto;">
                                <h6>RESET PASSOWORD</h6>
                                    <form class="form" method="post" action="{{ route('password.update') }}">
                                    @csrf
                                    @include('alerts.success')
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="form-group">
                                        <label for="email">E-Mail</label>
                                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}">
                                        @include('alerts.feedback', ['field' => 'email'])
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Password</label>
                                        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}">
                                        @include('alerts.feedback', ['field' => 'password'])
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm Password') }}">
                                    </div>
                                    <div class="form-group text-center">
                                        <input type="submit" name="" value="{{ __('Reset Password') }}" class="btn btn-warning">
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

