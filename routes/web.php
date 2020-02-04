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
Route::get('/excel_show','ImportExcelController@index')->name('show_excel');
Route::post('/excel','ImportExcelController@import')->name('upload');
Route::get('/important_testing','DeveloperController@hashing')->name('important');
Route::get('/exit', function () {
    return view('index');
})->name('exit');

Route::group(['prefix'=>'developer','as'=>'developer.'],function (){
    Route::get('/loginPage','Auth\DeveloperLoginController@showLoginForm')->name('loginPage');
    Route::post('/login','Auth\DeveloperLoginController@login')->name('login');
    Route::get('/logout','Auth\DeveloperLoginController@logout')->name('logout');
    Route::get('/dashboard','DeveloperController@dashboard')->name('dashboard');
    Route::get('/show_add_student','DeveloperController@show_add_student')->name('show_add_student');
    Route::get('/show_add_subject','DeveloperController@show_add_subject')->name('show_add_subject');
    Route::post('/add_subject','DeveloperController@add_subject')->name('add_subject');
    Route::get('/show_alter_feedback','DeveloperController@alter_feedback')->name('show_alter_feedback');
    Route::get('/show_add_faculty','DeveloperController@show_add_faculty')->name('show_add_faculty');
    Route::post('/dept_class','DeveloperController@ajax_classes_dept')->name('dept_class');
    Route::post('/ajax_class_wise_report','DeveloperController@ajax_class_wise')->name('ajax_class_wise');


});

Route::group(['prefix'=>'user','as'=>'user.'],function(){
    Route::post('/login','Auth\StudentLoginController@login')->name('login');
    Route::get('/logout','Auth\StudentLoginController@logout')->name('logout');
    Route::get('/dashboard','UserController@dashboard')->name('dashboard');
    Route::post('/submit_feedback','UserController@submit_feedback')->name('submit_feedback');
    Route::post('/phase/user/ajax_questions','UserController@feedback_form')->name('ajax_questions');
    Route::get('/loginPage','Auth\StudentLoginController@showLoginForm')->name('loginPage');
    Route::get('/phase/{id}','UserController@showFeedbackPage')->name('phase');

});

Route::group(['prefix'=>'faculty','as'=>'faculty.'],function () {
    Route::get('/loginPage','Auth\FacultyLoginController@showLoginForm')->name('loginPage');
    Route::post('/login','Auth\FacultyLoginController@login')->name('login');
    Route::get('/logout','Auth\FacultyLoginController@logout')->name('logout');
    Route::get('/dashboard','FacultyController@dashboard')->name('dashboard');
    Route::get('/feedback/report','FacultyController@feedback_report')->name('feedback_report');
    Route::post('/feedback/ajax/subject','FacultyController@ajax_subject_report')->name('ajax_subject_report');
    Route::post('/feedback/faculty_report/pdf','FacultyController@pdf_faculty_report')->name('pdf_faculty_report');
    Route::post('/dashboard/ajax','FacultyController@ajax_dashboard')->name('ajax_dashboard');

});


