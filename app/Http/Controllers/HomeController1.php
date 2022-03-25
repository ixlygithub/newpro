<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Validator;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (auth()->user()->role == 'admin'||auth()->user()->role == 'adminuser') {
            // User Accounts
            $website_reports =  User::Select('created_at as x',DB::raw("DATE_FORMAT(created_at, '%M') as dateform"),DB::raw('count(id) as y'))
                                                ->where([['role', '=', "user"],[DB::raw("DATE_FORMAT(created_at, '%Y')"), '=', date('Y')]])
                                                ->groupby('dateform')
                                                ->get()->toArray();
            //Passing Percentage
            $passing_reports = DB::table('usertests')->Select('created_at as x',DB::raw("DATE_FORMAT(created_at, '%M') as dateform"),DB::raw('count(id) as y'))
            ->where([['passing_percentage', '=', "1"],[DB::raw("DATE_FORMAT(created_at, '%Y')"), '=', date('Y')]])
            ->groupby('dateform')
            ->get()->toArray();
    
            //User Test 
            $test_reports = DB::table('usertests')->Select('created_at as x',DB::raw("DATE_FORMAT(created_at, '%M') as dateform"),DB::raw('count(id) as y'))
            ->where([[DB::raw("DATE_FORMAT(created_at, '%Y')"), '=', date('Y')]])
            ->groupby('dateform')
            ->get()->toArray();
    
            //Total Users Per Week
            $todal_day = User::where('role','user')
                            ->where('created_at', '>', Carbon::now()->startOfWeek())
                            ->where('created_at', '<', Carbon::now()->endOfWeek())
                            ->get();
    
            //Total Users Per Day
            $todal_weeks = User::Select('created_at as x',DB::raw("DATE_FORMAT(created_at, '%d') as dateform"),DB::raw('count(id) as y'))
                            ->where([['role', '=', "user"]])
                            ->where('created_at', '>', Carbon::now()->startOfWeek())
                            ->where('created_at', '<', Carbon::now()->endOfWeek())
                            ->groupby('dateform')
                            ->get()->toArray();
    
            //Passing Percentage Per Week
             $passing_reports_week = DB::table('usertests')->Select('created_at as x',DB::raw("DATE_FORMAT(created_at, '%d') as dateform"),DB::raw('count(id) as y'))
            ->where('passing_percentage', '=', "1")
            ->where('created_at', '>', Carbon::now()->startOfWeek())
            ->where('created_at', '<', Carbon::now()->endOfWeek())
            ->groupby('dateform')
            ->get()->toArray();
            
            //User Test Week
            $test_reports_week = DB::table('usertests')->Select('created_at as x',DB::raw("DATE_FORMAT(created_at, '%M') as dateform"),DB::raw('count(id) as y'))
            ->where('created_at', '>', Carbon::now()->startOfWeek())
            ->where('created_at', '<', Carbon::now()->endOfWeek())
            ->groupby('dateform')
            ->get()->toArray();
    
            // dd($passing_reports);
            return view('dashboard',compact('website_reports','passing_reports','test_reports','todal_day','todal_weeks','passing_reports_week','test_reports_week'));
            // dd($passing_reports);
        }
       
        return redirect('userpage');
    }
    public function userpage()
    {
    //     $uncats = DB::table('usertests')->select('test_questions.question_id','usertests.questionsid','usertests.user_option','tests.test_name')
    //         ->leftjoin('test_questions','test_questions.test_id','usertests.test_id')
    //         ->leftjoin('tests','tests.id','usertests.test_id')
    //         ->where('usertests.user_id',Auth::user()->id)
    //         ->get()->toArray();
    //     $arr_ques = array();
    //     $arr_ans = array();
    //     $user_option = array();
    //     $test_name = array();
    //     foreach ($uncats as $key => $uncat) {
    //         $arr_ques[] = explode(',', $uncat->question_id);
    //         $test_name[] = $uncat->test_name;
    //         $user_option[] = explode(',', $uncat->user_option);
    //         $arr_ans[] = explode(',', $uncat->questionsid);
    //     }
    //     $i=0;
    //     $unans_array = array();
    //     $ans_array = array();
    //     foreach ($arr_ques as $key => $arr_que){
    //         if(count($arr_que)!=count($arr_ans[$i])){
    //             $unans_array[] = array_diff($arr_que,$arr_ans[$i]);
    //         }
    //         $ans_array[] = $arr_ans[$i];
    //         $i++;
    //     }
    //     $array_datas = array_reduce($unans_array,'array_merge',array());
    //     $ans_array_datas = array_reduce($ans_array,'array_merge',array());
    //     $unanswers=DB::table('categories')
    //                     ->SelectRaw('categories.category_name, COUNT(*) as num_items,GROUP_CONCAT(questions.id) AS items')
    //                     ->join('questions','questions.category','categories.id')
    //                     ->WhereIn('questions.id',$array_datas)
    //                     ->groupby('categories.id')
    //                     ->get()->toArray();
    //     $answers=DB::table('categories')
    //                     ->SelectRaw('categories.category_name, COUNT(*) as num_items,GROUP_CONCAT(questions.id) AS items')
    //                     ->join('questions','questions.category','categories.id')
    //                     ->WhereIn('questions.id',$ans_array_datas)
    //                     ->groupby('categories.id')
    //                     ->get()->toArray();
    //   $quesarr=array_reduce($arr_ques,'array_merge',array());
    //   $ques= DB::table("questions")->whereIn('id',$quesarr)->get();
    //   $userattenques=array_reduce($arr_ans,'array_merge',array());
    //   $userattenoption=array_reduce($user_option,'array_merge',array());
    //   $taketest=array();
    //   $correct=0;
    //   $incorrect=0;
    //   $userans=0;
    //   foreach ($ques as $key => $value) {
    //         $category_id=$value->category;
    //         $category = DB::table("categories")->where("id",$category_id)->first();
    //         if(in_array($value->id,$userattenques)){
          
    //             $position =array_search($value->id,$userattenques);
    //             $userans  =$userattenoption[$position]; 
            
    //         }else{
    //           $userans  ="";
    //         }

    //         if($value->ans==$userans){
    //           $correct+=1;
    //           $question_result="correct";
    //         }
    //         else{
    //           $incorrect+=1;
    //           if(empty($userans)){
    //              $question_result="notanswer";
    //           }else{
    //             $question_result="incorrect";
    //           }
              
    //         }
    //         $taketest[]=array('question_id'    =>$value->id,
    //                           'questions'      =>$value->question,
    //                           'question_result'=>$question_result,
    //                           'questionans'    =>$value->ans,
    //                           'userans'        =>$userans,
    //                           'category'       =>$category->category_name);
         
    //   }
    //   // WRONG ANSWER
    //   $wrong_an = array();
    //   foreach ($taketest as $key => $taketes) {
    //       if($taketes['question_result']=='incorrect')
    //         {
    //             $wrong_an[] = $taketes['question_id'];
    //         }        
    //     }
    //     $wrong_ans = DB::table('categories')
    //                     ->SelectRaw('categories.category_name, COUNT(*) as num_items,GROUP_CONCAT(questions.id) AS items')
    //                     ->join('questions','questions.category','categories.id')
    //                     ->WhereIn('questions.id',$wrong_an)
    //                     ->groupby('categories.id')
    //                     ->get()->toArray();
    //     // CORRECT ANSWER
    //     $correct_an = array();
    //   foreach ($taketest as $key => $taketes) {
    //       if($taketes['question_result']=='correct')
    //         {
    //             $correct_an[] = $taketes['question_id'];
    //         }        
    //     }
    //     $correct_ans = DB::table('categories')
    //                     ->SelectRaw('categories.category_name, COUNT(*) as num_items,GROUP_CONCAT(questions.id) AS items')
    //                     ->join('questions','questions.category','categories.id')
    //                     ->WhereIn('questions.id',$correct_an)
    //                     ->groupby('categories.id')
    //                     ->get()->toArray();
    //     // dd($correct_ans);
    //     return view('userdashboard/questions',compact('unanswers','answers','wrong_ans','correct_ans'));
      $title="Categories Wise Test Taken Report";
      $aid=auth()->user()->id;
       $usertest = DB::table("usertests")
       ->select("test_id")
       ->where("user_id",$aid)
       ->groupBy("test_id")
       ->get()
       ->toArray();
       $catreport=array();
       $newcatreport=array();
       $testids = array_column($usertest,'test_id');
       if(empty($testids)){
            $cat = DB::table("categories")
           ->select("id","category_name")
           ->get();
         foreach ($cat as  $value) {
             $color="#808080";
             $catreport[]   =array('category'=>$value->category_name,
                                'test_details'=>0,
                                 'color'=>$color);
            $newcatreport[] =array('category'=>$value->category_name,
                                    'column-1'=>0);
         }
       }
       else
       {
         $tagreport1 = DB::table("categories")
        ->select("categories.*",\DB::raw("count(tests.id) as categorycount"))
        ->leftjoin("tests",\DB::raw("FIND_IN_SET(categories.id,tests.category)"),">",\DB::raw("'0'"))
         ->whereIn('tests.id', $testids)
        //->where('tests.','5')
        ->groupBy("categories.id")
        ->get()
        ->toArray();

         $catids = array_column($tagreport1,'id');
  // print_r($catids);
         $catnot = DB::table("categories")
           ->select("id","category_name")
           ->whereNotIn('id', $catids)
           ->get();
     
      // print_r($catnot);
       foreach($tagreport1 as $val){
         if($val->categorycount>0){
          $test_details="testtaken";
          $color="#CD0D74";
         }else{
          $test_details="testnottaken";
           $color="#808080";
         }
        $catreport[]=array('category'=>$val->category_name,
                         'test_details'=>$val->categorycount,
                         'color'=>$color);
        $newcatreport[]=array('category'     =>$val->category_name,
                              'column-1'=>$val->categorycount);
         
        }
         $catreport2=array();
         $newcatreport2=array();
        foreach ($catnot as $catval) {
            $color="#808080";
            $catreport2[]=array('category'=>$catval->category_name,
                         'test_details'=>0,
                         'color'=>$color);
        $newcatreport2[]=array('category'   =>$catval->category_name,
                              'column-1'=>0);
        }
        $catreport=array_merge($catreport,$catreport2);
        $newcatreport=array_merge($newcatreport,$newcatreport2);
       }
     
      $qcount = array_column($catreport, 'test_details');
      if(count(array_unique($qcount)) === 1 && end($qcount) === 0) {
       $categories=DB::table('categories')
                        ->SelectRaw('categories.id,categories.category_name, COUNT(*) as questionscount,GROUP_CONCAT(questions.id) AS items')
                        ->join('questions','questions.category','categories.id')
                       
                        ->groupby('categories.id')
                        ->get();


        
         $catreport=array();
         $newcatreport=array();
         
        foreach ($categories as $catval) {
           
             if($catval->questionscount>0){
                $color="#CD0D74";
              }else{
              $color="#808080";
             }
            $catreport[]=array('category'=>$catval->category_name,
                         'test_details'=>$catval->questionscount,
                         'color'=>$color);
        $newcatreport[]=array('category'   =>$catval->category_name,
                              'column-1'=>$catval->questionscount);
        }           
           $title="Categories Wise Questions Report"; 
          }
        //     echo "<pre>";
        //   print_r($catreport);
        return view('userdashboard/categorywise_testreport',compact('catreport','newcatreport','title'));
    }
    public function myaccount()
    {
        $pass_exam_count =  DB::table('usertests')->where('test_result', '=', 'pass')->get()->toArray();
        $quit_exam_count =  DB::table('usertests')->where('test_result', '=', 'left')->get()->toArray();
        $all_exam_count =  DB::table('usertests')->get()->toArray();
        //dd(count($pass_exam_count));
        return view('userdashboard/account_final',compact('pass_exam_count','quit_exam_count','all_exam_count'));
    }
    //Update PAN NO
    public function updatepanno(Request $request)
    {
      
        DB::table('users')
              ->where('id', auth()->user()->id)
              ->update(['pan_no' => $request->pan_no]);
        $request->session()->flash('success', 'PAN NO Updated Successfully!');
        return redirect('/myaccount')->with('success', 'PAN NO Updated Successfully!');
    }
    //Update Feedback
    public function updatepfe(Request $request)
    {
        DB::table('user_feedback') ->insert([
                        'user_id' => auth()->user()->id,
                        'feed_back' => $request->user_feedback,
                      ]);
        $request->session()->flash('success', 'Feedback sent successfully!');
        return redirect('/userpage')->with('success', 'Feedback sent successfully!');
    }
    public function adminlogout()
    {
        Auth::logout();
        return redirect('admin');
        
        
    }

}