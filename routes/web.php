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
Route::group(['prefix'=>'{local}'],function(){
    Route::get('/', function () {
    return view('welcome');
})->middleware('setLocale');
});
Route::get('language-change', [Bookcontroller::class, 'changeLanguage'])->middleware('setLocale');


