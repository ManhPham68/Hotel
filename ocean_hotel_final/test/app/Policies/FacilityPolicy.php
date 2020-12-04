<?php

namespace App\Policies;

use App\Facility;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FacilityPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->checkPermissions('Facility_list');
    }

    public function create(User $user)
    {
        return $user->checkPermissions('Facility_add');
    }

    public function update(User $user)
    {
        return $user->checkPermissions('Facility_edit');
    }

    public function delete(User $user)
    {
        return $user->checkPermissions('Facility_delete');
    }


}
