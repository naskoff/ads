<?php

namespace Database\Factories;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => UserFactory::new(),
            'start_date' => $this->faker->dateTimeBetween('-3 months', '-15 days'),
        ];
    }

    public function canceled(): Factory
    {
        return $this->state(function (array $attributes) {
            $endDate = $this->faker->dateTimeBetween($attributes['start_date'], '+1 months');

            $attributes['end_date'] = $endDate;

            return $attributes;
        });
    }
}
