<!DOCTYPE html>
<html>
<head>
	<title>QUIZ</title>
	  <link rel="stylesheet" href="<?php echo e(asset('resources')); ?>/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo e(asset('resources')); ?>/css/SimpleCalculadorajQuery.css">
      <link rel="stylesheet" href="<?php echo e(asset('resources')); ?>/css/styles.css">
	  <meta name="csrf-token" content="{{ csrf_token() }}" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <script src="<?php echo e(asset('resources')); ?>/js/SimpleCalculadorajQuery.js"></script>
	  <!-- Fonts -->
      <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
     <!-- Plugin -->
      <!-- confirm JS CDN -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
 <!-- confirm JSs CDN -->
<style type="text/css">
	.btn-grad {
    background-image: none !important;
}
button.btn.buzzerbtntext.musicbtnclr, .question_html button.btn.btn-success {
    background-color: #28a745 !important;
    border-color: #28a745 !important;
}
.banner {
    margin-top: 54px;
}
</style>
</head>
	<body>	
	<?php $hour=explode(":",$tests->hours);
	 $quexcount=count($ques);
   
   if(!empty($tests->audio)){
      $audio=$tests->audio;
     
     $testmusic='/public/audio/'.$audio;
   }else{
    $audio="naturemusic.mp3";
    $testmusic='/public/images/'.$audio;
   }
   $wronganssong=$testsetting->wrongques_song;
   $rightques_song=$testsetting->rightques_song;
   
   if(!empty($wronganssong)){
   	 $wrgsong='/public/testsetting/'.$wronganssong;
   	}else{
         $wrgsong='/public/images/Buzzer-sound.mp3';
   	}
    
   if(!empty($rightques_song)){
   	 $rightsong='/public/testsetting/'.$rightques_song;
   	}else{
         $rightsong='/public/images/naturemusic.mp3';
   	}
   
?>
		<div class="container">
    <iframe src="https://olafwempe.com/mp3/silence/silence.mp3" type="audio/mp3"  id="audio" style="display:none"></iframe>
		<audio id="myAudio" controls loop style="display: none">
  <source src="<?php echo url($testmusic)?>" type="audio/ogg">
  <source src="<?php echo url($testmusic)?>" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>
<audio id="buzzer" controls style="display: none">
  <source src="<?php echo url($wrgsong)?>" type="audio/ogg">
  <source src="<?php echo url($wrgsong)?>" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>
<audio id="rightbuzzer" controls style="display: none">
  <source src="<?php echo url($rightsong)?>" type="audio/ogg">
  <source src="<?php echo url($rightsong)?>" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>

			<header class="">
				<div class="banner">
					<img src="<?php echo e(asset('black')); ?>/img/Banner.jpg">
				</div>
			</header>
			<section class="">
				<div class="para_title" style="border-right: none !important;">
					<h6>PRACTICE QUESTIONS TEST BANK</h6>
				</div>
			</section>
			<section>
				<div class="small_title quiz_sm" style="padding-top: 24px;">
					<div class="row col-md-12">
						<div class="col-md-4">
							<h3 class="text-left"><span><i class="fas fa-calculator"></i></span><a href="#calculator" data-toggle="modal">Calculator</a></h3>
						</div>
						<div class="col-md-4">
							<h3 class="text-center"  style="padding-top: 5px;">Question <span class="currentques">1</span>
							<input type="hidden" class="currentquesno" value="1">
							</h3>
						</div>
						<div class="col-md-4">
							<h3 class="text-right"><span><i class="far fa-clock"></i></span>Time Remaining<span id="demo"> 00:59:37</span></h3>
              <!-- <span id="demo1" > </span> -->
              <input type="hidden" id="demo1">
              <button id="pausetime" onclick="pause_clocktime()">Pause Test</button>
              <button id="resumetime" onclick="resume_clocktime()">Resume</button>
             <br><br>
						<!-- 	Countdown Clock with Pause and Resume Functionality
<br><br>
<div id="clockdiv"></div>


<button id="pause">Pause</button>
<button id="resume">Resume</button>

