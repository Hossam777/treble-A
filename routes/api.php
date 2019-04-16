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

//'UserHandler@login'

Route::post('login','UserHandler@Login');
Route::post('register','UserHandler@Register');
Route::get('userdata','UserHandler@UserData');
Route::get('addskill','UserHandler@AddSkill');
Route::get('updatescore','UserHandler@UpdateScore');
Route::get('followuser','UserHandler@FollowUser');
Route::get('followcompany','UserHandler@FollowCompany');
Route::get('addresolvedquiz','UserHandler@AddResolvedQuiz');
Route::get('getfollowedcompanies','UserHandler@GetFollowedCompanies');
Route::get('getfollowedusers','UserHandler@GetFollowedUsers');

/*Route::group(['middleware' => 'auth:api'], function(){
    Route::get('details', 'UserHandler@details');
});*/