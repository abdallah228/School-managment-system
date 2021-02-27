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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//............register and login ............. 
Route::post('register', 'Api\LoginController@register');
Route::post('login', 'Api\LoginController@login');
//...............logout.............
route::get('/logout','Api\LoginController@logout')->middleware('auth:api');//logout
//.............................
    route::group(['namespace'=>'Api\Dashboard','prefix'=>'dashboard','middleware'=>['change_lang' ,'auth:api']],function(){
//.............grades..........
    route::post('/grades','GradeController@index');//show all grades
    Route::post('grades-store', 'GradeController@store');//add new grade
    route::post('grades/{id}','GradeController@show');//show single grade
    route::put('grades/update/{id}','GradeController@update');//update grade
    route::delete('grades/delete/{id}','GradeController@destroy');//delete grade
//................ClassRoom..................................
   // Route::apiResource('classrooms', 'ClassesRoomController');
    Route::post('classrooms','ClassesRoomController@index');//show classesrooms






        
});//end route group api/dashboard
