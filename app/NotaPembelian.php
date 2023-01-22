<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotaPembelian extends Model
{
    protected $table = "nota_pembelian";

    public function supplier(){
        return $this->belongsTo('App\Supplier','supplier_id');
    }
    public function pengguna(){
        return $this->belongsTo('App\User','pengguna_id','id');
    }
}
