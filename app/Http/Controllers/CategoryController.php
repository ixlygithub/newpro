<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Category;
use DB;
class CategoryController extends Controller
{
    // public function __construct()
    // {
    // $this->middleware('auth');
    // }
    public function index(){
        $category = Category::toBase()->get();
       
        return view('category.listcategory',compact('category'));
        
    }
    public function addcategory()
    {  
      $tagquestions = DB::table('tags')->where('status','0')->get();
         
        return view('category.addcategory',compact('tagquestions'));

      
    }
    public function storecategory(Request $request)
    {
        
      $rules = [
          'category_name' => 'required|min:2|unique:categories',
          'comprehensive' => 'required',
          'comprehensive_test_percentage' => 'required|numeric|min:1|max:100',
          'max_questions' => 'required|numeric|min:1|max:100',

      ];

      $errorMessage = [
          'required' => 'Enter your :attribute first.'
      ];

      $this->validate($request, $rules, $errorMessage);
      $tag_questions=implode(',',$request->tag_questions);
      Category::create([
         'category_name' => $request->category_name,
         'comprehensive' => $request->comprehensive,
         'comprehensive_test_percentage' =>$request->comprehensive_test_percentage,
         'max_questions'=>$request->max_questions,
         'tag_questions'=>$tag_questions

      ]);

    
     $this->meesage('message','Category created successfully!');
      //return redirect()->back();
       return redirect('category');

    }
    public function editcategory(category $category)
    { 
          $tagquestions = DB::table('tags')->where('status','0')->get();
        //dd($tagquestions);
        
       return view('category.editcategory',compact(['category','tagquestions']));
    }
    public function updatecategory(Request $request, category $category)
    {
       
      
    
       $rules = [
          'category_name' => 'required|unique:categories,category_name,'.$category->id,
          'comprehensive' => 'required',
          'comprehensive_test_percentage' => 'required|numeric|min:1|max:100',
          'max_questions' => 'required|numeric|min:1|max:100',
      ];

      $errorMessage = [
          'required' => 'Enter your :attribute first.'
      ];

      $this->validate($request, $rules, $errorMessage);
       $tag_questions=implode(',',$request->tag_questions);
      $category->update([
                   'category_name' => $request->category_name,
                   'comprehensive' => $request->comprehensive,
                   'comprehensive_test_percentage' =>$request->comprehensive_test_percentage,
                   'max_questions'=>$request->max_questions,
                   'tag_questions'=>$tag_questions
                ]);

      $this->meesage('message','Category updated successfully!');
      return redirect('category');
      //return redirect()->back();
    }
    public function delete_category($id)
    {
     // $category->delete();
       DB::delete('delete from categories where id = ?',[$id]);
      $this->meesage('message','Category deleted successfully!');
      return redirect('category');
    }
    public function meesage(string $name = null, string $message = null)
    {
        return session()->flash($name,$message);
    }
    
}
