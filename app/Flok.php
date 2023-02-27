<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flok extends Model
{
	use SoftDeletes;
    protected $connection = 'inventory';

    protected $table = "flok";
    public function pemasukanTelur(){
        return $this->belongsTo('App\PemasukanTelur','flok_id');
    }
    public function jadwalpakan(){
        return $this->belongsTo('App\JadwalPakan','flok_id');
    }
}
