<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('create','RegisterController@create');
Route::get('index','RegisterController@index');
Route::get('login','LoginController@login');
Route::post('forgotPassword','ForgotPasswordController@forgotPassword');
Route::post('resetPassword','ForgotPasswordController@resetPassword');
Route::get("userShow","loginController@userShow");
