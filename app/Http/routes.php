<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
  Route::get('facebook/authorize', function() {
    return SocialAuth::authorize('facebook', function($user, $details) {
      $user->nickname = $details->nickname;
      $user->name = $details->full_name;
      $user->profile_image = $details->avatar;
      $user->save();
    });
  });

  Route::get('linkedin/authorize', function() {
    return SocialAuth::authorize('linkedin');
  });

  Route::get('github/authorize', function() {
    return SocialAuth::authorize('github');
  });

  Route::get('google/authorize', function() {
    return SocialAuth::authorize('google');
  });
});
