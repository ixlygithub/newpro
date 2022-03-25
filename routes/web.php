<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});
// Route::get('/admin', function () {
//     return view('auth/admin');
// });

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::group(array('before' =>'IsAdmin'), function()
// {
// Route::get('/login','App\Http\Controllers\auth/LoginController@login');
// });


//Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('IsAdmin');
Route::get('/admin', 'App\Http\Controllers\Auth\LoginController@admin')->name('admin');
 Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' =>['auth']], function () {

	Route::get('adminlogout', ['as' => 'admin.logout', 'uses' => 'App\Http\Controllers\HomeController@adminlogout']);
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'App\Http\Controllers\PageController@icons']);
		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'App\Http\Controllers\PageController@maps']);
		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'App\Http\Controllers\PageController@notifications']);
		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'App\Http\Controllers\PageController@rtl']);
		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'App\Http\Controllers\PageController@tables']);
		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'App\Http\Controllers\PageController@typography']);
		Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'App\Http\Controllers\PageController@upgrade']);
	    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
		Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	   // Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Route::group(['middleware' =>['auth','IsUser']], function () {
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);	
      	Route::get('/userpage', 'App\Http\Controllers\HomeController@userpage')->name('userpage');
	Route::get('/myaccount', 'App\Http\Controllers\HomeController@myaccount')->name('myaccount');
	//New Password URL
	Route::put('profile/change-password', ['as' => 'profile.change-password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	//New Pages
	Route::put('/home-userpage', 'App\Http\Controllers\HomeController@updatepfe')->name('updatefeedback');
    Route::put('/profile-userpage', 'App\Http\Controllers\HomeController@updatepanno')->name('updatepan');
    //End New Pages
    Route::put('/userpage', 'App\Http\Controllers\ProfileController@update')->name('updateaccount');
    Route::get('/examlist', 'App\Http\Controllers\Userdashboard\ExamController@index')->name('examlist');
    Route::get('/examlistsearch/{search}', 'App\Http\Controllers\Userdashboard\ExamController@index')->name('examlistsearch');
    Route::get('/exams/{id}', 'App\Http\Controllers\Userdashboard\ExamController@exams')->name('exams');
    Route::get('/exam_history', 'App\Http\Controllers\Userdashboard\ExamController@exam_history')->name('exam_history');

    Route::get('/quiz/{testid}', 'App\Http\Controllers\Userdashboard\QuizController@index')->name('quiz');
    Route::get('/get_question_weightage/{weightage}/{quesarr}/{prevquesoriginaloption}/{prevoption}', 'App\Http\Controllers\Userdashboard\QuizController@get_question_weightage')->name('get_question_weightage');
     Route::post('/getquiz', 'App\Http\Controllers\Userdashboard\QuizController@getquiz');
     Route::post('/submitquiz', 'App\Http\Controllers\Userdashboard\QuizController@submitquiz');
  Route::get('/getexam', 'App\Http\Controllers\Userdashboard\ExamController@getExam')->name('getexam');
   Route::get('/review_summary/{usertestid}', 'App\Http\Controllers\Userdashboard\QuizController@review_summary')->name('review_summary');
   Route::get('/question_summary/{usertestid}/{questionid}', 'App\Http\Controllers\Userdashboard\QuizController@question_summary')->name('question_summary');
   Route::post('/timeoutsubmit', 'App\Http\Controllers\Userdashboard\QuizController@timeoutsubmit');
   Route::get('userchat_history/{id}','App\Http\Controllers\ChatController@userchat_history');
	Route::post('/userchatstore', 'App\Http\Controllers\ChatController@chatstore')->name('userchatstore.post');
	});
// 	Route::group(['middleware' => ['auth']], function () {
	
