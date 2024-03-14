<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    //todo this

    public function index(User $user)
    {
        if($user->isAdmin() || $user->hasRole(1)) {
            return true;
        }
        return false;
        //return $user->allowedTo('do_all_action_role') ?: $user->allowedTo('index_role');
    }

    public function create(User $user)
    {
        if($user->isAdmin() || $user->hasRole(1)) {
            return true;
        }
        return false;
        //return $user->allowedTo('do_all_action_role') ?: $user->allowedTo('create_role');
    }

    public function show(User $user, Role $role)
    {
        if($user->isAdmin() || $user->hasRole(1)) {
            return true;
        }
        return false;
        //return $user->allowedTo('do_all_action_role') ?: $user->allowedTo('show_role');
    }

    public function update(User $user, Role $role)
    {
        if($user->isAdmin() || $user->hasRole(1)) {
            return true;
        }
        return false;
        //return $user->allowedTo('do_all_action_role') ?: $user->allowedTo('update_role');
    }

    public function delete(User $user, Role $role)
    {
        if($user->isAdmin()) {
            return true;
        }
        return false;
        //return $user->allowedTo('do_all_action_role') ?: $user->allowedTo('delete_role');
    }

    public function restore(User $user, Role $role)
    {
        if($user->isAdmin()) {
            return true;
        }
        return false;
        //return $user->allowedTo('do_all_action_role') ?: $user->allowedTo('restore_role');
    }

    public function assign(User $user)
    {
        if($user->isAdmin()) {
            return true;
        }
        return false;
        //return $user->allowedTo('do_all_action_role') ?: $user->allowedTo('manage_User_role');
    }

    public function assignPrivilege(User $user)
    {
        if($user->isAdmin()) {
            return true;
        }
        return false;
        //return $user->allowedTo('do_all_action_role') ?: $user->allowedTo('manage_role_privilege');
    }
}
