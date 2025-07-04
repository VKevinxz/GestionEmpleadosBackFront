<?php

namespace App\Models;

class ContractorEmployee extends BaseEmployee
{
    protected $attributes = [
        'employee_type' => 'contractor'
    ];

    // LSP: Implementación específica del contrato
    public function calculateSalary(): float
    {
        // Contratistas tienen un valor fijo por proyecto
        return (float) $this->contract_value;
    }

    // Método específico para contratistas
    public function isContractActive(): bool
    {
        // Lógica para verificar si el contrato está activo
        return $this->contract_value > 0;
    }
}
