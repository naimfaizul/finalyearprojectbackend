<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {


});


Route::get('/index', 'Api\usersController@index')->name('index');
Route::post('/register', 'Api\usersController@register');
Route::post('/login', 'Api\usersController@login');
Route::post('/update', 'Api\usersController@update');

Route::post('/create', 'Api\ForumController@store');

Route::post('/api');

Route::post('/attendance', 'Api\MiscController@attendance');
Route::post('/forum', 'Api\MiscController@forum');
Route::get('/topics', 'Api\MiscController@topics');
Route::get('/questions', 'Api\MiscController@questions');
Route::post('/quiz', 'Api\MiscController@quiz');
Route::post('/result', 'Api\MiscController@result');