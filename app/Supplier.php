<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $connection = 'inventory';

    protected $table = "supplier";
    public function notapemesanan()
    {
        return $this->hasMany('App\NotaPemesanan', 'supplier_id', 'id');
    }
    public function notapembelian()
    {
        return $this->hasMany('App\NotaPembelian', 'supplier_id', 'id');
    }
}
