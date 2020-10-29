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
    Route::resource('topics', 'TopicController')->only(['index', 'show']);
    Route::resource('users', 'UserController')->only(['index', 'show']);
    Route::resource('feedbacks', 'FeedbackController')->only(['index', 'show']);
    
    
    Route::group(['middleware' => 'auth:api'], function () {
        Route::resource('topics', 'TopicController')->except(['index', 'show']);
        Route::resource('users', 'UserController')->except(['index', 'show']);

        Route::resources([
            'activities' => 'ActivityController',
            'activity-replies' => 'ActivityReplyController',
            'answers' => 'AnswerController',
            'categories' => 'CategoryController',
            'events' => 'EventController',
            // 'feedbacks' => 'FeedbackController',
            'questions' => 'QuestionController',
            'replies' => 'ReplyController',
            'roles' => 'RoleController'
        ]);

        Route::post('activities/toggle-liked', 'ActivityController@toggleLiked');
        Route::post('answers/toggle-helpful', 'AnswerController@toggleHelpful');
        Route::post('questions/follow', 'QuestionController@follow');
        Route::post('topics/join', 'TopicController@join');
        Route::post('topics/check-in', 'TopicController@checkIn');
        Route::post('users/become-coach', 'UserController@becomeCoach');
        Route::post('users/follow-coach', 'UserController@followCoach');
    });
});
