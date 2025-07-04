<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\EmployeeRepositoryInterface;
use App\Repositories\EmployeeRepository;
use App\Services\PayrollService;
use App\Services\ReportService;
use App\Services\Notifications\EmailNotification;
use App\Services\Notifications\SmsNotification;
use App\Services\Reports\PdfReportGenerator;
use App\Services\Reports\ExcelReportGenerator;
use App\Services\Reports\JsonReportGenerator;

class EmployeeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Bind del repositorio
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);

        // Bind del servicio de nómina con notificaciones
        $this->app->singleton(PayrollService::class, function ($app) {
            $employeeRepo = $app->make(EmployeeRepositoryInterface::class);
            
            $notificationServices = [
                new EmailNotification(),
                new SmsNotification()
            ];
            
            return new PayrollService($employeeRepo, $notificationServices);
        });

        // Bind del servicio de reportes con generadores
        $this->app->singleton(ReportService::class, function ($app) {
            $employeeRepo = $app->make(EmployeeRepositoryInterface::class);
            $reportService = new ReportService($employeeRepo);
            
            // Agregar generadores de reportes
            $reportService->addReportGenerator(new PdfReportGenerator());
            $reportService->addReportGenerator(new ExcelReportGenerator());
            $reportService->addReportGenerator(new JsonReportGenerator());
            
            return $reportService;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
