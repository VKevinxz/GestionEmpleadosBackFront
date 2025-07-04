<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Factories\EmployeeFactory;
use App\Contracts\EmployeeRepositoryInterface;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employeeRepo = app(EmployeeRepositoryInterface::class);

        // Empleados de tiempo completo
        $fullTimeEmployees = [
            [
                'name' => 'Juan Pérez',
                'email' => 'juan.perez@empresa.com',
                'phone' => '555-0101',
                'base_salary' => 3000.00
            ],
            [
                'name' => 'María García',
                'email' => 'maria.garcia@empresa.com',
                'phone' => '555-0102',
                'base_salary' => 3500.00
            ]
        ];

        foreach ($fullTimeEmployees as $data) {
            $employee = EmployeeFactory::create('full_time', $data);
            $employeeRepo->save($employee);
        }

        // Empleados de medio tiempo
        $partTimeEmployees = [
            [
                'name' => 'Carlos López',
                'email' => 'carlos.lopez@empresa.com',
                'phone' => '555-0201',
                'hourly_rate' => 20.00,
                'hours_worked' => 80
            ],
            [
                'name' => 'Ana Martínez',
                'email' => 'ana.martinez@empresa.com',
                'phone' => '555-0202',
                'hourly_rate' => 25.00,
                'hours_worked' => 60
            ]
        ];

        foreach ($partTimeEmployees as $data) {
            $employee = EmployeeFactory::create('part_time', $data);
            $employeeRepo->save($employee);
        }

        // Contratistas
        $contractors = [
            [
                'name' => 'Roberto Silva',
                'email' => 'roberto.silva@freelancer.com',
                'phone' => '555-0301',
                'contract_value' => 5000.00
            ],
            [
                'name' => 'Lucía Fernández',
                'email' => 'lucia.fernandez@consultor.com',
                'phone' => '555-0302',
                'contract_value' => 4500.00
            ]
        ];

        foreach ($contractors as $data) {
            $employee = EmployeeFactory::create('contractor', $data);
            $employeeRepo->save($employee);
        }
    }
}
