<?php

namespace App\Policies;

use App\Models\Event; // <-- GANTI MODEL JADI EVENT
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    /**
     * Izinkan Super Admin & Admin melakukan SEMUANYA.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->hasRole(['Super Admin', 'Admin'])) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('Contributor');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Event $event): bool // <-- GANTI MODEL JADI EVENT
    {
        return $user->hasRole('Contributor');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('Contributor');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Event $event): bool // <-- GANTI MODEL JADI EVENT
    {
        // Contributor TIDAK boleh update
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Event $event): bool // <-- GANTI MODEL JADI EVENT
    {
        // Contributor TIDAK boleh delete
        return false;
    }

    // ... (method restore, forceDelete, dll. biarkan saja)
}