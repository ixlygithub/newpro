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
 <!-- confirm JS CDN -->

</head>
	<body>	
	<?php $hour=explode(":",$tests->hours);
	 $quexcount=count($ques);
?>
		<div class="container">
		<audio id="myAudio" controls loop style="display: none">
  <source src="<?php echo url('/public/images/naturemusic.mp3')?>" type="audio/ogg">
  <source src="<?php echo url('/public/images/naturemusic.mp3')?>" type="audio/mpeg">
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
							<h3 class="text-center"  style="padding-top: 5px;">Question <span class="currentques">1</span></h3>
						</div>
						<div class="col-md-4">
							<h3 class="text-right"><span><i class="far fa-clock"></i></span>Time Remaining<span id="demo"> 00:59:37</span></h3>
							
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
					<button onclick="playAudio()" type="button" class="btn btn-success">Play <i class="far fa-play-circle"></i></button>
<button onclick="pauseAudio()" type="button" class="btn btn-warning">Pause <i class="far fa-pause-circle"></i></button> 
					<div class="row qt_div">

						<div class="col-md-9">
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
				<!--	<div class="col-md-3">-->
				<!--		<div class="banner">-->
				<!--	<img src="<?php //echo e(asset('black')); ?>/img/brain.gif">-->
				<!--</div>-->
				<!--	</div>-->
					</div>
					<button class="btn btn-danger" id="quit" onclick="quit()">Quit <i class="fas fa-sign-out-alt"></i></button>
				
				<button class="btn btn-success testnext" style="float:right;" onclick="next()"  id="next">Next <i class="fas fa-forward"></i></button>
				<input type="hidden" id="taken" name="taken"><p></p>
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

//var running='false';
var cal = new Date();
//var month=cal.getMonth();
var date =cal.getDate(); 
var Year =cal.getFullYear(); 
var month=monthNames[cal.getMonth()];
var fh=<?php echo $hour['0']?>;
var fm=<?php echo $hour['1']?>;
//alert(fm);
cal.setHours(cal.getHours() + fh);
cal.setMinutes(cal.getMinutes() + fm);
//alert(cal.getMinutes());
var endhours=cal.getHours();
var endmin=cal.getMinutes();
var hoursmin="<?php echo $tests->hours;?>";
//cudate1="May 31,2021 20:00:00";
console.log(endmin);
cudate=""+month+" " +date+","+Year+" "+endhours+":"+endmin+":00";

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
  
  
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(countdownfunction);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);


	
    

</script>

<script>
var testid="<?php echo $tests->id;?>";
var quiz=[];
var useroption=[];
getquiz(testid);

//create quiz 
 function getquiz(testid){
      var _token = $('meta[name="csrf-token"]').attr('content');
	  $.ajax({url: "{{url('getquiz')}}",
                    type:'POST',
                    //dataType : "json",
                     data: {_token:_token,testid:testid,quiz:quiz,useroption:useroption},
                    success: function(data) {
                    	//alert(data);
                      
                      $('.questionans').html(data);
                    }
                });
}
function next(){
	
	if ($(".option").is(":checked")) {
   
    var option=$("input[type='radio'][name='option']:checked").val();
	var ques_id=$('#cquestionid').val();
    quiz.push(ques_id);
    useroption.push(option);
    getquiz(testid);
    }
    var actualquesct="<?php echo $quexcount;?>";
    
    var currquiz=quiz.length+1;
     var currquizct=quiz.length;
   // console.log(currquizct);
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
  console.log(hours + " hours");
  console.log(minutes + " minutes");
  console.log(seconds + " seconds");
   //document.getElementById("taken").innerHTML =hours + ": "
  + minutes + ": " + seconds + "s ";    
  $('#taken').val(hours + ": "
  + minutes + ": " + seconds);
   }
   //alert(value);
    if(actualquesct!=currquizct){
    	
    	$('.currentques').html(currquiz);
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
function quit(){
	

    $.confirm({
    title: 'Confirm!',
    content: 'Quit Confirm!',
    buttons: {
        Quit: function () {
            $.alert('Quit success!');
            var link="{{url('examlist')}}";
            window.location.href = link;

            
        },
        Submit: function () {
        	 if ($(".option").is(":checked")) {
            $.alert('Submit!');
        }else{
        	$.alert('Please select option!');
        }
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
//playAudio();
function playAudio() { 
  x.play(); 
} 
function pauseAudio() { 
  x.pause(); 
} 
// function play() {
//   var audio = new Audio();
//   audio.play();
// }
</script>