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
        }
       
        return redirect('userpage');
    }
    public function userpage()
    {
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
                                    'column-1'=>0,
                                    "am4core.color('".$color."')");
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
        define('CONSTANT', 'am4core');
     
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

     
        //$var = "am4core.color('".$color."')";
        $newcatreport[]=array('category'     =>$val->category_name,
                              'column-1'=>$val->categorycount,
                              "color"=> $color);
         
        }
         $catreport2=array();
         $newcatreport2=array();
        foreach ($catnot as $catval) {
            $color="#808080";
            $catreport2[]=array('category'=>$catval->category_name,
                         'test_details'=>0,
                         'color'=>$color);
        $newcatreport2[]=array('category'   =>$catval->category_name,
                              'column-1'=>0,
                              "color"=>"am4core.color(".$color.")");
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
                              'column-1'=>$catval->questionscount,
                              'color'=>"am4core.color(".$color.")");
        }           
           $title="Categories Wise Questions Report"; 
          }
           /* echo "<pre>";
           print_r($catreport);*/
        return view('userdashboard/categorywise_testreport',compact('catreport','newcatreport','title'));
    
    }
    public function myaccount()
    {
        return view('userdashboard/account_final');
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
