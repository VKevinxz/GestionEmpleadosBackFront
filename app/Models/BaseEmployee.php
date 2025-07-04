<?php

namespace App\Models;

use App\Contracts\EmployeeInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseEmployee extends Model implements EmployeeInterface
{
    protected $table = 'employees';
    
    protected $fillable = [
        'name',
        'email',
        'phone',
        'employee_type',
        'base_salary',
        'hours_worked',
        'hourly_rate',
        'contract_value'
    ];

    // SRP: Cada método tiene una responsabilidad específica
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmployeeInfo(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'email' => $this->email,
            'phone' => $this->phone,
            'type' => $this->employee_type,
            'salary' => $this->calculateSalary()
        ];
    }

    // Template Method Pattern - cada tipo implementa su propio cálculo
    abstract public function calculateSalary(): float;

    // Validación de datos
    protected function validateEmployeeData(): void
    {
        if (empty($this->name)) {
            throw new \InvalidArgumentException('El nombre del empleado es requerido');
        }
        
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Email inválido');
        }
    }
}
