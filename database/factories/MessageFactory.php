<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\TelegraphBot;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->value('id'),
            'telegraph_bot_id' => TelegraphBot::query()->inRandomOrder()->value('id'),
            'content' => $this->faker->text(900),
        ];
    }
}
