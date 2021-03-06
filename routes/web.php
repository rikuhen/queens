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

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('dologin');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/vote/{event?}', 'HomeController@vote')->name('vote');
Route::get('/thanks', 'HomeController@thanks')->name('thanks');
Route::resource('/scores', 'ScoreController',['only' => ['store','update'] ]);

Route::prefix('/admin')->middleware('admin')->group(function() {
	Route::get('/','AdminController@index');
	Route::post('update-event','AdminController@updateCurrentEvent')->name('set-current-event');
	Route::resource('/misses', 'MissController');
	Route::resource('/cities', 'CityController');
	Route::resource('/events', 'EventController');
	Route::resource('/users', 'UserController');
	//EMERGENCIAS!!
	//Route::get('reset','AdminController@reset')->name('reset');
	Route::post('reset','AdminController@reset')->name('reset');

	Route::get('print/{type}','PdfController@print')->name('print');
});