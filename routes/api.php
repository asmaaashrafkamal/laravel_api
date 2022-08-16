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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware'=>['api','changeLang']],function(){
    Route::post('getall1','App\Http\Controllers\CategoriesController@getall');
    Route::post('index','App\Http\Controllers\CategoriesController@index');
    Route::post('get-cat-by-id','App\Http\Controllers\CategoriesController@getCategoryById');
    Route::post('changeStatus','App\Http\Controllers\CategoriesController@changeStatus');
    Route::group(['prefix' => 'admin','namespace'=>'App\Http\Controllers\Admin'],function (){
        Route::post('login', 'AuthController@login');
        Route::post('logout','AuthController@logout')-> middleware(['AssignGuard:admin-api']);
          //invalidate token security side

         //broken access controller user enumeration
            });
    Route::group(['prefix' => 'User','namespace'=>'App\Http\Controllers\User'],function (){
        Route::post('login', 'AuthController@userLogin');
        Route::post('logout','AuthController@userLogout')-> middleware(['AssignGuard:user-api']);
          //invalidate token security side
         //broken access controller user enumeration
  });
});
  Route::group(['middleware'=>['api','checkpassword','changeLang','CheckAdminToken:admin-api']],function(){
    Route::post('offers','App\Http\Controllers\CategoriesController@index');
  });
