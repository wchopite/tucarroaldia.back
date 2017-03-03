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

Route::group(['prefix'=>'v1'], function(){

  // Marcas de vehiculos
  Route::group(['prefix'=>'brands'], function(){
    Route::get('/', 'BrandsController@index');
    Route::get('/trashed', 'BrandsController@trashed');
    Route::post('/trashed/{brand}', 'BrandsController@restore')->where('brand','[0-9]+');
    Route::get('/{brand}', 'BrandsController@show')->where('brand','[0-9]+');
    Route::post('/', 'BrandsController@store');
    Route::put('/{brand}', 'BrandsController@update')->where('brand','[0-9]+');
    Route::delete('/{brand}', 'BrandsController@destroy')->where('brand','[0-9]+');
  });

  // Modelos de vehiculos
  Route::group(['prefix'=>'models'], function(){
    Route::get('/', 'VehicleModelsController@index');
    Route::get('/trashed', 'VehicleModelsController@trashed');
    Route::post('/trashed/{model}', 'VehicleModelsController@restore')->where('model','[0-9]+');
    Route::get('/{model}', 'VehicleModelsController@show')->where('model','[0-9]+');
    Route::post('/', 'VehicleModelsController@store');
    Route::put('/{model}', 'VehicleModelsController@update')->where('model','[0-9]+');
    Route::delete('/{model}', 'VehicleModelsController@destroy')->where('model','[0-9]+');
  });

  // Tipos de vehiculos
  Route::group(['prefix'=>'types'], function(){
    Route::get('/', 'TypesController@index');
    Route::get('/trashed', 'TypesController@trashed');
    Route::post('/trashed/{type}', 'TypesController@restore')->where('type','[0-9]+');
    Route::get('/{type}', 'TypesController@show')->where('type','[0-9]+');
    Route::post('/', 'TypesController@store');
    Route::put('/{type}', 'TypesController@update')->where('type','[0-9]+');
    Route::delete('/{type}', 'TypesController@destroy')->where('type','[0-9]+');
  });

});
