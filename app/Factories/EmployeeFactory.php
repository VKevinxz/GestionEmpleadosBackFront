<?php

namespace App\Factories;

use App\Contracts\EmployeeInterface;
use App\Models\FullTimeEmployee;
use App\Models\PartTimeEmployee;
use App\Models\ContractorEmployee;

class EmployeeFactory
{
    // Factory Pattern para crear empleados
    public static function create(string $type, array $data): EmployeeInterface
    {
        // Validar datos requeridos
        self::validateRequiredFields($data);
        
        switch ($type) {
            case 'full_time':
                return self::createFullTimeEmployee($data);
            case 'part_time':
                return self::createPartTimeEmployee($data);
            case 'contractor':
                return self::createContractorEmployee($data);
            default:
                throw new \InvalidArgumentException("Tipo de empleado no soportado: {$type}");
        }
    }

    private static function validateRequiredFields(array $data): void
    {
        $requiredFields = ['name', 'email', 'phone'];
        
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                throw new \InvalidArgumentException("El campo {$field} es requerido");
            }
        }
    }

    private static function createFullTimeEmployee(array $data): FullTimeEmployee
    {
        if (empty($data['base_salary'])) {
            throw new \InvalidArgumentException("El salario base es requerido para empleados de tiempo completo");
        }

        return new FullTimeEmployee([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'base_salary' => $data['base_salary'],
            'employee_type' => 'full_time'
        ]);
    }

    private static function createPartTimeEmployee(array $data): PartTimeEmployee
    {
        if (empty($data['hourly_rate']) || empty($data['hours_worked'])) {
            throw new \InvalidArgumentException("La tarifa por hora y horas trabajadas son requeridas para empleados de medio tiempo");
        }

        return new PartTimeEmployee([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'hourly_rate' => $data['hourly_rate'],
            'hours_worked' => $data['hours_worked'],
            'employee_type' => 'part_time'
        ]);
    }

    private static function createContractorEmployee(array $data): ContractorEmployee
    {
        if (empty($data['contract_value'])) {
            throw new \InvalidArgumentException("El valor del contrato es requerido para contratistas");
        }

        return new ContractorEmployee([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'contract_value' => $data['contract_value'],
            'employee_type' => 'contractor'
        ]);
    }
}
