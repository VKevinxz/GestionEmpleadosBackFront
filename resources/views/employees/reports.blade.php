@extends('layout')

@section('title', 'Generación de Reportes')

@section('content')
<div class="card">
    <h2>Generar Reportes</h2>

    <form action="{{ route('reports.generate') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="format">Formato del Reporte</label>
            <select name="format" id="format" class="form-control" required>
                <option value="">Seleccionar formato</option>
                @foreach($availableFormats as $format)
                    <option value="{{ $format }}">{{ $format }}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-top: 1rem;">
            <button type="submit" class="btn btn-success">Generar Reporte</button>
            <a href="{{ route('employees.index') }}" class="btn btn-primary">Volver a Empleados</a>
        </div>
    </form>
</div>

<div class="card">
    <h3>Información sobre los Reportes</h3>
    
    <div style="margin-top: 1rem;">
        <h4>Formatos Disponibles:</h4>
        <ul>
            <li><strong>PDF:</strong> Reporte detallado en formato PDF para impresión</li>
            <li><strong>Excel:</strong> Archivo CSV compatible con Excel para análisis</li>
            <li><strong>JSON:</strong> Datos estructurados en formato JSON para integración</li>
        </ul>
    </div>

    <div style="margin-top: 1rem;">
        <h4>Contenido del Reporte:</h4>
        <ul>
            <li>Lista completa de empleados</li>
            <li>Información personal y de contacto</li>
            <li>Tipo de empleado y salario calculado</li>
            <li>Fecha de generación del reporte</li>
        </ul>
    </div>
</div>
@endsection
