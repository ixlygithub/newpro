<?php

namespace App\Http\Controllers\userdashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usertests;
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
       $weightagevalue=$request->weightagevalue;
       $correctoption=$request->correctoption;
       //echo "<pre>";
        //first question  
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
        //first question  
        //more questions
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
        
       } //more question end
        if(!empty($ques)){
           //current ques count check
       
           
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
          $current_quesno=$request->currentquesno+1;
          if($current_quesno>=60){
           //echo "hi";
           $data = $request->all();
           $res=$this->submitquiztest($data);
           if($res=="next"){
           
              echo '<div class="question"><p>'.$current_quesno.'. '.$ques->question.'?</p>
          <input type="hidden" value="'.$ques->id.'" id="cquestionid">
          <input type="hidden" value="'.$ques->ans.'" id="correctoption"><br>
           <input type="hidden" value="'.$ques->weightage_type.'" id="cquestion_weightage">
           </div><div class="answer '.$class.'">'.$quesoptions.'</div>';
           }
          }else{
            echo '<div class="question"><p>'.$current_quesno.'. '.$ques->question.'?</p>
          <input type="hidden" value="'.$ques->id.'" id="cquestionid">
          <input type="hidden" value="'.$ques->ans.'" id="correctoption"><br>
           <input type="hidden" value="'.$ques->weightage_type.'" id="cquestion_weightage">
           </div><div class="answer '.$class.'">'.$quesoptions.'</div>';
          }
           
        }
        else{
          $this->submitquiztest($request);
          exit();
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
    public function submitquiz(Request $request){
      $quiz=$request->quiz;
      $useroption=$request->useroption;
       print_r($quiz);
      print_r($useroption);
      echo "hi".$testid=$request->testid;
      
    }
    public function submitquiztest($request)
    {
     
      // print_r($request);
       //echo "<pre>";
      $useroption    =$request['useroption'];
      $quiz          =$request['quiz'];
      $weightagevalue=$request['weightagevalue'];
      $correctoption =$request['correctoption'];
      $plotpoints =$request['plotpoints'];
      $totalques =$request['totalques'];
      
      //print_r($plotpoints);
      $level=count($weightagevalue);
      // print_r($quiz);
      // print_r($weightagevalue);
      // print_r($correctoption);
      // print_r($useroption);

          //mean calculation start formula=sum(weightagelevel)/n;
          $weightage=array_sum($plotpoints);
           //echo "<br>";
          $total =count($quiz);
          $mean=round($weightage/$total,2);
          //mean calculation end
          //echo $mean;
          //standard deviation start
          $weighlevelsquare=array();
          foreach($plotpoints as $weightage){
            $weighlevel=$weightage-$mean;
            $weighlevelsquare[]=$weighlevel*$weighlevel;
          }
          //echo "<pre>";
          $allweight=array_sum($weighlevelsquare);
          $n         =$total-1;
          //echo "<br>";
          $standard_dev=round($allweight/$n,2);
          
          $standard_deviation=round(sqrt($standard_dev),2);
           //standard deviation end
          //echo "<br>";
          //Confidence inteval formula
          // X  ±  Z s/√n  
          // • X is the mean 
          // • Z is the chosen Z-value from the table above
              //95 confidence default zcore 1.96
          // • s is the standard deviation
          // • n is the number of observations
          $standard_std=($standard_deviation/round(sqrt($total),2));
          //echo "<br>";
          $sec         =1.96*$standard_std;
          //echo "<br>";
          $confidence_inter_positive=round($mean+$sec,2);
          //echo "<br>";
          $confidence_inter_negative=round($mean-$sec,2);
          //echo "<br>";
          if($confidence_inter_negative>=3 && abs($confidence_inter_positive<=6.99)){
              $test_result="pass";
          }else{
            $test_result="fail";
          }
          
          if($test_result=="pass"){
            
             Usertests::create([
             'test_id' => $request['testid'],
             'user_id' => auth()->user()->id,
             'test_result'=>$test_result,
             'time_taken'=>$request['timetaken']
              ]);  
             echo "submitedpass";
            return "submited";
          }else{
               if(($totalques!=$total) && ($confidence_inter_negative>=2 || $confidence_inter_positive>=2))
               {
                echo "next";
                return "next";
               }
               else
               {
                
        
                  Usertests::create([
               'test_id' => $request['testid'],
               'user_id' => auth()->user()->id,
               'test_result'=>$test_result,
               'time_taken'=>$request['timetaken']
               
                ]); 
                echo "submitedfail";
                 return "submited";   
               }

          }
             
   }
    public function submitquiztestback($request)
    {
     
      // print_r($request);
       echo "<pre>";
      $useroption    =$request['useroption'];
      $quiz          =$request['quiz'];
      $weightagevalue=$request['weightagevalue'];
      $correctoption =$request['correctoption'];
      $plotpoints =$request['plotpoints'];
      print_r($plotpoints);
      $level=count($weightagevalue);
      print_r($quiz);
      print_r($weightagevalue);
      print_r($correctoption);
      print_r($useroption);

          //mean calculation start formula=sum(weightagelevel)/n;
          $weightage=array_sum($weightagevalue);
          $total =count($quiz);
          $mean=round($weightage/$total,2);
          //mean calculation end
          //echo $mean;
          //standard deviation start
          $weighlevelsquare=array();
          foreach($weightagevalue as $weightage){
            $weighlevel=$weightage-$mean;
            $weighlevelsquare[]=$weighlevel*$weighlevel;
          }
          //echo "<pre>";
          $allweight=array_sum($weighlevelsquare);
          $n         =$total-1;
          //echo "<br>";
          $standard_dev=round($allweight/$n,2);
          //echo "<br>";
          $standard_deviation=round(sqrt($standard_dev),2);
           //standard deviation end
          //echo "<br>";
          //Confidence inteval formula
          // X  ±  Z s/√n  
          // • X is the mean 
          // • Z is the chosen Z-value from the table above
              //95 confidence default zcore 1.96
          // • s is the standard deviation
          // • n is the number of observations
          $standard_std=($standard_deviation/round(sqrt($total),2));
          //echo "<br>";
          $sec         =1.96*$standard_std;
          //echo "<br>";
          $confidence_inter_positive=round($mean+$sec);
          //echo "<br>";
          $confidence_inter_negative=round($mean-$sec);
           //echo "<br>";
         
          $start=$confidence_inter_negative-1;
          $end=$confidence_inter_positive-1;  
          $passlevel=[];
          for ($x = $start; $x <= $end; $x++) {
             
          //echo $x."<br>";
          //echo $weightagevalue[$x]."<br>";
          if($weightagevalue[$x]<=3){
            $passlevel[]='true';
           }else{
            $passlevel[]='false';
           }
          }
          if (count(array_unique($passlevel)) === 1 && end($passlevel) === 'true') {
            $test_result="pass";
          }else{
            $test_result="fail";
          }
          echo "submited data";
          //echo $request['timetaken'];
          Usertests::create([
         'test_id' => $request['testid'],
         'user_id' => auth()->user()->id,
         'test_result'=>$test_result,
         'time_taken'=>$request['timetaken']
          ]);
    }
}
