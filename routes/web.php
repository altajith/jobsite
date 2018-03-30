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

Route::group(['namespace' => 'Auth'], function()
{
    Route::get('signup', 'RegisterController@index');
    Route::post('register', 'RegisterController@register');
    Route::get('signup/{id}', 'RegisterController@indexIframe');

    Route::post('login', 'LoginController@login');

    Route::get('logout', 'LoginController@logout');

    Route::get('forgot/password/{token}', 'ForgotPasswordController@index');
    Route::post('forgot/password/change', 'ForgotPasswordController@save');
});

Route::group(['namespace' => 'Account','prefix' => 'account'], function()
{
    Route::get('', 'AccountController@index');
    Route::post('save', 'AccountController@save');
    Route::post('password/change', 'AccountController@changePassword');
    Route::post('picture/change', 'AccountController@changePicture');

    Route::get('cvs', 'CvController@index');

    Route::get('cv/new/{id}', 'CvController@indexCv');
    Route::get('cv/edit/{id}', 'CvController@indexCv');
    Route::post('cv/save', 'CvController@save');
    
    Route::get('jobs', 'AccountController@indexMyList');

    Route::get('advance/settings', 'AdvanceController@index');
    Route::post('advance/settings/save', 'AdvanceController@save');
});

Route::group(['namespace' => 'Job','prefix' => 'job'], function()
{
    Route::get('create', 'JobController@index');
    Route::post('save', 'JobController@save');

    Route::get('list', 'JobController@indexList');

    Route::get('apply/{id}', 'JobController@apply');

    Route::get('view/{id}', 'JobController@indexView');
});

Route::get('attachments/{file}', 'HomeController@attachment');
Route::get('images/{file}', 'HomeController@image');
Route::get('', 'HomeController@index');
Route::get('job/{id}', 'HomeController@single');
Route::get('init', 'HomeController@init');
Route::get('thanks', 'HomeController@thanks');
