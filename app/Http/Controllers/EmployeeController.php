<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\EmployeeRepositoryInterface;
use App\Factories\EmployeeFactory;
use App\Services\PayrollService;
use App\Services\ReportService;

class EmployeeController extends Controller
{
    private EmployeeRepositoryInterface $employeeRepository;
    private PayrollService $payrollService;
    private ReportService $reportService;

    // DIP: Inyección de dependencias
    public function __construct(
        EmployeeRepositoryInterface $employeeRepository,
        PayrollService $payrollService,
        ReportService $reportService
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->payrollService = $payrollService;
        $this->reportService = $reportService;
    }

    // Mostrar lista de empleados
    public function index()
    {
        $employees = $this->employeeRepository->findAll();
        return view('employees.index', compact('employees'));
    }

    // Mostrar formulario para crear empleado
    public function create()
    {
        return view('employees.create');
    }

    // Guardar nuevo empleado
    public function store(Request $request)
    {
        try {
            // Validar datos
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:employees,email',
                'phone' => 'required|string|max:20',
                'employee_type' => 'required|in:full_time,part_time,contractor',
                'base_salary' => 'nullable|numeric|min:0',
                'hours_worked' => 'nullable|integer|min:0',
                'hourly_rate' => 'nullable|numeric|min:0',
                'contract_value' => 'nullable|numeric|min:0'
            ]);

            // Crear empleado usando Factory
            $employee = EmployeeFactory::create($validated['employee_type'], $validated);
            
            // Guardar en repository
            $this->employeeRepository->save($employee);

            return redirect()->route('employees.index')->with('success', 'Empleado creado exitosamente');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    // Mostrar empleado específico
    public function show($id)
    {
        $employee = $this->employeeRepository->findById($id);
        
        if (!$employee) {
            return redirect()->route('employees.index')->with('error', 'Empleado no encontrado');
        }

        return view('employees.show', compact('employee'));
    }

    // Mostrar formulario para editar empleado
    public function edit($id)
    {
        $employee = $this->employeeRepository->findById($id);
        
        if (!$employee) {
            return redirect()->route('employees.index')->with('error', 'Empleado no encontrado');
        }

        return view('employees.edit', compact('employee'));
    }

    // Actualizar empleado
    public function update(Request $request, $id)
    {
        try {
            $employee = $this->employeeRepository->findById($id);
            
            if (!$employee) {
                return redirect()->route('employees.index')->with('error', 'Empleado no encontrado');
            }

            // Validar datos
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:employees,email,' . $id,
                'phone' => 'required|string|max:20',
                'base_salary' => 'nullable|numeric|min:0',
                'hours_worked' => 'nullable|integer|min:0',
                'hourly_rate' => 'nullable|numeric|min:0',
                'contract_value' => 'nullable|numeric|min:0'
            ]);

            // Actualizar empleado
            if ($employee instanceof \Illuminate\Database\Eloquent\Model) {
                $employee->fill($validated);
                $this->employeeRepository->save($employee);
            }

            return redirect()->route('employees.index')->with('success', 'Empleado actualizado exitosamente');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    // Eliminar empleado
    public function destroy($id)
    {
        try {
            $result = $this->employeeRepository->delete($id);
            
            if ($result) {
                return redirect()->route('employees.index')->with('success', 'Empleado eliminado exitosamente');
            } else {
                return redirect()->route('employees.index')->with('error', 'Error al eliminar empleado');
            }
        } catch (\Exception $e) {
            return redirect()->route('employees.index')->with('error', $e->getMessage());
        }
    }

    // Procesar nómina
    public function processPayroll()
    {
        try {
            $results = $this->payrollService->processPayroll();
            return view('employees.payroll', compact('results'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    // Generar reporte
    public function generateReport(Request $request)
    {
        try {
            $format = $request->get('format', 'PDF');
            $report = $this->reportService->generateReport($format);
            
            // Determinar tipo de contenido
            $contentType = $this->getContentType($format);
            $filename = 'empleados_' . date('Y-m-d_H-i-s') . '.' . strtolower($format);
            
            return response($report)
                ->header('Content-Type', $contentType)
                ->header('Content-Disposition', "attachment; filename=\"{$filename}\"");
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    // Mostrar página de reportes
    public function reports()
    {
        $availableFormats = $this->reportService->getAvailableFormats();
        return view('employees.reports', compact('availableFormats'));
    }

    // Método auxiliar para determinar tipo de contenido
    private function getContentType(string $format): string
    {
        switch (strtoupper($format)) {
            case 'PDF':
                return 'application/pdf';
            case 'EXCEL':
                return 'text/csv';
            case 'JSON':
                return 'application/json';
            default:
                return 'text/plain';
        }
    }
}
