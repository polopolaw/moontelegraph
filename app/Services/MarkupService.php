<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use DefStudio\Telegraph\DTO\Message;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use DefStudio\Telegraph\Models\TelegraphChat;

class MarkupService
{
    public static function confirmPhoneMarkup(Message $message, TelegraphChat $chat): \DefStudio\Telegraph\Telegraph
    {
        $user = User::query()
            ->where('telegram_id', $message->from()->id())
            ->where('telegraph_bot_id', $chat->telegraph_bot_id)
            ->first();

        if ($user?->phone_verified_at) {
            return Telegraph::chat($chat)
                ->message(__('Phone already confirmed'));
        }

        return Telegraph::chat($chat)
            ->message(__('Please share your phone'))
            ->replyKeyboard(
                ReplyKeyboard::make()
                    ->when(true, fn (ReplyKeyboard $keyboard) => $keyboard->button('📞 Confirm phone')->requestContact())
            );
    }
}
