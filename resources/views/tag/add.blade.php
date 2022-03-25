@extends('layouts.app', ['pageSlug' => 'tags'])
@push('style')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
         @if ($message = Session::get('success'))
            <div class="btn btn-success btn-block btn-sm custom_message text-left">
                <button type="button" class="close" data-dismiss="alert">×</button>    
                <strong>{{ $message }}</strong>
            </div>
          @endif
        <div class="card">  
            <div class="card-header">
                    <h5 class="title">Add Tag</h5>
                </div>
            <div class="card-body">
            @if($tag->id=='')
             	{{Form::open([ 'id'=>'tag'])}}
            	{{csrf_field()}}
            	@method("POST")
            @else
            	 <form action="{{ route('updatetag',$tag->id) }}" method="post">
            	@csrf
            	@method('patch')
            @endif
             <div class="form-group">
              <label for="">Tag</label>
              {{Form::text('name',$tag->name,array('autocomplete' => 'off' ,'id' =>'name','class' => 'form-control','placeholder' => 'Enter Tag'))}}
              @if($errors->has('name'))
              <p style="color:red;font-size: 12px;font-weight: 600;margin-top: -17px !important;"> {{   $errors->first('name')}} </p>
              @endif
            </div>
            <div class="form-group">
            <label>Status <span class="mandatory">*</span></label>
                            <div class="radiobutton">
                                <input type="radio" name="status" id="active" value="1" checked>
                                <label for="active">Active</label>
                                <input type="radio" name="status" id="inactive" value="0">
                                <label for="inactive">Inactive</label>
                            </div><!-- Radio Button -->
                        </div><!-- Field -->
           
            <div class="form-group" style="margin-top: 24px;">
              <input type="submit" class="btn btn-primary" value="Submit">
            </div>

          {{Form::close()}}
          </div>
          </div>
        </div>
    </div>
</div>
@endsection