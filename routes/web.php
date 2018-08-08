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
Route::get('voters', 'VoteController@viewVoters')
    ->middleware('is_admin')
    ->name('voters');
Route::post('vote', 'VoteController@submitVote');
Route::get('results', 'ResultController@index')
    ->middleware('is_admin')
    ->name('results');
//Final results
Route::get('results/submitted', 'ResultController@submitted')
    ->name('finalResults');
// Partial results
Route::get('results/partial', 'ResultController@partial')
    ->name('partialResults');

Route::get('settings', 'AdminController@settings')
    ->middleware('is_admin')
    ->name('settings');
// Handle AJAX for turning on/off nomination
Route::post('settings/on', 'AdminController@turnOn')
    ->middleware('is_admin');
Route::post('settings/off', 'AdminController@turnOff')
    ->middleware('is_admin');
// Handle AJAX for resetting votes
Route::post('settings/reset', 'AdminController@reset')
    ->middleware('is_admin');
