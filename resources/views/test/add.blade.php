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
                <h5 class="title">Add test</h5>
            </div>
            <div class="card-body">
             	{{Form::open([ 'id'=>'test','enctype' => 'multipart/form-data','onsubmit'=>'return confirm("Please check the form once. Because did not provide edit to the form. Are you sure you want to submit this form?")'])}}
            <div class="row">
            <div class="form-group col-md-6">
              <label for="">Test Name <span class="mandatory">* </span></label>
              {{Form::text('test_name',$test->test_name,array('autocomplete' => 'off' ,'id' =>'test_name','class' => 'form-control','placeholder' => 'Enter test'))}}
              @if($errors->has('test_name'))
              <p style="color:red;font-size: 12px;font-weight: 600;margin-top: -17px !important;"> {{   $errors->first('test_name')}} </p>
              @endif
            </div>
            <div class="form-group col-md-6">
              <label for="">Test Hours <span class="mandatory">* </span></label>
              {{Form::text('hours',$test->hours,array('autocomplete' => 'off' ,'id' =>'hours','readonly' => 'readonly','class' => 'form-control','placeholder' => 'Enter Total Hour'))}}
               <p style="color: darkgrey;font-size: 11px;padding-left: 17px;font-weight: 600;margin-top: -13px;font-style: italic;">ex: 02:30</p>
               @if($errors->has('hours'))
              <p style="color:red;font-size: 12px;font-weight: 600;margin-top: -17px !important;"> {{   $errors->first('hours')}} </p>
              @endif
            </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
            <label>Test Type <span class="mandatory">*</span></label>
              <select class="form-control" name="test_type" id="test_type">
                  <option value="">[-Select-]</option>
                  <option value="Category Test">Category Test</option>
                  <option value="Comprehensive Test">Comprehensive Test</option>
              </select>
              @if($errors->has('test_type'))
              <p style="color:red;font-size: 12px;font-weight: 600;margin-top: -17px !important;"> {{   $errors->first('test_type')}} </p>
              @endif
            </div><!-- Field -->
           <div class="input-text form-group col-md-6">
              <label>Category <span class="mandatory">* </span></label>
              {{Form::select('category[]',$categories,'',array('autocomplete' => 'off' ,'id' =>'category','class' => 'form-control'))}}
              @if($errors->has('category'))
              <p style="color:red;font-size: 12px;font-weight: 600;margin-top: -17px !important;"> {{   $errors->first('category')}} </p>
              @endif
            </div><!-- Field -->
          </div>
           <div class="row">
            <div class="form-group col-md-6">
            <label>Question Type <span class="mandatory">*</span></label>
              <select class="form-control" name="question_usedstatus" id="question_usedstatus">
                  <option value="">[-Select-]</option>
                  <option value="1">Used</option>
                  <option value="0">Unused</option>
              </select>
              @if($errors->has('question_usedstatus'))
              <p style="color:red;font-size: 12px;font-weight: 600;margin-top: -17px !important;"> {{   $errors->first('question_usedstatus')}} </p>
              @endif
            </div><!-- Field -->
            <div class="form-group col-md-6">
              <label for="">No. Of Questions <span class="mandatory">* </span></label>
              {{Form::text('no_of_question',$test->no_of_question,array('autocomplete' => 'off' ,'readonly'=>'readonly','id' =>'no_of_question','class' => 'form-control','placeholder' => 'No. Of Questions / 256'))}}
               @if($errors->has('no_of_question'))
              <p style="color:red;font-size: 12px;font-weight: 600;margin-top: -17px !important;"> {{   $errors->first('no_of_question')}} </p>
              @endif
            </div>
          </div>
          <div class="checked_box">
            <div id="resultDiv">
              
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-6">
              <label for="">User Limit<span class="mandatory">* </span></label>
              {{Form::text('user_limit',$test->user_limit,array('autocomplete' => 'off' ,'id' =>'user_limit','class' => 'form-control','placeholder' => 'Enter User Limit'))}}
              @if($errors->has('user_limit'))
              <p style="color:red;font-size: 12px;font-weight: 600;margin-top: -17px !important;"> {{   $errors->first('user_limit')}} </p>
              @endif
            </div>
            <div class="form-group col-md-6">
              <label for="">Audio<span class="mandatory">* </span></label>
              <input name="audio" type="file" class="form-control" required="" accept="audio/*">
              @if($errors->has('audio'))
                <p style="color:red;font-size: 12px;font-weight: 600;margin-top: -17px !important;"> {{   $errors->first('audio')}} </p>
              @endif
            </div>
            <div class="form-group col-md-6">
              <label for="explanation_audio">Explanation Audio<span class="mandatory">* </span></label>
              <input name="explanation_audio" type="file" class="form-control" required="" accept="audio/*">
              @if($errors->has('explanation_audio'))
                <p style="color:red;font-size: 12px;font-weight: 600;margin-top: -17px !important;"> {{   $errors->first('explanation_audio')}} </p>
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
<style type="text/css">
  select{
    padding: 7px 9px 6px 20px !important;
  }
  .select2-container--default .select2-selection--multiple .select2-selection__choice{
    color: #000;
  }
  input[type="radio"]{
      vertical-align: middle;
      margin-right: 6px;
  }
  .form-group input[type=file] {
    opacity: 1;
    position: unset;
    margin-bottom: 0px !important;
    height: 46px;
}
input[type="radio"], input[type="checkbox"] {
   
    width: 20px;
    display: inline-block;
    vertical-align: middle;
    margin-right: 10px;
}
.form-control[readonly] {
    background-color: #eee;
}
</style>
<script type="text/javascript">
  $(document).ready(function() {
    var lastChecked;
      $('.checked_box #resultDiv').on("click",".check",function() {
        var checkcount = $('input[name="question_id[]"]:checked').length;
        if($('#no_of_question').val()<checkcount){
          alert("Sorry, you have already selected "+$('#no_of_question').val()+" Questions!");
          lastChecked.checked = false;
        }
        lastChecked = this;
      });
    });
