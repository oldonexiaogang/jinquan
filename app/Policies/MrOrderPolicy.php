<?php

namespace App\Policies;

use App\Models\MrOrder;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MrOrderPolicy
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
    public function update(User $currentUser, MrOrder $mrOrder)
    {
        //修改金主自己订单且订单未到进行中
        if($currentUser->id === $mrOrder->mr_user_id && $mrOrder->status=='ms_unconfirmed'){
            return true;
        }else{
            return false;
        }

    }

    public function show(User $currentUser, MrOrder $mrOrder)
    {

        return $currentUser->id === $mrOrder->mr_user_id ;

    }

    public function review(User $currentUser, MrOrder $mrOrder)
    {

        return $currentUser->id === $mrOrder->mr_user_id ;

    }
}
