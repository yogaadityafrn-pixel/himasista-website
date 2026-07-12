<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
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

        return null; // Lanjutkan ke pengecekan method lain untuk Contributor
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Contributor boleh lihat daftar post
        return $user->hasRole('Contributor');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post): bool
    {
        // Contributor boleh lihat detail post
        return $user->hasRole('Contributor');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Contributor boleh buat post
        return $user->hasRole('Contributor');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {
        // Contributor TIDAK boleh update
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        // Contributor TIDAK boleh delete
        return false;
    }

    // ... (method restore, forceDelete, dll. biarkan saja)
}