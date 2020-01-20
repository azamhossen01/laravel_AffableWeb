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
    Route::resource('students','StudentController');
    Route::resource('news','NewsController');
    Route::resource('teams','TeamController');
    Route::resource('payments','PaymentController');
});
