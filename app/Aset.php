<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    protected $connection = 'inventory';
    protected $table = "aset";
    public function notapembelian()
    {
        return $this->hasMany('App\NotaPembelian', 'nota_pembelian_id', 'id');
    }
}
