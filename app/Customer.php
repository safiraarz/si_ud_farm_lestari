<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
	use SoftDeletes;
    protected $connection = 'inventory';

    protected $table = "customer";

    public function notapenjualan()
    {
        return $this->hasMany('App\NotaPenjualan', 'customer_id', 'id');
    }
}
