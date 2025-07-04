@extends('layout')

@section('title', 'Arquitectura del Sistema')

@section('content')
<div class="card">
    <h2>Arquitectura del Sistema - Principios SOLID</h2>

    <div style="margin-top: 1rem;">
        <h3>1. Principio de Responsabilidad Única (SRP)</h3>
        <p>Cada clase tiene una sola responsabilidad:</p>
        <ul>
            <li><strong>BaseEmployee</strong>: Maneja solo la lógica base de empleados</li>
            <li><strong>PayrollService</strong>: Se encarga únicamente del procesamiento de nómina</li>
            <li><strong>ReportService</strong>: Responsable solo de generar reportes</li>
            <li><strong>EmployeeRepository</strong>: Maneja únicamente la persistencia de datos</li>
        </ul>
    </div>

    <div style="margin-top: 1rem;">
        <h3>2. Principio Abierto/Cerrado (OCP)</h3>
        <p>El sistema está abierto para extensión pero cerrado para modificación:</p>
        <ul>
            <li><strong>Generadores de Reportes</strong>: Nuevos formatos se agregan sin modificar código existente</li>
            <li><strong>Notificaciones</strong>: Nuevos tipos de notificación se pueden agregar fácilmente</li>
            <li><strong>Tipos de Empleados</strong>: Nuevos tipos se crean extendiendo BaseEmployee</li>
        </ul>
    </div>

    <div style="margin-top: 1rem;">
        <h3>3. Principio de Sustitución de Liskov (LSP)</h3>
        <p>Los objetos derivados pueden sustituir a sus clases base:</p>
        <ul>
            <li><strong>FullTimeEmployee, PartTimeEmployee, ContractorEmployee</strong>: Todos pueden sustituir a BaseEmployee</li>
            <li>Implementan <code>calculateSalary()</code> manteniendo el contrato esperado</li>
        </ul>
    </div>

    <div style="margin-top: 1rem;">
        <h3>4. Principio de Segregación de Interfaces (ISP)</h3>
        <p>Interfaces específicas y pequeñas:</p>
        <ul>
            <li><strong>EmployeeInterface</strong>: Define solo métodos básicos de empleado</li>
            <li><strong>ReportGeneratorInterface</strong>: Solo métodos para generar reportes</li>
            <li><strong>NotificationInterface</strong>: Solo métodos para notificaciones</li>
        </ul>
    </div>

    <div style="margin-top: 1rem;">
        <h3>5. Principio de Inversión de Dependencias (DIP)</h3>
        <p>Dependencias de abstracciones, no de implementaciones:</p>
        <ul>
            <li><strong>EmployeeController</strong>: Depende de interfaces, no de implementaciones</li>
            <li><strong>PayrollService</strong>: Recibe dependencias por inyección</li>
            <li><strong>ReportService</strong>: Usa abstracciones para generadores</li>
        </ul>
    </div>

    <div style="margin-top: 2rem;">
        <h3>Buenas Prácticas Implementadas</h3>
        <ul>
            <li>✅ Manejo de excepciones</li>
            <li>✅ Nomenclatura consistente</li>
            <li>✅ Validación de datos</li>
            <li>✅ Principio DRY (Don't Repeat Yourself)</li>
            <li>✅ Documentación del código</li>
        </ul>
    </div>

    <div style="margin-top: 2rem;">
        <h3>Extensibilidad</h3>
        <p>El sistema permite fácilmente:</p>
        <ul>
            <li>🔧 Agregar nuevos tipos de empleados</li>
            <li>📊 Incorporar nuevos formatos de reporte</li>
            <li>📱 Cambiar proveedores de notificación</li>
            <li>🧪 Realizar pruebas unitarias</li>
        </ul>
    </div>

    <div style="margin-top: 1rem;">
        <a href="{{ route('employees.index') }}" class="btn btn-primary">Volver a Empleados</a>
    </div>
</div>
@endsection
