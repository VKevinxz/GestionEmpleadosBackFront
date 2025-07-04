<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return redirect('/employees');
});

// Rutas de empleados
Route::resource('employees', EmployeeController::class);

// Rutas adicionales
Route::get('/payroll', [EmployeeController::class, 'processPayroll'])->name('payroll.process');
Route::get('/reports', [EmployeeController::class, 'reports'])->name('reports.index');
Route::post('/reports/generate', [EmployeeController::class, 'generateReport'])->name('reports.generate');

// Ruta para documentación
Route::get('/architecture', function () {
    return view('architecture');
});
