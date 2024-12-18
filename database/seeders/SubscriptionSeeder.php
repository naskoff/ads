<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    public function run(): void
    {
        Subscription::factory()->count(70)->create();
        Subscription::factory()->count(30)->canceled()->create();
    }
}