<br><br>
<a href="http://simplestepscode.com/" target="_blank">Simple Steps Code</a> -->
						</div>
					</div>
				</div>
				<div id="calculator" class="modal" data-easein="slideDownBigIn"  tabindex="-1" role="dialog" aria-labelledby="costumModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content" style="background-color: none !important;background: none !important;box-shadow: none !important;border: none !important;">
							<div class="modal-body">
          						<div id="micalc"> </div>
							</div>
						</div>
					</div>
				</div>
				<div class="question_html">
					<div><h3 class="text-center"><span style="padding-right: 10px;"><i class="fas fa-print"></i></span> 
					<i class="currentques">1</i> of <?php echo count($ques);?>
					</h3></div>
					
           <!-- <button onclick="pauseAudio()" type="button" class="btn btn-warning">Pause <i class="far fa-pause-circle"></i></button> 
					<div class="row qt_div"> -->
             <button onclick="mute_unmutebuzzerAudio()" title="Wrong Answer buzzer" type="button" class="btn buzzerbtntext musicbtnclr">Music Memory Mode ON<i class="far fa-pause-circle"></i></button> 
          <div class="row qt_div">
						<div class="col-md-7">
						<!-- <div class="question">
								<p>The nurse monitors continouse bladder irrigation (CBI) on a client who just went underwent a prostatectomy. Which finding indicates to the nurse that the CBI flow rate is adequate?</p>
								
							</div>
							<div class="answer">

								<input type="radio" name="option1" value="">
                                 
								There is 30 ml of fluid in the drainage bag <br>
								<input type="radio" name="option1" value="">There clients rine output equals <br>
								<input type="radio" name="option1" value="">There clients rine output equals <br>
								<input type="radio" name="option1" value="">There clients rine output equals 
								</div> -->
						<div class="questionans">
							
						</div>
						</div>
           <!--  <div class="col-md-2" style="
    margin-left: 0px;
    margin-right: 0px;
    padding-left: 0px;
    padding-right: 0px;
    margin-top: -145px;
    margin-left: 276px;
">
              <h3 class="text_smart">test smarter</h3>
          </div> -->
					<div class="col-md-3" style="
    margin-left: 0px;
    margin-right: 0px;
    padding-left: 0px;
    padding-right: 0px;
"> <div  style="
    margin-left: 0px;
    margin-right: 0px;
    padding-left: 0px;
    padding-right: 0px;
    margin-top: -145px;
    margin-left: 276px;

">
              <h3 class="text_smart">test smarter</h3>
              <button onclick="playAudio()" type="button" class="btn btn-success btntext btn-grad" title="Test Music" id="ss" style="
    margin-top: -307px;
    margin-right: -236px;"><i class="far fa-play-circle"></i> STIM MODE ON</button>
          </div>
          <br>
						<div class="banner">
					<img src="<?php echo e(asset('black')); ?>/img/brain.gif">
					
				    
				</div>
					</div>
				<!-- 	<div class="col-md-2" style="
    margin-left: 0px;
    margin-right: 0px;
    padding-left: 0px;
    padding-right: 0px;
