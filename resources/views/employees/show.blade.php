@extends('layout')

@section('title', 'Detalles del Empleado')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: between; align-items: center; margin-bottom: 1rem;">
        <h2>Detalles del Empleado</h2>
        <div>
            <a href="{{ route('employees.edit', $employee->getId()) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('employees.index') }}" class="btn btn-primary">Volver</a>
        </div>
    </div>

    <div class="form-row">
        <div class="form-col">
            <div class="form-group">
                <label>ID</label>
                <p>{{ $employee->getId() }}</p>
            </div>
        </div>
        <div class="form-col">
            <div class="form-group">
                <label>Nombre</label>
                <p>{{ $employee->getName() }}</p>
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="form-col">
            <div class="form-group">
                <label>Email</label>
                <p>{{ $employee->getEmployeeInfo()['email'] }}</p>
            </div>
        </div>
        <div class="form-col">
            <div class="form-group">
                <label>Teléfono</label>
                <p>{{ $employee->getEmployeeInfo()['phone'] }}</p>
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="form-col">
            <div class="form-group">
                <label>Tipo de Empleado</label>
                <p>
                    @if($employee->getEmployeeInfo()['type'] === 'full_time')
                        <span class="badge badge-success">Tiempo Completo</span>
                    @elseif($employee->getEmployeeInfo()['type'] === 'part_time')
                        <span class="badge badge-warning">Medio Tiempo</span>
                    @else
                        <span class="badge badge-info">Contratista</span>
                    @endif
                </p>
            </div>
        </div>
        <div class="form-col">
            <div class="form-group">
                <label>Salario Calculado</label>
                <p><strong>${{ number_format($employee->calculateSalary(), 2) }}</strong></p>
            </div>
        </div>
    </div>

    @if($employee->getEmployeeInfo()['type'] === 'full_time')
        <div class="form-group">
            <label>Salario Base</label>
            <p>${{ number_format($employee->base_salary, 2) }}</p>
        </div>
    @elseif($employee->getEmployeeInfo()['type'] === 'part_time')
        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label>Tarifa por Hora</label>
                    <p>${{ number_format($employee->hourly_rate, 2) }}</p>
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label>Horas Trabajadas</label>
                    <p>{{ $employee->hours_worked }}</p>
                </div>
            </div>
        </div>
    @else
        <div class="form-group">
            <label>Valor del Contrato</label>
            <p>${{ number_format($employee->contract_value, 2) }}</p>
        </div>
    @endif
</div>
@endsection
