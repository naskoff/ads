<?php

declare(strict_types=1);

namespace App\Policies;

use App\Enums\Permissions;
use App\Models\User;

class SystemPolicy
{
    public function viewAny(User $user): bool
    {
        return $user?->can(Permissions::SystemView->value);
    }

    public function create(User $user): bool
    {
        return $user?->can(Permissions::SystemCreate->value);
    }

    public function update(User $user): bool
    {
        return $user?->can(Permissions::SystemUpdate->value);
    }

    public function delete(User $user): bool
    {
        return $user?->can(Permissions::SystemDelete->value);
    }
}
