<?php

namespace App\Contracts;

interface EmployeeInterface
{
    public function calculateSalary(): float;
    public function getEmployeeInfo(): array;
    public function getId(): int;
    public function getName(): string;
}
