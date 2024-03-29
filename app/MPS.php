<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MPS extends Model
{
    protected $connection = 'inventory';
    protected $dates = ['tgl_mulai_produksi','tgl_selesai_produksi'];
    protected $table = "mps";
    public function barang()
    {
        return $this->belongsTo('App\Barang', 'barang_id');
    }
    public function spk()
    {
        return $this->belongsTo('App\SPK', 'surat_perintah_kerja_id');
    }

    public function mrp()
    {
        return $this->hasMany('App\MRP','MPS_id','id');
    }
}
