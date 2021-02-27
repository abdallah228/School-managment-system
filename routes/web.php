<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth' ]
    ], function(){ //...

            Route::get('/dashboard', 'HomeController@index')->name('home');//home page after login

            route::group(['prefix'=>'dashboard','namespace'=>'Dashboard'],function(){
            
            Route::resource('grades', 'GradeController');//grades
            ###classes rooms######
            Route::resource('classes-rooms', 'ClassesRoomController');//classesrooms
            route::post('classes-rooms/delete-all','ClassesRoomController@delete_all')->name('delete_all');//delete all classesrooms
            route::post('filter-classes','ClassesRoomController@filter_classes')->name('filter_classes');//dilter classes to search by grade
        

        });

    });

