<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuestionCategory;
use Illuminate\Validation\Rule;
use DB;
use Validator;
class QuestionCategoryController extends Controller
{
    public function add()
    {  
    	$this->data['question_types'] = array("" => "Select Option","textbox" => "Text box", "image" => "Image","audio" => "Audio");
    	$this->data['category'] = $category = new QuestionCategory;
        return view('questioncategory.add', $this->data);
    }
    public function edit($id) {
    	$this->data['question_types'] = array("" => "Select Option","textbox" => "Text Box", "image" => "Image","audio" => "Audio");
		$this->data['category'] = $category = QuestionCategory::where('id', $id)->first();
		return view('questioncategory.add', $this->data);
	}
    public function list()
    {  
       	$categories= QuestionCategory::toBase()->get();
        return view('questioncategory.list',compact('categories'));
        
    }
    public function save(Request $request) {
		// dd($request->all());
		DB::beginTransaction();
		try {
			$rules = [
          		'question_category' => 'required|min:2|unique:question_categories,question_category,' . $request->id,
          		'input_option' => 'required',
          		'status' => 'required'
      		];

      		$errorMessage = [
          		'required' => 'Enter :attribute.'
      		];

      		$this->validate($request, $rules, $errorMessage);

			if (empty($request->id)) {
				$category = new QuestionCategory;

			} else {
				$category = QuestionCategory::where('id', $request->id)->first();
				$category->updated_at = date('Y-m-d H:i:s');
			}
			$category->question_category = $request->question_category;
			$category->input_option = $request->input_option;
			$category->status = $request->status;
			$category->save();
			DB::commit();
			if (empty($request->id)) {
				$request->session()->flash('success', 'Category added successfully!');
				return redirect('/listquestioncategory')->with('success', 'Category added successfully!');
			} else {
				$request->session()->flash('success', 'Category updated successfully!');
				return redirect('/listquestioncategory')->with('success', 'Category updated successfully!');
			}
				
		} catch (Exception $e) {
			DB::rollBack();
			return response()->json(['success' => false, 'errors' => ['Exception Error' => $e->getMessage()]]);
		}

	}
	public function delete($id)
    {
      	DB::delete('delete from question_categories where id = ?',[$id]);
      	return redirect('/listquestioncategory')->with('success', 'Category deleted successfully!');
    }
}
