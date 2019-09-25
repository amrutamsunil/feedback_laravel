<?php

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
    return view('index');
});

Route::get('/exit', function () {
    return view('index');
})->name('exit');
Route::group(['prefix'=>'user','as'=>'user.'],function(){
    Route::post('/login','Auth\StudentLoginController@login')->name('login');
    Route::get('/logout','Auth\StudentLoginController@logout')->name('logout');
    Route::get('/dashboard','UserController@dashboard')->name('dashboard');
    Route::post('/submit_feedback','UserController@submit_feedback')->name('submit_feedback');
    Route::post('/phase/user/ajax_questions','UserController@feedback_form')->name('ajax_questions');
    Route::get('/loginPage','Auth\StudentLoginController@showLoginForm')->name('loginPage');
    Route::get('/phase/{id}','UserController@showFeedbackPage')->name('phase');

});
Route::group(['prefix'=>'hod','as'=>'hod.'],function (){
    Route::post('/ajax_class_wise_report','HodController@ajax_class_wise')->name('ajax_class_wise');
    Route::post('/login','Auth\HodLoginController@login')->name('login');
    Route::get('/logout','Auth\HodLoginController@logout')->name('logout');
    Route::get('/loginPage','Auth\HodLoginController@showLoginForm')->name('loginPage');
    Route::get('/dashboard','HodController@dashboard')->name('dashboard');
    Route::get('/ajax_faculty_wise_report','HodController@ajax_faculty_wise')->name('ajax_faculty_wise');
    Route::get('/all_faculty_wise_report','HodController@all_faculty_wise')->name('all_faculty_wise');
    Route::get('/class_wise_page','HodController@class_wise_page')->name('class_wise_page');
    Route::get('/faculty_wise_page','HodController@faculty_wise_page')->name('faculty_wise_page');
    Route::get('/all_faculty_wise_page','HodController@all_faculty_wise_page')->name('all_faculty_wise_page');

});


Route::get('/home', 'HomeController@index')->name('home');
