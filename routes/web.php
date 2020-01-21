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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
    Route::get('students/get_student/{id}','StudentController@get_student')->name('get_student');
    Route::get('students/change_status','StudentController@change_status')->name('students.change_status');
    Route::get('news/change_status','NewsController@change_status')->name('news.change_status');
    Route::get('teams/change_status','TeamController@change_status')->name('teams.change_status');
    Route::resource('students','StudentController');
    Route::resource('news','NewsController');
    Route::resource('teams','TeamController');
    Route::resource('payments','PaymentController');
    Route::resource('payment_details','PaymentDetailController');
});
