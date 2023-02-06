<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    
    use Notifiable;
    protected $connection = 'inventory';

    
    protected $table = "pengguna";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'username', 'password','jabatan_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function notapembelian()
    {
        return $this->hasMany('App\NotaPembelian', 'pengguna_id', 'id');
        
    }
    public function notapenjualan()
    {
        return $this->hasMany('App\NotaPenjualan', 'pengguna_id', 'id');
    }
    public function notapemesanan()
    {
        return $this->hasMany('App\NotaPemesanan', 'pengguna_id', 'id');
    }
    public function pemasukanTelur(){
        return $this->hasMany('App\PemasukanTelur','pengguna_id');
    }
    public function spk()
    {
        return $this->belongsTo('App\SPK', 'pengguna_id', 'id');
    }
    public function suratjalan()
    {
        return $this->hasMany('App\SuratJalan', 'pengguna_id', 'id');
    }
    public function jadwalpakan()
    {
        return $this->hasMany('App\JadwalPakan', 'pengguna_id', 'id');
    }
    public function hasilproduksi()
    {
        return $this->hasMany('App\HasilProduksi', 'pengguna_id', 'id');
    }
    public function lpb()
    {
        return $this->hasMany('App\LPB', 'pengguna_id', 'id');
    }
    public function jabatan(){
        return $this->belongsTo('App\Jabatan','jabatan_id','id');
    }
}
