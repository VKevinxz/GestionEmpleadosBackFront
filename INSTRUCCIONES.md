# Configuración del Sistema de Gestión de Empleados

## Para ejecutar el proyecto:

1. Asegúrate de tener Laragon funcionando
2. Configura la base de datos en el archivo .env
3. Ejecuta las migraciones:
   ```
   php artisan migrate
   ```
4. Ejecuta el seeder para datos de prueba:
   ```
   php artisan db:seed --class=EmployeeSeeder
   ```
5. Inicia el servidor:
   ```
   php artisan serve
   ```

## Datos de prueba incluidos:

- 2 empleados de tiempo completo
- 2 empleados de medio tiempo  
- 2 contratistas

## Funcionalidades principales:

### 1. Gestión de Empleados
- Crear, editar, ver y eliminar empleados
- Tres tipos: Tiempo completo, medio tiempo, contratistas
- Cálculo automático de salarios según tipo

### 2. Procesamiento de Nómina
- Procesa todos los empleados
- Envía notificaciones (simuladas)
- Muestra resumen de pagos

### 3. Generación de Reportes
- Formatos: PDF, Excel (CSV), JSON
- Información completa de empleados
- Descarga automática del archivo

### 4. Arquitectura SOLID
- Página dedicada explicando principios aplicados
- Código extensible y mantenible

## Principios SOLID demostrados:

✅ **SRP**: Cada clase tiene una responsabilidad única
✅ **OCP**: Abierto para extensión, cerrado para modificación
✅ **LSP**: Objetos derivados sustituyen a sus clases base
✅ **ISP**: Interfaces específicas y pequeñas
✅ **DIP**: Dependencias de abstracciones, no implementaciones

## Buenas prácticas implementadas:

✅ Manejo de excepciones
✅ Nomenclatura consistente
✅ Validación de datos
✅ Principio DRY
✅ Documentación del código
✅ Factory Pattern
✅ Repository Pattern
✅ Dependency Injection
