<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * 是否可以操作该记录
     *
     * @param $user
     * @return bool
     */
    public function control($user, $order)
    {
        return $order['user_id'] == $user['id'] || $order['manager_id'] == $user['id'] ;
    }
}
