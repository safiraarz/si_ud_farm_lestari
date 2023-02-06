<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JurnalAkuntansi extends Model
{
    //
    protected $connection = 'akuntansi';
    protected $table = "jurnal";
}
