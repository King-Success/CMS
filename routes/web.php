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
    Route::get('/student/ajax/search', 'StudentController@studentDatatable');
    Route::get('/student/{id}/scoresheet/{session}/{term}/edit', 'SubjectScoresController@show');
    Route::get('/student/{id}/scoresheet/{session}/{term}/create', 'SubjectScoresController@create');
    Route::post('/student/{id}/scoresheet/update', 'SubjectScoresController@update');
    Route::post('/student/{id}/scoresheet/{session}/{term}/store', 'SubjectScoresController@store');
    Route::get('/student/{id}/delete', 'StudentController@destroy');

    Route::get('/staff', 'staffController@index');
    Route::get('/staff/register', 'StaffController@create');

//     Route::post('student/{id}/scor', [
//     'uses' => 'AboutController@show'
//   ]);
    Route::get('/scores', function() {
        return view('student.score_form');
    });
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
