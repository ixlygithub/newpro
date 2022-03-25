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
                        @include('alerts.success')
                        <div id="login" class="sign_form animate form">
                            <div class="col-md-5" style="margin: 0 auto;">
                                <h6>RESET PASSOWORD</h6>
                                    <form class="form" method="post" action="{{ route('password.email') }}">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="email">E-Mail</label>
                                        <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="far fa-envelope"></i>
                                                </div>
                                            </div>
                                            <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}">
                                            @include('alerts.feedback', ['field' => 'email'])
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <input type="submit" name="" value="{{ __('Send Password Reset Link') }}" class="btn btn-warning">
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

