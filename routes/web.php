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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['admin']], function() {
	//Database
  Route::get('/database', 'DatabaseController@index');
  Route::get('/backup', 'DatabaseController@backup');
  Route::post('/restore', 'DatabaseController@restore');
  Route::get('download/{filename}', 'DatabaseController@download');

  //Tahun
  Route::get('/tahun', 'TahunController@index');
  Route::get('/tahun/tambah', 'TahunController@create');
  Route::post('/tahun/simpan', 'TahunController@store');
  Route::delete('/tahun/hapus/{id}', 'TahunController@destroy');
  Route::get('/tahun/edit/{id}', 'TahunController@edit');
  Route::get('/tahun/show/{id}', 'TahunController@show');
  Route::post('/tahun/update/{id}', 'TahunController@update');

  //Kelas
  Route::get('/kelas', 'KelasController@index');
  Route::get('/kelas/tambah', 'KelasController@create');
  Route::post('/kelas/simpan', 'KelasController@store');
  Route::delete('/kelas/hapus/{id}', 'KelasController@destroy');
  Route::get('/kelas/edit/{id}', 'KelasController@edit');
  Route::get('/kelas/show/{id}', 'KelasController@show');
  Route::post('/kelas/update/{id}', 'KelasController@update');
  
  Route::post('/identitas/update', 'IdentitasController@update');
  Route::get('pengaturan', 'IdentitasController@getSet');
  Route::post('/pengaturan/update', 'IdentitasController@setUpdate');
  
});
  //Identitas
  Route::get('/identitas', 'IdentitasController@index');

	//Siswa
	Route::get('/siswa', 'SiswaController@index');
	Route::get('/siswa/tambah', 'SiswaController@create');
	Route::post('/siswa/simpan', 'SiswaController@store');
	Route::delete('/siswa/hapus/{id}', 'SiswaController@destroy');
	Route::get('/siswa/edit/{id}', 'SiswaController@edit');
	Route::get('/siswa/show/{id}', 'SiswaController@show');
	Route::post('/siswa/update/{id}', 'SiswaController@update');
	Route::get('/siswa/mutasi', 'SiswaController@vmutasi');
	Route::post('/siswa/mutasi/save', 'SiswaController@mutasi');

	// Kas
	Route::get('/kas', 'KasController@index');
	Route::get('/kas/pemasukan', 'KasController@pemasukan');
	Route::get('/kas/pengeluaran', 'KasController@pengeluaran');
	Route::post('/kas/kasmasuk', 'KasController@kasmasuk');
	Route::post('/kas/kaskeluar', 'KasController@kaskeluar');
	Route::get('/kas/view/{id}', 'KasController@show');
	Route::get('/kas/edit/{id}', 'KasController@edit');
	Route::post('/kas/update/{id}', 'KasController@update');
	Route::delete('/kas/hapus/{id}', 'KasController@destroy');

	//Transaksi
	Route::get('/transaksi', 'TransaksiController@index');
  Route::get('/cari', 'TransaksiController@loadData');
  Route::post('/transaksi/simpan', 'TransaksiController@store');

  //Laporan
  Route::get('/laporan/tahun', 'LaporanController@tahun');
  Route::get('/laporan/kelas', 'LaporanController@kelas');
  Route::get('/laporan/siswa', 'LaporanController@siswa');
  Route::get('/laporan/kas', 'LaporanController@kas');
  Route::get('/laporan/transaksi', 'LaporanController@transaksi');
  Route::get('/laporan/grafik', 'LaporanController@grafik');
