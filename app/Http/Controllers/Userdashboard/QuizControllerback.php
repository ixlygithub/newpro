<?php

namespace App\Http\Controllers\userdashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Questions;
use DB;
class QuizController extends Controller
{
     public function index($testid)
     {
        $tests = DB::table("tests")->where("id",$testid)->first();
        $testsques = DB::table("test_questions")->where("test_id",$testid)->first();
        $quesarr=explode(',',$testsques->question_id);
        $ques= DB::table("questions")->whereIn('id',$quesarr)->get();
        return view('userdashboard/quiz_html',compact(['tests','ques']));
    }
    //get quiz
    public function getquiz(Request $request)
    {
       $testid=$request->testid;
       $testsques = DB::table("test_questions")->where("test_id",$testid)->first();
       $quiz=$request->quiz;
        //echo "<pre>";
       if(empty($quiz)){
           $quesarr=explode(',',$testsques->question_id);
           $ques= DB::table("questions")
            ->whereIn('id',$quesarr)
            ->Where('weightage_type','3')
            ->first();
         if(empty($ques)){
          $ques= DB::table("questions")
            ->whereIn('id',$quesarr)
           ->first();
         }
        }
       else{
         $useroption=$request->useroption;
         $preques_id=end($quiz);
         $prevoption=end($useroption);
         $allquiz=explode(',',$testsques->question_id);
         //print_r($allquiz);
         $quesarr=array_diff($allquiz,$quiz);
         $prevques=DB::table("questions")->where('id',$preques_id)->first();
         $weightage=$prevques->weightage_type;
         //get weightage based ques start for success ans
         $questionarr=$this->get_question_weightage($weightage,$quesarr,$prevques->ans,$prevoption);
         if(empty($questionarr)){
          $ques= DB::table("questions")->whereIn('id',$quesarr)->first();
        }else{
          $ques=$questionarr;
        }
         // echo "<pre>";
         // print_r($ques);
         // exit();   
        
       }
        if(!empty($ques)){
           
         
           $option=json_decode($ques->options,true);
           $quesoptions="";
           $class="";
           foreach ($option as $key => $value) {
            if($ques->optiontype=="text"){
                $quesoptions.='<input type="radio" class="option" name="option" value="'.$key.'" >'.$value.' <br>';
            }
            if($ques->optiontype=="audio"){
                $quesoptions.='<input type="radio" class="option" name="option" value="'.$key.'" ><audio controls>
               <source src="'.url('/public/images/').'/'.$value.'" type="audio/ogg" >
               <source src="'.url('/public/images/').'/'.$value.'" type="audio/mpeg" >
                Your browser does not support the audio tag.
               </audio><br> <br>';

            }
            if($ques->optiontype=="image"){
                $quesoptions.='<div class="col-md-4"><input type="radio" class="option" name="option" value="'.$key.'" >
                 <img src="'.url('/public/images/').'/'.$value.'" alt="image" width="143px" height="143px">
                 </div>';
                $class="row";
                
            }
            
         }
           echo '<div class="question"><p>'.$ques->id.'. '.$ques->question.'?</p><input type="hidden" value="'.$ques->id.'" id="cquestionid"></div>
                <div class="answer '.$class.'">'.$quesoptions.'</div>';
        }
        else{
            echo "submited data";
        }
        
    }
    public function get_question_weightage($weightage,$quesarr,$prevquesoriginaloption,$prevoption) 
     {
      //o Remembering
      if($weightage=='1'){
         $query = DB::table('questions');     
         $query->whereIn('id',$quesarr);
         if($prevquesoriginaloption==$prevoption){
            $query->Where('weightage_type','2');
         }
         if($prevquesoriginaloption!=$prevoption){
            $query->Where('weightage_type','1');
         }
          $result=$query->first();
      }
      //o Understanding
      if($weightage=='2'){
        if($prevquesoriginaloption==$prevoption){
        $questions = Questions::whereIn('id',$quesarr)
         ->where('weightage_type','3')
          
           ->first();
        }
        if($prevquesoriginaloption!=$prevoption){
        $questions = Questions::whereIn('id',$quesarr)
           ->where(function ($query) {
               $query->where('weightage_type','2')
                     ->orWhere('weightage_type','1');
           })
           ->first();
        }
        $result=$questions;
     }
    // o  Applying
     if($weightage=='3'){
         if($prevquesoriginaloption==$prevoption){
        $questions = Questions::whereIn('id',$quesarr)
         ->where('weightage_type','4')
          
           ->first();
        
        }
        if($prevquesoriginaloption!=$prevoption){
        $questions = Questions::whereIn('id',$quesarr)
           ->where(function ($query) {
               $query->where('weightage_type','2')
                     ->orWhere('weightage_type','1')
                     ->orWhere('weightage_type','3');
           })
           ->first();
        }
        $result=$questions;
     }
     //o  Analyzing
     if($weightage=='4'){
        if($prevquesoriginaloption==$prevoption){
        $questions = Questions::whereIn('id',$quesarr)
         ->where('weightage_type','5')
          
           ->first();
       
        }
        if($prevquesoriginaloption!=$prevoption){
        $questions = Questions::whereIn('id',$quesarr)
           ->where(function ($query) {
               $query->where('weightage_type','2')
                     ->orWhere('weightage_type','1')
                      ->orWhere('weightage_type','3')
                     ->orWhere('weightage_type','4');
           })
           ->first();
        }
        $result=$questions;
     }
     //o  Evaluating
     if($weightage=='5'){
         if($prevquesoriginaloption==$prevoption){
         $questions = Questions::whereIn('id',$quesarr)
         ->where('weightage_type','5')
          
           ->first();
       
        }
        if($prevquesoriginaloption!=$prevoption){
        $questions = Questions::whereIn('id',$quesarr)
           ->where(function ($query) {
               $query->where('weightage_type','3')
                     ->orWhere('weightage_type','2')
                     ->orWhere('weightage_type','1')
                     ->orWhere('weightage_type','4');
           })
           ->first();
        }
        $result=$questions;
     }
     //o  Creating
     if($weightage=='6'){
         if($prevquesoriginaloption==$prevoption){
         $questions = Questions::whereIn('id',$quesarr)
         ->where('weightage_type','6')
          
           ->first();
       
        }
        if($prevquesoriginaloption!=$prevoption){
        $questions = Questions::whereIn('id',$quesarr)
           ->where(function ($query) {
               $query->where('weightage_type','5')
                     ->orWhere('weightage_type','2')
                     ->orWhere('weightage_type','1')
                     ->orWhere('weightage_type','4')
                     ->orWhere('weightage_type','3');
           })
           ->first();
        }
        $result=$questions;
     }
     return $result;
    }
}
