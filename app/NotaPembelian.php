<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotaPembelian extends Model
{
    protected $connection = 'inventory';

    protected $table = "nota_pembelian";
    public $timestamps = false;
    public function supplier(){
        return $this->belongsTo('App\Supplier','supplier_id');
    }
    public function pengguna(){
        return $this->belongsTo('App\User','pengguna_id','id');
    }
    public function barang(){
        return $this->belongsToMany('App\Barang','d_nota_pembelian','nota_pembelian_id','barang_id')->withPivot('kuantitas','harga');;
    }
}
