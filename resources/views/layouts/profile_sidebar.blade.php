<script>
    function chathistory(){
      var userid="<?php echo auth()->user()->id; ?>";
      //alert(userid);
       $('#to_user').val(0);
  $('#msg').val(''); 

  $.ajax({
 type: "GET",
 url: "userchat_history/{id}",
 data: {
  "id": userid},
 cache: false,
 success: function(data) {
 //alert(data);
 $('.chathistory').html(data);
 //$.alert(data);
 },
 error: function(xhr, status, error) {
 console.error(xhr);
 }
 });
    }
function chatstore(){
  //alert('hi');
 var to_user =$('#to_user').val();
 var msg=$('#msg').val();
    $.ajax({
 type: "POST",
 url: "{{ route('userchatstore.post') }}",
 data: {
  "msg": msg,
  "_token": "{{ csrf_token() }}",
  "to_user":to_user
 },
 cache: false,
 success: function(data) {
 //alert(data);
 $.alert(data);
 $('#chat').modal('hide');

 setTimeout(function(){ 
     location.reload(); }, 3000);
 },
 error: function(xhr, status, error) {
 console.error(xhr);
 }
 });
}
</script>
<div class="col-md-3 no_padding" style="border-right:none">
                    <div class="small_title questionpage" style="padding-top: 25px;padding-bottom: 26px;border-bottom: 1px solid #fff;border-top: 1px solid #fff;">
                        <span>{{auth()->user()->name}}</span><br>
                        <span>{{auth()->user()->email}}</span><br>
                        <span>{{auth()->user()->mobile}}</span>
                    </div>
                    <?php $msgcount=0;?>
                    <?php
                    // echo "SELECT count(id) as unread_msg FROM `chats` where from_role='admin' and status='unread' and to_user=".auth()->user()->id."";
            $results = DB::select("SELECT count(id) as unread_msg FROM `chats` where from_role='admin' and status='unread' and to_user=".auth()->user()->id."");
             if(!empty($results)){
                 $unread_msg=$results[0]->unread_msg;
                 if($unread_msg>0){
                      $msgcount=$unread_msg;
                 }else{
                  $msgcount=0;
                 }
             }else{
              $msgcount=0;
             }
             
            ?>
                    <div class="bg_color sidebar">
                        <ul class="list-inline">
                            <li><a href="{{ route('myaccount') }}"><span><i class="fas fa-home"></i></span>My Account</a></li>
                          
                             <li><a  href="#chat" data-toggle="modal" onclick="chathistory();"><span><i class="fas fa-edit"></i></span>Chat
                             <?php if($msgcount>0){?>
                                   <span class="badge badge-success chatnum"><?php echo $msgcount;?></span>
                             <?php }?>
                              

                            </a></li>
                           
                            <li><a href="{{ route('exam_history') }}"><span><i class="fas fa-edit"></i></span>Exam History</a></li>
                            <li><a href="{{route('construction')}}"><span><i class="fas fa-dollar-sign"></i></span>Payment Details</a></li>
                            <li><a href="{{route('examlist')}}"><span><i class="far fa-edit"></i></span>Exams</a></li>
                            <li><a href="#costumModal20" data-toggle="modal"><span><i class="fas fa-pencil-alt"></i></span>Feedback</a></li>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();"><span><i class="fas fa-sign-out-alt"></i></span>Logout</a></li>
                        </ul>
                        <div class="start_exam det_exam">
                        <a href="{{route('examlistsearch','start')}}" name="" class="btn btn-success" value="START EXAM">START EXAM</a>
                           
                        </div>
                    </div>
                </div>
<!-- chat msg test start  -->
          
<div id="chat" class="modal" data-easein="slideDownBigIn"  tabindex="-1" role="dialog" aria-labelledby="chatLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Chat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
          
            <div class="modal-body">
               <div class="chathistory">
         <!--        <div class="direct-chat-msg">-->
         <!--                       <div class="direct-chat-info clearfix"> <span class="direct-chat-name pull-left">Timona Siera</span> <span class="direct-chat-timestamp pull-right">23 Jan 5:37 pm</span> </div> <img class="direct-chat-img" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="message user image">-->
         <!--                       <div class="direct-chat-text"> For what reason would it be advisable for me to think about business content? </div>-->
         <!--                   </div>-->
         <!--<div class="direct-chat-msg right">-->
         <!--                       <div class="direct-chat-info clearfix"> <span class="direct-chat-name pull-right">Sarah Bullock</span> <span class="direct-chat-timestamp pull-left">23 Jan 6:10 pm</span> </div> <img class="direct-chat-img" src="https://img.icons8.com/office/36/000000/person-female.png" alt="message user image">-->
         <!--                       <div class="direct-chat-text"> I would love to. </div>-->
         <!--                   </div>-->
               </div> 
                    <form action="#" method="post" onsubmit="chatstore();return false;">
         <div class="row">
                    <div class="col-8"> 
         <input type="hidden" name="to_user" id="to_user" value="">
  <div class="form-group">
   <textarea class="form-control" id="msg" name="msg" placeholder="Type Message here" required=""></textarea>
    
