<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LPB extends Model
{
    protected $table = "pengeluaran_bahan_baku";

    public function barang(){
        return $this->belongsTo('App\Barang','barang_id');
    }
}