Route::group(['prefix'=>'principal','as'=>'principal.'],function () {
Route::get('/loginPage','Auth\PrincipalLoginController@showLoginForm')->name('loginPage');
Route::post('/login','Auth\PrincipalLoginController@login')->name('login');
Route::get('/dashboard','PrincipalController@dashboard')->name('dashboard');
Route::post('/dashboard/ajax','PrincipalController@ajax_dashboard')->name('ajax_dashboard');
Route::get('/logout','Auth\PrincipalLoginController@logout')->name('logout');
Route::get('/principal/report_generator/home_page','PrincipalController@report_generator')->name('report_generator');
Route::post('/principal/pdf_question_wise_report','PrincipalController@pdf_question_wise_report')->name('pdf_question_wise_report');
Route::get('/testing','PrincipalController@test')->name("test");
Route::post('/pdf_all_classes_report','PrincipalController@pdf_all_classes_report')->name('pdf_all_classes_report');
Route::get('/all_classes_report','PrincipalController@all_class_report_page')->name('classes_report');
Route::get('/class_wise_page','PrincipalController@class_wise_page')->name('class_wise_page');
Route::get('/faculty_wise_page','PrincipalController@faculty_wise_page')->name('faculty_wise_page');
Route::post('/class_wise_pdf','PrincipalController@pdf_classwise_report')->name('pdf_classwise_report');
Route::post('/ajax_class_wise_report','PrincipalController@ajax_class_wise')->name('ajax_class_wise');
Route::post('/dept_class','PrincipalController@ajax_classes_dept')->name('dept_class');
Route::post('/faculty_wise_pdf','PrincipalController@pdf_faculty_wise_report')->name('pdf_faculty_wise_report');
Route::post('/ajax_faculty_wise_report','PrincipalController@ajax_faculty_wise')->name('ajax_faculty_wise');
Route::post('/dept_faculty','PrincipalController@ajax_faculty_dept')->name('dept_faculty');


});
Route::group(['prefix'=>'hod','as'=>'hod.'],function (){

    Route::get('/pdf','HodController@pdf')->name('testpdf');
    Route::post('/class_on_batch','HodController@class_batch')->name('class_batch');
    Route::get('/old_class_wise_report','HodController@show_old_class_wise')->name('show_old_class_wise');
    Route::post('/class_wise_pdf','HodController@pdf_classwise_report')->name('pdf_classwise_report');
    Route::get('/show_old_faculty_wise_report','HodController@show_old_faculty_wise')->name('show_old_faculty_wise');
    Route::post('/faculty_wise_pdf','HodController@pdf_faculty_wise_report')->name('pdf_faculty_wise_report');
    Route::post('/old_faculty_wise_pdf','HodController@pdf_faculty_wise_old_report')->name('pdf_faculty_wise_old_report');
    Route::get('/time_table_initialize/{class_id}','HodController@time_table_initialize')->name('time_table_initialize');
    Route::post('/ajax_class_wise_report','HodController@ajax_class_wise')->name('ajax_class_wise');
    Route::post('/add_subject_alloc','HodController@add_subject_alloc')->name('add_subject_alloc');
    Route::post('/delete_subject_allocation','HodController@delete_subject_alloc')->name('delete_subject_alloc');
    Route::post('/edit_subject_allocation','HodController@edit_subject_alloc')->name('delete_subject_alloc');
    Route::post('/scheduler','HodController@scheduler')->name('scheduler');
    Route::get('/time_table_page','HodController@show_time_table_page')->name('show_time_table_page');
    Route::post('/login','Auth\HodLoginController@login')->name('login');
    Route::get('/logout','Auth\HodLoginController@logout')->name('logout');
    Route::get('/student_status','HodController@student_status')->name('student_status');
    Route::post('/student_status_live','HodController@student_status_live')->name('ajax_student_status_live');
    Route::get('/loginPage','Auth\HodLoginController@showLoginForm')->name('loginPage');
    Route::get('/dashboard','HodController@dashboard')->name('dashboard');
    Route::post('/ajax/graph','HodController@ajax_dashboard')->name('ajax_dashboard');
    Route::post('/ajax_faculty_wise_report','HodController@ajax_faculty_wise')->name('ajax_faculty_wise');
    Route::post('/ajax_old_faculty_wise_report','HodController@ajax_old_faculty_wise')->name('ajax_old_faculty_wise');
    Route::get('/all_faculty_wise_report','HodController@all_faculty_wise')->name('all_faculty_wise');
    Route::get('/class_wise_page','HodController@class_wise_page')->name('class_wise_page');
    Route::get('/faculty_wise_page','HodController@faculty_wise_page')->name('faculty_wise_page');
    Route::get('/all_faculty_wise_page','HodController@all_faculty_wise_page')->name('all_faculty_wise_page');
});


Route::get('/home', 'HomeController@index')->name('home');
