<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\Permissions;
use App\Enums\Roles;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $viewerRole = Role::create(['name' => Roles::Viewer->value]);
        $viewerRole->givePermissionTo(
            Permissions::AdsView->value,
            Permissions::AdsTemplateView->value,
        );

        $editorRole = Role::create(['name' => Roles::Editor->value]);
        $editorRole->givePermissionTo(
            $viewerRole->permissions()->pluck('name')->merge([
                Permissions::AdsCreate->value,
                Permissions::AdsUpdate->value,
                Permissions::AdsDelete->value,
                Permissions::AdsTemplateCreate->value,
                Permissions::AdsTemplateUpdate->value,
                Permissions::AdsTemplateDelete->value,
            ])
        );

        $adminRole = Role::create(['name' => Roles::Admin->value]);
        $adminRole->givePermissionTo(
            $editorRole->permissions()->pluck('name')->merge([
                Permissions::SystemView->value,
            ])
        );

        $superAdmin = Role::create(['name' => Roles::SuperAdmin->value]);
        $superAdmin->givePermissionTo(Permission::all());
    }
}
