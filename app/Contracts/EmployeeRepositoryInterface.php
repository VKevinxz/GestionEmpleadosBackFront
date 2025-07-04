<?php

namespace App\Contracts;

interface EmployeeRepositoryInterface
{
    public function save(EmployeeInterface $employee): bool;
    public function findById(int $id): ?EmployeeInterface;
    public function findAll(): array;
    public function delete(int $id): bool;
}
