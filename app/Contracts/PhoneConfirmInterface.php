<?php

namespace App\Contracts;

interface PhoneConfirmInterface
{
    public function registerPhone(string $phone, ?int $userId = null, array $attributes = []);

    public function confirm(string $code, string $phone);

    public function call(string $phone);

    public function sms(string $phone);
}
