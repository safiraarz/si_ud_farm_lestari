<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HasilProduksi extends Model
{
    protected $connection = 'inventory';
    protected $dates = ['tgl_pencatatan'];
    protected $table = "daftar_hasil_produksi";
    public $timestamps = false;
    public function barang(){
        return $this->belongsTo('App\Barang','barang_id','id');
    }
    public function surat_perintah_kerja(){
        return $this->belongsTo('App\SPK','surat_perintah_kerja_id','id');
    }
    public function pengguna(){
        return $this->belongsTo('App\User','pengguna_id','id');
    }
}
