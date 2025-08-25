<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller {
    public function index() {
        $totalEquipment = \App\Models\Equipment::count();
    $openWorkOrders = \App\Models\WorkOrder::where('status','Open')->count();
    $inProgress     = \App\Models\WorkOrder::where('status','In Progress')->count();
    $completed30d   = \App\Models\WorkOrder::where('status','Completed')
                        ->where('updated_at','>=', now()->subDays(30))->count();

    // Status distribution
    $statusCounts = \App\Models\WorkOrder::select('status', DB::raw('count(*) as c'))
        ->groupBy('status')->pluck('c','status');

    // Priority distribution (Low/Medium/High)
    $priorityCounts = \App\Models\WorkOrder::select('priority', DB::raw('count(*) as c'))
        ->groupBy('priority')->pluck('c','priority');

    // 30-day trend (change SUM(cost) to COUNT(*) if you don't have a cost column)
    $daily = \App\Models\WorkOrder::selectRaw('DATE(created_at) d, COUNT(*) c')
        // ->selectRaw('DATE(created_at) d, SUM(cost) c') // use this if you have a numeric "cost" column
        ->where('created_at','>=', now()->subDays(30))
        ->groupBy('d')->orderBy('d')->get();

    $trendLabels = $daily->pluck('d')->map(fn($d)=>Carbon::parse($d)->format('M d'));
    $trendValues = $daily->pluck('c');

    $recentWorkOrders = \App\Models\WorkOrder::latest()->limit(8)->get();

    return view('dashboard', compact(
        'totalEquipment','openWorkOrders','inProgress','completed30d',
        'statusCounts','priorityCounts','trendLabels','trendValues','recentWorkOrders'
    ));
}
}