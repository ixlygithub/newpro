@extends('layouts.front_app', ['class' => 'account-page', 'page' => __('My Account Page'), 'contentClass' => 'account-page','pageSlug' => 'examlist'])
@section('content')
	<?php  $option=json_decode($ques->options,true);
	       if(!empty($tests->audio)){
      $audio=$tests->explanation_audio;
     
     $testmusic='/public/audio/'.$audio;
   }else{
    $audio="naturemusic.mp3";
    $testmusic='/public/images/'.$audio;
   }
	?>
			<section class="row">
			<div class="col-md-9 para_title">
					<h6>QUESTION SUMMARY</h6>
				</div>
				<div class="col-md-9 no_padding">
				
					<div class="small_title">
						<h3>NCLEX PREP > QUESTION SUMMARY</h3>
					</div>
					<div class="home_signin">
						<h3><a href="<?php echo url('userpage')?>">HOME</a> / <a href="<?php echo url("/review_summary/{$usertest->id}");?>">REVIEW SUMMARY</a> / <a href="<?php echo url("/question_summary/{$usertest->id}/{$ques->id}");?>">QUESTION SUMMARY</a></h3>
					</div>
					<div class="bgcolour">
						<div class="row qt_div">
							<div class="col-md-9">
								<div class="question">
									<p><?php echo $ques->question;?>?</p>
								</div>
								<div class="answer" style="margin-bottom: 0px;">
								<?php $quesoptions=""; foreach ($option as $key => $value) {
                                       $checked=($key==$userans)?'checked':'';
            if($ques->optiontype=="text"){
                $quesoptions.='<input type="radio" class="option" name="option" value="'.$key.'"  '.$checked.'>'.$value.'<br>';
            }
            if($ques->optiontype=="audio"){
                $quesoptions.='<input type="radio" class="option" name="option" value="'.$key.'" '.$checked.'><audio controls>
               <source src="'.url('/public/images/').'/'.$value.'" type="audio/ogg" >
               <source src="'.url('/public/images/').'/'.$value.'" type="audio/mpeg" >
                Your browser does not support the audio tag.
               </audio>';

            }
            if($ques->optiontype=="image"){
                $quesoptions.='<input type="radio" class="option" name="option" value="'.$key.'" '.$checked.'> <img src="'.url('/public/images/').'/'.$value.'" alt="image" width="143px" height="143px">';
                 $class="row";
                
            }
            
         } echo $quesoptions;?>
									
								</div>
								<h6 class="text-primary"> Status : <span class="text-danger"><?php if($ques->ans==$userans){
								echo "Correct";
								 }else {  echo (empty($userans))?"Not Answer": "Wrong";}?></span></h6>
								<button type="button" class="collapse_css" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">SEE EXPLANATION</button>
								<audio id="myAudio" controls loop style="display: none;">
								  <source src="<?php echo url($testmusic)?>" type="audio/ogg">
								  <source src="<?php echo url($testmusic)?>" type="audio/mpeg">
								  Your browser does not support the audio element.
								</audio>
								<button type="button"  role="button" class="collapse_css" onclick="playAudio()">HEAR EXPLANATION</button>
								<div class="collapse" id="collapseExample">
									<div class="card card-body">
										<?php echo $ques->explanation;?>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="banner">
									<img src="<?php echo e(asset('black')); ?>/img/brain.gif">
								</div>
							</div>
						</div>
    				</div>
				</div>
				
				 @include('layouts.profile_sidebar')
			</section>
		 @endsection
		
	</body>
</html>
<style type="text/css">
	.collapse_css{
		box-shadow: rgb(50 50 93 / 25%) 0px 30px 60px -12px inset, rgb(0 0 0 / 30%) 0px 18px 36px -18px inset;
	    background-color: aqua;
	    color: #000;
	    border: none;
	    border-radius: 7px;
	    padding: 6px 13px;
	    cursor: pointer;
	    margin-top: 10px;
	    font-family: 'Poppins-SemiBold';
	}
	.answer {
    color: #3a346d !important;
	}
	.questionpage{
		margin-top: -126px;
	}
		.collapse:not(.show) {
        display: block !important;
    }
	.collapse:not(.in) {
        display: none !important;
    }
</style>
<script type="text/javascript">
// 	var x = document.getElementById("myAudio"); 

// playAudio();
function playAudio() { 
var x = document.getElementById("myAudio"); 

	
  if(x.paused){
     x.play(); 
      //$('.btntext').html('Pause<i class="far fa-pause-circle"></i>');
    
  }else{
    x.pause();
    //$('.btntext').html('Play<i class="far fa-play-circle"></i>');
    
  }
  
} 
</script>