<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
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
    public function mrp()
    {
        return $this->hasMany('App\MRP', 'barang_id', 'id');
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
        return $this->hasMany('App\BOM', 'barang_id', 'id');
    }
    public function lpb()
    {
        return $this->hasMany('App\LPB', 'barang_id', 'id');
    }
}
