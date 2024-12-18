<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Ad;
use Illuminate\Database\Seeder;

class AdSeeder extends Seeder
{
    public function run(): void
    {
        Ad::factory()->count(10)->create();
    }
}
