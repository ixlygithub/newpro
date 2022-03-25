@extends('layouts.app', ['pageSlug' => 'test'])
@push('style')
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
         @if ($message = Session::get('success'))
            <div class="btn btn-success btn-block btn-sm custom_message text-left">
                <button type="button" class="close" data-dismiss="alert">×</button>    
                <strong>{{ $message }}</strong>
            </div>
          @endif
            <div class="card">  
                <div class="card-header">
                    <h5 class="title">Add Audio</h5>
                </div>
                <div class="card-body">
                    {{Form::open([ 'id'=>'audiotest','enctype' => 'multipart/form-data','onsubmit'=>'return'])}}
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Wrong Answer Audio<span class="mandatory">* </span></label><br>
                            <input name="wrongques_song" type="file" class="form-control" required="" accept="audio/*">
                                @if($errors->has('wrongques_song'))
                                    <p style="color:red;font-size: 12px;font-weight: 600;margin-top: -17px !important;"> {{   $errors->first('wrongques_song')}} </p>
                                @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Right Answer Audio<span class="mandatory">* </span></label><br>
                            <input name="rightques_song" type="file" class="form-control" required="" accept="audio/*">
                                @if($errors->has('rightques_song'))
                                    <p style="color:red;font-size: 12px;font-weight: 600;margin-top: -17px !important;"> {{   $errors->first('rightques_song')}} </p>
                                @endif
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 24px;">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                    {{Form::close()}}
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .form-group input[type=file] {
    opacity: 1;
    position: unset;
    height: auto;
    margin-top: 17px;
}
</style>
@endsection

