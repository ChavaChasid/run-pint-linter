<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->getRoleNames()->contains(fn ($value, $key) => $value == 'admin' || $value == 'team-lead');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $user->getRoleNames()->contains('admin') | $user->id == $model->id;
    }
}
