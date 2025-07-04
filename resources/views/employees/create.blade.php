@extends('layout')

@section('title', 'Crear Empleado')

@section('content')
<div class="card">
    <h2>Crear Nuevo Empleado</h2>

    <form action="{{ route('employees.store') }}" method="POST">
        @csrf
        
        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-col">
                <div class="form-group">
                    <label for="phone">Teléfono</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required>
                </div>
            </div>
            <div class="form-col">
                <div class="form-group">
                    <label for="employee_type">Tipo de Empleado</label>
                    <select name="employee_type" id="employee_type" class="form-control" required onchange="showFields()">
                        <option value="">Seleccionar tipo</option>
                        <option value="full_time" {{ old('employee_type') === 'full_time' ? 'selected' : '' }}>Tiempo Completo</option>
                        <option value="part_time" {{ old('employee_type') === 'part_time' ? 'selected' : '' }}>Medio Tiempo</option>
                        <option value="contractor" {{ old('employee_type') === 'contractor' ? 'selected' : '' }}>Contratista</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Campos específicos para tiempo completo -->
        <div id="full_time_fields" style="display: none;">
            <div class="form-group">
                <label for="base_salary">Salario Base</label>
                <input type="number" name="base_salary" id="base_salary" class="form-control" step="0.01" value="{{ old('base_salary') }}">
            </div>
        </div>

        <!-- Campos específicos para medio tiempo -->
        <div id="part_time_fields" style="display: none;">
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label for="hourly_rate">Tarifa por Hora</label>
                        <input type="number" name="hourly_rate" id="hourly_rate" class="form-control" step="0.01" value="{{ old('hourly_rate') }}">
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label for="hours_worked">Horas Trabajadas</label>
                        <input type="number" name="hours_worked" id="hours_worked" class="form-control" value="{{ old('hours_worked') }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Campos específicos para contratista -->
        <div id="contractor_fields" style="display: none;">
            <div class="form-group">
                <label for="contract_value">Valor del Contrato</label>
                <input type="number" name="contract_value" id="contract_value" class="form-control" step="0.01" value="{{ old('contract_value') }}">
            </div>
        </div>

        <div style="margin-top: 1rem;">
            <button type="submit" class="btn btn-success">Crear Empleado</button>
            <a href="{{ route('employees.index') }}" class="btn btn-primary">Cancelar</a>
        </div>
    </form>
</div>

<script>
    function showFields() {
        const employeeType = document.getElementById('employee_type').value;
        
        // Ocultar todos los campos específicos
        document.getElementById('full_time_fields').style.display = 'none';
        document.getElementById('part_time_fields').style.display = 'none';
        document.getElementById('contractor_fields').style.display = 'none';
        
        // Mostrar campos específicos según el tipo
        if (employeeType === 'full_time') {
            document.getElementById('full_time_fields').style.display = 'block';
        } else if (employeeType === 'part_time') {
            document.getElementById('part_time_fields').style.display = 'block';
        } else if (employeeType === 'contractor') {
            document.getElementById('contractor_fields').style.display = 'block';
        }
    }

    // Mostrar campos al cargar la página si hay valor seleccionado
    document.addEventListener('DOMContentLoaded', function() {
        showFields();
    });
</script>
@endsection
