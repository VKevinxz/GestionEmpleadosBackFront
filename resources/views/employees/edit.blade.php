@extends('layout')

@section('title', 'Editar Empleado')

@section('content')
<div class="card">
    <h2>Editar Empleado</h2>

    <form action="{{ route('employees.update', $employee->getId()) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $employee->getName()) }}" required>
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $employee->getEmployeeInfo()['email']) }}" required>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label for="phone">Teléfono</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $employee->getEmployeeInfo()['phone']) }}" required>
                </div>
            </div>
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
        </div>

        <!-- Campos específicos según el tipo -->
        @if($employee->getEmployeeInfo()['type'] === 'full_time')
            <div class="form-group">
                <label for="base_salary">Salario Base</label>
                <input type="number" name="base_salary" id="base_salary" class="form-control" step="0.01" value="{{ old('base_salary', $employee->base_salary) }}">
            </div>
        @elseif($employee->getEmployeeInfo()['type'] === 'part_time')
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label for="hourly_rate">Tarifa por Hora</label>
                        <input type="number" name="hourly_rate" id="hourly_rate" class="form-control" step="0.01" value="{{ old('hourly_rate', $employee->hourly_rate) }}">
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label for="hours_worked">Horas Trabajadas</label>
                        <input type="number" name="hours_worked" id="hours_worked" class="form-control" value="{{ old('hours_worked', $employee->hours_worked) }}">
                    </div>
                </div>
            </div>
        @else
            <div class="form-group">
                <label for="contract_value">Valor del Contrato</label>
                <input type="number" name="contract_value" id="contract_value" class="form-control" step="0.01" value="{{ old('contract_value', $employee->contract_value) }}">
            </div>
        @endif

        <div style="margin-top: 1rem;">
            <button type="submit" class="btn btn-success">Actualizar Empleado</button>
            <a href="{{ route('employees.show', $employee->getId()) }}" class="btn btn-primary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
