<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = "jabatan";
    public function user()
    {
        return $this->hasMany('App\User', 'jabatan_id', 'id');
    }
}
