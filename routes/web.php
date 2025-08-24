<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\WorkOrderController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/equipment', EquipmentController::class);
    Route::resource('/workorders', WorkOrderController::class);
    Route::resource('/technicians', TechnicianController::class);
    Route::resource('/inventory', SparePartController::class)
    ->parameters(['inventory' => 'sparepart']);
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
    Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');
});

require __DIR__.'/auth.php';