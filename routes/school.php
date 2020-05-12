<?php

Route::group(['namespace' => 'School', 'as'=>'school.'], function() {
    Route::get('/', 'HomeController@getSubjects')->name('dashboard');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Register
    // Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    // Route::post('register', 'Auth\RegisterController@register');

    // Passwords
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

    // Must verify email
    Route::get('email/resend','Auth\VerificationController@resend')->name('verification.resend');
    Route::get('email/verify','Auth\VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}','Auth\VerificationController@verify')->name('verification.verify');
    Route::get('/subjects', 'HomeController@getSubjects')->name('subjects');
    Route::resource('/subject/{id}/videos', 'VideoController')->name('*', 'videos');
});