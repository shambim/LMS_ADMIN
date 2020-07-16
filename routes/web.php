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

Route::get('/teacher/add', 'TeacherController@create');

Route::post('/teacher/store', 'TeacherController@store')->name('teacher.store');

Route::get('/teacher/lists', 'TeacherController@index')->name('teacher.index');

Route::get('/teacher/{id}/edit', 'TeacherController@edit');

Route::put('/teacher/{id}/update', 'TeacherController@update')->name('teacher.update');

Route::get('/teacher/{id}/delete', 'TeacherController@delete')->name('teacher.delete');

Route::get('/teacher/assign_lists/{id}', 'TeacherController@assign_lists')->name('teacher.assign_lists');

Route::get('/teacher/attendance_lists', 'TeacherController@attendance_lists')->name('teacher.attendance_lists');





Route::get('/allclass/add', 'AllClassController@create');

Route::post('/allclass/store', 'AllClassController@store')->name('allclass.store');

Route::get('/allclass/lists', 'AllClassController@index')->name('allclass.index');

Route::get('/allclass/{id}/edit', 'AllClassController@edit');

Route::put('/allclass/{id}/update', 'AllClassController@update')->name('allclass.update');
