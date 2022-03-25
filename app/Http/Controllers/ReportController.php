<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use App\Models\Questions;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Exports\WithHeadings;
use DB;
class ReportController extends Controller
{
    public function report(){
       	$reports= DB::table('usertests')
        ->selectRaw('users.name as user_name,count(usertests.id) as testcount')
        ->leftjoin('users','users.id','usertests.user_id')
        ->where('users.role','user')
        ->groupBy('users.id')->get();
    	return view('reports.list',compact('reports'));
    }
    public function questionreports(){
       	$questions_reports=  DB::table('questions')
       	->selectRaw('question_categories.question_category,count(question_categories.id) as catcount')
       	->leftJoin('question_categories', 'question_categories.id', '=', 'questions.category')
       	->groupBy('question_categories.question_category')->get();
    	return view('reports.question-list',compact('questions_reports'));
    }
    public function weightagereports(Request $request){
       	$weightage_reports=  DB::table('questions')
       	->selectRaw('weightages.weightage_title,count(weightages.id) as wetcount')
       	->leftJoin('weightages', 'weightages.id', '=', 'questions.weightage_type')
       	->groupBy('weightages.weightage_title')->get();
    	return view('reports.weightage-list',compact('weightage_reports'));
    }
    public function websitereport(Request $request){
          $newfr =  str_replace('/', '-', $request->start_date);  
          $newto =  str_replace('/', '-', $request->end_date); 

          $from = date("Y-m-d", strtotime($newfr));
          $to = date("Y-m-d", strtotime($newto)); 
          $website_reports=''
          if($from!="1970-01-01" && $to!="1970-01-01"){
            $website_reports =  User::Select(DB::raw("DATE_FORMAT(created_at, '%Y') x"),DB::raw('count(id) as y'))
                                            ->where('role','user')
                                            ->whereBetween(DB::raw("DATE(created_at)"), [$from, $to])
                                            ->groupby('x')
                                            ->get()->toArray();
            $reports= User::where('role','user')
            ->whereBetween(DB::raw("DATE(created_at)"), [$from, $to])
            ->get();
         }else{
            
            $website_reports =  User::Select(DB::raw("DATE_FORMAT(created_at, '%Y') x"),DB::raw('count(id) as y'))
                                            ->where('role','user')
                                            ->groupby('x')
                                            ->get()->toArray();
            $reports= User::where('role','user')
            ->get();
         }
        return view('reports.website-performance',compact('website_reports','reports'));
    }
    public function audioreport(){
       $questions_reports= Questions::leftJoin("categories as cat", "cat.id", '=', "questions.category")
        ->leftjoin('weightages', 'weightages.id', '=', 'questions.weightage_type')
        ->leftjoin('question_categories', 'question_categories.id', '=', 'questions.question_type')
        ->select('questions.*','cat.category_name','weightage_title','question_category')
        ->where([['questions.status', '=', '0'],['question_categories.input_option', '=', 'Audio']])
        ->get();
      return view('reports.audio-question-list',compact('questions_reports'));
    }
    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
     //tagwise questions count report start
    public function tagreport(){
        $tagreport = DB::table("tags")
        ->select("tags.*",\DB::raw("count(questions.id) as questioncount"))
        ->leftjoin("questions",\DB::raw("FIND_IN_SET(tags.id,questions.tags)"),">",\DB::raw("'0'"))
        ->groupBy("tags.id")
        ->get();
            // echo "<pre>";
            // print_r($data);
            //->paginate(10);
      return view('reports.tagreport',compact('tagreport'));
    }
    //tagwise questions count report end
}
