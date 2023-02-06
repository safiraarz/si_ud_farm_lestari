<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiAkuntansi extends Model
{
    //
    protected $connection = 'akuntansi';
    protected $table = "transaksi";
}
