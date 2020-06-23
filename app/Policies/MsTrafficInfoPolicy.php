<?php

namespace App\Policies;

use App\Models\MsTrafficInfo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MsTrafficInfoPolicy
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

    public function update(User $currentUser, MsTrafficInfo $msTrafficInfo)
    {
        return $currentUser->id === $msTrafficInfo->ms_user_id;
    }
}
