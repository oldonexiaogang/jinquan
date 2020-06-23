<?php

namespace App\Policies;

use App\Models\ImgVideo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ImgVideoPolicy
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

    public function update(User $currentUser, ImgVideo $imgVideo)
    {
        return $currentUser->id === $imgVideo->user_id;
    }


}
