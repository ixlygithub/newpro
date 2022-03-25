@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Edit Profile') }}</h5>
                </div>
                <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                    <div class="card-body">
                            @csrf
                            @method('put')

                            @include('alerts.success')

                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label>{{ __('Name') }}</label>
                                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}">
                                @include('alerts.feedback', ['field' => 'name'])
                                <input type="hidden" name="last_name" value="admin">
                                <input type="hidden" name="address" value="admin">
                                <input type="hidden" name="city" value="admin">
                                <input type="hidden" name="zip_code" value="000000">
                                <input type="hidden" name="country" value="India">
                                <input type="hidden" name="mobile" value="0000000000">
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label>{{ __('Email address') }}</label>
                                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email address') }}" value="{{ old('email', auth()->user()->email) }}">
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Password') }}</h5>
                </div>
                <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @method('put')

                        @include('alerts.success', ['key' => 'password_status'])

                        <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                            <label>{{ __('Current Password') }}</label>
                            <input type="password" name="old_password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>
                            @include('alerts.feedback', ['field' => 'old_password'])
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label>{{ __('New Password') }}</label>
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
                            @include('alerts.feedback', ['field' => 'password'])
                        </div>
                        <div class="form-group">
                            <label>{{ __('Confirm New Password') }}</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm New Password') }}" value="" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Change password') }}</button>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Social Links') }}</h5>
                </div>
                <form method="post" action="{{ route('profile.social') }}" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @method('put')

                         @include('alerts.success', ['key' => 'social_status'])

                        <div class="form-group{{ $errors->has('facebook') ? ' has-danger' : '' }}">
                            <label>{{ __('Facebook') }}</label>
                            <input type="text" name="facebook" required class="form-control{{ $errors->has('facebook') ? ' is-invalid' : '' }}" placeholder="{{ __('Facebook URL') }}" value="{{ auth()->user()->facebook }}">
                            @include('alerts.feedback', ['field' => 'facebook'])
                        </div>

                        <div class="form-group{{ $errors->has('twitter') ? ' has-danger' : '' }}">
                            <label>{{ __('Twitter') }}</label>
                            <input type="text" name="twitter" required  class="form-control{{ $errors->has('twitter') ? ' is-invalid' : '' }}" placeholder="{{ __('Twitter URL') }}" value="{{ auth()->user()->twitter }}">
                            @include('alerts.feedback', ['field' => 'twitter'])
                        </div>
                        <div class="form-group">
                            <label>{{ __('Google Plus') }}</label>
                            <input type="text" name="google_plus" required  class="form-control" placeholder="{{ __('Google Plus URL') }}" value="{{ auth()->user()->google_plus }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-user">
                <div class="card-body">
                    <p class="card-text">
                        <div class="author">
                            <div class="block block-one"></div>
                            <div class="block block-two"></div>
                            <div class="block block-three"></div>
                            <div class="block block-four"></div>
                            <a href="#">
                                <img class="avatar" src="{{ asset('black') }}/img/emilyz.jpg" alt="">
                                <h5 class="title">{{ auth()->user()->name }}</h5>
                                <h5 class="title">{{ auth()->user()->email }}</h5>
                            </a>
                        </div>
                    </p>
                </div>
                <div class="card-footer">
                    <div class="button-container">
                        <button class="btn btn-icon btn-round btn-facebook">
                            <a style="color:#fff;" href="{{ auth()->user()->facebook }}"><i class="fab fa-facebook"></i></a>
                        </button>
                        <button class="btn btn-icon btn-round btn-twitter">
                            <a style="color:#fff;" href="{{ auth()->user()->twitter }}"><i class="fab fa-twitter"></i></a>
                        </button>
                        <button class="btn btn-icon btn-round btn-google">
                            <a style="color:#fff;" href="{{ auth()->user()->google_plus }}"><i class="fab fa-google-plus"></i></a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
