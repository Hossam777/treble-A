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

Route::post('login','UserHandler@Login');
Route::post('register','UserHandler@Register');

//Route::get('userdata','UserHandler@UserData')->middleware('auth:api');
Route::group(['middleware' => 'auth:api'], function(){
	Route::get('userdata', 'UserHandler@UserData');
    //Route::get('test', 'UserHandler@Test');
    Route::get('addskill','UserHandler@AddSkill');
    Route::get('updatescore','UserHandler@UpdateScore');
    Route::get('followuser','UserHandler@FollowUser');
    Route::get('followcompany','UserHandler@FollowCompany');
    Route::get('addresolvedquiz','UserHandler@AddResolvedQuiz');
    Route::get('getfollowedcompanies','UserHandler@GetFollowedCompanies');
    Route::get('getfollowedusers','UserHandler@GetFollowedUsers');
    Route::get('updateprofile','UserHandler@UpdateProfile');
});

/*Route::group(['middleware' => 'auth:api'], function(){
    Route::get('details', 'UserHandler@details');
});*/

Route::post('companies/login','CompanyHandler@Login');
Route::post('companies/register','CompanyHandler@Register');

Route::post('candidateform/add','CandidateFormHandler@AddForm');
Route::get('candidateform/get','CandidateFormHandler@GetForm');

Route::post('applicationform/add','ApplicationFormHandler@AddForm');
Route::get('applicationform/get','ApplicationFormHandler@GetForm');

Route::post('vacancy/add','VacanciesHandler@AddVacancy');
Route::get('vacancy/company/get','VacanciesHandler@GetVacancyByCompany');
Route::get('vacancy/get','VacanciesHandler@GetALLVacancies');
/*
Route::group(['middleware' => 'auth:companies-api'], function(){

});*/