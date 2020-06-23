<?php

namespace App\Policies;

use App\Models\MsPublish;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MsPublishPolicy
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

    public function update(User $currentUser, MsPublish $msPublish)
    {

        return $currentUser->id === $msPublish->user_id;
    }
}
