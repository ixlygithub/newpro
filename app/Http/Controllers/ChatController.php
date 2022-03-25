<?php

namespace App\Http\Controllers;
use App\Models\Chat;
use Illuminate\Http\Request;
use Auth;
use DB;
class ChatController extends Controller
{
     public function chatstore(Request $request)
    {
          // $data=$request->all();
          // print_r($data);
           Chat::create([
         'from_user' =>auth()->user()->id,
         'to_user'   => $request->to_user,
         'msg'       => $request->msg,
         'from_role' => auth()->user()->role,
         'chatdate_time'=>date('Y-m-d h:i:sa')
         
         ]);
        echo "Message sented successfully";
    }
    public function chat_history(){
       $id=$_GET['id'];

       $result = Chat::orderBy('chats.id', 'asc')
                
              ->leftjoin('users', 'chats.from_user', '=', 'users.id')
              ->select('chats.id','chats.chatdate_time','chats.from_role','chats.msg','users.name')
              
        		->where('chats.from_user', $id)
          		->orWhere('chats.to_user',$id)
        		->get();
        		$msg='';
        foreach($result as $chat){

        	$datechat=date('d-m-Y h:i:sa',strtotime($chat->chatdate_time));
          if(auth()->user()->role=="admin" && $chat->from_role=="admin"){
           $msg.='<div class="direct-chat-msg right">
                                <div class="direct-chat-info clearfix"> <span class="direct-chat-name pull-right">Admin</span> <span class="direct-chat-timestamp pull-left">'.$datechat.'</span> </div> <img class="direct-chat-img" src="https://img.icons8.com/office/36/000000/administrator-male.png" alt="message user image">
                                <div class="direct-chat-text"> '.$chat->msg.' </div>
                            </div>';
          }else{
           $msg.='<div class="direct-chat-msg">
                                <div class="direct-chat-info clearfix"> <span class="direct-chat-name pull-left">'.$chat->name.'</span> <span class="direct-chat-timestamp pull-right">'.$datechat.'</span> </div> <img class="direct-chat-img" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="message user image">
                                <div class="direct-chat-text">'.$chat->msg.' </div>
                            </div>';
          }
        }
       Chat::where('chats.from_role','user')
       ->orWhere('chats.to_user',0)
       ->update([
        'status' => "read",
        ]);  
      echo $msg;
      
    }
    public function userchat_history(){
    	//echo "hi";
    	$id=$_GET['id'];

       $result = Chat::orderBy('chats.id', 'asc')
                
              ->leftjoin('users', 'chats.from_user', '=', 'users.id')
              ->select('chats.id','chats.chatdate_time','chats.from_role','chats.msg','users.name')
              
        		->where('chats.from_user', $id)
          		->orWhere('chats.to_user',$id)
        		->get();
        		$msg='';
        foreach($result as $chat){

        	$datechat=date('d-m-Y h:i:sa',strtotime($chat->chatdate_time));
          if(auth()->user()->role=="user" && $chat->from_role=="admin"){
           $msg.='<div class="direct-chat-msg ">
                                <div class="direct-chat-info clearfix"> <span class="direct-chat-name pull-right">Admin</span> <span class="direct-chat-timestamp pull-left">'.$datechat.'</span> </div> <img class="direct-chat-img" src="https://img.icons8.com/office/36/000000/administrator-male.png" alt="message user image">
                                <div class="direct-chat-text"> '.$chat->msg.' </div>
                            </div>';
          }else{
           $msg.='<div class="direct-chat-msg right">
                                <div class="direct-chat-info clearfix"> <span class="direct-chat-name pull-left">'.$chat->name.'</span> <span class="direct-chat-timestamp pull-right">'.$datechat.'</span> </div> <img class="direct-chat-img" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="message user image">
                                <div class="direct-chat-text">'.$chat->msg.' </div>
                            </div>';
          }
        }
       Chat::where('chats.to_user', $id)
    //->orWhere('chats.to_user',$id)
    
    ->update([
        'status' => "read",
        
    ]);  
      echo $msg;
    }
}
