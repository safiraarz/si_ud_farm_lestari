<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemasukanTelur extends Model
{
    protected $table = "daftar_pemasukan_telur";
    public function barang(){
        return $this->belongsTo('App\Barang','barang_id','id');
    }
    public function flok(){
        return $this->belongsTo('App\Flok','flok_id','id');
    }
    public function pengguna(){
        return $this->belongsTo('App\User','pengguna_id','id');
    }
}
