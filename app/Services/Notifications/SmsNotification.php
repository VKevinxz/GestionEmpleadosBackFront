<?php

namespace App\Services\Notifications;

use App\Contracts\NotificationInterface;

class SmsNotification implements NotificationInterface
{
    public function sendNotification(string $recipient, string $message): bool
    {
        // Simulación de envío de SMS
        try {
            // Aquí iría la lógica real de envío de SMS
            error_log("SMS enviado a {$recipient}: {$message}");
            return true;
        } catch (\Exception $e) {
            error_log("Error enviando SMS: " . $e->getMessage());
            return false;
        }
    }

    public function getType(): string
    {
        return 'SMS';
    }
}
