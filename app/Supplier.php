<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
	use SoftDeletes;
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
