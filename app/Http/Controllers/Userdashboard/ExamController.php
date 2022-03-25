<?php

namespace App\Http\Controllers\Userdashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;
use DB;
class ExamController extends Controller
{
    public function index(){

         
        $tests=Test::where('test_type','comprehensive')
        ->where('status','A')
        ->first();
        return view('userdashboard/examlist',compact('tests'));
    }
   
    /* Process ajax request */
    public function getExam(Request $request)
    {

        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');
        $searchexamstatus=$request->get('examsearch');
        $searchetest=$request->get('testsearch');
        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $columnSortOrder="asc";
        $searchValue = $search_arr['value']; // Search value
       // echo $searchetest;
        if($searchetest=="testsearch"){
            //echo "yui";
            
            $filter= array('status' =>'A','tests.test_name'=>$searchexamstatus);
            //print_r($filter);
        }else{
             $filter= array('status' =>'A');
             //print_r($filter);
        }
        // Total records
        $totalRecords = Test::select('count(*) as allcount')->where($filter)->count();
        $totalRecordswithFilter = Test::select('count(*) as allcount')->where('test_name', 'like', '%' . $searchValue . '%')
         //->where('status','A')
          ->where($filter)
        ->count();

        // Get records, also we have included search filter as well
        $records = Test::orderBy($columnName, $columnSortOrder)
            ->where('tests.test_name', 'like', '%' . $searchValue . '%')
             //->where('status','A')
             ->where($filter)
            // ->orWhere('students.', 'like', '%' . $searchValue . '%')
            // ->orWhere('students.branch', 'like', '%' . $searchValue . '%')
            ->select('tests.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();
        
        $userid=auth()->user()->id;
        $data_arr = array();
        $sno=$start+1;
        
        if($searchexamstatus=="start"){
            foreach ($records as $record) {
            $where=array("test_id"=>$record->id,"user_id"=>$userid);
            $usertests = DB::table("usertests")->where($where)->first();

            //if(empty($usertests)){
               $action="<a href='".route('quiz' , $record->id)."' type='button' class='btn btn-success'>Start Exam</a>";
                $data_arr[] = array(
                "id" =>$sno,
                "test_name" => $record->test_name,
                "hours" => $record->hours,
                "action" => $action,
            );
          
            //}
            
            $sno++;
        }

        }
        if($searchexamstatus=="review"){
            foreach ($records as $record) {
            $where=array("test_id"=>$record->id,"user_id"=>$userid);
            $usertests = DB::table("usertests")->where($where)->first();

            if(!empty($usertests)){
               $action="<a href='".route('review_summary' , $usertests->id)."' type='button' class='btn btn-primary'>Review Summary</a>";
                $data_arr[] = array(
                "id" =>$sno,
                "test_name" => $record->test_name,
                "hours" => $record->hours,
                "action" => $action,
            );
          
            }
            
            $sno++;
        }

        }
        else{
        foreach ($records as $record) {
            $where=array("test_id"=>$record->id,"user_id"=>$userid);
            $usertests = DB::table("usertests")->where($where)->first();
             $action="<a href='".route('quiz' , $record->id)."' type='button' class='btn btn-success'>Start Exam</a>";
            
                $data_arr[] = array(
                "id" =>$sno,
                "test_name" => $record->test_name,
                "hours" => $record->hours,
                "action" => $action,
            );
                
             
            
           
            $sno++;
        }
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        echo json_encode($response);
    }
   public function exams($id){
        if($id==1){
            $exams = DB::table('usertests')
                ->select('tests.test_name','usertests.test_result','usertests.created_at')
                ->leftjoin('tests','tests.id','usertests.test_id')
                ->where('test_result', '=', 'pass')
                ->get()->toArray();
        }elseif($id==2){
            $exams = DB::table('usertests')
                ->select('tests.test_name','usertests.test_result','usertests.created_at')
                ->leftjoin('tests','tests.id','usertests.test_id')
                ->where('test_result', '=', 'left')
                ->get()->toArray();
        }else{
            $exams = DB::table('usertests')
                ->select('tests.test_name','usertests.test_result','usertests.created_at')
                ->leftjoin('tests','tests.id','usertests.test_id')
                ->get()->toArray();
        }
        return view('userdashboard/exams',compact('exams'));
    }
    public function exam_history(){
        $exams = DB::table('usertests')
                ->select('tests.test_name','usertests.test_result','usertests.created_at','usertests.id as userid')
                ->leftjoin('tests','tests.id','usertests.test_id')
                ->get()->toArray();
        //Bar Chart
        $bar_chart = DB::table('usertests')->Select('created_at as x',DB::raw("DATE_FORMAT(created_at, '%M') as dateform"),DB::raw('count(id) as y'))
            ->where([[DB::raw("DATE_FORMAT(created_at, '%Y')"), '=', date('Y')]])
            ->groupby('dateform')
            ->get()->toArray();
       // dd($bar_chart);
        //Pie Chart
        $pass_exam_count =  DB::table('usertests')->where('test_result', '=', 'pass')->get()->toArray();
        $fail_exam_count =  DB::table('usertests')->where('test_result', '=', 'fail')->get()->toArray();
        $quit_exam_count =  DB::table('usertests')->where('test_result', '=', 'left')->get()->toArray();
        $all_exam_count  =  DB::table('usertests')->get()->toArray();
        return view('userdashboard/exam_history',compact('exams','bar_chart','pass_exam_count','fail_exam_count','all_exam_count','quit_exam_count'));
    }
}
