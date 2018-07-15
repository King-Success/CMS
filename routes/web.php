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
    Route::get('/student/{id}/delete', 'StudentController@destroy');

    Route::get('/student/{id}/scoresheet/{session}/{term}/edit', 'SubjectScoresController@show');
    Route::get('/student/{id}/scoresheet/{session}/{term}/create', 'SubjectScoresController@create');
    Route::post('/student/{id}/scoresheet/update', 'SubjectScoresController@update');
    Route::post('/student/{id}/scoresheet/{session}/{term}/store', 'SubjectScoresController@store');
    
    Route::get('/staff', 'staffController@index');
    Route::get('/staff/register', 'StaffController@create');
    Route::get('/staff/ajax/search', 'StaffController@staffDatatable');
    Route::post('/staff/register', 'StaffController@store');
    Route::post('/staff/update', 'StaffController@update');
    Route::get('/staff/{id}/delete', 'StaffController@destroy');


    Route::get('/subject', 'SubjectController@index');
    Route::get('/subject/add', 'SubjectController@create');
    Route::get('/subject/ajax/search', 'SubjectController@subjectDatatable');
    Route::post('/subject/add', 'SubjectController@store');
    Route::get('/subject/{id}/delete', 'SubjectController@destroy');
    Route::post('/subject/update', 'SubjectController@update');

    Route::get('/subject/mapping', 'SubjectMappingController@index');
    Route::get('/subject/mapping/ajax/search', 'SubjectController@subjectMappingDatatable');
    Route::post('/subject/mapping/{id}/update', 'SubjectMappingController@update');
    Route::post('/subject/mapping/{id}/delete', 'SubjectMappingController@destroy');

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
