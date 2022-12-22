<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalPakan extends Model
{
    protected $table = "jadwal_pakan";

    public function barang(){
        return $this->belongsTo('App\Barang','barang_id','id');
    }
    public function flok(){
        return $this->belongsTo('App\Flok','flok_id','id');
    }
}
