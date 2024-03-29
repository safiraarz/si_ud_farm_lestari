<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotaPenjualan extends Model
{
    protected $connection = 'inventory';
    protected $dates = ['tgl_pembuatan_nota'];
    protected $table = "nota_penjualan";
    public $timestamps = false;
    public function customer(){
        return $this->belongsTo('App\Customer','customer_id');
    }
    public function pengguna(){
        return $this->belongsTo('App\User','pengguna_id','id');
    }
    public function barang(){
        return $this->belongsToMany('App\Barang','d_nota_penjualan','nota_penjualan_id','barang_id')->withPivot('kuantitas','harga');
    }
}
