<?php

namespace App\Policies;

use App\Models\User;

class TransaksiPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isKasir() || $user->isAdmin() || $user->isPemilik();
    }

    public function updateStatus(User $user): bool
    {
        return $user->isKasir() || $user->isAdmin();
    }
}
