<?php

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

Route::get('/', 'PresensiController@front');

Auth::routes();

Route::post('presensi/check', 'PresensiController@check');
Route::get('presensi/absen_data', 'PresensiController@absen_data');

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('dashboard', 'DashBoardController@index');

    Route::group(['prefix' => 'data'], function () {
        /**
         * Route user
         */
        Route::get('user', 'UsersController@index');
        Route::group(['prefix' => 'user'], function () {
            Route::get('create', 'UsersController@create');
            Route::post('store', 'UsersController@store');
            Route::post('delete', 'UsersController@delete');
        });

        /**
         * Route jadwal
         */
        Route::get('jadwal', 'JadwalController@index');
        Route::group(['prefix' => 'jadwal'], function () {
            Route::get('create', 'JadwalController@create');
            Route::post('store', 'JadwalController@store');
            Route::post('delete', 'JadwalController@delete');
        });

        /**
         * Route golongan
         */
        Route::get('golongan', 'GolonganController@index');
        Route::group(['prefix' => 'golongan'], function () {
            Route::get('create', 'GolonganController@create');
            Route::post('golongan', 'GolonganController@store_golongan');
            Route::post('store_masa_kerja', 'GolonganController@store_masa_kerja');
            Route::post('delete_golongan', 'GolonganController@delete_golongan');
            Route::post('delete_masa_kerja', 'GolonganController@delete_masa_kerja');
        });

        /**
         * Route presensi
         */
        Route::get('presensi', 'PresensiController@index');
        Route::group(['prefix' => 'presensi'], function () {
            Route::get('show', 'PresensiController@show');
            Route::post('update', 'PresensiController@update');
            Route::post('delete', 'PresensiController@delete');
        });

    });
    
    Route::group(['prefix' => 'penggajian'], function () {
        Route::get('', 'SalaryController@index');
        Route::get('proses', 'SalaryController@proses');
        Route::get('print', 'SalaryController@print');
    });
});
