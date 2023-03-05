<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProduksiPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    function check_bom_mps_mrp_hasilproduksi(User $user)
    {
        return ($user->jabatan->id == 10103 || $user->jabatan->id == 10104 ? Response::allow() : Response::deny("Anda Tidak Dapat Akses"));
    }

    function check_spk_lpb(User $user)
    {
        return ($user->jabatan->id == 10103 || $user->jabatan->id == 10102 ? Response::allow() : Response::deny("Anda Tidak Dapat Akses"));
    }

    function check_sk_bahanbaku(User $user)
    {
        return ($user->jabatan->id == 10103 || $user->jabatan->id == 10102 ? Response::allow() : Response::deny("Anda Tidak Dapat Akses"));
    }

}
