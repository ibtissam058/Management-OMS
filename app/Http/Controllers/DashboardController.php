<?php
namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\WorkOrder;
use App\Models\Technician;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    public function index() {
        $totalEquipment = Equipment::count();
        $activeOrders = WorkOrder::where('status', 'In Progress')->count();
        $monthlyCosts = WorkOrder::whereMonth('created_at', now()->month)->sum('cost');
        $technicians = Technician::count();
        $workOrders = WorkOrder::with(['equipment', 'technician'])->latest()->take(3)->get();
        $chartData = [
            'costs' => WorkOrder::selectRaw('MONTH(created_at) as month, SUM(cost) as total')
                ->groupBy('month')->get(),
            'status' => Equipment::selectRaw('status, COUNT(*) as count')
                ->groupBy('status')->get()
        ];
        return view('dashboard', compact('totalEquipment', 'activeOrders', 'monthlyCosts', 'technicians', 'workOrders', 'chartData'));
    }
}