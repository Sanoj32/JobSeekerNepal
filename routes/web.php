<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
// Route::get('/update', 'JobsController@store');
Route::get('/search', 'JobsController@search');
Route::get('/test', 'SiteController@test');
Route::get('/references', 'SiteController@references');
Auth::routes();
Route::post('/viewed/{jobs}', 'ViewedController@store')->middleware('auth');
Route::post('/saved/{jobs}', 'SavedController@store')->middleware('auth');
Route::post('/savedjobs/{userId}', 'SavedController@index')->middleware('auth');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/faqs', 'SiteController@faqs');
Route::get('/all', 'JobsController@index');
// Route::get('/feedback', 'JobsController@feedback');
Auth::routes();
// Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
// Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');
