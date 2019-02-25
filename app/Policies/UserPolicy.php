<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
    public function update(User $currentUser,User $user)//第一个参数为当前用户，第二个参数为需要进行授权访问的用户
    {
        return $currentUser->id===$user->id;
    }
}
