<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flok extends Model
{
    protected $table = "flok";
    public function pemasukanTelur(){
        return $this->belongsTo('App\PemasukanTelur','flok_id');
    }
    public function jadwalpakan(){
        return $this->belongsTo('App\JadwalPakan','flok_id');
    }
}
