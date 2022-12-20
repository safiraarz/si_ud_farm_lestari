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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');
//supplier
Route::resource('supplier', 'SupplierController');
Route::post('/supplier/getEditForm', 'SupplierController@getEditForm')->name('supplier.getEditForm');
Route::post('/supplier/saveData', 'SupplierController@saveData')->name('supplier.saveData');
Route::post('/supplier/saveDataField', 'SupplierController@saveDataField')->name('supplier.saveDataField');
Route::post('/supplier/deleteData', 'SupplierController@deleteData')->name('supplier.deleteData');

//customer
Route::resource('customer', 'CustomerController');
Route::post('/customer/getEditForm', 'CustomerController@getEditForm')->name('customer.getEditForm');
Route::post('/customer/saveData', 'CustomerController@saveData')->name('customer.saveData');
Route::post('/customer/saveDataField', 'CustomerController@saveDataField')->name('customer.saveDataField');
Route::post('/customer/deleteData', 'CustomerController@deleteData')->name('customer.deleteData');

//barang
Route::resource('barang', 'BarangController');
Route::post('/barang/getEditForm', 'BarangController@getEditForm')->name('barang.getEditForm');
Route::post('/barang/saveData', 'BarangController@saveData')->name('barang.saveData');
Route::post('/barang/saveDataField', 'BarangController@saveDataField')->name('barang.saveDataField');
Route::post('/barang/deleteData', 'BarangController@deleteData')->name('barang.deleteData');

Route::resource('bom', 'BOMController');

//flok
Route::resource('flok', 'FlokController');
Route::post('/flok/getEditForm', 'FlokController@getEditForm')->name('flok.getEditForm');
Route::post('/flok/saveData', 'FlokController@saveData')->name('flok.saveData');
Route::post('/flok/saveDataField', 'FlokController@saveDataField')->name('flok.saveDataField');
Route::post('/flok/deleteData', 'FlokController@deleteData')->name('flok.deleteData');


Route::resource('hasilproduksi', 'HasilProduksiController');

//jabatan
Route::resource('jabatan', 'JabatanController');
Route::post('/jabatan/getEditForm', 'JabatanController@getEditForm')->name('jabatan.getEditForm');
Route::post('/jabatan/saveData', 'JabatanController@saveData')->name('jabatan.saveData');
Route::post('/jabatan/saveDataField', 'JabatanController@saveDataField')->name('jabatan.saveDataField');
Route::post('/jabatan/deleteData', 'JabatanController@deleteData')->name('jabatan.deleteData');

Route::resource('lpb', 'LPBController');
Route::resource('mps', 'MPSController');
Route::resource('mrp', 'MRPController');
Route::resource('notapembelian', 'NotaPembelianController');
Route::resource('notapemesanan', 'NotaPemesananController');
Route::resource('notapenjualan', 'NotaPenjualanController');
Route::resource('spk', 'SPKController');
Route::resource('suratjalan', 'SuratJalanController');
Route::resource('pemasukantelur', 'PemasukanTelurController');
Route::resource('jadwalpakan', 'JadwalPakanController');
Route::resource('daftarakun', 'DaftarAkunController');
