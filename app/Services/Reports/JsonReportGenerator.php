<?php

namespace App\Services\Reports;

use App\Contracts\ReportGeneratorInterface;

class JsonReportGenerator implements ReportGeneratorInterface
{
    public function generateReport(array $data): string
    {
        $report = [
            'generated_at' => date('Y-m-d H:i:s'),
            'total_employees' => count($data),
            'employees' => $data
        ];
        
        return json_encode($report, JSON_PRETTY_PRINT);
    }

    public function getFormat(): string
    {
        return 'JSON';
    }
}
