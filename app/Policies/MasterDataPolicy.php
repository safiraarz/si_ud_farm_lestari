<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class MasterDataPolicy
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

    function checkbarang(User $user)
    {
        return ($user->jabatan->id == 10103 ||  $user->jabatan->id == 10102 ||  $user->jabatan->id == 10104 ||  $user->jabatan->id == 10106 ||  $user->jabatan->id == 10107  ? Response::allow() : Response::deny("Anda Tidak Dapat Akses"));
    }

    function checkflok(User $user)
    {
        return ( $user->jabatan->id == 10103 || $user->jabatan->id == 10102 || $user->jabatan->id == 10106 ? Response::allow() : Response::deny("Anda Tidak Dapat Akses"));
    }

    function checksupplier(User $user)
    {
        return ( $user->jabatan->id == 10103 || $user->jabatan->id == 10102 || $user->jabatan->id == 10106 ? Response::allow() : Response::deny("Anda Tidak Dapat Akses"));
    }

    function checkcustomer(User $user)
    {
        return ( $user->jabatan->id == 10103 || $user->jabatan->id == 10105 ? Response::allow() : Response::deny("Anda Tidak Dapat Akses"));
    }

    function checkjabatanpengguna(User $user)
    {
        return ( $user->jabatan->id == 10103 ? Response::allow() : Response::deny("Anda Tidak Dapat Akses"));
    }

    function checkakun(User $user)
    {
        return ( $user->jabatan->id == 10103 || $user->jabatan->id == 10105  ? Response::allow() : Response::deny("Anda Tidak Dapat Akses"));
    }



}
