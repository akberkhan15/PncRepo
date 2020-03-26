<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::post('/addemployee', 'HomeController@addemployee');
Route::post('/addcompany', 'HomeController@addcompany');
Route::post('/editemployee', 'HomeController@editemployee');
Route::post('/editcompany', 'HomeController@editcompany');
Route::post('/deleteemployee', 'HomeController@deleteemployee');
Route::post('/deletecompany', 'HomeController@deletecompany');

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/employees', 'HomeController@employees');
Route::get('/companies', 'HomeController@companies');
