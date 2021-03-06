<?php

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

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

Route::get('/home', 'HomeController@getSubjects')->name('home');
Route::get('/subjects', 'HomeController@getSubjects')->name('subjects');
Route::resource('/subject/{id}/videos', 'VideoController')->name('*', 'videos');
Route::get('/subject/{id}/documents/{document}/download', 'DocumentController@download')->name('documents.download');
Route::resource('/subject/{id}/documents', 'DocumentController')->name('*', 'documents');
