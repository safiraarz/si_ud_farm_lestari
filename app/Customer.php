<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $connection = 'inventory';

    protected $table = "customer";

    public function notapenjualan()
    {
        return $this->hasMany('App\NotaPenjualan', 'customer_id', 'id');
    }
}
