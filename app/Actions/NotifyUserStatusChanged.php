<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Models\TelegraphChat;

class NotifyUserStatusChanged
{
    public function execute(User $user): void
    {
        $chat = TelegraphChat::query()->where('chat_id', $user->telegram_id)->first();
        Telegraph::chat($chat)
            ->message(__('You status was changed to').' '.($user->is_active ? __('🟢 Active') : __('🛑 Blocked')))
            ->send();
    }
}
