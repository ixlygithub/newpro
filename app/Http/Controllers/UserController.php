<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Redirect;
use DB;
class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
       
        
    $currentURL = url()->current();
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    $url=$uri_segments[2];
    $role=auth()->user()->role;
    $priviledge=auth()->user()->privileges;
    $priviledge=explode(',',$priviledge);
    // $priviledge=array('user1','useredit');
    return view('users.userlist');

   }
    public function getUsers(Request $request)
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
        //$filter=array('users.status' =>"0",'users.role'=>$category);
        $filter=array('users.role'=>$category);
       }
       else{
        $filter= array();
       
       }
      
        // Total records
        $totalRecords = User::select('count(*) as allcount')
        ->where($filter)
        //->where('users.status','>=',"0")
        ->count();
        $totalRecordswithFilter = User::select('count(*) as allcount')
        // ->leftJoin("categories as cat", "cat.id", '=', "questions.category")
        // ->leftjoin('weightages', 'weightages.id', '=', 'questions.weightage_type')
        // ->leftjoin('question_categories', 'question_categories.id', '=', 'questions.question_type')
        //->select('users.*')
      
        ->where($filter)
     
        ->where(function ($query) use ($searchValue) {
       $query->where('users.name', 'like', '%' . $searchValue . '%')
          ->orWhere('users.email', 'like', '%' . $searchValue . '%')
          ->orWhere('users.role', 'like', '%' . $searchValue . '%');
       })
       ->count();

        // Get records, also we have included search filter as well
        $records = User::orderBy($columnName, $columnSortOrder)
        // ->leftJoin("categories as cat", "cat.id", '=', "questions.category")
        //     ->leftjoin('weightages', 'weightages.id', '=', 'questions.weightage_type')
        // ->leftjoin('question_categories', 'question_categories.id', '=', 'questions.question_type')
       // ->select('users.*')
       ->where($filter) 
     
      ->where(function ($query) use ($searchValue) {
       $query->where('users.name', 'like', '%' . $searchValue . '%')
          ->orWhere('users.email', 'like', '%' . $searchValue . '%')
          ->orWhere('users.role', 'like', '%' . $searchValue . '%');
       })
         
            // ->select('questions.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();
        
        $userid=auth()->user()->id;
        $data_arr = array();
         $sno=$start+1;
         $status="";
        foreach ($records as $record) {
          if($record->status==0){
            
             $status='<button type="button" class="btn btn-sm btn-success">Active</button>';
             $trail='';
          }
          if($record->status==2){
           
            $status='<button type="button" class="btn btn-sm btn-warning '.$record->id.'"  href="'.route('userstatusupdate',$record->id).'" onclick="confirmpage('.$record->id.')"  >Trial</button>';

             $trail='<li><a type="button" href="#" class="btn btn-sm btn-outline-danger py-0" onclick="trailextend('.$record->id.');return false;">Trial Extend</a></li>';
          }
          $results = DB::select("SELECT count(id) as unread_msg FROM `chats` where status='unread' and from_role='user' and from_user='".$record->id."'");
           $unread_msg=$results[0]->unread_msg;
                 if($unread_msg>0){
                   $msgcount=$unread_msg;
                  $message='<span class="badge badge-light" onclick="chathistory('.$record->id.');" data-toggle="modal" data-target="#myModal">'.$msgcount.'</span>';
                 }else{
                  $message='';
                 }
         // $results = DB::select('select * from users where id = :id', ['id' => 1]);
           $chat=' <span id="group">
                 <button type="button" class="btn btn-sm btn-outline-danger'.$record->id.'" onclick="chathistory('.$record->id.');" data-toggle="modal" data-target="#myModal">
                  <i class="fa fa-envelope"></i>
                 </button>
                 '.$message.'
               </span>';
          $action='<div class="dropdown">
  <button class="btn  btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li><a type="button" class="btn btn-sm btn-outline-primary py-0" href="'.route('edituser' , $record->id).'">Edit</a></li>
    <li><a type="button" href="'.route('deleteuser' , $record->id).'" class="btn btn-sm btn-outline-danger py-0 '.$record->id.'" onclick="confirmpage('.$record->id.');return false;">Delete</a></li>
      '.$trail.'
       
  </ul>
</div>';
          
            
            // $action="<a href='".route('edituser' , $record->id)."' type='button' class='btn btn-sm btn-outline-primary py-0'>Edit</a>
            // <a style='margin-left: 10px;' href='".route('deleteuser',$record->id)."' class='btn btn-sm btn-outline-danger py-0' onclick='confirmpage(".$record->id.");return false;' >Delete</a>";
            $data_arr[] = array(
                "id" => $sno,
                "name" => $record->name,
                "email" => $record->email,
               "role"=>$record->role,
               "status"=>$status,
               "chat"=>$chat,
                "action" => $action,
            );
            $sno++;
        }
        
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
            ""
        );

        echo json_encode($response);
    }
    public function adduser(){

       return view('users.adduser');
    }
    public function save(Request $request){
      
      $rules1 = [
          'name' => 'required|min:2',
          'password' =>'required|string|min:8',
          'role' => 'required',

      ];
      $id=$request->id;
      if($request->id==""){
        $rules2= ['email' => 'required|unique:users'];
      }
      else{
        $rules2= ['email' => 'required|unique:users,id,'.$id];
      }
      $rules=array_merge($rules1,$rules2);  
      $errorMessage = [
          'required' => 'Enter your :attribute first.'
      ];
 
      $this->validate($request, $rules, $errorMessage);
      if($request->privileges!=""){
         $privileges=implode(',',$request->privileges);
      }else{$privileges="";}
      if($request->id==""){
        if($request->role=="user"){
          $status    =$request->status;
          $trail_from =date('Y-m-d');
          $trail_to  =date('Y-m-d', strtotime("+2 days"));
        }else{
           $status=0;
           $trail_from ="0000-00-00";
           $trail_to  ="0000-00-00";
        }
        
        User::create([
         'name'    => $request->name,
         'email'    => $request->email,
         'password' => Hash::make($request['password']),
         'role'      => $request->role,
         'privileges'=>$privileges,
         'status'    =>$status,
         'trail_from'=>$trail_from,
         'trail_to'  =>$trail_to

         ]);
        $this->meesage('message','User created successfully!');
        }
        
    
     
      //return redirect()->back();
       return redirect('user');
    }
    public function edituser(User $user)
    { 
        return view('users.edituser',compact('user'));
    }
     public function updateuser(Request $request, User $user){
      $id=$request->id;
       $rules = [
          'name' =>'required|min:2',
          'email'=>'required|unique:users,email,'.$id,
          'role' => 'required',];
       
      $errorMessage = [
          'required' => 'Enter your :attribute first.'
      ];
 
      $this->validate($request, $rules, $errorMessage);
      if($request->privileges!=""){
         $privileges=implode(',',$request->privileges);
      }else{$privileges="";}
    
      $userup = User::find($request->id);
       if($request->role=="user"){
          $status    =$request->status;
          $trail_from =date('Y-m-d');
          $trail_to  =date('Y-m-d', strtotime("+2 days"));
        }else{
           $status=0;
           $trail_from ="0000-00-00";
           $trail_to  ="0000-00-00";
        }
      
        $userup->name = $request->name;
        $userup->email = $request->email;
        $userup->role = $request->role;
       
        $userup->privileges=$privileges;
        if($request->role=="user"){
          $status    =$request->status;
          $trail_from =date('Y-m-d');
          $trail_to  =date('Y-m-d', strtotime("+2 days"));
          if($status=="2"){
          $userup->trail_from = $trail_from;
          $userup->trail_to = $trail_to;
          }
          $userup->status =$status;
          
        }
        $userup->update();        
      
      $this->meesage('message','User Updated successfully!');
      return redirect('user');
     }
    public function deleteuser($id){
      DB::delete('delete from users where id = ?',[$id]);
      $this->meesage('message','User deleted successfully!');
      return redirect('user');
    }
    public function updatetrails(Request $request){
       
      $request->id;
      $days=$request->trailcount;
      $userup = User::find($request->id);
       
      if($userup->trail_from=="0000-00-00"){
        $userup->trail_from = date('Y-m-d');
      }
        
        $userup->trail_to = date('Y-m-d', strtotime("+".$days." days"));
        
        $userup->update();
        echo "Update trails successfully";
    }
    public function userstatusupdate($id){
      //echo $id;
      $userup = User::find($id);
      $userup->status ="0";
        
        $userup->update();
        $this->meesage('message','User status  Updated successfully!');
      return redirect('user');
    }
    public function meesage(string $name = null, string $message = null)
    {
        return session()->flash($name,$message);
    }
}