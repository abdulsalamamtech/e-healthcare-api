<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Auth\Access\Response;

class NotePolicy
{
    use ApiResponse;

    public function before($user, $ability){
        if($user->roles->has('admin')){
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Note $note): bool
    {
        return (($user->id != $note->user_id) || (!$user->roleHas('admin')) || (!$user->roleHas('super-admin')));

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Note $note): bool
    {
        return $user->id == $note->user_id || $user->roles->has('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Note $note): bool
    {
        // return $this->sendError([], 'Unauthorized access', 401);
        return (($user->id != $note->user_id) || (!$user->roleHas('admin')) || (!$user->roleHas('super-admin')));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Note $note): bool
    {
        return (($user->id != $note->user_id) || (!$user->roleHas('admin')) || (!$user->roleHas('super-admin')));

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Note $note): bool
    {
        return (($user->id != $note->user_id) || (!$user->roleHas('admin')) || (!$user->roleHas('super-admin')));

    }
}
