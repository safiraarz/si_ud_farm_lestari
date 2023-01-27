<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratJalan extends Model
{
    protected $table = "surat_jalan";
    public function suratjalan(){
        return $this->belongsTo('App\Barang','barang_id');
    }
    public function pengguna(){
        return $this->belongsTo('App\User','pengguna_id','id');
    }
    public function daftar_barang(){
        return $this->belongsToMany('App\Barang','d_surat_jalan','surat_jalan_id','barang_id')->withPivot('kuantitas');
    }
}