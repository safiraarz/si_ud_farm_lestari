<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SPK extends Model
{
    protected $table = "surat_perintah_kerja";

    public function barang(){
        return $this->belongsTo('App\Barang','barang_id');
    }
    public function hasilproduksi()
    {
        return $this->has('App\HasilProduksi', 'barang_id', 'id');
    }
    public function pengguna(){
        return $this->belongsTo('App\User','pengguna_id','id');
    }
    public function daftar_barang(){
        return $this->belongsToMany('App\Barang','d_surat_perintah_kerja','surat_perintah_kerja_id','barang_id')->withPivot('kuantitas');;
    }
    public function mps()
    {
        return $this->hasMany('App\MPS', 'barang_id', 'id');
    }
}
