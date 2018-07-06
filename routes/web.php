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
// You must be authenticated before accessing these route
Route::middleware('auth')->group(function(){
    Route::get('/student', 'StudentController@index');
    Route::get('/student/create', 'StudentController@create');
    Route::post('/student/create', 'StudentController@store');
    Route::get('/logout', 'Auth\LoginController@Logout');
    Route::get('/home', function(){ return view('home'); });
});
Auth::routes();






// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/create', function(){
//     $student = App\student::find(1);
//     $subject = new App\subject(['name' => 'physics', 'class_id' => 1, 'staff_id' => 2]);

//     $student->subject()->save($subject);
// })->middleware('admin', 'staff');
