<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BOM extends Model
{
    protected $table = "bom";

    public function barang(){
        return $this->belongsTo('App\Barang','barang_id','id');
    }
}
