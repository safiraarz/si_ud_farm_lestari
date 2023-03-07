<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
	use SoftDeletes;
    protected $connection = 'inventory';
    protected $table = "barang";

    public function notapembelian()
    {
        return $this->hasMany('App\NotaPembelian', 'nota_pembelian_id', 'id');
    }
    public function notapembelian2(){
        return $this->belongsToMany('App\NotaPembelian','d_nota_pembelian','nota_pembelian_id','barang_id')->withPivot('kuantitas','harga');;
    }
    public function notapenjualan()
    {
        return $this->hasMany('App\NotaPenjualan', 'barang_id', 'id');
    }
    public function notapemesanan()
    {
        return $this->hasMany('App\NotaPemesanan', 'barang_id', 'id');
    }
    // public function pemasukantelur()
    // {
    //     return $this->hasMany('App\PemasukanTelur', 'barang_id', 'id');
    // }
    public function spk()
    {
        return $this->hasMany('App\SPK', 'barang_id', 'id');
    }
    public function mps()
    {
        return $this->hasMany('App\MPS', 'barang_id', 'id');
    }
    public function suratjalan()
    {
        return $this->hasMany('App\SuratJalan', 'barang_id', 'id');
    }
    public function dmrp()
    {
        return $this->hasMany('App\d_MRP','barang_id','id');
    }
    public function jadwalpakan()
    {
        return $this->hasMany('App\JadwalPakan', 'barang_id', 'id');
    }
    public function hasilproduksi()
    {
        return $this->hasMany('App\HasilProduksi', 'barang_id', 'id');
    }
    public function bom()
    {
        return $this->belongsToMany('App\BOM','d_bom', 'BOM_id','barang_id');
    }
    public function lpb()
    {
        return $this->hasMany('App\LPB', 'barang_id', 'id');
    }

    // public function updateTotalStok($idbarang)
    // {
    //     $barang = Barang::find($idbarang);
    //     $kuantitas_stok_onorder_supplier = $barang->kuantitas_stok_onorder_supplier;
    //     $kuantitas_stok_onorder_produksi = $barang->kuantitas_stok_onorder_produksi;
    //     $kuantitas_stok_pengaman = $barang->kuantitas_stok_pengaman;
    //     $kuantitas_stok_ready = $barang->kuantitas_stok_ready;
    //     $total_kuantitas_stok = $kuantitas_stok_onorder_supplier + $kuantitas_stok_onorder_produksi + $kuantitas_stok_pengaman + $kuantitas_stok_ready;
    //     $barang->total_kuantitas_stok = $total_kuantitas_stok;
    //     $barang->save();
    // }
}
