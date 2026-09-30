<?php

namespace App\Policies;

use App\Models\User;

class KategoriPolicy
{
    public function manage(User $user): bool
    {
        return $user->isAdmin();
    }
}
