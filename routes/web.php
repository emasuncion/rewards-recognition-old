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

Route::get('home', 'HomeController@index')->name('home');
Route::get('admin', 'AdminController@index')
    ->middleware('is_admin')
    ->name('admin');
Route::get('vote', 'VoteController@index')->name('vote');
Route::get('voters', 'VoteController@viewVoters')->name('voters');
Route::post('vote', 'VoteController@submitVote');
Route::get('results', 'ResultController@index')->name('results');

Route::get('settings', 'HomeController@index')->name('settings');
