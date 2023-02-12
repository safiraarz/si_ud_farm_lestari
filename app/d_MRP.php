<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class d_MRP extends Model
{
    //
    protected $connection = 'inventory';
    protected $table = "d_mrp";
    public $timestamps = false;

    public function barang()
    {
        return $this->belongsTo('App\Barang','barang_id','id');
    }
    public function mrp()
    {
        return $this->belongsTo('App\MRP','MRP_id','id');
    }
}
