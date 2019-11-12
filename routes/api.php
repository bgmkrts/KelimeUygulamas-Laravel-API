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
Route::post('create', 'RegisterController@create');
Route::get('index', 'RegisterController@index');
Route::get('login', 'LoginController@login');
Route::post('forgotPassword', 'ForgotPasswordController@forgotPassword');
Route::post('resetPassword', 'ForgotPasswordController@resetPassword');
Route::get("userShow", "loginController@userShow");



Route::prefix('word')->group(function () {
    Route::get("/{degreeOfDifficulty}", "WordController@index");
    Route::post("create", "WordController@create");
    Route::get("removeWord/{id}","WordController@removeWord");
    Route::post("updateWord","WordController@updateWord");
});
Route::prefix('myWord')->group(function(){
    Route::post("create","MyWordController@create");
    Route::get("/","MyWordController@index");
    Route::get("removeMyWord/{id}","MyWordController@removeMyWord")->middleware('auth:api');
    Route::post("updateMyWord","MyWordController@updateMyWord")->middleware('auth:api');
});
Route::prefix('exerciseType')->group(function(){
    Route::post("create","ExerciseTypeController@create");
    Route::get("/","ExerciseTypeController@index");
});
Route::prefix('exerciseStatistic')->group(function() {
    Route::post("create","ExerciseStatisticController@create");
    Route::get('/','ExerciseStatisticController@index')->middleware('auth:api');
});
Route::prefix('wordStatistic')->group(function(){
    Route::post("create","WordStatisticController@create");
    Route::get('/','WordStatisticController@index')->middleware('auth:api');
});

