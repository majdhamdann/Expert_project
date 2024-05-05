<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Expertascontroller;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*


//*****************************************/
//login and logout expert
Route::post('register/expert','Expertascontroller@registerexpert');
Route::post('login/expert','Expertascontroller@loginexpert');
Route::group(['prefix'=>'expert','middleware'=>['auth:expert-api','scopes:expert']],function(){
    Route::get('/logout/expert','Expertascontroller@logoutexpert');
    Route::get('/search/{value}','Expertascontroller@search');
    Route::get('/expert/{b}','Expertascontroller@index');//  تصفح اسماء الخبراء ذوي الخبرةكذا
    Route::get('/show/{value}','Expertascontroller@show');
    Route::post('/createbook','Expertascontroller@createBook');
    Route::post('/book','Bookcontroller@Book');
    Route::post('/action/','Bookcontroller@action');
    



//Book
  Route::get('fullcalendar','Bookcontroller@index');
  Route::post('/create','Bookcontroller@createBook');
  Route::post('/update','Bookcontroller@update');
  Route::post('/delete','Bookcontroller@destroy');
   
 });

Route::post('/speciality', 'Expertascontroller@storeSpeciality'); 
Route::post('/day', 'Expertascontroller@storeDays'); 







