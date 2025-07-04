<?php

namespace App\Services;

use App\Contracts\EmployeeRepositoryInterface;
use App\Contracts\NotificationInterface;
use App\Contracts\EmployeeInterface;

class PayrollService
{
    private EmployeeRepositoryInterface $employeeRepository;
    private array $notificationServices;

    // DIP: Inyección de dependencias
    public function __construct(
        EmployeeRepositoryInterface $employeeRepository,
        array $notificationServices = []
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->notificationServices = $notificationServices;
    }

    // SRP: Responsabilidad única de procesar pagos
    public function processPayroll(): array
    {
        $results = [];
        $employees = $this->employeeRepository->findAll();

        foreach ($employees as $employeeData) {
            try {
                $employee = $this->employeeRepository->findById($employeeData['id']);
                
                if ($employee) {
                    $salary = $employee->calculateSalary();
                    $this->sendPaymentNotifications($employee, $salary);
                    
                    $results[] = [
                        'employee_id' => $employee->getId(),
                        'name' => $employee->getName(),
                        'salary' => $salary,
                        'status' => 'processed'
                    ];
                }
            } catch (\Exception $e) {
                $results[] = [
                    'employee_id' => $employeeData['id'] ?? 'unknown',
                    'name' => $employeeData['name'] ?? 'unknown',
                    'salary' => 0,
                    'status' => 'error',
                    'error' => $e->getMessage()
                ];
            }
        }

        return $results;
    }

    // Método para añadir servicios de notificación (OCP)
    public function addNotificationService(NotificationInterface $service): void
    {
        $this->notificationServices[] = $service;
    }

    // Envío de notificaciones - DRY principle
    private function sendPaymentNotifications(EmployeeInterface $employee, float $salary): void
    {
        $message = "Tu pago de $" . number_format($salary, 2) . " ha sido procesado.";
        
        foreach ($this->notificationServices as $service) {
            try {
                // Determinar destinatario según tipo de notificación
                $recipient = $this->getRecipientForNotification($employee, $service);
                $service->sendNotification($recipient, $message);
            } catch (\Exception $e) {
                error_log("Error enviando notificación: " . $e->getMessage());
            }
        }
    }

    private function getRecipientForNotification(EmployeeInterface $employee, NotificationInterface $service): string
    {
        $employeeInfo = $employee->getEmployeeInfo();
        
        // Determinar el destinatario según el tipo de notificación
        if ($service->getType() === 'Email') {
            return $employeeInfo['email'] ?? '';
        } elseif ($service->getType() === 'SMS') {
            return $employeeInfo['phone'] ?? '';
        }
        
        return $employeeInfo['email'] ?? '';
    }
}
