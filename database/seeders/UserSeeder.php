<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\Roles;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        UserFactory::new()->create([
            'email' => 'viewer@ads.dev',
            'password' => Hash::make('viewer'),
        ])->assignRole(Roles::Viewer->value);

        UserFactory::new()->create([
            'email' => 'editor@ads.dev',
            'password' => Hash::make('editor'),
        ])->assignRole(Roles::Editor->value);

        UserFactory::new()->create([
            'email' => 'admin@ads.dev',
            'password' => Hash::make('admin'),
        ])->assignRole(Roles::Admin->value);

        UserFactory::new()->create([
            'email' => 'super-admin@ads.dev',
            'password' => Hash::make('super-admin'),
        ])->assignRole(Roles::SuperAdmin->value);
    }
}
