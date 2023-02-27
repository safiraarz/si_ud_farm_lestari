<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jabatan extends Model
{
	use SoftDeletes;
    protected $connection = 'inventory';

    protected $table = "jabatan";
    public function user()
    {
        return $this->hasMany('App\User', 'jabatan_id', 'id');
    }
}
