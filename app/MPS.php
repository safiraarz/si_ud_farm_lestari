<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MPS extends Model
{
    protected $connection = 'inventory';

    protected $table = "mps";
    public function barang()
    {
        return $this->belongsTo('App\Barang', 'barang_id');
    }
    public function spk()
    {
        return $this->belongsTo('App\SPK', 'surat_perintah_kerja_id');
    }
}
