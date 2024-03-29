<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalPakan extends Model
{
    protected $connection = 'inventory';
    protected $dates = ['tgl_pemberian'];
    protected $table = "jadwal_pakan";
    public $timestamps = false;

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
