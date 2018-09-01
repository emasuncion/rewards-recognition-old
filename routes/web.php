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
Route::get('nominate', 'NominationController@index')
    ->middleware('voted')
    ->name('nominate');
Route::get('vote', 'NominationController@vote')
    ->middleware('voted')
    ->name('vote');
Route::get('voters', 'NominationController@viewVoters')
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
Route::get('awardForward', 'HomeController@awardForward')
    ->name('awardForward');

// POST Routes
Route::post('changePassword','HomeController@changePassword')
    ->name('changePassword');
Route::post('addVote', 'NominationController@addVote');
Route::post('nominate', 'NominationController@submitVote');
Route::post('admin/changeRole', 'AdminController@changeRole')
    ->middleware('is_admin');
Route::post('addMember', 'AdminController@addMember');
Route::post('admin/changeQuarter', 'AdminController@changeQuarter')
    ->middleware('is_admin');
Route::post('admin/changeGuest', 'AdminController@changeGuest')
    ->middleware('is_admin');
Route::post('admin/deleteUser', 'AdminController@deleteUser')
    ->middleware('is_admin');
Route::post('awardForward/add', 'HomeController@awardForwardAdd');
