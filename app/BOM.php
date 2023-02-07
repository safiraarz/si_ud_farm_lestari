<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BOM extends Model
{
    protected $connection = 'inventory';

    protected $table = "bom";
    public $timestamps = false;

    // public function barang(){
    //     return $this->belongsTo('App\Barang','barang_id','id');
    // }

    public function barang(){
        return $this->belongsToMany('App\Barang','d_BOM','BOM_id','barang_id')->withPivot('kuantitas_bahan_baku');
    }
}
