<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotaPenjualan extends Model
{
    protected $table = "nota_penjualan";

    public function customer(){
        return $this->belongsTo('App\Customer','customer_id');
    }
}
