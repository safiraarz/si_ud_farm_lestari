<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;


class TransaksiPolicy
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


    function checktambahnota(User $user)
    {
        return ($user->jabatan->id == 10103 ||  $user->jabatan->id == 10102 ||  $user->jabatan->id == 10105  ? Response::allow() : Response::deny("Anda Tidak Dapat Akses"));
    }

    function checknotapemesanan(User $user)
    {
        return ($user->jabatan->id == 10103 ||  $user->jabatan->id == 10102 ||  $user->jabatan->id == 10105  ? Response::allow() : Response::deny("Anda Tidak Dapat Akses"));
    }

    function checknotapembelian(User $user)
    {
        return ($user->jabatan->id == 10103 ||  $user->jabatan->id == 10102 ||  $user->jabatan->id == 10105  ? Response::allow() : Response::deny("Anda Tidak Dapat Akses"));
    }
    function checknotapenjualan(User $user)
    {
        return ($user->jabatan->id == 10103 ||  $user->jabatan->id == 10105 ? Response::allow() : Response::deny("Anda Tidak Dapat Akses"));
    }

    function checkpemasukantelur(User $user)
    {
        return ($user->jabatan->id == 10103 || $user->jabatan->id == 10106 || $user->jabatan->id == 10107 ? Response::allow() : Response::deny("Anda Tidak Dapat Akses"));
    }

    function checkpemberianpakan(User $user)
    {
        return ($user->jabatan->id == 10103 || $user->jabatan->id == 10102 ? Response::allow() : Response::deny("Anda Tidak Dapat Akses"));
    }

}
