<?php

namespace App\Policies;

use App\User;
use App\Profile;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the profile.
     *
     * @param  \App\User  $user
     * @param  \App\Profile  $profile
     * @return mixed
     */
    public function view(User $user, Profile $profile)
    {
        //
    }

    /**
     * Determine whether the user can create profiles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the profile.
     *
     * @param  \App\User  $user
     * @param  \App\Profile  $profile
     * @return mixed
     */
    public function update(User $user, Profile $profile)
    {
        return $profile->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the profile.
     *
     * @param  \App\User  $user
     * @param  \App\Profile  $profile
     * @return mixed
     */
    public function delete(User $user, Profile $profile)
    {
        //
    }
}
