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

Route::resource("profile","APIProfileController",['only'=>['index']]);
Route::post("profile","APIProfileController@update");
Route::resource("statuses","APIStatusesController",['only'=>['index','show','update','store','destroy']]);
Route::resource("projects","APIProjectsController",['only'=>['index','show','update','store','destroy']]);
Route::resource("projects/{project_id}/tasks","APITasksController",['only'=>['index','show','update','store','destroy']]);
Route::resource("tasks","APITasksController",['only'=>['index','show','update','store','destroy']]);