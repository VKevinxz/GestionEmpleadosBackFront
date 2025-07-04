<?php

namespace App\Services\Notifications;

use App\Contracts\NotificationInterface;

class EmailNotification implements NotificationInterface
{
    public function sendNotification(string $recipient, string $message): bool
    {
        // Simulación de envío de email
        try {
            // Aquí iría la lógica real de envío de email
            error_log("Email enviado a {$recipient}: {$message}");
            return true;
        } catch (\Exception $e) {
            error_log("Error enviando email: " . $e->getMessage());
            return false;
        }
    }

    public function getType(): string
    {
        return 'Email';
    }
}
