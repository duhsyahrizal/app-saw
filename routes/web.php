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
    Route::get('/nasabah', 'FrontendController@nasabah');
    Route::get('/riwayat', 'FrontendController@riwayat');

    Route::group(['prefix' => '/input/data'], function() {
        Route::get('/nasabah', 'FrontendController@inputDataAnggota');
        Route::get('/informasi', 'FrontendController@inputDataInformasi');
        Route::get('/foto', 'FrontendController@inputDataFoto');
        Route::get('/penghasilan', 'FrontendController@inputDataPenghasilan');
    });

    Route::get('/konfirmasi/data', 'FrontendController@konfirmasiData');

});

Route::get('/logout', 'AuthController@logout')->name('logout');
