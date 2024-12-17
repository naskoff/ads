<?php

declare(strict_types=1);

namespace App\Policies;

use App\Enums\Permissions;
use App\Models\AdTemplate;
use App\Models\User;

class AdTemplatePolicy
{
    public function view(User $user, AdTemplate $adTemplate): bool
    {
        return $user->can(Permissions::AdsTemplateView->value);
    }

    public function create(User $user): bool
    {
        return $user->can(Permissions::AdsTemplateCreate->value);
    }

    public function update(User $user, AdTemplate $adTemplate): bool
    {
        return $user->can(Permissions::AdsTemplateUpdate->value);
    }

    public function delete(User $user, AdTemplate $adTemplate): bool
    {
        return $user->can(Permissions::AdsTemplateDelete->value);
    }
}