</div>
</div>
<div class="col-2">
  <button type="submit" class="btn btn-default" >Send</button>
  </div>
  </div>
  </form> 
               
            </div>
            
            
        </div>
    </div>
</div>
               
 <!-- chat msg test end  -->
<!--/*******FeedBack Form****/-->
<div id="costumModal20" class="modal" data-easein="slideDownBigIn"  tabindex="-1" role="dialog" aria-labelledby="costumModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">FEEDBACK</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
           <form method="post" action="{{ route('updatefeedback') }}" autocomplete="off">
                                    @csrf
                                    @method('put')
            <div class="modal-body">
               
                    <div class="form-group">
                        <textarea autocomplete="off" id="user_feedback" class="form-control" placeholder="Enter Your Feedback" required="" name="user_feedback" cols="50" rows="6"></textarea>
                    </div>
               
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">
                    Close
                </button>
               <input type="submit" class="btn btn-warning" name="submit" value="Send">
            </div>
             </form>
        </div>
    </div>
</div>
   
<style>
.start_exam.det_exam .btn.btn-success {
    background-color: aqua;
    border-color: aqua;
    font-family: 'Poppins-SemiBold';
    font-size: 23px;
    width: 100%;
    box-shadow: rgb(50 50 93 / 25%) 0px 30px 60px -12px inset, rgb(0 0 0 / 30%) 0px 18px 36px -18px inset;
    color:#fff;
}
.start_exam {
    text-align: center;
    padding-left: 11px;
    padding-right: 11px;
}    
</style>
<style>

a.notif {
  position: relative;
  display: block;
  height: 50px;
  width: 50px;
  background: url('http://i.imgur.com/evpC48G.png');
  background-size: contain;
  text-decoration: none;
}
.num {
  position: absolute;
  right: 11px;
  top: 6px;
  color: #fff;
}
.chatnum{
    position: absolute;
   right: 151px;
    top: 185px;
}
</style>
<style type="text/css">
  .stretch-card>.card {
    width: 100%;
    min-width: 100%
}

body {
    background-color: #f9f9fa
}

.flex {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto
}

@media (max-width:991.98px) {
    .padding {
        padding: 1.5rem
    }
}

@media (max-width:767.98px) {
    .padding {
        padding: 1rem
    }
}

.padding {
    padding: 3rem
}

.box.box-warning {
    border-top-color: #f39c12
}

.box {
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    border-top: 3px solid #d2d6de;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1)
}

.box-header.with-border {
    border-bottom: 1px solid #f4f4f4
}

.box-header.with-border {
    border-bottom: 1px solid #f4f4f4
}

.box-header {
    color: #444;
    display: block;
    padding: 10px;
    position: relative
}

.box-header:before,
.box-body:before,
.box-footer:before,
.box-header:after,
.box-body:after,
.box-footer:after {
    content: "";
    display: table
}

.box-header {
    color: #444;
    display: block;
    padding: 10px;
    position: relative
}

.box-header>.fa,
.box-header>.glyphicon,
.box-header>.ion,
.box-header .box-title {
    display: inline-block;
    font-size: 18px;
    margin: 0;
    line-height: 1
}

.box-header>.box-tools {
    position: absolute;
    right: 10px;
    top: 5px
}

.box-header>.box-tools [data-toggle="tooltip"] {
    position: relative
}

.bg-yellow,
.callout.callout-warning,
.alert-warning,
.label-warning,
.modal-warning .modal-body {
    background-color: #f39c12 !important
}

.bg-yellow {
    color: #fff !important
}

.btn {
    border-radius: 3px;
    -webkit-box-shadow: none;
    box-shadow: none;
    border: 1px solid transparent
}

