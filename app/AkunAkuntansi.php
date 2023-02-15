<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AkunAkuntansi extends Model
{
    //
    protected $connection = 'akuntansi';
    protected $table = "akun";
    protected $primaryKey = 'no_akun';

    public function jurnal(){
        return $this->belongsToMany('App\JurnalAkuntansi','jurnal_has_akun','jurnal_id','akun_no_akun')->withPivot('no_urut','nominal_debit','nominal_kredit');
    }


}
