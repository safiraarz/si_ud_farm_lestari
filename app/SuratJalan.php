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
}