.btn-box-tool {
    padding: 5px;
    font-size: 12px;
    background: transparent;
    color: #97a0b3
}

.direct-chat .box-body {
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
    position: relative;
    overflow-x: hidden;
    padding: 0
}

.box-body {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    padding: 10px
}

.box-header:before,
.box-body:before,
.box-footer:before,
.box-header:after,
.box-body:after,
.box-footer:after {
    content: "";
    display: table
}

.direct-chat-messages {
    -webkit-transform: translate(0, 0);
    -ms-transform: translate(0, 0);
    -o-transform: translate(0, 0);
    transform: translate(0, 0);
    padding: 10px;
    height: 250px;
    overflow: auto
}

.direct-chat-messages,
.direct-chat-contacts {
    -webkit-transition: -webkit-transform .5s ease-in-out;
    -moz-transition: -moz-transform .5s ease-in-out;
    -o-transition: -o-transform .5s ease-in-out;
    transition: transform .5s ease-in-out
}

.direct-chat-msg {
    margin-bottom: 10px
}

.direct-chat-msg,
.direct-chat-text {
    display: block
}

.direct-chat-info {
    display: block;
    margin-bottom: 2px;
    font-size: 12px
}

.direct-chat-timestamp {
    color: #999
}

.btn-group-vertical>.btn-group:after,
.btn-group-vertical>.btn-group:before,
.btn-toolbar:after,
.btn-toolbar:before,
.clearfix:after,
.clearfix:before,
.container-fluid:after,
.container-fluid:before,
.container:after,
.container:before,
.dl-horizontal dd:after,
.dl-horizontal dd:before,
.form-horizontal .form-group:after,
.form-horizontal .form-group:before,
.modal-footer:after,
.modal-footer:before,
.modal-header:after,
.modal-header:before,
.nav:after,
.nav:before,
.navbar-collapse:after,
.navbar-collapse:before,
.navbar-header:after,
.navbar-header:before,
.navbar:after,
.navbar:before,
.pager:after,
.pager:before,
.panel-body:after,
.panel-body:before,
.row:after,
.row:before {
    display: table;
    content: ""
}

.direct-chat-img {
    border-radius: 50%;
    float: left;
    width: 40px;
    height: 40px
}

.direct-chat-text {
    border-radius: 5px;
    position: relative;
    padding: 5px 10px;
    background: #d2d6de;
    border: 1px solid #d2d6de;
    margin: 5px 0 0 50px;
    color: #444
}

.direct-chat-msg,
.direct-chat-text {
    display: block
}

.direct-chat-text:before {
    border-width: 6px;
    margin-top: -6px
}

.direct-chat-text:after,
.direct-chat-text:before {
    position: absolute;
    right: 100%;
    top: 15px;
    border: solid transparent;
    border-right-color: #d2d6de;
    content: ' ';
    height: 0;
    width: 0;
    pointer-events: none
}

.direct-chat-text:after {
    border-width: 5px;
    margin-top: -5px
}

.direct-chat-text:after,
.direct-chat-text:before {
    position: absolute;
    right: 100%;
    top: 15px;
    border: solid transparent;
    border-right-color: #d2d6de;
    content: ' ';
    height: 0;
    width: 0;
    pointer-events: none
}

:after,
:before {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box
}

.direct-chat-msg:after {
    clear: both
}

.direct-chat-msg:after {
    content: "";
    display: table
}

.direct-chat-info {
    display: block;
    margin-bottom: 2px;
    font-size: 12px
}

.right .direct-chat-img {
    float: right
}

.direct-chat-warning .right>.direct-chat-text {
    background: #f39c12;
    border-color: #f39c12;
    color: #fff
}

.right .direct-chat-text {
    margin-right: 50px;
    margin-left: 0
}

.box-footer {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    border-top: 1px solid #f4f4f4;
    padding: 10px;
    background-color: #fff
}

.box-header:before,
.box-body:before,
.box-footer:before,
.box-header:after,
.box-body:after,
.box-footer:after {
    content: "";
    display: table
}

.input-group-btn {
    position: relative;
    font-size: 0;
    white-space: nowrap
}

.input-group-btn:last-child>.btn,
.input-group-btn:last-child>.btn-group {
    z-index: 2;
    margin-left: -1px
}

.btn-warning {
    color: #fff;
    background-color: #f0ad4e;
    border-color: #eea236
}
  .chathistory
{
    max-height: 313px;
    overflow-y: scroll;
}
</style>