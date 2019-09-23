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
    Route::post('/ajax_questions','UserController@feedback_form')->name('ajax_questions');
    Route::get('/loginPage','Auth\StudentLoginController@showLoginForm')->name('loginPage');
    Route::get('/phase/{id}','UserController@showFeedbackPage')->name('phase');

});


Route::get('/home', 'HomeController@index')->name('home');
