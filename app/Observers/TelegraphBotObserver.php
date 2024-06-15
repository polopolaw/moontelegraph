<?php

namespace App\Observers;

use App\Models\TelegraphBot;

class TelegraphBotObserver
{
    public function creating(TelegraphBot $bot): void
    {
        if ($bot->isDirty('token')) {
            $bot->hash_token = hash('sha256', $bot->token);
        }
    }

    public function updating(TelegraphBot $bot): void
    {
        if ($bot->isDirty('token')) {
            $bot->hash_token = hash('sha256', $bot->token);
        }
    }
}
