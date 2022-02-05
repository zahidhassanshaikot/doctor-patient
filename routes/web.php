<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(
    [
        'namespace'=>'App\Http\Controllers'
    ],
    function () {
        Route::get('/', 'DashboardController@index')->name('dashboard')->middleware('auth');
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('auth');
        Route::get('/user-list', 'UserController@userList')->name('user-list')->middleware('auth');

        Route::get('/user-list', 'UserController@userList')->name('user-list')->middleware('auth');
        Route::get('/doctor-list', 'UserController@doctorList')->name('doctor-list')->middleware('auth');
        Route::get('/patient-list', 'UserController@patientList')->name('patient-list')->middleware('auth');
        Route::get('/approve/{id}', 'UserController@approve')->name('approve')->middleware('auth');
        Route::get('/not-approve/{id}', 'UserController@notApprove')->name('not-approve')->middleware('auth');
        Route::get('/delete-user/{id}', 'UserController@deleteUser')->name('delete-user')->middleware('auth');

        Route::get('/messages', 'UserController@messages')->name('messages')->middleware('auth');
        Route::get('/view/messages/{user_id}', 'UserController@ViewMessages')->name('view-message-details')->middleware('auth');
        Route::post('/reply-message', 'UserController@ReplyMessages')->name('reply-message')->middleware('auth');

    });
