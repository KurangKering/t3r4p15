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
/**
 * There are 3 roles allowed 
 * - admin
 * - klien
 * - terapis
 */


Route::get('/', function () {
	return redirect('login');
});

Auth::routes();





Route::group(['middleware' => 'revalidate'], function() {

	Route::group(['middleware' => 'role:admin,klien,terapis'], function() {
		Route::get('/home', 'HomeController@index')->name('home');


	});

	
	Route::group(['middleware' => 'role:admin'], function() {
		Route::resource('pengguna', 'PenggunaController');
		Route::resource('terapi', 'TerapiController');
		Route::resource('terapis', 'TerapisController');
		Route::resource('klien', 'KlienController');
		Route::resource('anak', 'AnakController');

	});
	Route::group(['middleware' => 'role:terapis, klien'], function() {
		Route::get('hasil_terapi/{id}/cetak', [
			'uses' => 'HasilTerapiController@cetak',
			'as' => 'hasil_terapi.cetak',

		]);

		Route::get('hasil_evaluasi/{id}/cetak', [
			'uses' => 'HasilEvaluasiController@cetak',
			'as' => 'hasil_evaluasi.cetak',

		]);

	});
	Route::group(['middleware' => 'role:terapis'], function() {
		Route::resource('terapi_anak', 'TerapiAnakController');
		Route::resource('hasil_terapi', 'HasilTerapiController');
		Route::resource('hasil_evaluasi', 'HasilEvaluasiController');

	});
	
});
