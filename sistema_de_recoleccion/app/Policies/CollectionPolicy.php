<?php

namespace App\Policies;

use App\Models\Collection;
use App\Models\User;

class CollectionPolicy
{
    public function view(User $user, Collection $collection)
    {
        return $user->id === $collection->user_id || $user->hasRole('admin');
    }

    public function update(User $user, Collection $collection)
    {
        return $user->id === $collection->user_id || $user->hasRole('admin');
    }

    public function delete(User $user, Collection $collection)
    {
        return $user->id === $collection->user_id || $user->hasRole('admin');
    }
}
