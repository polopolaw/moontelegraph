<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\TelegraphBot;
use App\Models\User;
use DefStudio\Telegraph\DTO\Message;

class ConfirmPhone
{
    public function execute(Message $message, TelegraphBot $bot): string
    {
        $contact = $message->contact();
        $contactUserId = $contact->userId();
        $senderId = $message->from()->id();

        $user = User::query()
            ->where('telegram_id', $senderId)
            ->where('telegraph_bot_id', $bot->id)
            ->firstOrCreate([
                'name' => $contact->firstName().' '.$contact->lastName(),
                'telegram_id' => $senderId,
                'telegraph_bot_id' => $bot->id,
            ]);

        if ($user->phone_verified_at) {
            return __('Phone already confirmed');
        }

        if ($contactUserId === $senderId) {
            $user->update([
                'phone' => $contact->phoneNumber(),
                'phone_verified_at' => now(),
            ]);

            return __('Phone confirmed');
        }

        return __('This is NOT your phone');
    }
}
