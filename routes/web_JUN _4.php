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
	Route::get('/userpage', 'App\Http\Controllers\HomeController@userpage')->name('userpage');
	Route::get('/myaccount', 'App\Http\Controllers\HomeController@myaccount')->name('myaccount');

    Route::put('/userpage', 'App\Http\Controllers\ProfileController@update')->name('updateaccount');
    Route::get('/examlist', 'App\Http\Controllers\Userdashboard\ExamController@index')->name('examlist');
    Route::get('/quiz/{testid}', 'App\Http\Controllers\Userdashboard\QuizController@index')->name('quiz');
    
   Route::get('/getexam', 'App\Http\Controllers\Userdashboard\ExamController@getExam')->name('getexam');
	Route::get('adminlogout', ['as' => 'admin.logout', 'uses' => 'App\Http\Controllers\HomeController@adminlogout']);
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'App\Http\Controllers\PageController@icons']);
		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'App\Http\Controllers\PageController@maps']);
		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'App\Http\Controllers\PageController@notifications']);
		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'App\Http\Controllers\PageController@rtl']);
		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'App\Http\Controllers\PageController@tables']);
		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'App\Http\Controllers\PageController@typography']);
		Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'App\Http\Controllers\PageController@upgrade']);
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
	Route::get('/addcategory', 'App\Http\Controllers\CategoryController@addcategory')->name('addcategory');
	Route::post('/addcategory', 'App\Http\Controllers\CategoryController@storecategory');
	Route::get('/category', 'App\Http\Controllers\CategoryController@index')->name('category');
	Route::get('/category/editcategory/{category}', 'App\Http\Controllers\CategoryController@editcategory')->name('category.editcategory');
	Route::patch('/category/editcategory/{category}', 'App\Http\Controllers\CategoryController@updatecategory')->name('category.updatecategory');
	Route::get('deletecategory/{id}','App\Http\Controllers\CategoryController@delete_category');

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
	Route::get('/deletetest/{id}','App\Http\Controllers\TestController@delete')->name('deletetest');
    //Test Master
    //user master
    Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
    Route::get('/adduser','App\Http\Controllers\UserController@adduser')->name('adduser');
    Route::post('/adduser', 'App\Http\Controllers\UserController@save');
    Route::get('/edituser/{user}', 'App\Http\Controllers\UserController@edituser')->name('edituser');
    Route::patch('updateuser/{id}', 'App\Http\Controllers\UserController@updateuser')->name('updateuser');
    Route::get('/deleteuser/{id}','App\Http\Controllers\UserController@deleteuser')->name('deleteuser');
});
// HTML Pages
	Route::get('/add/login', 'App\Http\Controllers\HTMLController@login_html')->name('login_html');
	Route::get('/add/question_html', 'App\Http\Controllers\HTMLController@question_html')->name('question_html');
	Route::get('/add/content_html', 'App\Http\Controllers\HTMLController@content_html')->name('content_html');
	Route::get('/add/account_final_html', 'App\Http\Controllers\HTMLController@account_final_html')->name('account_final_html');
	Route::get('/add/quiz_html', 'App\Http\Controllers\HTMLController@quiz_html')->name('quiz_html');

	