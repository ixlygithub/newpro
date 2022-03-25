@extends('layouts.app', ['pageSlug' => 'weightage'])
@push('style')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">

          @if(session()->has('message'))
            <p class="btn btn-success btn-block btn-sm custom_message text-left">{{ session()->get('message') }}</p>
          @endif
        <div class="card">  
            <div class="card-header">
                    <h5 class="title">Add Weightage</h5>
                </div>
            <div class="card-body">

          <form action="{{ route('addweightage') }}" method="post">
            @csrf
            <div class="form-group">
              <label for="">Weightage</label>
              <input type="text" class="form-control" name="weightage_title" value="{{ old('weightage_title') }}" placeholder="Enter weightage" required>
              <font style="color:red"> {{ $errors->has('weightage_title') ?  $errors->first('weightage_title') : '' }} </font>
            </div>
             <div class="form-group">
              <label for="">Rating</label>
              <input type="number" class="form-control" name="rating" value="{{ old('rating') }}" placeholder="Enter rating">
              <font style="color:red"> {{ $errors->has('rating') ?  $errors->first('rating') : '' }} </font>
            </div>
            <div class="form-group" style="margin-top: 24px;">
              <input type="submit" class="btn btn-primary" value="Submit">
            </div>

          </form>
          </div>
          </div>
        </div>
    </div>
</div>
@endsection