</script>
<script type="text/javascript">
   $(document).ready(function() {
    $('#question_usedstatus').on('change',function(){
      // alert('s');
      var no_question = $('#no_of_question').val();
      var category = $('#category').val();
     
      var qtype = $('#question_usedstatus').val();
      $.ajax({
        method:'POST',
        url: "{{url('getquestion')}}",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {no_question:no_question,category:category,qtype:qtype},
        success: function(data){
          $("#resultDiv").html("");
          if(JSON.parse(data).length==0) {
            $("#resultDiv").append('<h6 style="margin-bottom: 20px;color: red;text-align: center;">There is no questions for this Category</h6>');
          }else{
            $("#resultDiv").html("<input value='' class='form-control all_check' type='checkbox' id='all_check' /> Select All (" + JSON.parse(data).length+ ' )<br>');
            $.each(JSON.parse(data), function(i, record) {
              $("#resultDiv").append("<input value='"+record.id+"' class='form-control check' type='checkbox' id='chk-" + i + "' name='question_id[]' /> " + record.question+'<br>');
            });
          }
        }
      });
    });

    //Select All Checkbox
    $(document).on('click','#all_check',function(e) {
    //   alert('as');
      if($(this).prop("checked")) {
        $(".check").prop("checked", true);
      }else{
        $(".check").prop("checked", false);

      }
    });
    $(document).on('click','.check',function(e) {
            if($(".check").length == $(".check:checked").length) { 
                 //if the length is same then untick 
                $("#all_check").prop("checked", true);
            }else {
                //vise versa
                $("#all_check").prop("checked", false);            
            }
        });
    //End Select All
    $('.select2').select2();
    });
    
</script>
<script type="text/javascript">
   $(document).ready(function() {


    function minTommss(minutes){
 var sign = minutes < 0 ? "-" : "";
 var min = Math.floor(Math.abs(minutes));
 var sec = Math.floor((Math.abs(minutes) * 60) % 60);
 return sign + (min < 10 ? "0" : "") + min + ":" + (sec < 10 ? "0" : "") + sec;
}

    $('#category').on('change',function(){
      var category = $(this).val();
      $.ajax({
        method:'POST',
        url: "{{url('getcategory')}}",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {category:category},
        success: function(data){
          // console.log(JSON.parse(data)[0].max_questions);
          var test_percentage = JSON.parse(data)[0].comprehensive_test_percentage;
          $('#no_of_question').val(JSON.parse(data)[0].max_questions);
          var time = test_percentage/100*6;
          //console.log(minTommss(time) );
          $('#hours').val(minTommss(time));
       }
      });
    });
  });
</script>
@endsection

