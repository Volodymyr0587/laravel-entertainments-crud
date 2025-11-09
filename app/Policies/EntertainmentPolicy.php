<?php

namespace App\Policies;

use App\Models\Entertainment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EntertainmentPolicy
{
   /**
     * Determine whether the user can view any entertainments.
     */
    public function viewAny(User $user): bool
    {
        return true; // All authenticated users can view their entertainments
    }

    /**
     * Determine whether the user can view the entertainment.
     */
    public function view(User $user, Entertainment $entertainment): bool
    {
        return $user->id === $entertainment->user_id;
    }

    /**
     * Determine whether the user can create entertainments.
     */
    public function create(User $user): bool
    {
        return true; // All authenticated users can create
    }

    /**
     * Determine whether the user can update the entertainment.
     */
    public function update(User $user, Entertainment $entertainment): bool
    {
        return $user->id === $entertainment->user_id;
    }

    /**
     * Determine whether the user can delete the entertainment (soft delete).
     */
    public function delete(User $user, Entertainment $entertainment): bool
    {
        return $user->id === $entertainment->user_id;
    }

    /**
     * Determine whether the user can restore the entertainment.
     */
    public function restore(User $user, Entertainment $entertainment): bool
    {
        return $user->id === $entertainment->user_id;
    }

    /**
     * Determine whether the user can permanently delete the entertainment.
     */
    public function forceDelete(User $user, Entertainment $entertainment): bool
    {
        return $user->id === $entertainment->user_id;
    }
}
