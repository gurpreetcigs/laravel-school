<?php

Route::group(['namespace' => 'Admin', 'as'=>'admin.'], function() {
    Route::get('/', 'HomeController@index')->name('dashboard');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Register
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    // Passwords
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

    // Must verify email
    Route::get('email/resend','Auth\VerificationController@resend')->name('verification.resend');
    Route::get('email/verify','Auth\VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}','Auth\VerificationController@verify')->name('verification.verify');
    Route::resource('/standard', 'StandardController')->name('*', 'standard');
    Route::resource('/standard/{id}/subject', 'SubjectController')->name('*', 'subject');
    
    Route::get('/standard/{standard}/subject/{id}/videos/{video}/activate', 'VideoController@activate')->name('videos.active');

    Route::resource('/standard/{standard}/subject/{id}/videos', 'VideoController')->name('*', 'videos');

    Route::get('/standard/{standard}/subject/{id}/documents/{document}/activate', 'DocumentController@activate')->name('documents.active');
    Route::get('/standard/{standard}/subject/{id}/documents/{document}/download', 'DocumentController@download')->name('documents.download');
    Route::resource('/standard/{standard}/subject/{id}/documents', 'DocumentController')->name('*', 'documents');

    Route::get('/student/{student}/active', 'StudentController@viewActivatePage')->name('student.activate-view');
    Route::put('/student/{student}/active', 'StudentController@activate')->name('student.activate');
    Route::resource('student', 'StudentController')->name('*', 'student');
    Route::resource('school', 'SchoolController')->name('*', 'school');
});