// 	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
// 	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
// 	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
// });
	// Category Master
	Route::group(['middleware' => ['auth','IsAdmin']], function () {
    
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);	
	//For Social Link
	Route::put('profile/social', ['as' => 'profile.social', 'uses' => 'App\Http\Controllers\ProfileController@socialupdate']);
	//End Social Link
    Route::get('/addcategory', 'App\Http\Controllers\CategoryController@addcategory')->name('addcategory');
	Route::post('/addcategory', 'App\Http\Controllers\CategoryController@storecategory');
	Route::get('/category', 'App\Http\Controllers\CategoryController@index')->name('category');
	Route::get('/category/editcategory/{category}', 'App\Http\Controllers\CategoryController@editcategory')->name('category.editcategory');
	Route::patch('/category/editcategory/{category}', 'App\Http\Controllers\CategoryController@updatecategory')->name('category.updatecategory');
	Route::get('deletecategory/{id}','App\Http\Controllers\CategoryController@delete_category');
    //User FeedBack
     Route::get('/feedback', 'App\Http\Controllers\FeedbackController@list')->name('feedback');
     Route::post('/feedback-reply', 'App\Http\Controllers\FeedbackController@reply')->name('feedback-reply');
     Route::get('/get-data', 'App\Http\Controllers\FeedbackController@getData')->name('get-data');
	//Weightage Master

	Route::get('/weightage', 'App\Http\Controllers\WeightageController@index')->name('weightage');
	Route::get('/addweightage', 'App\Http\Controllers\WeightageController@addweightage')->name('addweightage');
	Route::post('/addweightage', 'App\Http\Controllers\WeightageController@storeweightage');
	Route::get('/editweightage/{weightage}', 'App\Http\Controllers\WeightageController@editweightage')->name('weightage.editweightage');
	Route::patch('/weightage/editweightage/{weightage}', 'App\Http\Controllers\WeightageController@updateweightage')->name('weightage.updateweightage');
	Route::get('deleteweightage/{id}','App\Http\Controllers\WeightageController@delete_weightage');
 
	//Questions start
	Route::get('/addquestion', 'App\Http\Controllers\QuestionsController@addquestions')->name('addquestion');
	Route::get('/gettagcategories/{id}', 'App\Http\Controllers\QuestionsController@gettagcategories');
	Route::post('/addquestion', 'App\Http\Controllers\QuestionsController@savequestion');
	Route::get('/questions', 'App\Http\Controllers\QuestionsController@index')->name('questions');
	Route::get('/editquestion/{question}', 'App\Http\Controllers\QuestionsController@editquestion')->name('editquestion');
	Route::patch('/updatequestion/{question}', 'App\Http\Controllers\QuestionsController@updatequestions')->name('updatequestion');
	Route::get('/deletequestion/{question}', 'App\Http\Controllers\QuestionsController@deletequestion')->name('deletequestion');
   //question end 
	//Question Category Master
	Route::get('/addquestioncategory', 'App\Http\Controllers\QuestionCategoryController@add')->name('addquestioncategory');
	Route::post('/addquestioncategory', 'App\Http\Controllers\QuestionCategoryController@save');
	Route::patch('/addquestioncategory/{id}', 'App\Http\Controllers\QuestionCategoryController@save')->name('updatequestcategory');
	Route::get('/listquestioncategory', 'App\Http\Controllers\QuestionCategoryController@list')->name('listquestioncategory');
	Route::get('/editquestioncategory/{id}', 'App\Http\Controllers\QuestionCategoryController@edit')->name('editquestioncategory');
	Route::get('deletequestioncategory/{id}','App\Http\Controllers\QuestionCategoryController@delete')->name('deletequestioncategory');
	//Tag Master
	Route::get('/addtag', 'App\Http\Controllers\TagsController@add')->name('addtag');
	Route::post('/addtag', 'App\Http\Controllers\TagsController@save');
	Route::patch('/addtag/{id}', 'App\Http\Controllers\TagsController@save')->name('updatetag');
	Route::get('/listtag', 'App\Http\Controllers\TagsController@list')->name('listtag');
	Route::get('/edittag/{id}', 'App\Http\Controllers\TagsController@edit')->name('edittag');
	Route::get('/deletetag/{id}','App\Http\Controllers\TagsController@delete')->name('deletetag');
	//Test Master
	Route::get('/addtest', 'App\Http\Controllers\TestController@add')->name('addtest');
	Route::post('/addtest', 'App\Http\Controllers\TestController@save');
	Route::get('/listtest', 'App\Http\Controllers\TestController@list')->name('listtest');
	Route::post('/getquestion', 'App\Http\Controllers\TestController@getquestion')->name('getquestion');
	Route::post('/getcategory', 'App\Http\Controllers\TestController@getcategory')->name('getcategory');
	Route::post('/getquestion', 'App\Http\Controllers\TestController@getquestion')->name('getquestion');
	Route::get('/deletetest/{id}','App\Http\Controllers\TestController@delete')->name('deletetest');
    //Test Master
    //Audio Question
    Route::get('/listaudio', 'App\Http\Controllers\TestController@listaudio')->name('listaudio');
    Route::get('/addaudio', 'App\Http\Controllers\TestController@addaudio')->name('addaudio');
    Route::post('/addaudio', 'App\Http\Controllers\TestController@saveaudio');
    //user master
    Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
    Route::get('/adduser','App\Http\Controllers\UserController@adduser')->name('adduser');
    Route::post('/adduser', 'App\Http\Controllers\UserController@save');
    Route::get('/edituser/{user}', 'App\Http\Controllers\UserController@edituser')->name('edituser');
    Route::patch('updateuser/{id}', 'App\Http\Controllers\UserController@updateuser')->name('updateuser');
    Route::get('/deleteuser/{id}','App\Http\Controllers\UserController@deleteuser')->name('deleteuser');
    //get dynamic tables
    Route::post('/get_questionscount', 'App\Http\Controllers\QuestionsController@get_questionscount');
    Route::get('/getQues', 'App\Http\Controllers\QuestionsController@getQues')->name('getQues');
    Route::get('/getUsers', 'App\Http\Controllers\UserController@getUsers')->name('getUsers');
    Route::post('/updatetrails', 'App\Http\Controllers\UserController@updatetrails')->name('updatetrails.post');
    Route::get('/userstatusupdate/{id}','App\Http\Controllers\UserController@userstatusupdate')->name('userstatusupdate');
    //Reports
    Route::get('/reports', 'App\Http\Controllers\ReportController@report')->name('reports');
    Route::get('/export', 'App\Http\Controllers\ReportController@export')->name('export');
    Route::get('/questionreports', 'App\Http\Controllers\ReportController@questionreports')->name('questionreports');
    Route::get('/weightagereports', 'App\Http\Controllers\ReportController@weightagereports')->name('weightagereports');
    Route::get('/websitereport', 'App\Http\Controllers\ReportController@websitereport')->name('websitereport');
    Route::get('/audioreport', 'App\Http\Controllers\ReportController@audioreport')->name('audioreport');
    Route::get('/tagreport', 'App\Http\Controllers\ReportController@tagreport')->name('tagreport');
     //Chat
    Route::post('/chatstore', 'App\Http\Controllers\ChatController@chatstore')->name('chatstore.post');
    Route::get('chat_history/{id}','App\Http\Controllers\ChatController@chat_history');
    
});
// HTML Pages
	Route::get('/add/login', 'App\Http\Controllers\HTMLController@login_html')->name('login_html');
	Route::get('/add/question_html', 'App\Http\Controllers\HTMLController@question_html')->name('question_html');
	Route::get('/add/content_html', 'App\Http\Controllers\HTMLController@content_html')->name('content_html');
	Route::get('/add/account_final_html', 'App\Http\Controllers\HTMLController@account_final_html')->name('account_final_html');
	Route::get('/add/quiz_html', 'App\Http\Controllers\HTMLController@quiz_html')->name('quiz_html');
	Route::get('/add/review_summary', 'App\Http\Controllers\HTMLController@review_summary')->name('review_summaryhtml');
	Route::get('/add/exam_html', 'App\Http\Controllers\HTMLController@exam_html')->name('exam_html');
	Route::get('/add/question_summary', 'App\Http\Controllers\HTMLController@question_summary')->name('question_summaryhtml');
	Route::get('/add/construction', 'App\Http\Controllers\HTMLController@construction')->name('construction');
	Route::get('/testsearch/{search}', 'App\Http\Controllers\Userdashboard\ExamController@index')->name('testsearch');
	

	