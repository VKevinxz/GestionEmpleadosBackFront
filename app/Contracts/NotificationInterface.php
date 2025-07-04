<?php

namespace App\Contracts;

interface NotificationInterface
{
    public function sendNotification(string $recipient, string $message): bool;
    public function getType(): string;
}
