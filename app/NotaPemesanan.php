<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotaPemesanan extends Model
{
    protected $table = "nota_pemesanan";

    public function supplier(){
        return $this->belongsTo('App\Supplier','supplier_id');
    }
    public function pengguna(){
        return $this->belongsTo('App\User','pengguna_id','id');
    }
}
