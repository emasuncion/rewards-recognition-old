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

// GET Routes
Route::get('home', 'HomeController@index')
    ->name('home');
Route::get('changePassword', 'HomeController@showChangePasswordForm');
Route::get('admin', 'AdminController@index')
    ->middleware('is_admin')
    ->name('admin');
Route::get('nominate', 'VoteController@index')
    ->name('nominate');
Route::get('vote', 'VoteController@vote')
    ->middleware('voted')
    ->name('vote');
Route::get('voters', 'VoteController@viewVoters')
    ->middleware('is_admin')
    ->name('voters');
Route::get('results', 'ResultController@index')
    ->middleware('is_admin')
    ->name('results');
Route::get('results/submitted', 'ResultController@submitted')
    ->name('finalResults');
Route::get('results/partial', 'ResultController@index')
    ->name('partialResults');
Route::get('settings', 'AdminController@settings')
    ->middleware('is_admin')
    ->name('settings');

// POST Routes
Route::post('changePassword','HomeController@changePassword')
    ->name('changePassword');
Route::post('addVote', 'VoteController@addVote');
Route::post('nominate', 'VoteController@submitVote');
Route::post('admin/changeRole', 'AdminController@changeRole')
    ->middleware('is_admin');
Route::post('settings/on', 'AdminController@turnOn')
    ->middleware('is_admin');
Route::post('settings/off', 'AdminController@turnOff')
    ->middleware('is_admin');
Route::post('settings/reset', 'AdminController@reset')
    ->middleware('is_admin');
Route::post('addMember', 'AdminController@addMember');
