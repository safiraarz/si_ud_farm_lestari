<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LPB extends Model
{
    protected $connection = 'inventory';
    
    protected $dates = ['tgl_pengeluaran_barang'];
    protected $table = "pengeluaran_bahan_baku";
    public $timestamps = false;

    public function barang(){
        return $this->belongsTo('App\Barang','barang_id');
    }
    public function pengguna(){
        return $this->belongsTo('App\User','pengguna_id','id');
    }
    public function daftar_barang(){
        return $this->belongsToMany('App\Barang','d_pengeluaran_bahan_baku','pengeluaran_bahan_baku_id','barang_id')->withPivot('kuantitas');;
    }
}
