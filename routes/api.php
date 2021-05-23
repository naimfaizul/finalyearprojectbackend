<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {


});


Route::get('/index', 'Api\usersController@index')->name('index');
Route::post('/register', 'Api\usersController@register');
Route::post('/login', 'Api\usersController@login');
Route::post('/update', 'Api\usersController@update');


##Forum
Route::post('/create', 'Api\ForumController@store');

##Attendance
Route::post('/create', 'Api\AttendancesController@store');
