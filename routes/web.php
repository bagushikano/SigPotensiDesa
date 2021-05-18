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

Route::get('/', 'User\Landing\LandingController@landing')->name('Landing Page');

Route::get('/login', 'Admin\Auth\LoginController@loginForm')->name('Login Form')->middleware('guest');
Route::post('/login', 'Admin\Auth\LoginController@login')->name('Login');
Route::post('/logout', 'Admin\Auth\LoginController@logout')->name('Logout');

Route::get('/dashboard', 'Admin\dashboard\DashboardController@dashboard')->name('Dashboard Admin');

Route::get('/manajemen-desa', 'Admin\ManajemenDesa\ManajemenDesaController@semuaDesa')->name('Manajemen Desa');
Route::post('/manajemen-desa/tambah', 'Admin\ManajemenDesa\ManajemenDesaController@tambahDesa')->name('Tambah Desa');
Route::get('/manajemen-desa/polyline/{desa}', 'Admin\ManajemenDesa\ManajemenDesaController@polylineDesa')->name('Polyline Desa');
Route::get('/manajemen-desa/detail/{desa}', 'Admin\ManajemenDesa\ManajemenDesaController@detailDesa')->name('Detail Desa');
Route::post('/manajemen-desa/update/{desa}', 'Admin\ManajemenDesa\ManajemenDesaController@updateDesa')->name('Update Desa');

Route::get('/pasar', 'Admin\PotensiDesa\PasarController@semuaPasar')->name('Pasar');
Route::get('/pasar/tambah', 'Admin\PotensiDesa\PasarController@tambahPasar')->name('Tambah Pasar');
Route::post('/pasar/simpan', 'Admin\PotensiDesa\PasarController@simpanPasar')->name('Simpan Pasar');
Route::get('/pasar/detail/{pasar}', 'Admin\PotensiDesa\PasarController@detailPasar')->name('Detail Pasar');
Route::post('/pasar/update/{pasar}', 'Admin\PotensiDesa\PasarController@updatePasar')->name('Update Pasar');
Route::post('/pasar/hapus/{pasar}', 'Admin\PotensiDesa\PasarController@hapusPasar')->name('Hapus Pasar');

Route::get('/pusat-pemerintahan', 'Admin\PotensiDesa\PuspemController@semuaPuspem')->name('Puspem');

Route::get('/sekolah', 'Admin\PotensiDesa\SekolahController@semuaSekolah')->name('Sekolah');

Route::get('/tempat-ibadah', 'Admin\PotensiDesa\TempatIbadahController@semuaTempatIbadah')->name('Tempat Ibadah');