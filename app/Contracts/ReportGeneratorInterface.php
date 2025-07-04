<?php

namespace App\Contracts;

interface ReportGeneratorInterface
{
    public function generateReport(array $data): string;
    public function getFormat(): string;
}
