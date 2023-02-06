<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaftarAkun extends Model
{
    protected $connection = 'inventory';
    protected $table = "daftar_akun";
}
