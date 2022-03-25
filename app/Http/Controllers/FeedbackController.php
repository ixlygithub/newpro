<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserFeedback;

class FeedbackController extends Controller
{
    public function list(){
       	$feedbacks= UserFeedback::Select('user_feedback.reply_message as reply_message','user_feedback.status as status','user_feedback.id as id','user_feedback.feed_back','users.name as username')->leftjoin('users','users.id','user_feedback.user_id')->get()->toArray();
       	// dd($feedbacks);
    	return view('feedback.list',compact('feedbacks'));
    }
    public function reply(Request $request){
    	//print_r($request->all());
       	$feedbacks = UserFeedback::find($request->get('feed_id'));
        $feedbacks->reply_message = $request->get('reply_message');
        $feedbacks->update();

      $request->session()->flash('success', 'Message Send successfully!');
      return redirect('feedback');
    }
    public function getData(Request $request){
    	
       	$feedbacks = UserFeedback::find($request->sid);
        $feedbacks->status =$request->val;
        $feedbacks->update();

      $request->session()->flash('success', 'Message Send successfully!');
      return redirect('feedback');
    }
}
