<?php

namespace App\Policies;

use App\Models\Installment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InstallmentPolicy
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

    public function update(User $currentUser, Installment $installment)
    {
        return $currentUser->id === $installment->ms_user_id;
    }

    public function delete(User $currentUser, Installment $installment)
    {
        return $currentUser->id === $installment->ms_user_id;
    }
}
