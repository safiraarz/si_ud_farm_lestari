<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BOM extends Model
{
    protected $table = "bom";

    public function barang(){
        return $this->belongsTo('App\Barang','barang_id','id');
    }

    public function daftar_barang(){
        return $this->belongsToMany('App\Barang','d_BOM','BOM_id','barang_id')->withPivot('kuantitas_bahan_baku');;
    }
}
