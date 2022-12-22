<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MRP extends Model
{
    protected $table = "mrp";
    public function mrp(){
        return $this->belongsTo('App\Barang','barang_id');
    }
}
