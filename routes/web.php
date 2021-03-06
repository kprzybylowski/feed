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

Route::get('/feed', 'FeedController@index')->name('feed');
Route::get('/feed/browse', 'FeedController@browse')->name('feed_browse')->middleware('auth');
Route::get('/feed/edit/{id?}', 'FeedController@edit')->name('feed_edit')->middleware('auth');
Route::get('/feed/delete/{id}', 'FeedController@delete')->name('feed_delete')->middleware('auth');
Route::post('/feed/save', 'FeedController@save')->name('feed_save')->middleware('auth');
Route::get('/feed/publish/{id?}', 'FeedController@publish')->name('feed_publish')->middleware('auth');
Route::get('/feed/{feed_id}/item_edit/{item_id?}', 'FeedController@item_edit')->name('feed_item_publish')->middleware('auth');
Route::post('/feed/item_save', 'FeedController@item_save')->name('feed_item_save')->middleware('auth');
Route::get('/feed/item_delete/{id}', 'FeedController@item_delete')->name('feed_item_delete')->middleware('auth');
Route::get('/company/browse', 'CompanyController@browse')->name('company_browse')->middleware('auth', 'admin');
Route::get('/company/edit/{id?}', 'CompanyController@edit')->name('company_edit')->middleware('auth', 'admin');
Route::any('/company/delete/{id}', 'CompanyController@delete')->name('company_delete')->middleware('auth', 'admin');
Route::post('/company/save', 'CompanyController@save')->name('company_save')->middleware('auth', 'admin');
Route::get('/user/browse', 'UserController@browse')->name('user_browse')->middleware('auth', 'admin');
Route::get('/user/edit/{id?}', 'UserController@edit')->name('user_edit')->middleware('auth', 'admin');
Route::get('/user/delete/{id}', 'UserController@delete')->name('user_delete')->middleware('auth', 'admin');
Route::post('/user/save', 'UserController@save')->name('user_save')->middleware('auth', 'admin');
Route::get('/images/browse', 'ImagesController@browse')->name('images_browse')->middleware('auth');
Route::get('/images/edit/{id?}', 'ImagesController@edit')->name('images_edit')->middleware('auth');
Route::get('/images/delete/{id}', 'ImagesController@delete')->name('images_delete')->middleware('auth');
Route::post('/images/save', 'ImagesController@save')->name('images_save')->middleware('auth');
