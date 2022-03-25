@extends('layouts.front_app', ['class' => 'account-page', 'page' => __('My Account Page'), 'contentClass' => 'account-page','pageSlug' => 'my-quiz'])
@section('content')
<?php $hour=explode(":",$tests->hours);
?>

			 <link rel="stylesheet" type="text/css" href="<?php echo e(asset('resources')); ?>/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('resources')); ?>/css/animate-custom.css" />
			<!-- <section class="row border">
                <div class="col-md-9 para_title">
                    <h6>PRACTICE QUESTIONS TEST BANK</h6>
                </div>
                <div class="col-md-3 small_title">
                    <h6>Nurses are angels in comfortable shoes</h6>
                    <span>Get ready to become licensed</span>
                </div>
            </section> -->
             <section class="row">
                <div class="col-md-9 no_padding">
                    <!-- <div class="small_title">
                        <h3>Quiz</h3>
                    </div> -->
                   
                     @if(session()->has('error'))
            <p class="btn btn-danger btn-block btn-sm custom_message text-left">{{ session()->get('error') }}</p>
          @endif
                     <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div class="small_title quiz_sm" style="padding-top: 24px;">
					<div class="row col-md-12">
						<div class="col-md-4">
							<h3 class="text-left"><span><i class="fas fa-calculator"></i></span>Calculator</h3>
						</div>
						<div class="col-md-4">
							<h3 class="text-center"  style="padding-top: 5px;">Question 1</h3>
						</div>
						<div class="col-md-4">
							<h3 class="text-right" ><span><i class="far fa-clock"></i></span><?php echo $tests->hours;?>
                             Time Remaining<p id="demo"> 00:59:37</p>
							 </h3>
						</div>
					</div>
				</div>
				 <div class="home_signin">
                        <h3>home / Quiz</h3>
                    </div>
				<div class="question_html">
					<div><h3 class="text-center"><span style="padding-right: 10px;"><i class="fas fa-print"></i></span> 1 of 50
					</h3></div>
					<div class="row qt_div">
						<div class="col-md-9">
							<div class="question">
								<p>The nurse monitors continouse bladder irrigation (CBI) on a client who just went underwent a prostatectomy. Which finding indicates to the nurse that the CBI flow rate is adequate?</p>
							</div>
							<div class="answer">
								<input type="radio" name="option1" value="">There is 30 ml of fluid in the drainage bag <br>
								<input type="radio" name="option1" value="">There clients rine output equals <br>
								<input type="radio" name="option1" value="">There clients rine output equals <br>
								<input type="radio" name="option1" value="">There clients rine output equals 
							</div>
						</div>
					<div class="col-md-3">
						<div class="banner">
					<img src="<?php echo e(asset('black')); ?>/img/brain.gif">
				</div>
					</div>
					</div>
				</div>
				<button>Quit</button>
				<button>Next</button>
                </div>
              @include('layouts.profile_sidebar')
            </section>
				
				
			
				
			
		
		<style type="text/css">
			.tab-content>.active {
    display: block;
    opacity: 1;
}
		</style>
		@endsection
		 <script>
         var dt = new Date();
         var fh=<?php echo $hour['0']?>;
         var fm=<?php echo $hour['1']?>;
     
         dt.setHours(dt.getHours() + fh);
         dt.setMinutes(dt.getMinutes() + fm);
         
         var endhours=dt.getHours();
         var endmin=dt.getMinutes();
      </script>s
<script>

const monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];


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

 $(document).on('click', '.calcl', function() { 
    
      document.getElementById("micalctxtResultado").focus();
});  
</script>