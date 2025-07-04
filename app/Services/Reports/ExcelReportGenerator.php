<?php

namespace App\Services\Reports;

use App\Contracts\ReportGeneratorInterface;

class ExcelReportGenerator implements ReportGeneratorInterface
{
    public function generateReport(array $data): string
    {
        // Simulación de generación de Excel (CSV)
        $report = "ID,Nombre,Email,Tipo,Salario\n";
        
        foreach ($data as $employee) {
            $report .= "{$employee['id']},{$employee['name']},{$employee['email']},{$employee['type']},${$employee['salary']}\n";
        }
        
        return $report;
    }

    public function getFormat(): string
    {
        return 'Excel';
    }
}
