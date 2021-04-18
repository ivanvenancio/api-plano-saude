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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::prefix('v1')->group(function(){

// });
Route::post('login', 'AuthController@login')->name('login');
Route::middleware(['apiJWT'])->group(function () {
    Route::get('clientes','ClienteController@index')->name('cliente.index');
    Route::post('clientes','ClienteController@store')->name('cliente.store');
    Route::put('clientes/{Cliente}','ClienteController@update')->name('cliente.update');
    Route::delete('clientes/{Cliente}','ClienteController@destroy')->name('cliente.delete');
    Route::get('clientes/{Cliente}','ClienteController@show')->name('cliente.show');
    Route::post('cliente/plano','ClienteController@contrataPlano')->name('cliente.contrata_plano');
});

