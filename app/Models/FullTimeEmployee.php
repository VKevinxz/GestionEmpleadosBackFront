<?php

namespace App\Models;

class FullTimeEmployee extends BaseEmployee
{
    protected $attributes = [
        'employee_type' => 'full_time'
    ];

    // LSP: Puede sustituir a BaseEmployee sin romper funcionalidad
    public function calculateSalary(): float
    {
        // Empleados de tiempo completo tienen salario fijo mensual
        return (float) $this->base_salary;
    }

    // Método específico para empleados de tiempo completo
    public function calculateAnnualSalary(): float
    {
        return $this->calculateSalary() * 12;
    }
}
