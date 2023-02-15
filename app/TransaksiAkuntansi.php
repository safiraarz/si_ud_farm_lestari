<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiAkuntansi extends Model
{
    //
    protected $connection = 'akuntansi';
    protected $table = "transaksi";
    public function jurnal(){
        return $this->hasMany('App\JurnalAkuntansi','transaksi_id','id');
        
    }
}
