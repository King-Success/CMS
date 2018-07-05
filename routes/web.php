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

Route::get('/create', function(){
    $student = App\student::find(1);
    $subject = new App\subject(['name' => 'physics', 'class_id' => 1, 'staff_id' => 2]);

    $student->subject()->save($subject);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
