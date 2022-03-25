@extends('layouts.app', ['pageSlug' => 'weightage'])
@push('style')
 

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

@endpush
@section('content')
<style>
   .form-group input[type=file] {
    opacity: 1;
    position: unset;
    margin-bottom: 0px !important;
    height: 46px;
}  
 .questionlist {
                margin:4px, 4px;
                padding:4px;
                /*background-color: green;*/
                /*width: 500px;*/
                height: 140px;
                overflow-x: hidden;
                overflow-y: auto;
                text-align:justify;
            }
</style>
<?php //echo "<pre>";
// print_r($question);
  $optionslist=json_decode($question->options,true);
  $optionno=count($optionslist);
   $qtags=explode(',',$question->tags);
 ?>

<script type="text/javascript">
            jQuery(document).ready(function ()
            {
                    jQuery('select[name="category"]').on('change',function(){
                       var categoryID = jQuery(this).val();
                       if(categoryID)
                       {
                          jQuery.ajax({
                             url : "{{url('gettagcategories')}}/"+categoryID,
                             type : "GET",
                             dataType : "json",
                             success:function(data)
                             {
                                console.log(data);
                                if(data.length == 0 ){

                                }
                                jQuery('#tags').empty();
                                 if(data.length == 0 ){
                                  $('#tags').append('<option value="">No data Found</option>');
                                }
                                jQuery.each(data, function(key,value){
                                   $('#tags').append('<option value="'+ key +'">'+ value +'</option>');
                                });
                             }
                          });
                       }
                       else
                       {
                          $('select[name="tags"]').empty();
                       }
                    });
            });
             function categorytagonchange(){
   

    var catid=$('select[name="category"]').val();
    var tagid=$('#tags').val();
    
    if(catid!=''){
      if(tagid==""){
        var tagid="0";
      }
       $.ajax
      ({
      type:'post',
      url:"{{url('get_questionscount')}}",
      data:{
       "catid":catid,
       "tagid":tagid,
       "_token": "{{ csrf_token() }}",
      },
      dataType: "json",
      success:function(data) {
      
      $('.test').html(data.countques);
      $('.questionlist').html(data.avaques);
      }
      });
    }
     
    
  }
            </script>
