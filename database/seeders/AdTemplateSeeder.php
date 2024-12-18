<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\AdTemplate;
use Illuminate\Database\Seeder;

class AdTemplateSeeder extends Seeder
{
    public function run(): void
    {
        AdTemplate::factory()->count(20)->create();
    }
}