">
					    <h3 class="text_smart">test smarter</h3>
					</div> -->
					</div>
					<button class="btn btn-danger" id="quit" onclick="quit()">Quit <i class="fas fa-sign-out-alt"></i></button>
				
				<button class="btn btn-success testnext" style="margin-left:313px" onclick="next()"  id="next">Next <i class="fas fa-forward"></i></button>

				<input type="hidden" id="taken" name="taken" class="taken"><p></p>
				</div>
			</section>
		</div>
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-md-2">
						<h6>Site Map</h6>
						<ul class="list-inline">
							<li><a href="">Physiological</a></li>
							<li><a href="">Health Promotion</a></li>
							<li><a href="">Safe and Effective Care</a></li>
							<li><a href="">SATA</a></li>
							<li><a href="">NCLEX - RN Exam Stimulator</a></li>
						</ul>
					</div>
					<div class="col-md-3">
						<h6>NCLEX</h6>
						<ul class="list-inline">
							<li><a href="">NCLEX Practice Questions</a></li>
							<li><a href="">NCLEX Mastery Questions</a></li>
							<li><a href="">Practice Questions Test Bank</a></li>
							<li><a href="">Nursing Career Guide</a></li>
							<li><a href="">Become a Registered Nurse</a></li>
							<li><a href="">Become a Nurse Practitioner</a></li>
						</ul>
					</div>
					<div class="col-md-3">
						<h6>Canadian HQ</h6>
						<ul class="list-inline">
							<li><a>1466 Limeridge Rd East, Hamilton,</a></li>
							<li><a>ON, L8W3J9</a></li>
						</ul>
						<h6>US Office</h6>
						<ul class="list-inline">
							<li><a>4283 Express Lane, Suite 392-536,</a></li>
							<li><a>Sarasota, FL 34249</a></li>
						</ul>
					</div>
					<div class="col-md-2">
						<h6>General Inquries</h6>
						<ul class="list-inline">
							<li><a href="">Hello@nurse.plus</a></li>
							<li><a href="">Terms</a></li>
							<li><a href="">Privacy Policy</a></li>
							<li><a href="">Mobile</a></li>
						</ul>
					</div>
					<div class="col-md-2">
						<h6>Telephone</h6>
						<ul class="list-inline">
							<li><a href="">x-xxx-xxxx-xxxx</a></li>
							<li><a href="">Help Center</a></li>
						</ul>
					</div>
				</div>
				<div class="copy_right text-center">
					<span class="">&#169; Copyrights reserved 2021</span>
				</div>
			</div>
		</footer>
		<!-- <button onclick="start()">Start</button>

<button onclick="end()">End</button> -->
        </div>

	</body>
</html>
<script type="text/javascript">
  
// // 10 minutes from now
// var time_in_minutes = 1;
// var current_time = Date.parse(new Date());
// var deadline = new Date(current_time + time_in_minutes*60*1000);


// function time_remaining(endtime){
//   var t = Date.parse(endtime) - Date.parse(new Date());
//   var seconds = Math.floor( (t/1000) % 60 );
//   var minutes = Math.floor( (t/1000/60) % 60 );
//   var hours = Math.floor( (t/(1000*60*60)) % 24 );
//   var days = Math.floor( t/(1000*60*60*24) );
//   return {'total':t, 'days':days, 'hours':hours, 'minutes':minutes, 'seconds':seconds};
// }

// var timeinterval;
// function run_clock(id,endtime){
//   var clock = document.getElementById(id);
//   function update_clock(){
//     var t = time_remaining(endtime);
//     clock.innerHTML = 'minutes: '+t.minutes+'<br>seconds: '+t.seconds;
//     if(t.total<=0){ clearInterval(timeinterval); }
//   }
//   update_clock(); // run function once at first to avoid delay
//   timeinterval = setInterval(update_clock,1000);
// }
// run_clock('clockdiv',deadline);


// var paused = false; // is the clock paused?
// var time_left; // time left on the clock when paused

// function pause_clock(){
//   if(!paused){
//     paused = true;
//     clearInterval(timeinterval); // stop the clock
//     time_left = time_remaining(deadline).total; // preserve remaining time
//   }
// }

// function resume_clock(){
//   if(paused){
//     paused = false;

//     // update the deadline to preserve the amount of time remaining
//     deadline = new Date(Date.parse(new Date()) + time_left);

//     // start the clock
//     run_clock('clockdiv',deadline);
//   }
// }

// // handle pause and resume button clicks
// document.getElementById('pause').onclick = pause_clock;
// document.getElementById('resume').onclick = resume_clock;
</script>
<script>
var startTime, endTime;
start();
function start() {
  startTime = new Date();
};

// function end() {
//   endTime = new Date();
//   var timeDiff = endTime - startTime; //in ms
//   // strip the ms
//   //timeDiff /= 1000;

//   // get seconds 
//   var hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//   var minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
//   var seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);
//   //var seconds = Math.round(timeDiff);
//   console.log(hours + " hours");
//   console.log(minutes + " minutes");
//   console.log(seconds + " seconds");
//    document.getElementById("taken").innerHTML =hours + ": "
//   + minutes + ": " + seconds + "s ";
// }
</script>
<script>

const monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];
var paused = false;
//var running='false';
var cal = new Date();
//var month=cal.getMonth();
var date =cal.getDate(); 
var Year =cal.getFullYear(); 
var month=monthNames[cal.getMonth()];
var fh=<?php echo $hour['0']?>;
var fm=<?php echo $hour['1']?>;
//alert(fh);
cal.setHours(cal.getHours() + fh);
cal.setMinutes(cal.getMinutes() + fm);
//alert(cal.getMinutes());
var endhours=cal.getHours();
var endmin=cal.getMinutes();
//alert(endhours);
var hoursmin="<?php echo $tests->hours;?>";
//cudate1="May 31,2021 20:00:00";
console.log(endmin);
cudate=""+month+" " +date+","+Year+" "+endhours+":"+endmin+":10";

console.log(cudate);
//console.log(cudate1);
//var countDownDate = new Date(cudate).getTime();
var countDownDate = new Date(cudate).getTime();
// Update the count down every 1 second
var countdownfunction = setInterval(function() {

  // Get todays date and time
  
  var  now=new Date().getTime();
  var startTime = new Date();
  // Find the distance between now an the count down date
  var distance = countDownDate - now;
  
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
 
  
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML =hours + "h "
  + minutes + "m " + seconds + "s ";
  document.getElementById("demo1").innerHTML =hours + ":"
  + minutes + ": " + seconds;
  
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(countdownfunction);

    //document.getElementById("demo").innerHTML = "EXPIRED";
    timeoutsubmit();
  }
}, 1000);

var time_remains="";
$('#resumetime').hide();
function pause_clocktime(){
 
  
   if(!paused){
    $('#pausetime').hide();
    $('#resumetime').show();
     paused = true;
    clearInterval(countdownfunction); // stop the clock
    //var currenttime=$('#demo').val();
    // var x = document.getElementById("demo").innerText;
    // var time_remains =x;
    alert('paused');
  //   time_left = time_remaining(deadline).total; // preserve remaining time
   }
}

	function resume_clocktime(){

  if(paused){
    paused = false;
    $('#resumetime').hide();
    // update the deadline to preserve the amount of time remaining
    //deadline = new Date(Date.parse(new Date()) + time_remains);
  var input = document.getElementById("demo1").innerText;
  //alert(x);
  var fields = input.split(':');
  var hours =fields[0];
  var min = fields[1];
  var sec = fields[2];
    var minutesToAdd=fields[1];
    var h=fields[0];
var currentDate = new Date();
var futureDate = new Date(currentDate.getTime() + (h*60*60*1000)+ minutesToAdd*60000);


console.log(futureDate);
 var date1 =futureDate.getDate();
 //alert(date1);
  var Year1 =futureDate.getFullYear(); 
  var month1=monthNames[futureDate.getMonth()];
  var endhours1 = futureDate.getHours();
  var endmin1 = futureDate.getMinutes();
  redate=""+month1+" " +date1+","+Year1+" "+endhours1+":"+endmin1+":00";

 console.log(redate);
   var countDownDate = new Date(redate).getTime();
// Update the count down every 1 second
var countdownfunction = setInterval(function() {

  // Get todays date and time
  
  var  now=new Date().getTime();
  var startTime = new Date();
  // Find the distance between now an the count down date
  var distance = countDownDate - now;
  
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
 
  
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML =hours + "h "
  + minutes + "m " + seconds + "s ";
  document.getElementById("demo1").innerHTML =hours + ":"
  + minutes + ": " + seconds;
  
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(countdownfunction);

    //document.getElementById("demo").innerHTML = "EXPIRED";
    timeoutsubmit();
  }
}, 1000);
  }
}
    

</script>

<script>
var testid="<?php echo $tests->id;?>";
var quiz=[];
var useroption=[];
var weightagevalue=[];
var correctoption=[];
var plotpoints=[];

getquiz(testid);

