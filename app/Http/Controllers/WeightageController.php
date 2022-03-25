<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Weightages;
use DB;
class WeightageController extends Controller
{
     public function index(){
        $weightages= Weightages::toBase()->get();
       
        return view('weightages.listweightages',compact('weightages'));
        
    }
    public function addweightage()
    {  
      

        return view('weightages.addweightage');

      
    }
    public function storeweightage(Request $request)
    {
        
      $rules = [
          'weightage_title' => 'required|min:2|unique:weightages',
          'rating' => 'required'
      ];

      $errorMessage = [
          'required' => 'Enter your :attribute first.'
      ];

      $this->validate($request, $rules, $errorMessage);
      
      Weightages::create([
         'weightage_title' => $request->weightage_title,
         'rating' => $request->rating,
         
      ]);

    
     $this->meesage('message','Weightage created successfully!');
      //return redirect()->back();
       return redirect('weightage');

    }
    public function editweightage($id)
    { 
       $weightages = DB::table('weightages')->find($id);
       return view('weightages.editweightage',compact('weightages'));
    }
    public function updateweightage(Request $request,$id){
        
        $rules = [
          'weightage_title' => 'required|unique:weightages,weightage_title,'.$id,
          'rating' => 'required'
      ];

      $errorMessage = [
          'required' => 'Enter your :attribute first.'
      ];

      $this->validate($request, $rules, $errorMessage);
      $weightages = Weightages::find($id);
        $weightages->weightage_title = $request->get('weightage_title');
        $weightages->rating = $request->get('rating');
        $weightages->update();
    //   $weightages->update([
    //               'weightage_title' => $request->weightage_title,
    //               'rating' => $request->rating]);

      $this->meesage('message','Weightage Updated successfully!');
      return redirect('weightage');
        
    }
     public function delete_weightage($id)
    {
     // $category->delete();
       DB::delete('delete from weightages where id = ?',[$id]);
      $this->meesage('message','Weightage deleted successfully!');
      return redirect('weightage');
    }
    public function meesage(string $name = null, string $message = null)
    {
        return session()->flash($name,$message);
    }
}
