<?php

namespace App\Models;

class PartTimeEmployee extends BaseEmployee
{
    protected $attributes = [
        'employee_type' => 'part_time'
    ];

    // LSP: Implementación específica que respeta el contrato
    public function calculateSalary(): float
    {
        // Empleados de medio tiempo se pagan por horas trabajadas
        return (float) ($this->hours_worked * $this->hourly_rate);
    }

    // Método específico para empleados de medio tiempo
    public function getMaxHoursPerWeek(): int
    {
        return 20; // Máximo 20 horas por semana
    }
}
