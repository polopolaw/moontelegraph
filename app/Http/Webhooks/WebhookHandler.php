<?php

declare(strict_types=1);

namespace App\Http\Webhooks;

use App\Actions\ConfirmPhone;
use App\Actions\SaveMessage;
use App\Exceptions\UnverifiedException;
use App\Services\MarkupService;
use DefStudio\Telegraph\Handlers\WebhookHandler as BaseHandler;
use Illuminate\Support\Stringable;

class WebhookHandler extends BaseHandler
{
    public function start(): void
    {
        MarkupService::confirmPhoneMarkup($this->message, $this->chat)
            ->send();
    }

    protected function handleChatMessage(Stringable $text): void
    {
        if ($this->message->contact()) {
            $this->reply(app(ConfirmPhone::class)->execute($this->message, $this->bot));
            $this->deleteKeyboard();
            exit();
        }

        try {
            app(SaveMessage::class)->execute($this->message, $this->bot);
        } catch (UnverifiedException $e) {
            MarkupService::confirmPhoneMarkup($this->message, $this->chat)
                ->send();
        }
    }
}
