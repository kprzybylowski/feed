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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::any('/register', 'HomeController@index')->name('register'); //disable registration

Route::any('/feed', 'FeedController@index')->name('feed');
Route::any('/feed/browse', 'FeedController@browse')->name('feed_browse')->middleware('auth');
Route::any('/feed/edit', 'FeedController@edit')->name('feed_edit')->middleware('auth');
Route::any('/feed/save', 'FeedController@save')->name('feed_edit')->middleware('auth');
Route::any('/company/browse', 'CompanyController@browse')->name('company_browse')->middleware('auth', 'admin');
Route::any('/company/edit', 'CompanyController@edit')->name('company_edit')->middleware('auth', 'admin');
Route::any('/user/browse', 'UserController@browse')->name('user_browse')->middleware('auth', 'admin');
Route::any('/user/edit', 'UserController@edit')->name('user_edit')->middleware('auth', 'admin');
