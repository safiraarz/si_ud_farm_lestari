<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AkuntansiPolicy
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

    function checkakun(User $user)
    {
        return ($user->jabatan->id == 10101 || $user->jabatan->id == 10103 || $user->jabatan->id == 10105 ? Response::allow() : Response::deny("Anda Tidak Dapat Akses"));
    }

    function checkpenutupanperiode(User $user)
    {
        return ($user->jabatan->id == 10103 || $user->jabatan->id == 10105 ? Response::allow() : Response::deny("Anda Tidak Dapat Akses"));
    }


}
