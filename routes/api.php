<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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



Route::resource('user', 'User\UserController', [
    'only' => ['store', 'show', 'update', 'destroy']
]);
Route::post('login', 'LoginApiController@login');

Route::group(['middleware' => 'jwt.auth'], function () {

    Route::resource('test', 'Test\TestController');
    Route::resource('test.questions', 'Test\TestQuestionsController');
    Route::resource('test.questions.answers', 'Test\TestQuestionAnswerController');
});