<script type="text/javascript">
  //alert('srr');
  function generateoption($value){
    

   var inputoption =$('#question_type').find('option:selected').attr('inputoption');
  
   if(inputoption=="text"){
     var inp="textbox";
   }else{
    var inp=inputoption;
   }
  var text ="<input type='hidden' class='form-control' value='"+inp+"'; name='optiontype'>";
    if($value!='' && inputoption!=''){
     // <?php $optionno?>
     ans='';

     $s=1;

     for (i = $s; i <= $value; i++) {
       if(inputoption=="textbox"){

        text +='<div class="col-md-6"><div class="form-group"><label for="">Option '+i+'</label><input type="text" class="form-control" name="options[]" value="{{ old('A') }}" placeholder="Option '+i+'" required></div></div>';
       }else{
        text +='<div class="col-md-6"><div class="form-group"><label for="">Option '+i+'</label><input type="file" name="options[]"  placeholder="Option '+i+'" required></div></div>';
        
       }
     ans +='<option value="option'+i+'">option'+i+'</option>';
    console.log(ans);
    }
    $("#option").html(text);

    $('#ans').html(ans);
    }
  
  }
  
    
  
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12">

          @if(session()->has('message'))
            <p class="btn btn-success btn-block btn-sm custom_message text-left">{{ session()->get('message') }}</p>
          @endif
        <div class="card">  
            <div class="card-header">
                    <h5 class="title">Edit Questions</h5>
                    
                </div>
            <div class="card-body">
            
     <form action="{{ route('updatequestion',$question->id) }}" method="post"  enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="form-group">
              <label for="">Questions</label>
              <input type="text" class="form-control" name="question" value="{{ $question->question}}" placeholder="Enter question" >
              <font style="color:red"> {{ $errors->has('question') ?  $errors->first('question') : '' }} </font>
            </div>
            <div class="row">
            <div class="col-md-6">
             <div class="form-group">
              <label for="">Question Type</label>
              <select  class="form-control select2" name="question_type" id="question_type">
              @if(!empty($questions_categories))
                                    @forelse($questions_categories as $questcat)
            <option value="{{ $questcat->id }}" inputoption="{{ $questcat->input_option }}" {{ ($question->question_type==$questcat->id) ? 'selected' : '' }}>{{ $questcat->question_category }}</option>
                                    

                                    @empty
                                        <option value="">No data found</option>
                                    @endforelse
                                @endif
                
              </select>
              <font style="color:red"> {{ $errors->has('question_type') ?  $errors->first('question_type') : '' }} </font>
            </div>
            </div>
             <div class="col-md-6">
             <div class="form-group">
              <label for="">Weightage Type</label>
              <select  class="form-control select2" name="weightage_type">
              <option value="">Select</option>
                @if(!empty($weightages))
                                    @forelse($weightages as $weightage)
            <option value="{{ $weightage->id }}" {{ ($question->weightage_type==$weightage->id) ? 'selected' : '' }}>{{ $weightage->weightage_title }}</option>
                                    

                                    @empty
                                        <option value="">No data found</option>
                                    @endforelse
                                @endif
              </select>
              <font style="color:red"> {{ $errors->has('weightage_type') ?  $errors->first('weightage_type') : '' }} </font>
            </div>
            </div>
           
            
            </div>
            <div class="row">
             <div class="col-md-6">
             <div class="form-group">
              <label for="">Category</label>
              <select  class="form-control select2" name="category"  onchange="categorytagonchange()">
              <option value="">Select</option>
              @if(!empty($categories))
                                    @forelse($categories as $category)
            <option value="{{ $category->id }}" {{ ($question->category==$category->id) ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                    

                                    @empty
                                        <option value="">No data found</option>
                                    @endforelse
                                @endif
                
              </select>
              <font style="color:red"> {{ $errors->has('category') ?  $errors->first('category') : '' }} </font>
            </div>
            <div class="test" style="color:green;"></div>
            </div>
            <div class="col-md-6">
             <div class="form-group">
              <label for="">Tags</label>
              <select  class="form-control select2" name="tags[]"  id="tags" multiple=""  onchange="categorytagonchange()">
              <option value="">Select Category first</option>
             
                @if(!empty($tagcategories))
                                    @forelse($tagcategories as $tag)
                <option value="{{ $tag->id }}" <?php if (in_array($tag->id, $qtags)) {
   echo "selected";
} ?>>{{ $tag->name }}</option>
                @empty
                                        <option value="">No data found</option>
                                    @endforelse
                                @endif                    
              </select>
              <font style="color:red"> {{ $errors->has('tags') ?  $errors->first('tags') : '' }} </font>
            </div>
            </div>
             <div class="col-md-12">
             <div class="questionlist"></div>
            </div>
            <div class="col-md-6">
             <div class="form-group">
              <label for="">No of Option </label>
                <!--    {{ $editoption=json_decode($question->option_no,'true')}} --> 
                 
               <input type="number" class="form-control" name="" id="option_no"  onchange="generateoption(this.value)"  min="1" placeholder="No of Option" required value="{{ $optionno }}">
               
              
            </div>
            </div>
            </div>
            <!-- <div id="divoptionedit">
            <div class="row">
             <div class="col-md-4">
              <label><b>Updated Options</b></label>
              </div>
              </div>
              
            </div> -->
            <div id="divoption">
             <!-- <div class="row">
             <div class="col-md-4">
              <label><b>New Options</b></label>
              </div>
              </div> -->
              <div class="row" id="option">
            <input type='hidden' class='form-control' value='{{ $question->optiontype}}'; name='optiontype'>
           

      <input type="hidden" class="form-control" value="" name="oldoptions">
             
                 @if(!empty($optionslist))
                                    @forelse($optionslist as $key=>$op) 

              <div class="col-md-6">

              <div class="form-group">
              <label for="">{{$key}}</label><br>
              <?php if($question->optiontype=="text"){?>
              <br>
               <input type="text" class="form-control" name="options[]" value="{{$op}}" placeholder="{{$key}}" required>    
              <?php }else if($question->optiontype=="audio"){?>
                <br><audio controls>
  <source src="{{url('/public/images/').'/'.$op}}" type="audio/ogg" >
  <source src="{{url('/public/images/').'/'.$op}}" type="audio/mpeg" >
  Your browser does not support the audio tag.
</audio>
            <?php  }else{?>
              <img src="{{url('/public/images/').'/'.$op}}" alt="image" width="200px" height="200px">
              <?php } ?>
              </div>
              </div>
              @empty
                                        <div class="no">No data found</div>
                                    @endforelse
                                @endif
            
              </div>
            </div>
            
              <div class="row">
            <div class="col-md-6">
             <div class="form-group">
              <label for="">Answer</label>
              <select class="form-control" name="ans" id="ans" value="" placeholder="Answer" >
              @if(!empty($optionslist))
                                    @forelse($optionslist as $key=>$op)
                <option value="{{$key}}" {{ ($question->ans==$key) ? 'selected' : '' }}>{{ $key}}</option>
                @empty
                                        <div class="no">No data found</div>
                                    @endforelse
                                @endif
              </select>
               
              <font style="color:red"> {{ $errors->has('ans') ?  $errors->first('ans') : '' }} </font>
            </div>
            </div>
            <div class="col-md-6">
             <div class="form-group">
              <label for="">Notes</label>
              <textarea  class="form-control" name="notes" style="border: 1px solid #2825255e;border-color: #2b3553;
    border-radius: 0.4285rem;">
               {{ $question->notes}}
              </textarea>
               
              <font style="color:red"> {{ $errors->has('notes') ?  $errors->first('notes') : '' }} </font>
            </div>
            </div>
            <div class="col-md-6">
             <div class="form-group">
              <label for="">Explanation</label>
              <textarea  class="form-control" name="explanation" required="" id="explanation" style="border: 1px solid #2825255e;border-color: #2b3553;
    border-radius: 0.4285rem;
">{{ $question->explanation}}
               
              </textarea>
               
              <font style="color:red"> {{ $errors->has('explanation') ?  $errors->first('explanation') : '' }} </font>
            </div>
            </div>

            <div class="col-md-6">
            
            <div class="form-group">
              <label for="wrong answer audio">Audio(wrong answer audio)</label><br>
              <?php if(!empty($question->wrong_ans_audio)){
              $wop=$question->wrong_ans_audio;
               ?>
            <audio controls>
  <source src="{{url('/public/questions_wrong_ans_audio/').'/'.$wop}}" type="audio/ogg" >
  <source src="{{url('/public/questions_wrong_ans_audio/').'/'.$wop}}" type="audio/mpeg" >
  Your browser does not support the audio tag.
</audio>
<input type="hidden" name="oldwrong_ans_audio" value="<?php echo $wop?>">
 <?php } ?>
              <input type="file" name="wrong_ans_audio" class="form-control" accept="audio/*" placeholder="wrong answer audio">

              </div>
            </div>
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