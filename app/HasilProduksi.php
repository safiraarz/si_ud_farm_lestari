<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HasilProduksi extends Model
{
    protected $table = "daftar_hasil_produksi";
    public function barang(){
        return $this->belongsTo('App\Barang','barang_id','id');
    }
    public function spk(){
        return $this->belongsTo('App\SPK','spk_id','id');
    }
}
