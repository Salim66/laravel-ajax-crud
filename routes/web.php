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
    return view('welcome');
});

Route::resource('student', 'App\Http\Controllers\StudentController');
Route::post('student-create', 'App\Http\Controllers\StudentController@store')->name('student.register');
Route::get('student-all', 'App\Http\Controllers\StudentController@allStudent');
Route::get('edit-Student/{id}', 'App\Http\Controllers\StudentController@edit');
Route::patch('update-Student/{id}', 'App\Http\Controllers\StudentController@update');
Route::get('show-Student/{id}', 'App\Http\Controllers\StudentController@show');
Route::delete('delete-Student/{id}', 'App\Http\Controllers\StudentController@destroy');
