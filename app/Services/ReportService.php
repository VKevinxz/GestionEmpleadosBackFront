<?php

namespace App\Services;

use App\Contracts\ReportGeneratorInterface;
use App\Contracts\EmployeeRepositoryInterface;

class ReportService
{
    private EmployeeRepositoryInterface $employeeRepository;
    private array $reportGenerators;

    // DIP: Inyección de dependencias
    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
        $this->reportGenerators = [];
    }

    // OCP: Permite agregar nuevos generadores sin modificar código existente
    public function addReportGenerator(ReportGeneratorInterface $generator): void
    {
        $this->reportGenerators[$generator->getFormat()] = $generator;
    }

    // SRP: Responsabilidad única de generar reportes
    public function generateReport(string $format): string
    {
        if (!isset($this->reportGenerators[$format])) {
            throw new \InvalidArgumentException("Formato de reporte no soportado: {$format}");
        }

        try {
            $employees = $this->employeeRepository->findAll();
            $employeeData = $this->prepareEmployeeData($employees);
            
            return $this->reportGenerators[$format]->generateReport($employeeData);
        } catch (\Exception $e) {
            throw new \RuntimeException("Error generando reporte: " . $e->getMessage());
        }
    }

    public function getAvailableFormats(): array
    {
        return array_keys($this->reportGenerators);
    }

    // DRY: Método reutilizable para preparar datos
    private function prepareEmployeeData(array $employees): array
    {
        $data = [];
        
        foreach ($employees as $employeeData) {
            $employee = $this->employeeRepository->findById($employeeData['id']);
            
            if ($employee) {
                $data[] = $employee->getEmployeeInfo();
            }
        }
        
        return $data;
    }
}
