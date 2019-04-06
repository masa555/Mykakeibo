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
    return view('top');
});

Route::get('/sort', 'SortController@index')->middleware('auth');
Route::post('/list/edit','ListController@Edit')->middleware('auth');
Route::post('/list/update','ListController@Update')->middleware('auth');
Route::get('/list', 'ListController@Index')->middleware('auth');
Route::post('/list/destroy','ListDestroyController@Index')->middleware('auth');
Route::get('/','GreetingController@getIndex')->middleware('auth');
Route::post('/', 'GreetingController@postIndex')->middleware('auth');

Route::get('/income','IncomeController@index')->middleware('auth');
Route::post('/income','IncomeController@create')->middleware('auth');
Route::post('income/edit','IncomeController@edit')->middleware('auth');
Route::post('/income/update','IncomeController@update')->middleware('auth');
Route::post('/income/destroy','IncomeController@destroy')->middleware('auth');
Auth::routes();

Route::get('/income/ajax/sort', 'SortController@sortIncome')->middleware('auth');
Route::get('/home', 'HomeController@index')->name('home');
