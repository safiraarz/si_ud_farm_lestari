<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaftarAkun extends Model
{
    protected $connection = 'akuntansi';
    protected $table = "akun";
}
