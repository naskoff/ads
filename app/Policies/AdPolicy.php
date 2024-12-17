<?php

declare(strict_types=1);

namespace App\Policies;

use App\Enums\Permissions;
use App\Models\Ad;
use App\Models\User;

class AdPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can(Permissions::AdsView->value);
    }

    public function create(User $user): bool
    {
        return $user->can(Permissions::AdsCreate->value);
    }

    public function update(User $user, Ad $ad): bool
    {
        return $user->can(Permissions::AdsUpdate->value);
    }

    public function delete(User $user, Ad $ad): bool
    {
        return $user->can(Permissions::AdsDelete->value);
    }
}
