<?php

namespace App\Policies;

use App\RoomType;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoomTypePolicy
{
    use HandlesAuthorization;


    public function view(User $user)
    {
        return $user->checkPermissions('RoomType_list');
    }

    public function create(User $user)
    {
        return $user->checkPermissions('RoomType_add');
    }

    public function update(User $user)
    {
        return $user->checkPermissions('RoomType_edit');
    }


    public function delete(User $user)
    {
        return $user->checkPermissions('RoomType_delete');
    }


}
