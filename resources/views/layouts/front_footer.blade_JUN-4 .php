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
			
<script>

	$("#edit_profile" ).addClass("active");
	//$("#changepassword" ).addClass("active");
	function addactive($id){
    $("#"+$id+"").addClass("active");
	}
</script>
<script type="text/javascript">
    $(document).ready(function(){
     
      // DataTable
      $('#exam').DataTable({
         processing: true,
         serverSide: true,
         ajax: "{{route('getexam')}}",
         columns: [
            { data: 'id' },
            { data: 'test_name' },
            { data: 'hours' },
            { data: 'action' },
            
         ]
      });

    });
    </script>