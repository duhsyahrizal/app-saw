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

Route::get('/login', 'AuthController@showLogin')->name('login');
Route::post('/login', 'AuthController@postLogin');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'FrontendController@index');
    Route::get('/result', 'FrontendController@result');
    Route::get('/pass-result', 'FrontendController@passResult');

    Route::group(['prefix' => 'nasabah'], function() {
        Route::get('/', 'FrontendController@nasabah');
        Route::get('/detail/{id}', 'FrontendController@detailNasabah');
        Route::post('/update', 'FrontendController@updateNasabah');
        Route::get('/delete/{id}', 'FrontendController@deleteNasabah');
    });

    Route::group(['prefix' => '/input/data'], function() {
        Route::get('/nasabah', 'FrontendController@inputDataAnggota');
        Route::post('/nasabah', 'FrontendController@postDataNasabah');

        Route::get('/informasi', 'FrontendController@inputDataInformasi');
        Route::post('/informasi', 'FrontendController@postDataInformasi');

        Route::get('/foto', 'FrontendController@inputDataFoto');
        Route::post('/foto', 'FrontendController@postDataFoto');

        Route::get('/usaha', 'FrontendController@inputDataUsaha');
        Route::post('/usaha', 'FrontendController@postDataUsaha');
    });

    Route::get('/konfirmasi/data', 'FrontendController@konfirmasiData');
    Route::post('/konfirmasi/data', 'FrontendController@confirmation');

});

Route::get('/logout', 'AuthController@logout')->name('logout');
