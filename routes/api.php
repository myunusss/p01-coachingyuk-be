<?php

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

Route::group(['middleware' => 'response.time'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::get('login/{provider}', 'AuthController@redirectToProvider');
    Route::get('login/{provider}/callback', 'AuthController@handleProviderCallback');
    
    Route::group(['middleware' => 'auth:api'], function () {
        Route::resources([
            'activities' => 'ActivityController',
            'activity-replies' => 'ActivityReplyController',
            'answers' => 'AnswerController',
            'categories' => 'CategoryController',
            'questions' => 'QuestionController',
            'replies' => 'ReplyController',
            'roles' => 'RoleController',
            'topics' => 'TopicController',
            'users' => 'UserController'
        ]);

        Route::post('answers/toggle-helpful', 'AnswerController@toggleHelpful');
        Route::post('questions/follow', 'QuestionController@follow');
        Route::post('topics/join', 'TopicController@join');
        Route::post('topics/check-in', 'TopicController@checkIn');
        Route::post('users/become-coach', 'UserController@becomeCoach');
    });
});
