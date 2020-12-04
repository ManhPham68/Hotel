<?php

namespace App\Policies;

use App\Slider;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SliderPolicy
{
    use HandlesAuthorization;


    public function view(User $user)
    {
        return $user->checkPermissions('Slider_list');
    }

    public function create(User $user)
    {
        return $user->checkPermissions('Slider_add');
    }


    public function update(User $user)
    {
        return $user->checkPermissions('Slider_edit');
    }


    public function delete(User $user)
    {
        return $user->checkPermissions('Slider_delete');
    }

}
