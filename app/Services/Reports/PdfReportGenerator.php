<?php

namespace App\Services\Reports;

use App\Contracts\ReportGeneratorInterface;

class PdfReportGenerator implements ReportGeneratorInterface
{
    public function generateReport(array $data): string
    {
        // Simulación de generación de PDF
        $report = "=== REPORTE PDF DE EMPLEADOS ===\n";
        $report .= "Fecha: " . date('Y-m-d H:i:s') . "\n";
        $report .= "Total de empleados: " . count($data) . "\n\n";
        
        foreach ($data as $employee) {
            $report .= "ID: {$employee['id']}\n";
            $report .= "Nombre: {$employee['name']}\n";
            $report .= "Email: {$employee['email']}\n";
            $report .= "Tipo: {$employee['type']}\n";
            $report .= "Salario: $" . number_format($employee['salary'], 2) . "\n";
            $report .= "------------------------\n";
        }
        
        return $report;
    }

    public function getFormat(): string
    {
        return 'PDF';
    }
}
