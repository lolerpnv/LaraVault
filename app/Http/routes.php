<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/upload',  ['middleware' => 'auth',function () {
    return view('assets.upload');
}]);

Route::get('/files', [ 'middleware' => 'auth',
                    'uses' => 'AssetController@index']);

Route::get('/file/{name}', 'AssetController@getAsset');

Route::post('/file', [ 'middleware' => 'auth',
                    'uses' => 'AssetController@upload']);

Route::delete('/file/{name}', [ 'middleware' => 'auth',
                    'uses' => 'AssetController@destroy']);

Route::auth();

Route::get('/home', 'AssetController@index');