//create quiz 
 function getquiz(testid){
      var _token = $('meta[name="csrf-token"]').attr('content');
      var currentquesno=$('.currentquesno').val();
      var totalques=<?php echo count($ques);?>

      //var timetaken="";
     endTime = new Date();
     var timeDiff = endTime - startTime; //in ms
  // strip the ms
  //timeDiff /= 1000;

  // get seconds 
  var hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);
  //var seconds = Math.round(timeDiff);
  // console.log(hours + " hours");
  // console.log(minutes + " minutes");
  // console.log(seconds + " seconds");
   //document.getElementById("taken").innerHTML =hours + ": "
  //+ minutes + ": " + seconds + "s "; 
   $('#taken').val(hours + ": "
  + minutes + ": " + seconds);   
   var timetaken=$('.taken').val();
   //alert(timetaken);
      //alert(currentquesno);
	  $.ajax({url: "{{url('getquiz')}}",
                    type:'POST',
                    //dataType : "json",
                     data: {_token:_token,testid:testid,quiz:quiz,useroption:useroption,weightagevalue:weightagevalue,currentquesno:currentquesno,correctoption:correctoption,timetaken:timetaken,plotpoints:plotpoints,totalques:totalques},
                    success: function(data) {
                    	//alert(data);
                      if(isNaN(data)){
                      	   $('.testnext').attr('disabled', 'disabled');
                         setTimeout(function(){ 

                            $('.questionans').html(data);
                          var wrongansaudio=$(".wrongansaudio").val();
  if(wrongansaudio!=''){
    var srcurl="<?php echo url('/public/questions_wrong_ans_audio')?>/"+wrongansaudio;
  }else{
   var srcurl="<?php echo url('/public/images/Buzzer-sound.mp3')?>";
  }
 
  $('.wrongans').attr('src',srcurl);
 $('.testnext').removeAttr('disabled');
                          }, 5000);
                        

// alert(wrongansaudio);
// alert(srcurl);
                      }else{
                          //alert(data);
                         var url="/review_summary/"+data;
                        // alert(url)
                           var base="{{url('')}}";
                          var link=base+url
                          // alert(link);
                         window.location.href = link;
                      }
                      //$('.questionans').html(data);
                    }
                });
}
function submit(){
	//alert(testid);
  if ($(".option").is(":checked")) {
	var option=$("input[type='radio'][name='option']:checked").val();
	var ques_id=$('#cquestionid').val();
  var weightage=$('#cquestion_weightage').val();
  var weightageset=3;
  var correctans=$('#correctoption').val();
   var correctans=$('#correctoption').val();
     if(correctans == option){
          // console.log('correct');
          var br = document.getElementById("righbuzzer"); 
           br.play();
           if (plotpoints.length === 0) 
            { 
            plotpoints.push(weightageset);
            console.log(weightageset); 
            }
           else{
             var lastItem = plotpoints[plotpoints.length - 1];
             var inweight=Number(lastItem)+Number(1);
                if(lastItem==6){
                  plotpoints.push(lastItem);
                 }else{
                  plotpoints.push(inweight);
                 }
            

             
             console.log(lastItem); 
           }
      }else{
         var bx = document.getElementById("buzzer"); 
           bx.play();
           if (plotpoints.length === 0) 
            {   
              $deweight=Number(weightageset)-Number(1);
              plotpoints.push($deweight);
               console.log($deweight); 
            }
            else{
               var lastItem = plotpoints[plotpoints.length - 1];
               var deweight=Number(lastItem)-Number(1);
               if(lastItem==0){
                  plotpoints.push(lastItem);
                 }else{
                  plotpoints.push(deweight);
                 }
                 console.log(lastItem); 
            }
        //console.log("wrong ans!"); 
      }
    endTime = new Date();
    var timeDiff = endTime - startTime; //in ms
  // strip the ms
  //timeDiff /= 1000;

  // get seconds 
  var hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);
  //var seconds = Math.round(timeDiff);
  // console.log(hours + " hours");
  // console.log(minutes + " minutes");
  // console.log(seconds + " seconds");
   //document.getElementById("taken").innerHTML =hours + ": "
  //+ minutes + ": " + seconds + "s ";    
  $('#taken').val(hours + ": "
  + minutes + ": " + seconds);
  var timetaken=$('.taken').val();
	var _token = $('meta[name="csrf-token"]').attr('content');
  quiz.push(ques_id);
  useroption.push(option);
  weightagevalue.push(weightage);
  correctoption.push(correctans);
	  $.ajax({url: "{{url('submitquiz')}}",
                    type:'POST',
                    //dataType : "json",
                     data: {_token:_token,testid:testid,quiz:quiz,useroption:useroption,weightagevalue:weightagevalue,plotpoints:plotpoints,timetaken:timetaken},
                    success: function(data) {
                    	//alert(data);
                      // if(data=="Success")
                      // {
                        $.alert('Lefted Successfully');
                       var url="/review_summary/"+data;
                        
                           var base="{{url('')}}";
                          var link=base+url
                        setTimeout(function(){   
                        window.location.href = link; }, 3000);
                      //}
                      //$('.questionans').html(data);
                    }
                });
     }else{
      //alert('Select option');
      $.alert('Select option!');
     }
}
function quitsubmit(){
 var _token = $('meta[name="csrf-token"]').attr('content');
 var timetaken="<?php echo $tests->hours;?>";
 $.ajax({url: "{{url('submitquiz')}}",
                    type:'POST',
                    //dataType : "json",
                     data: {_token:_token,testid:testid,quiz:quiz,useroption:useroption,weightagevalue:weightagevalue,plotpoints:plotpoints,timetaken:timetaken,correctoption:correctoption},
                    success: function(data) {
                      //alert(data);
                      $.alert('Lefted Successfully');
                       var url="/review_summary/"+data;
                        
                           var base="{{url('')}}";
                          var link=base+url
                        setTimeout(function(){   
                        window.location.href = link; }, 3000);
                    }
                });
            
}
function next(){
	
	if ($(".option").is(":checked")) {
   
  var option=$("input[type='radio'][name='option']:checked").val();
	var ques_id=$('#cquestionid').val();
	var weightage=$('#cquestion_weightage').val();
  var weightageset=3;
  
	var correctans=$('#correctoption').val();

     if(correctans == option){
     	//alert(correctans);
     	$.alert('Your option :-'+correctans+ ' is Correct Answer!');
        var br = document.getElementById("rightbuzzer"); 
         //bx.pause();
           br.play();

          // console.log('correct');
           if (plotpoints.length === 0) 
            { 
            plotpoints.push(weightageset);
            console.log(weightageset); 
            }
           else{
             var lastItem = plotpoints[plotpoints.length - 1];
             var inweight=Number(lastItem)+Number(1);
                if(lastItem==6){
                  plotpoints.push(lastItem);
                 }else{
                  plotpoints.push(inweight);
                 }
            

             
             console.log(lastItem); 
           }
      }else{
      	$.alert('Your option  :-' +option+ ' is Wrong Answer!');
         var bx = document.getElementById("buzzer"); 
         // br.pause();
           bx.play();
           if (plotpoints.length === 0) 
            {   
              $deweight=Number(weightageset)-Number(1);
              plotpoints.push($deweight);
               console.log($deweight); 
            }
            else{
               var lastItem = plotpoints[plotpoints.length - 1];
               var deweight=Number(lastItem)-Number(1);
               if(lastItem==0){
                  plotpoints.push(lastItem);
                 }else{
                  plotpoints.push(deweight);
                 }
                 console.log(lastItem); 
            }
        //console.log("wrong ans!"); 
      }
      // if (plotpoints.length === 0) 
      // { 
      //    plotpoints.push(weightage);
      //    console.log("Array is empty!"); 
      //  }
      // else{
      //       if(correctans == option){
      //             console.log('correct');
      //       }
      //      console.log('ploat have values');
      // }
 
    quiz.push(ques_id);
    useroption.push(option);
    weightagevalue.push(weightage);
    correctoption.push(correctans);
       
    getquiz(testid);
    }
    var actualquesct="<?php echo $quexcount;?>";
    var currquiz=quiz.length+1;
    var currquizct=quiz.length;
    console.log(currquizct);
   // console.log(actualquesct);
   // console.log(currquiz);
   var value=$(".testnext").html();
   if(value=="Submit"){
           endTime = new Date();
         var timeDiff = endTime - startTime; //in ms
  // strip the ms
  //timeDiff /= 1000;

  // get seconds 
  var hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);
  //var seconds = Math.round(timeDiff);
  // console.log(hours + " hours");
  // console.log(minutes + " minutes");
  // console.log(seconds + " seconds");
   //document.getElementById("taken").innerHTML =hours + ": "
  + minutes + ": " + seconds + "s ";    
  $('#taken').val(hours + ": "
  + minutes + ": " + seconds);
   }
   //alert(value);
    if(actualquesct!=currquizct){
    	
    	$('.currentques').html(currquiz);
    	$('.currentquesno').val(currquiz);
    }
    if(actualquesct==currquiz){
    	
    	$(".testnext").html("Submit");
	}
   
}


