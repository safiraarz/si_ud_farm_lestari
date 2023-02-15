<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeriodeAkuntansi extends Model
{
    //
    protected $connection = 'akuntansi';
    protected $table = "periode";
    protected $dates = ['tanggal_awal','tanggal_akhir'];
    public $timestamps = false;
    public function jurnal(){
        return $this->hasMany('App\JurnalAkuntansi','periode_id','id');
        
    }
}
