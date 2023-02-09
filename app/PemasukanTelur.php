<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemasukanTelur extends Model
{
    protected $connection = 'inventory';
    protected $dates = ['tgl_pencatatan'];
    protected $table = "pemasukan_telur";

    public function flok(){
        return $this->belongsTo('App\Flok','flok_id','id');
    }
    public function pengguna(){
        return $this->belongsTo('App\User','pengguna_id','id');
    } 
    public function daftar_barang(){
        return $this->belongsToMany('App\Barang','d_pemasukan_telur','pemasukan_telur_id','barang_id')->withPivot('kuantitas_bersih','kuantitas_reject','total_kuantitas');
    }
    
}
