<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usercontroller;
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
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//login and logout user
Route::post('register/user','usercontroller@registeruser');
Route::post('login/user','usercontroller@loginuser');
Route::group(['prefix'=>'user', 'middleware'=> ['auth:user-api','scopes:user' ]], function (){
    Route::get('/logout/user', 'usercontroller@logoutuser');   
});