</script>
<script type="text/javascript">
                $("#micalc").Calculadora({'EtiquetaBorrar':'Clear'});
</script>
<script type="text/javascript">
function quit(testid){
	

    $.confirm({
    title: 'Confirm!',
    content: 'Quit Confirm!',
    buttons: {
        Confirm: function () {
           // $.alert('confirm success!');
            quitsubmit();
             // var link="{{url('examlist')}}";
             // window.location.href = link;

            
        },
        Cancel: function () {
        	//location.reload();
        }
        
    }
   });
    
 }

</script>
<script>
//alert();
var sound_url="<?php echo url('/public/images/162124889332.oga')?>";
//alert(sound_url);
var x = document.getElementById("myAudio"); 
var xb = document.getElementById("buzzer");
var xr = document.getElementById("rightbuzzer");
 
//playAudio();
function playAudio() { 
  if(x.paused){
     x.play(); 
      $('.btntext').html('<i class="far fa-pause-circle"></i> STIM MODE ON');
       $('.btntext').removeClass('stembtnclr');
  }else{
    x.pause();
    $('.btntext').html('<i class="far fa-play-circle"></i> STIM MODE OFF');
    $('.btntext').addClass('stembtnclr');
    
  }
  
} 
function pauseAudio() { 
  x.pause(); 
} 
// function play() {
//   var audio = new Audio();
//   audio.play();
// }
function mute_unmutebuzzerAudio(){
  if (xb.muted === false) {    
       xb.muted = true;
       xr.muted = true;
        $('.buzzerbtntext').html('Music Memory Mode Off<i class="far fa-pause-circle"></i>');
      $('.buzzerbtntext').removeClass('musicbtnclr');
      
  }else{
      xb.muted = false;
      xr.muted = false;
       $('.buzzerbtntext').html('Music Memory Mode On<i class="far fa-play-circle"></i>');
       $('.buzzerbtntext').addClass('musicbtnclr');

  }

}
</script>
<script>

