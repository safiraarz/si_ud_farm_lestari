<?php

use App\MRP;
use Illuminate\Support\Facades\Auth;
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
//test
Route::get('/testmrp',function(){
    $idmps = 11202;
    $mrp = MRP::where('MPS_id', $idmps)->first();
    $dmrp = $mrp->dmrp;
    dd($mrp->dmrp->groupBy('barang_id'));
});

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/home', 'HomeController@index')->name('home');
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
Route::post('/bom/getEditForm', 'BOMController@getEditForm')->name('bom.getEditForm');
Route::post('/bom/saveData', 'BOMController@saveData')->name('bom.saveData');
Route::post('/bom/saveDataField', 'BOMController@saveDataField')->name('bom.saveDataField');
Route::post('/bom/deleteData', 'BOMController@deleteData')->name('bom.deleteData');
Route::post('/bom/create', 'BOMController@create')->name('bom.create');

//flok
Route::resource('flok', 'FlokController');
Route::post('/flok/getEditForm', 'FlokController@getEditForm')->name('flok.getEditForm');
Route::post('/flok/saveData', 'FlokController@saveData')->name('flok.saveData');
Route::post('/flok/saveDataField', 'FlokController@saveDataField')->name('flok.saveDataField');
Route::post('/flok/deleteData', 'FlokController@deleteData')->name('flok.deleteData');


Route::resource('hasilproduksi', 'HasilProduksiController');
Route::post('/hasilproduksi/getEditForm', 'HasilProduksiController@getEditForm')->name('hasilproduksi.getEditForm');
Route::post('/hasilproduksi/saveData', 'HasilProduksiController@saveData')->name('hasilproduksi.saveData');
Route::post('/hasilproduksi/saveDataField', 'HasilProduksiController@saveDataField')->name('hasilproduksi.saveDataField');
Route::post('/hasilproduksi/deleteData', 'HasilProduksiController@deleteData')->name('hasilproduksi.deleteData');


//jabatan
Route::resource('jabatan', 'JabatanController');
Route::post('/jabatan/getEditForm', 'JabatanController@getEditForm')->name('jabatan.getEditForm');
Route::post('/jabatan/saveData', 'JabatanController@saveData')->name('jabatan.saveData');
Route::post('/jabatan/saveDataField', 'JabatanController@saveDataField')->name('jabatan.saveDataField');
Route::post('/jabatan/deleteData', 'JabatanController@deleteData')->name('jabatan.deleteData');

//LPB
Route::resource('lpb', 'LPBController');
Route::post('/lpb/getEditForm', 'LPBController@getEditForm')->name('lpb.getEditForm');
Route::post('/lpb/saveData', 'LPBController@saveData')->name('lpb.saveData');
Route::post('/lpb/saveDataField', 'LPBController@saveDataField')->name('lpb.saveDataField');
Route::post('/lpb/deleteData', 'LPBController@deleteData')->name('lpb.deleteData');
Route::post('/lpb/create', 'LPBController@create')->name('lpb.create');

//MPS
Route::resource('mps', 'MPSController');
Route::post('/mps/getEditForm', 'MPSController@getEditForm')->name('mps.getEditForm');
Route::post('/mps/saveData', 'MPSController@saveData')->name('mps.saveData');
Route::post('/mps/saveDataField', 'MPSController@saveDataField')->name('mps.saveDataField');
Route::post('/mps/deleteData', 'MPSController@deleteData')->name('mps.deleteData');

//MRP
Route::get('/mrp/laporan', 'MRPController@laporanKebutuhan')->name('mrp.laporanKebutuhan');
Route::post('/mrp/getLaporan', 'MRPController@getLaporanKebutuhn')->name('mrp.getLaporanKebutuhan');
Route::resource('mrp', 'MRPController');
Route::post('/mrp/getPerhitunganMRP', 'MRPController@getPerhitungMRP')->name('mrp.getPerhitungMRP');
Route::post('/mrp/getEditForm', 'MRPController@getEditForm')->name('mrp.getEditForm');
Route::post('/mrp/saveData', 'MRPController@saveData')->name('mrp.saveData');
Route::post('/mrp/saveDataField', 'MRPController@saveDataField')->name('mrp.saveDataField');
Route::post('/mrp/deleteData', 'MRPController@deleteData')->name('mmrpps.deleteData');


// Nota Universal
Route::resource('nota', 'NotaController');

//notapembelian
Route::resource('notapembelian', 'NotaPembelianController');
Route::post('/notapembelian/getEditForm', 'NotaPembelianController@getEditForm')->name('notapembelian.getEditForm');
Route::post('/notapembelian/saveData', 'NotaPembelianController@saveData')->name('notapembelian.saveData');
Route::post('/notapembelian/saveDataField', 'NotaPembelianController@saveDataField')->name('notapembelian.saveDataField');
Route::post('/notapembelian/deleteData', 'NotaPembelianController@deleteData')->name('notapembelian.deleteData');

