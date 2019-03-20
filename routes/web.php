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

	Route::group(['middleware' => 'role:admin,klien,terapis,pimpinan'], function() {
		Route::get('/home', 'HomeController@index')->name('home');


	});

	
	Route::group(['middleware' => 'role:admin'], function() {
		Route::resource('pengguna', 'PenggunaController');
		Route::resource('terapi', 'TerapiController');
		Route::resource('terapis', 'TerapisController');
		Route::resource('klien', 'KlienController');
		Route::resource('anak', 'AnakController');

	});
	Route::group(['middleware' => 'role:terapis'], function() {
		Route::resource('terapi_anak', 'TerapiAnakController');
		
	});
	
	
	Route::group(['middleware' => 'role:terapis,klien,pimpinan'], function() {
		Route::get('hasil_terapi/{id}/cetak', [
			'uses' => 'HasilTerapiController@cetak',
			'as' => 'hasil_terapi.cetak',

		]);

		Route::get('hasil_evaluasi/{id}/cetak', [
			'uses' => 'HasilEvaluasiController@cetak',
			'as' => 'hasil_evaluasi.cetak',

		]);

		Route::resource('hasil_terapi', 'HasilTerapiController');
		Route::resource('hasil_evaluasi', 'HasilEvaluasiController');
		Route::resource('profil', 'ProfilController');
	});
	

	Route::group(['middleware' => 'role:pimpinan'], function() {

		Route::get('pimpinan/daftar_klien', [
			'uses' => 'PimpinanController@daftar_klien',
			'as' => 'pimpinan.daftar_klien',
		]);

		Route::get('pimpinan/daftar_anak', [
			'uses' => 'PimpinanController@daftar_anak',
			'as' => 'pimpinan.daftar_anak',
		]);

		Route::get('pimpinan/daftar_terapi', [
			'uses' => 'PimpinanController@daftar_terapi',
			'as' => 'pimpinan.daftar_terapi',
		]);
		Route::get('pimpinan/daftar_terapis', [
			'uses' => 'PimpinanController@daftar_terapis',
			'as' => 'pimpinan.daftar_terapis',
		]);
		Route::get('pimpinan/daftar_terapi_anak', [
			'uses' => 'PimpinanController@daftar_terapi_anak',
			'as' => 'pimpinan.daftar_terapi_anak',
		]);
		Route::get('pimpinan/daftar_hasil_terapi', [
			'uses' => 'PimpinanController@daftar_hasil_terapi',
			'as' => 'pimpinan.daftar_hasil_terapi',
		]);
		Route::get('pimpinan/daftar_hasil_evaluasi', [
			'uses' => 'PimpinanController@daftar_hasil_evaluasi',
			'as' => 'pimpinan.daftar_hasil_evaluasi',
		]);
		


		Route::resource('pimpinan', 'PimpinanController');
		
	});
	
});
