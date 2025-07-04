# Sistema de Gestión de Empleados

## Descripción
Sistema web para gestionar empleados aplicando principios SOLID y buenas prácticas de programación.

## Arquitectura del Sistema

### Principios SOLID Aplicados

#### 1. Principio de Responsabilidad Única (SRP)
- **BaseEmployee**: Maneja solo la lógica base de empleados
- **PayrollService**: Se encarga únicamente del procesamiento de nómina
- **ReportService**: Responsable solo de generar reportes
- **EmployeeRepository**: Maneja únicamente la persistencia de datos

#### 2. Principio Abierto/Cerrado (OCP)
- **Generadores de Reportes**: Nuevos formatos se agregan sin modificar código existente
- **Notificaciones**: Nuevos tipos de notificación se pueden agregar fácilmente
- **Tipos de Empleados**: Nuevos tipos se crean extendiendo BaseEmployee

#### 3. Principio de Sustitución de Liskov (LSP)
- **FullTimeEmployee, PartTimeEmployee, ContractorEmployee**: Todos pueden sustituir a BaseEmployee
- Implementan `calculateSalary()` manteniendo el contrato esperado

#### 4. Principio de Segregación de Interfaces (ISP)
- **EmployeeInterface**: Define solo métodos básicos de empleado
- **ReportGeneratorInterface**: Solo métodos para generar reportes
- **NotificationInterface**: Solo métodos para notificaciones

#### 5. Principio de Inversión de Dependencias (DIP)
- **EmployeeController**: Depende de interfaces, no de implementaciones
- **PayrollService**: Recibe dependencias por inyección
- **ReportService**: Usa abstracciones para generadores

## Buenas Prácticas Implementadas

### 1. Manejo de Excepciones
```php
try {
    $employee = EmployeeFactory::create($validated['employee_type'], $validated);
    $this->employeeRepository->save($employee);
} catch (\Exception $e) {
    return back()->with('error', $e->getMessage());
}
```

### 2. Nomenclatura Consistente
- Clases: PascalCase (`EmployeeFactory`)
- Métodos: camelCase (`calculateSalary()`)
- Variables: camelCase (`$employeeRepository`)

### 3. Validación de Datos
```php
private function validateEmployee(EmployeeInterface $employee): void
{
    if (empty($employee->getName())) {
        throw new \InvalidArgumentException('El nombre del empleado es requerido');
    }
}
```

### 4. Principio DRY (Don't Repeat Yourself)
- Método `prepareEmployeeData()` reutilizable
- Validaciones centralizadas en Factory
- Método `sendPaymentNotifications()` para todas las notificaciones

### 5. Documentación del Código
- Comentarios explicativos en puntos clave
- Docblocks para métodos públicos
- README con explicación de la arquitectura

## Extensibilidad del Sistema

### Agregar Nuevos Tipos de Empleados
```php
class InternEmployee extends BaseEmployee
{
    public function calculateSalary(): float
    {
        return $this->stipend; // Becarios reciben estipendio
    }
}
```

### Agregar Nuevos Formatos de Reporte
```php
class WordReportGenerator implements ReportGeneratorInterface
{
    public function generateReport(array $data): string
    {
        // Lógica para generar reporte en Word
    }
}
```

### Cambiar Proveedores de Notificación
```php
class WhatsAppNotification implements NotificationInterface
{
    public function sendNotification(string $recipient, string $message): bool
    {
        // Lógica para enviar por WhatsApp
    }
}
```

## Estructura del Proyecto

```
app/
├── Contracts/              # Interfaces
├── Models/                 # Modelos de empleados
├── Services/               # Servicios de negocio
├── Repositories/           # Repositorios
├── Factories/              # Factories
├── Http/Controllers/       # Controladores
└── Providers/             # Service Providers

resources/views/
└── employees/             # Vistas del sistema
```

## Instalación

1. Clonar el repositorio
2. Ejecutar `composer install`
3. Configurar base de datos en `.env`
4. Ejecutar `php artisan migrate`
5. Ejecutar `php artisan db:seed --class=EmployeeSeeder`
6. Ejecutar `php artisan serve`

## Funcionalidades

- ✅ Gestión de empleados (CRUD)
- ✅ Cálculo de salarios por tipo
- ✅ Procesamiento de nómina
- ✅ Generación de reportes (PDF, Excel, JSON)
- ✅ Sistema de notificaciones
- ✅ Interfaz web responsive

## Patrones de Diseño Utilizados

- **Factory Pattern**: Para crear empleados
- **Strategy Pattern**: Para cálculo de salarios
- **Observer Pattern**: Para notificaciones
- **Repository Pattern**: Para acceso a datos
- **Dependency Injection**: Para inversión de control

## Tecnologías

- **Backend**: Laravel 11, PHP 8.x
- **Frontend**: Blade Templates, CSS puro
- **Base de Datos**: MySQL/SQLite
- **Arquitectura**: MVC con principios SOLID
