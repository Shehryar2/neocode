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

Route::get('/', function () {
    return view('welcome');

});

Route::group(['prefix'=>'zoom','as'=>'zoom.'], function(){
    Route::get('/list/{code}', ['as' => 'index', 'uses' => 'App\Http\Controllers\ZoomWebController@listMeetings']);
});
