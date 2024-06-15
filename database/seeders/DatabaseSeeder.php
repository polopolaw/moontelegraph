<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\MessageFactory;
use Database\Factories\TelegraphBotFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $bot = TelegraphBotFactory::new()
            ->has(UserFactory::new()->count(20))
            ->create([
                'token' => '338570805:AAHBlr7mVxZxBmQG6xbR_Iur7ptsoneU5JE',
                'name' => '@ssubot',
            ])->registerWebhook()->send();

        TelegraphBotFactory::new()
            ->has(UserFactory::new()->count(20))
            ->create([
                'token' => '6647318716:AAG9F7dT9ZT_Jea_IoFm1-srXpek0ASXYYc',
                'name' => '@pora_do_excercise_bot',
            ])->registerWebhook()->send();

        MessageFactory::new()
            ->count(1000)
            ->create();
    }
}
