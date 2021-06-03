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

Route::get('/maps/icon/{id}', 'Admin\Images\ImageController@getIcon');


Route::get('/', 'User\Landing\LandingController@landing')->name('Landing Page');
Route::post('/kunjungan', 'User\Landing\LandingController@tambahKunjungan')->name('Tambah Kunjungan');


Route::post('/tambah/admin', 'Admin\Auth\RegisController@tambahAdmin')->name('Tambah Admin')->middleware('auth');
Route::get('/login', 'Admin\Auth\LoginController@loginForm')->name('Login Form')->middleware('guest');
Route::post('/profile/admin/update/{admin}', 'Admin\Auth\ProfileController@updateProfile')->name('Update Profile Admin')->middleware('auth');
Route::post('/password/admin/ubah/{admin}', 'Admin\Auth\ProfileController@ubahPassword')->name('Ubah Password Admin')->middleware('auth');
Route::post('/login', 'Admin\Auth\LoginController@login')->name('Login');
Route::post('/logout', 'Admin\Auth\LoginController@logout')->name('Logout')->middleware('auth');


Route::get('/dashboard', 'Admin\Dashboard\DashboardController@dashboard')->name('Dashboard Admin');


Route::get('/manajemen-desa', 'Admin\ManajemenDesa\ManajemenDesaController@semuaDesa')->name('Manajemen Desa');
Route::post('/manajemen-desa/tambah', 'Admin\ManajemenDesa\ManajemenDesaController@tambahDesa')->name('Tambah Desa');
Route::get('/manajemen-desa/polyline/{desa}', 'Admin\ManajemenDesa\ManajemenDesaController@polylineDesa')->name('Polyline Desa');
Route::get('/manajemen-desa/detail/{desa}', 'Admin\ManajemenDesa\ManajemenDesaController@detailDesa')->name('Detail Desa');
Route::post('/manajemen-desa/update/{desa}', 'Admin\ManajemenDesa\ManajemenDesaController@updateDesa')->name('Update Desa');


Route::get('/pasar', 'Admin\PotensiDesa\PasarController@semuaPasar')->name('Pasar');
Route::get('/pasar/tambah', 'Admin\PotensiDesa\PasarController@tambahPasar')->name('Tambah Pasar');
Route::post('/pasar/simpan', 'Admin\PotensiDesa\PasarController@simpanPasar')->name('Simpan Pasar');
Route::get('/pasar/detail/{pasar}', 'Admin\PotensiDesa\PasarController@detailPasar')->name('Detail Pasar');
Route::get('/pasar/getImg/{pasar}', 'Admin\PotensiDesa\PasarController@imgPasar')->name('Image Pasar');
Route::post('/pasar/update/{pasar}', 'Admin\PotensiDesa\PasarController@updatePasar')->name('Update Pasar');
Route::post('/pasar/hapus/{pasar}', 'Admin\PotensiDesa\PasarController@hapusPasar')->name('Hapus Pasar');


Route::get('/pusat-pemerintahan', 'Admin\PotensiDesa\PuspemController@semuaPuspem')->name('Puspem');
Route::get('/pusat-pemerintahan/tambah', 'Admin\PotensiDesa\PuspemController@tambahPuspem')->name('Tambah Puspem');
Route::post('/pusat-pemerintahan/simpan', 'Admin\PotensiDesa\PuspemController@simpanPuspem')->name('Simpan Puspem');
Route::get('/pusat-pemerintahan/detail/{puspem}', 'Admin\PotensiDesa\PuspemController@detailPuspem')->name('Detail Puspem');
Route::get('/pusat-pemerintahan/getImg/{puspem}', 'Admin\PotensiDesa\PuspemController@imgPuspem')->name('Image Puspem');
Route::post('/pusat-pemerintahan/update/{puspem}', 'Admin\PotensiDesa\PuspemController@updatePuspem')->name('Update Puspem');
Route::post('/pusat-pemerintahan/hapus/{puspem}', 'Admin\PotensiDesa\PuspemController@hapusPuspem')->name('Hapus Puspem');


Route::get('/sekolah', 'Admin\PotensiDesa\SekolahController@semuaSekolah')->name('Sekolah');
Route::get('/sekolah/tambah', 'Admin\PotensiDesa\SekolahController@tambahSekolah')->name('Tambah Sekolah');
Route::post('/sekolah/simpan', 'Admin\PotensiDesa\SekolahController@simpanSekolah')->name('Simpan Sekolah');
Route::get('/sekolah/detail/{sekolah}', 'Admin\PotensiDesa\SekolahController@detailSekolah')->name('Detail Sekolah');
Route::get('/sekolah/getImg/{sekolah}', 'Admin\PotensiDesa\SekolahController@imgSekolah')->name('Image Sekolah');
Route::post('/sekolah/update/{sekolah}', 'Admin\PotensiDesa\SekolahController@updateSekolah')->name('Update Sekolah');
Route::post('/sekolah/hapus/{sekolah}', 'Admin\PotensiDesa\SekolahController@hapusSekolah')->name('Hapus Sekolah');


Route::get('/tempat-ibadah', 'Admin\PotensiDesa\TempatIbadahController@semuaTempatIbadah')->name('Tempat Ibadah');
Route::get('/tempat-ibadah/tambah', 'Admin\PotensiDesa\TempatIbadahController@tambahTempatIbadah')->name('Tambah Tempat Ibadah');
Route::post('/tempat-ibadah/simpan', 'Admin\PotensiDesa\TempatIbadahController@simpanTempatIbadah')->name('Simpan Tempat Ibadah');
Route::get('/tempat-ibadah/detail/{tempatIbadah}', 'Admin\PotensiDesa\TempatIbadahController@detailTempatIbadah')->name('Detail Tempat Ibadah');
Route::get('/tempat-ibadah/getImg/{tempatIbadah}', 'Admin\PotensiDesa\TempatIbadahController@imgTempatIbadah')->name('Image Tempat Ibadah');
Route::post('/tempat-ibadah/update/{tempatIbadah}', 'Admin\PotensiDesa\TempatIbadahController@updateTempatIbadah')->name('Update Tempat Ibadah');
Route::post('/tempat-ibadah/hapus/{tempatIbadah}', 'Admin\PotensiDesa\TempatIbadahController@hapusTempatIbadah')->name('Hapus Tempat Ibadah');


Route::get('/report', 'Admin\Report\ReportController@semuaPotensiDesa')->name('Report');
Route::get('/report/potensi-desa/{desa}', 'Admin\Report\ReportController@detailPotensiDesa')->name('Detail Report');
Route::get('/report/jumlah-kunjungan/{desa}', 'Admin\Report\ReportController@jumlahKunjungan')->name('Jumlah Kunjungan');