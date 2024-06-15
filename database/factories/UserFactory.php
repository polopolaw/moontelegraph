<?php

namespace Database\Factories;

use App\Models\TelegraphBot;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'is_active' => fake()->boolean(),
            'telegram_id' => \str()->random(20),
            'telegraph_bot_id' => TelegraphBot::query()->inRandomOrder()->value('id'),
            'phone' => fake()->phoneNumber(),
            'phone_verified_at' => fake()->numberBetween(1, 2) % 2 ? fake()->dateTime() : null,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
