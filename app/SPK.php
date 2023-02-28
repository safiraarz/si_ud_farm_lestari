<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SPK extends Model
{
    protected $connection = 'inventory';
    protected $table = "surat_perintah_kerja";
    public $timestamps = false;

    public function barang()
    {
        return $this->belongsTo('App\Barang', 'barang_id');
    }
    public function hasilproduksi()
    {
        return $this->hasMany('App\HasilProduksi', 'surat_perintah_kerja_id', 'id');
    }

    public function pengguna()
    {
        return $this->belongsTo('App\User', 'pengguna_id', 'id');
    }
    public function daftar_barang()
    {
        return $this->belongsToMany('App\Barang', 'd_surat_perintah_kerja', 'surat_perintah_kerja_id', 'barang_id')
            ->withPivot('tgl_mulai_produksi', 'tgl_selesai_produksi', 'kuantitas');
    }
    public function mps()
    {
        return $this->belongsTo('App\MPS', 'surat_perintah_kerja_id');
    }
    public function mps2()
    {
        return $this->hasMany('App\MPS', 'surat_perintah_kerja_id', 'id');
    }
}
