<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Validation\Rule;
use DB;
use Validator;
class TagsController extends Controller
{
   
    public function add()
    {  
    	$this->data['tag'] = $tag = new Tag;
        return view('tag.add', $this->data);
    }
    public function edit($id) {
		$this->data['tag'] = $tag = Tag::where('id', $id)->first();
		// dd($this->data['company']);
		return view('tag.add', $this->data);
	}
    public function list()
    {  
       	$tags= Tag::toBase()->get();
        return view('tag.list',compact('tags'));
        
    }
    public function save(Request $request) {
		//dd($request->all());
		DB::beginTransaction();
		try {
			$rules = [
          		'name' => 'required|min:2|unique:tags,name,' . $request->id,
          		'status' => 'required'
      		];

      		$errorMessage = [
          		'required' => 'Enter Tag Name.'
      		];

      		$this->validate($request, $rules, $errorMessage);

				if (empty($request->id)) {
					$tag = new tag;

				} else {
					$tag = Tag::where('id', $request->id)->first();
					$tag->updated_at = date('Y-m-d H:i:s');
				}
				$tag->name = $request->name;
				$tag->status = $request->status;
				$tag->save();
				DB::commit();
				if (empty($request->id)) {
					$request->session()->flash('success', 'Tag added successfully!');
					return redirect('/listtag')->with('success', 'Tag added successfully!');
				} else {
					$request->session()->flash('success', 'Tag updated successfully!');
					return redirect('/listtag')->with('success', 'Tag updated successfully!');
				}

		} catch (Exception $e) {
			DB::rollBack();
			return response()->json(['success' => false, 'errors' => ['Exception Error' => $e->getMessage()]]);
		}

	}
	public function delete($id)
    {
      	DB::delete('delete from tags where id = ?',[$id]);
      	return redirect('/listtag')->with('success', 'Tag deleted successfully!');
    }
}
