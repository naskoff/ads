<?php

namespace Database\Factories;

use App\Enums\AdStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ad>
 */
class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'status' => fake()->randomElement(AdStatus::cases())->value,
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'url' => fake()->url(),
        ];
    }
}
