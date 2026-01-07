<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Role;

class InvitationPolicy
{

    public function viewAny(User $user): bool
    {
        return in_array($user->role->name, ['SuperAdmin', 'Admin']);
    }


    public function create(User $user, Role $roleToInvite): bool
    {
        $authRole = $user->role->name;
        $inviteRole = $roleToInvite->name;


        if ($authRole === 'SuperAdmin' && $inviteRole === 'Admin') {
            return false;
        }


        if ($authRole === 'Admin' && in_array($inviteRole, ['Admin', 'Member'])) {
            return false;
        }

        return true;
    }


    public function delete(User $user): bool
    {
        return in_array($user->role->name, ['SuperAdmin', 'Admin']);
    }
}
