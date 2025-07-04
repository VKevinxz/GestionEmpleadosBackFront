@extends('layout')

@section('title', 'Lista de Empleados')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: between; align-items: center; margin-bottom: 1rem;">
        <h2>Lista de Empleados</h2>
        <a href="{{ route('employees.create') }}" class="btn btn-primary">Nuevo Empleado</a>
    </div>

    @if(empty($employees))
        <p>No hay empleados registrados.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Tipo</th>
                    <th>Salario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>{{ $employee['id'] }}</td>
                        <td>{{ $employee['name'] }}</td>
                        <td>{{ $employee['email'] }}</td>
                        <td>{{ $employee['phone'] }}</td>
                        <td>
                            @if($employee['employee_type'] === 'full_time')
                                <span class="badge badge-success">Tiempo Completo</span>
                            @elseif($employee['employee_type'] === 'part_time')
                                <span class="badge badge-warning">Medio Tiempo</span>
                            @else
                                <span class="badge badge-info">Contratista</span>
                            @endif
                        </td>
                        <td>${{ number_format($employee['base_salary'] ?? $employee['contract_value'] ?? ($employee['hourly_rate'] * $employee['hours_worked']), 2) }}</td>
                        <td>
                            <a href="{{ route('employees.show', $employee['id']) }}" class="btn btn-primary" style="margin-right: 0.5rem;">Ver</a>
                            <a href="{{ route('employees.edit', $employee['id']) }}" class="btn btn-warning" style="margin-right: 0.5rem;">Editar</a>
                            <form action="{{ route('employees.destroy', $employee['id']) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
