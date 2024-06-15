<?php

namespace App\Observers;

use App\Actions\NotifyUserStatusChanged;
use App\Models\User;

class UserObserver
{
    public function updated(User $user): void
    {
        if ($user->isDirty(['is_active'])) {
            try {
                app(NotifyUserStatusChanged::class)->execute($user);
            } catch (\Throwable $e) {
                logger()->critical($e);
            }

        }
    }
}
