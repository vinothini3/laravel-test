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

Route::get('/users', 'UserController@index')->name('list');
Route::get('/create', 'UserController@create')->name('create');
Route::post('/save', 'UserController@save')->name('save');
Route::get('/edit/{id}', 'UserController@edit')->name('edit');
Route::put('/update/{id}', 'UserController@update')->name('update');
Route::delete('/delete/{id}', 'UserController@delete')->name('delete');
