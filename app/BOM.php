<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BOM extends Model
{
	use SoftDeletes;
    protected $connection = 'inventory';

    protected $table = "bom";
    public $timestamps = false;

    public function barang(){
        return $this->belongsToMany('App\Barang','d_BOM','BOM_id','barang_id')->withPivot('kuantitas_bahan_baku');
    }

    public function mrp()
    {
        return $this->hasMany('App\MRP','BOM_id','id');
    }
}
