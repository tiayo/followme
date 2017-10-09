<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class ManagerPolicy
{
    use HandlesAuthorization;

    /**
     * 是否超级管理员
     *
     * @param $user
     * @return bool
     */
    public function admin($user, $class)
    {
        return config('site.administrator') == $user['email'];
    }
}