//nota pemesanan
Route::resource('notapemesanan', 'NotaPemesananController');
Route::post('/notapemesanan/getEditForm', 'NotaPemesananController@getEditForm')->name('notapemesanan.getEditForm');
Route::post('/notapemesanan/saveData', 'NotaPemesananController@saveData')->name('notapemesanan.saveData');
Route::post('/notapemesanan/saveDataField', 'NotaPemesananController@saveDataField')->name('notapemesanan.saveDataField');
Route::post('/notapemesanan/deleteData', 'NotaPemesananController@deleteData')->name('notapemesanan.deleteData');
Route::post('/notapemesanan/create', 'NotaPemesananController@create')->name('notapemesanan.create');
Route::post('/notapemesanan/store', 'NotaPemesananController@store')->name('notapemesanan.store');

//notapenjualan
Route::resource('notapenjualan', 'NotaPenjualanController');
Route::post('/notapenjualan/getEditForm', 'NotaPenjualanController@getEditForm')->name('notapenjualan.getEditForm');
Route::post('/notapenjualan/saveData', 'NotaPenjualanController@saveData')->name('notapenjualan.saveData');
Route::post('/notapenjualan/saveDataField', 'NotaPenjualanController@saveDataField')->name('notapenjualan.saveDataField');
Route::post('/notapenjualan/deleteData', 'NotaPenjualanController@deleteData')->name('notapenjualan.deleteData');

//SPK
Route::resource('spk', 'SPKController');
Route::post('/spk/getEditForm', 'SPKController@getEditForm')->name('spk.getEditForm');
Route::post('/spk/saveData', 'SPKController@saveData')->name('spk.saveData');
Route::post('/spk/saveDataField', 'SPKController@saveDataField')->name('spk.saveDataField');
Route::post('/spk/deleteData', 'SPKController@deleteData')->name('spk.deleteData');
Route::post('/spk/create', 'SPKController@create')->name('spk.create');

Route::resource('suratjalan', 'SuratJalanController');
Route::post('/suratjalan/getEditForm', 'SuratJalanController@getEditForm')->name('suratjalan.getEditForm');
Route::post('/suratjalan/saveData', 'SuratJalanController@saveData')->name('suratjalan.saveData');
Route::post('/suratjalan/saveDataField', 'SuratJalanController@saveDataField')->name('suratjalan.saveDataField');
Route::post('/suratjalan/deleteData', 'SuratJalanController@deleteData')->name('suratjalan.deleteData');
Route::post('/suratjalan/create', 'SuratJalanController@create')->name('suratjalan.create');

Route::resource('pemasukantelur', 'PemasukanTelurController');
Route::post('/pemasukantelur/getEditForm', 'PemasukanTelurController@getEditForm')->name('pemasukantelur.getEditForm');
Route::post('/pemasukantelur/saveData', 'PemasukanTelurController@saveData')->name('pemasukantelur.saveData');
Route::post('/pemasukantelur/saveDataField', 'PemasukanTelurController@saveDataField')->name('pemasukantelur.saveDataField');
Route::post('/pemasukantelur/deleteData', 'PemasukanTelurController@deleteData')->name('pemasukantelur.deleteData');

Route::resource('jadwalpakan', 'JadwalPakanController');
Route::post('/jadwalpakan/getEditForm', 'JadwalPakanController@getEditForm')->name('jadwalpakan.getEditForm');
Route::post('/jadwalpakan/saveData', 'JadwalPakanController@saveData')->name('jadwalpakan.saveData');
Route::post('/jadwalpakan/saveDataField', 'JadwalPakanController@saveDataField')->name('jadwalpakan.saveDataField');
Route::post('/jadwalpakan/deleteData', 'JadwalPakanController@deleteData')->name('jadwalpakan.deleteData');

Route::resource('user', 'UserController');
Route::post('/user/getEditForm', 'UserController@getEditForm')->name('user.getEditForm');
Route::post('/user/saveData', 'UserController@saveData')->name('user.saveData');
Route::post('/user/saveDataField', 'UserController@saveDataField')->name('user.saveDataField');
Route::post('/user/deleteData', 'UserController@deleteData')->name('user.deleteData');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

// akuntansi
Route::resource('akun', 'AkunAkuntansiController');
Route::post('/akun/getEditForm', 'AkunAkuntansiController@getEditForm')->name('akun.getEditForm');
Route::post('/akun/saveData', 'AkunAkuntansiController@saveData')->name('akun.saveData');
Route::post('/akun/saveDataField', 'AkunAkuntansiController@saveDataField')->name('akun.saveDataField');
Route::post('/akun/deleteData', 'AkunAkuntansiController@deleteData')->name('akun.deleteData');

Route::resource('jurnal_akuntansi', 'JurnalAkuntansiController');
Route::resource('periode_akuntansi', 'PeriodeAkuntansiController');
Route::resource('transaksi_akuntansi', 'TransaksiAkuntansiController');
Route::resource('laporan_akuntansi', 'LaporanAkuntansiController');
Route::post('/laporan_akuntansi/getData', 'LaporanAkuntansiController@getData')->name('laporan.getData');
Route::get('/export/pdf/{periode}','LaporanAkuntansiController@ExportPDF');

Route::resource('neraca', 'NeracaController');
Route::resource('perubahanekuitas', 'PerubahanEkuitasController');
Route::resource('bukubesar', 'BukuBesarController');
Route::resource('labarugi', 'LabaRugiController');
Route::resource('aruskas', 'ArusKasController');
Route::resource('aset', 'AsetController');

Auth::routes();
