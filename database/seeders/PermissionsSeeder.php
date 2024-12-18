<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\Permissions;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        array_map(
            fn (Permissions $permission) => Permission::create(['name' => $permission->value]),
            Permissions::cases()
        );
    }
}
