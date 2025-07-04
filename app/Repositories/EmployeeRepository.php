<?php

namespace App\Repositories;

use App\Contracts\EmployeeInterface;
use App\Contracts\EmployeeRepositoryInterface;
use App\Models\FullTimeEmployee;
use App\Models\PartTimeEmployee;
use App\Models\ContractorEmployee;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    // DIP: Depende de abstracciones, no de implementaciones concretas
    
    public function save(EmployeeInterface $employee): bool
    {
        try {
            // Validar datos antes de guardar
            $this->validateEmployee($employee);
            
            if ($employee instanceof \Illuminate\Database\Eloquent\Model) {
                return $employee->save();
            }
            
            return false;
        } catch (\Exception $e) {
            error_log("Error guardando empleado: " . $e->getMessage());
            return false;
        }
    }

    public function findById(int $id): ?EmployeeInterface
    {
        try {
            // Buscar en todos los tipos de empleado
            $employee = FullTimeEmployee::find($id) 
                     ?? PartTimeEmployee::find($id) 
                     ?? ContractorEmployee::find($id);
            
            return $employee;
        } catch (\Exception $e) {
            error_log("Error buscando empleado: " . $e->getMessage());
            return null;
        }
    }

    public function findAll(): array
    {
        $employees = [];
        
        try {
            // Buscar todos los tipos de empleado
            $fullTime = FullTimeEmployee::all();
            $partTime = PartTimeEmployee::all();
            $contractors = ContractorEmployee::all();
            
            $employees = array_merge(
                $fullTime->toArray(),
                $partTime->toArray(),
                $contractors->toArray()
            );
            
        } catch (\Exception $e) {
            error_log("Error obteniendo empleados: " . $e->getMessage());
        }
        
        return $employees;
    }

    public function delete(int $id): bool
    {
        try {
            $employee = $this->findById($id);
            
            if ($employee && $employee instanceof \Illuminate\Database\Eloquent\Model) {
                return $employee->delete();
            }
            
            return false;
        } catch (\Exception $e) {
            error_log("Error eliminando empleado: " . $e->getMessage());
            return false;
        }
    }

    // Validación de datos - DRY principle
    private function validateEmployee(EmployeeInterface $employee): void
    {
        if (empty($employee->getName())) {
            throw new \InvalidArgumentException('El nombre del empleado es requerido');
        }
    }
}