</script>
<script type="text/javascript">
  $( document ).ready(function() {
    $('.btntext').trigger('click');
  });
 
</script>
<script>
  function timeoutsubmit(){
    var _token = $('meta[name="csrf-token"]').attr('content');
    var timetaken="<?php echo $tests->hours;?>";
   $.confirm({
    title: 'Confirm!',
    content: ' Confirm!',
    buttons: {
        Clicktosubmit: function () {
            $.alert('confirm success!');
            $.ajax({url: "{{url('timeoutsubmit')}}",
                    type:'POST',
                    //dataType : "json",
                     data: {_token:_token,testid:testid,quiz:quiz,useroption:useroption,weightagevalue:weightagevalue,plotpoints:plotpoints,timetaken:timetaken,correctoption:correctoption},
                    success: function(data) {
                      //alert(data);
                      $.alert('Submitted');
                       var url="/review_summary/"+data;
                        
                           var base="{{url('')}}";
                          var link=base+url
                        setTimeout(function(){   
                        window.location.href = link; }, 3000);
                    }
                });
            
        }
        
    }
   });
  }
</script>
<script>
  //var intervalID = setInterval(alert, 1000); // Will alert every second.
// clearInterval(intervalID); // Will clear the timer.

//setTimeout(alert, 1000); // Will alert once, after a second.
setInterval(function(){ 
  console.log("1minute!");
   console.log(cudate);
   var countDownDate = new Date(cudate).getTime();
var  now=new Date().getTime();
var distance = countDownDate - now;
}, 60000);//run this thang every 2 seconds
</script>
<script>

 $(document).on('click', '.calcl', function() { 
    
      document.getElementById("micalctxtResultado").focus();
});  
</script>