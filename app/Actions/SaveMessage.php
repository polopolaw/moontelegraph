<?php

declare(strict_types=1);

namespace App\Actions;

use App\Exceptions\UnverifiedException;
use App\Models\Message;
use App\Models\TelegraphBot;
use App\Models\User;
use DefStudio\Telegraph\DTO\Message as MessageDTO;

class SaveMessage
{
    /**
     * @throws UnverifiedException
     */
    public function execute(MessageDTO $message, TelegraphBot $bot): void
    {
        $user = User::query()
            ->where('telegram_id', $message->from()->id())
            ->where('telegraph_bot_id', $bot->id)
            ->value('id');
        if (! $user) {
            throw new UnverifiedException();
        }
        Message::query()
            ->create([
                'user_id' => $user,
                'telegraph_bot_id' => $bot->id,
                'content' => $message->text(),
                'created_at' => $message->date(),
            ]);
    }
}
