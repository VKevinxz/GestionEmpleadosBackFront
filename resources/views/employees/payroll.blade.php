@extends('layout')

@section('title', 'Procesamiento de Nómina')

@section('content')
<div class="card">
    <h2>Resultados del Procesamiento de Nómina</h2>

    @if(empty($results))
        <p>No hay empleados para procesar nómina.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Salario</th>
                    <th>Estado</th>
                    <th>Error</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $result)
                    <tr>
                        <td>{{ $result['employee_id'] }}</td>
                        <td>{{ $result['name'] }}</td>
                        <td>${{ number_format($result['salary'], 2) }}</td>
                        <td>
                            @if($result['status'] === 'processed')
                                <span class="badge badge-success">Procesado</span>
                            @else
                                <span class="badge badge-danger">Error</span>
                            @endif
                        </td>
                        <td>{{ $result['error'] ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 1rem;">
            <p><strong>Total de empleados procesados: {{ count($results) }}</strong></p>
            <p><strong>Total de salarios: ${{ number_format(array_sum(array_column($results, 'salary')), 2) }}</strong></p>
        </div>
    @endif

    <div style="margin-top: 1rem;">
        <a href="{{ route('employees.index') }}" class="btn btn-primary">Volver a Empleados</a>
    </div>
</div>
@endsection
