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

Route::get('/', function(){
    return view ('welcome');
});

Route::get('/test', 'QrController@store');
Route::get('/dashboard','QrController@index');
//Route::post('/test','QrController@store');
//Route::post('/test2', 'QrController@store');
Route::get('/date', function(){
//use Carbon\Carbon;
    $date = new Carbon\Carbon('2014-08-30 00:00:00', 'Europe/Paris');       // DST off
    echo $date->floatDiffInRealMinutes('2014-08-30    01:30:50')."<br>";

});
Route::get('/price/{id}','QrController@calculer');

