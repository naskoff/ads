<?php

namespace Database\Factories;

use App\Enums\AdTemplateStatus;
use App\Models\Ad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdTemplate>
 */
class AdTemplateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ad_id' => Ad::factory(),
            'status' => fake()->randomElement(AdTemplateStatus::cases())->value,
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'canva_url' => fake()->url(),
        ];
    }
}
