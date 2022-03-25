<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questions;
use DB;
class QuestionsController extends Controller
{
   public function index(){
    // $questions= Questions::leftJoin("categories as cat", "cat.id", '=', "questions.category")
    //     ->leftjoin('weightages', 'weightages.id', '=', 'questions.weightage_type')
    //     ->leftjoin('question_categories', 'question_categories.id', '=', 'questions.question_type')
    //     ->select('questions.*','cat.category_name','weightage_title','question_category')
    //     ->where('questions.status', '0')
    //     ->get();
        $categories = DB::table('categories')->where('status','0')->get();
     return view('questions.questionslist',compact('categories'));
   }
     /* Process ajax request */
    public function getQues(Request $request)
    {

        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');
        $category = $request->get('category');
        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $columnSortOrder="asc";
        $searchValue = $search_arr['value']; // Search value
       if($category!=''){
        $filter=array('questions.status' =>0,'questions.category'=>$category);
       }else{
        $filter= array('questions.status' =>0);
       }
       
        //$filter= array('questions.status' =>0);
        // Total records
        $totalRecords = Questions::select('count(*) as allcount')
          ->where('questions.status', '=', 0)
        ->count();
        $totalRecordswithFilter = Questions::select('count(*) as allcount')
        ->leftJoin("categories as cat", "cat.id", '=', "questions.category")
        ->leftjoin('weightages', 'weightages.id', '=', 'questions.weightage_type')
        ->leftjoin('question_categories', 'question_categories.id', '=', 'questions.question_type')
        ->select('questions.*','cat.category_name','weightages.weightage_title','question_categories.question_category')
        ->where($filter)
        ->where(function ($query) use ($searchValue,$filter) {
        $query->where('questions.question', 'like', '%' . $searchValue . '%')
          ->orWhere('cat.category_name', 'like', '%' . $searchValue . '%')
          ->orWhere('weightages.weightage_title', 'like', '%' . $searchValue . '%');
       })
       ->count();

        // Get records, also we have included search filter as well
        $records = Questions::orderBy($columnName, $columnSortOrder)
        ->leftJoin("categories as cat", "cat.id", '=', "questions.category")
            ->leftjoin('weightages', 'weightages.id', '=', 'questions.weightage_type')
        ->leftjoin('question_categories', 'question_categories.id', '=', 'questions.question_type')
        ->select('questions.*','cat.category_name','weightages.weightage_title','question_categories.question_category')
       ->where($filter) 
      ->where(function ($query) use ($searchValue,$filter) {
       $query->where('questions.question', 'like', '%' . $searchValue . '%')
          ->orWhere('cat.category_name', 'like', '%' . $searchValue . '%')
          ->orWhere('weightages.weightage_title', 'like', '%' . $searchValue . '%');
       })
         
            // ->select('questions.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();
        
        $userid=auth()->user()->id;
        $data_arr = array();
        $sno=$start+1;
        foreach ($records as $record) {
            // $where=array("test_id"=>$record->id,"user_id"=>$userid);
            // $usertests = DB::table("usertests")->where($where)->first();
            // if(empty($usertests)){
            //    $action="<a href='".route('quiz' , $record->id)."' type='button' class='btn btn-success'>Start Exam</a>";
            // }
            // else{
            //    $action="<a href='".route('review_summary' , $usertests->id)."' type='button' class='btn btn-primary'>Review Summary</a>";
            // }
            
            $action="<a href='".route('editquestion' , $record->id)."' type='button' class='btn btn-sm btn-outline-primary py-0'>Edit</a>
            <a style='margin-left: 10px;' href='".route('deletequestion' , $record->id)."' class='btn btn-sm btn-outline-danger py-0 ".$record->id."' onclick='confirmpage(".$record->id.");return false;' >Delete</a>";
            $data_arr[] = array(
                "id" => $sno,
                "question" => $record->question,
                "category_name" => $record->category_name,
                "weightage_title" => $record->weightage_title,
                "question_category" => $record->question_category,
                "action" => $action,
            );
            $sno++;
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        echo json_encode($response);
    }
   public function addquestions(){
   	$categories = DB::table('categories')->where('status','0')->get();
   	$weightages = DB::table('weightages')->where('status','0')->get();
   	$questions_categories = DB::table('question_categories')->where('status','0')->get();
   
     return view('questions.addquestions',compact(['categories','weightages','questions_categories']));
   }
   public function gettagcategories($id)
   {
        $subcategories = DB::table("categories")->where("id",$id)->pluck("tag_questions","id")->first();
        $sub=explode(',',$subcategories);
        $tagcategories = DB::table('tags')
                    ->whereIn('id',$sub)
                    ->pluck("name","id");
                    //->get();

        

        echo  json_encode($tagcategories);
   }
   //get question count based on category and tag start
     public function get_questionscount(Request $request){
        $catid=$request->get('catid');
        $tagid=$request->get('tagid');
        if($tagid!='0'){
            $questionarr=array();
            foreach($tagid as $tag){
            $colname = $tag;
            $query = DB::table('questions')
           ->select("id")
           ->whereRaw('FIND_IN_SET(?,tags)', [$colname])
           ->get();
           $questionarr=$query;
          }
          $questionid=array();
          foreach($questionarr as $valqid){
            $questionid[]=$valqid->id;
          }
       }
     if($tagid=='0'){
        $questions = Questions::where('category', '=', $catid)
         ->get();
      }else{

        $questions = Questions::whereIn('id',$questionid)

           ->get();
      }
     $countques="Available Questions Count: ".count($questions);
     $avaques='<h4>Available Questions List</h4>
       
   <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>s.no</th>
        <th>Questions</th>
        <th>Category</th>
      </tr>
    </thead><tbody>';
    foreach ($questions as $key => $value) {
      $categories = DB::table("categories")->where("id",$value->category)->pluck("category_name")->first();
       $sno=$key+1;
       $avaques.='<tr>
        <td>'.$sno.'</td>
        <td>'.$value->question.'</td>
        <td>'.$categories.'</td>
      </tr>';
    }
    
      

   $avaques.= '</tbody></table>';
   $quesdetails=array('countques'=>$countques,
                      'avaques'=>$avaques);
      echo json_encode($quesdetails);
     }
   //get question count based on category and tag end
   public function savequestion(Request $request){
   	 
     $rules = [
          'question'       => 'required|min:2|unique:questions',
          'category'       => 'required',
          'weightage_type' => 'required',
          'question_type'  => 'required',
          'ans'            => 'required',
          'explanation'    => 'required'];

      $errorMessage = [
          'required' => 'Enter your :attribute first.'
      ];

      $this->validate($request, $rules, $errorMessage);
      if($request->get('tags')!=''){
      	$tags=implode(',',$request->get('tags'));
      }else{$tags="";}
      
       if($request->get('optiontype')=="text"){
        $questionoption=$request->get('options');
        $options=array();
        foreach($questionoption as $key => $value){
        	$sno=$key+1;
          $options +=array('option'.$sno.''=>$value);
        }
      }else{
      	//$files = [];
        if($request->hasfile('options'))
         {
         	$options=array();
            foreach($request->file('options') as $key => $file)
            {
            	$sno=$key+1;
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('images'), $name);  
                $options +=array('option'.$sno.''=>$name);
                //$files[] = $name;  
            }
         }
         //print_r($files);
      	
      	
      }
      if($request->hasfile('wrong_ans_audio'))
         {
          $wrong_ans_audio=$request->file('wrong_ans_audio');
         // print_r($wrong_ans_audio);
          $audioname = time().rand(1,100).'.'.$wrong_ans_audio->extension();
          $wrong_ans_audio->move(public_path('questions_wrong_ans_audio'),$audioname); 
          
         }else{ $audioname="";}
      Questions::create([
         'question'      => $request->get('question'),
         'category'      => $request->get('category'),
          'tags'          =>$tags,
          'weightage_type'=>$request->get('weightage_type'),
          'options'          =>json_encode($options),
          'question_type'=>$request->get('question_type'),
          'optiontype'=>$request->get('optiontype'),
          'ans'          =>$request->get('ans'),
          'notes'        =>$request->get('notes'),
          'explanation'  =>$request->get('explanation'),
          'wrong_ans_audio'=>$audioname
      ]);

    
     $this->meesage('message','Questions created successfully!');
      //return redirect()->back();
      return redirect('questions');
   }
   public function editquestion(Questions $question)
    { 
    	// echo "<pre>";
    	// print_r($question);

    	// exit();
    $categories = DB::table('categories')->where('status','0')->get();
   	$weightages = DB::table('weightages')->where('status','0')->get();
   	$questions_categories = DB::table('question_categories')->where('status','0')->get();
    $subcategories = DB::table("categories")->where("id",$question->category)->pluck("tag_questions","id")->first();
    $sub=explode(',',$subcategories);
    $tagcategories = DB::table('tags')
                    ->whereIn('id',$sub)
                    //->pluck("name","id");
                    ->get();

     return view('questions.editquestions',compact(['categories','weightages','questions_categories','question','tagcategories']));
         
    }
   public function updatequestions(Request $request, Questions $question)
    { 
    	$id=$question->id;
    	 $rules = [
          'question'       => 'required|min:2|unique:questions,id,'.$id,
          'category'       => 'required',
          'weightage_type' => 'required',
          'question_type'  => 'required',
          'ans'            => 'required',];

      $errorMessage = [
          'required' => 'Enter your :attribute first.'
      ];

      $this->validate($request, $rules, $errorMessage);
      if($request->get('tags')!=''){
      	$tags=implode(',',$request->get('tags'));
      }else{$tags="";}
      
       if($request->get('optiontype')=="text"){
        $questionoption=$request->get('options');
        $options=array();
        foreach($questionoption as $key => $value){
        	$sno=$key+1;
          $options +=array('option'.$sno.''=>$value);
        }
      }else{
      	//$files = [];
        if($request->hasfile('options'))
         {
         	$options=array();
            foreach($request->file('options') as $key => $file)
            {
            	$sno=$key+1;
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('images'), $name);  
                $options +=array('option'.$sno.''=>$name);
                //$files[] = $name;  
            }
         }else{
         	 $test = DB::table('questions')->find($id);
             $options=json_decode($test->options,true);

         	 //$options=$request->get('oldoptions');
         }
         //print_r($files);
      	
      	
      }
     if($request->hasfile('wrong_ans_audio'))
         {
          $wrong_ans_audio=$request->file('wrong_ans_audio');
          print_r($wrong_ans_audio);
          $audioname = time().rand(1,100).'.'.$wrong_ans_audio->extension();
          $wrong_ans_audio->move(public_path('questions_wrong_ans_audio'),$audioname); 
          
         }else{ $audioname=$request->get('oldwrong_ans_audio');}
      $question->update([
         'question'      => $request->get('question'),
         'category'      => $request->get('category'),
          'tags'          =>$tags,
          'weightage_type'=>$request->get('weightage_type'),
          'options'          =>json_encode($options),
          'question_type'=>$request->get('question_type'),
          'optiontype'=>$request->get('optiontype'),
          'ans'          =>$request->get('ans'),
          'notes'        =>$request->get('notes'),
          'explanation'  =>$request->get('explanation'),
          'wrong_ans_audio'=>$audioname
      ]);

    
     $this->meesage('message','Questions Updated successfully!');
      //return redirect()->back();
      return redirect('questions');

    } 
   public function deletequestion(Request $request, Questions $question){
   	
   	if($question->used_status==0){
      $question->status ="2";
      $question->update();
      $this->meesage('message','Questions Updated Successfully!');
   	}else{
   		$this->meesage('message','Unable to Delete Question in used!');
   	}
   	
    
    return redirect('questions');
   }
   public function meesage(string $name = null, string $message = null)
    {
        return session()->flash($name,$message);
    }
}
