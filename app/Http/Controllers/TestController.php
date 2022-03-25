<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Questions;
use App\Category;
use App\TestSetting;
use App\Weightages;
use Illuminate\Validation\Rule;
use DB;
use Validator;

class TestController extends Controller
{
     public function add()
    {  
    	$this->data['test'] = $test = new Test;
    	$this->data['categories'] = Category::pluck('category_name', 'id');
    	$this->data['weightages'] = Weightages::pluck('weightage_title', 'id');
        return view('test.add', $this->data);
    }
    public function list()
    {  
       	$tests= Test::toBase()->get();
        return view('test.list',compact('tests'));
        
    }
    public function save(Request $request) {
      
		 // dd($request->all());
		DB::beginTransaction();
		try {
			$rules = [
          		'test_name' => 'required|min:2|unique:tests',
          		'hours' => 'required|date_format:h:i',
          		'question_usedstatus' => 'required',
          		'category' => 'required',
          		'no_of_question' => 'required|integer|between:1,256',
          		
          		'user_limit' => 'required',
      		];

      		$errorMessage = [
          		'required' => 'Enter :attribute'
      		];
        //Move AUDIO

        $audioName = time().'.'.$request->audio->extension();  
        $request->audio->move(public_path('audio'), $audioName); 

        $explanation_audioName = $request->explanation_audio.'.'.time().'.'.$request->explanation_audio->extension();  
        $request->explanation_audio->move(public_path('explanation_audio'), $explanation_audioName);

        //END AUDIO FILE
      	$this->validate($request, $rules, $errorMessage);
				$test = new Test;
				$test->test_name = $request->test_name;
				$test->question_usedstatus = $request->question_usedstatus;
				$test->hours = $request->hours;
				
				$test->category = implode(',', $request->category);
				$test->no_of_question = $request->no_of_question;
				$test->user_limit = $request->user_limit;
				$test->audio = $audioName;
        $test->explanation_audio = $explanation_audioName;
				$test->save();
                $test_id= $test->id;
                $amts =  Questions::WhereIn('questions.category', explode(',',$test->category))
              
              ->Where('questions.used_status', $test->question_usedstatus)
              ->orderBy(DB::raw('RAND()'))->take($request->no_of_question)->get()->toArray();
                $quest_ids=$amts;
                $qt_id = array();
                if(count($quest_ids)!=0){
                    foreach ($quest_ids as $key => $quest_id) {
                      $qt_id[] = $quest_id['id'];
                     //Update Question Status
                        if($test->question_usedstatus=='0'){
                            DB::table('questions')->where('id', $quest_id['id'])->update(['used_status' => 1]);
                        }
                    }
                    DB::table('test_questions')->insert(array('test_id' => $test_id,'question_id' => implode(',', $qt_id)));
                }
    				DB::commit();
    				if(count($quest_ids)==0){
    				    $request->session()->flash('error', 'No question for that kind of categories!!');
    					return redirect('/listtest')->with('error', 'No question for that kind of categories!!');
    				}else if (empty($request->id)) {
    					$request->session()->flash('success', 'Test added successfully!');
    					return redirect('/listtest')->with('success', 'Test added successfully!');
    				} else {
    					$request->session()->flash('success', 'Test updated successfully!');
    					return redirect('/listtest')->with('success', 'Test updated successfully!');
    				}
        

		} catch (Exception $e) {
			DB::rollBack();
			return response()->json(['success' => false, 'errors' => ['Exception Error' => $e->getMessage()]]);
		}

	   }  
	public function delete($id)
    {
      	DB::delete('delete from tests where id = ?',[$id]);
        DB::delete('delete from test_questions where test_id = ?',[$id]);
      	return redirect('/listtest')->with('success', 'Test deleted successfully!');
    }
    public function getcategory(Request $request)
    {
     $datas = Category::Where('id', $request->get('category'))
              ->get()->toArray();
     echo  json_encode($datas);
    }
  public function getquestion(Request $request)
    {
     
     $datas = Questions::Where('questions.category', $request->get('category'))
              ->Where('questions.used_status', $request->get('qtype'))
              ->get()->toArray();
     //print_r($datas);exit();
     echo  json_encode($datas);
    }
    //Get Audio
     public function listaudio()
    {
        $get_tests_audio= TestSetting::toBase()->get();
        return view('test.audio_list',compact('get_tests_audio'));
    }
    public function addaudio()
    {  
      $this->data['test'] = $test = new TestSetting;
      return view('test.audio_add', $this->data);
    }
    public function saveaudio(Request $request) {
      
     // dd($request->all());
    DB::beginTransaction();
    try {
     
        // $rules = [
        //       'wrongques_song' => 'required',
        //       'rightques_song' => 'required',
        //     ];
        //   $errorMessage = [
        //       'required' => 'Enter :attribute'
        //   ];

        $audioName = time().$request->file('wrongques_song')->getClientOriginalName();
        $request->wrongques_song->move(public_path('testsetting'), $audioName);
        //dd($audioName);exit();
        //Right Ans Audio
        $audioName1 = time().$request->file('rightques_song')->getClientOriginalName();
        $request->rightques_song->move(public_path('testsetting'), $audioName1);

        //END AUDIO FILE
        // $this->validate($request, $rules, $errorMessage);
        $tests_settings= TestSetting::toBase()->get();

      if(count($tests_settings)>0){
          DB::table('test_setting')  // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update(array('wrongques_song' => $audioName,'rightques_song' => $audioName1)); 
      }else{
        $test = new TestSetting;
        $test->wrongques_song = $audioName;
        $test->rightques_song = $audioName1;
        $test->save();
      }
               
        DB::commit();
         $request->session()->flash('success', 'Audio added successfully!');
        return redirect('/listaudio')->with('success', 'Audio added successfully!');
        

    } catch (Exception $e) {
      DB::rollBack();
      return response()->json(['success' => false, 'errors' => ['Exception Error' => $e->getMessage()]]);
    }

     } 
}
