<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Carbon\Carbon;
use App\Models\WorkOrder;
use App\Models\Technician;
use App\Models\SparePart;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->buildReportData($request);
        return view('reports.index', $data);
    }

    public function export(Request $request): StreamedResponse
    {
        $data = $this->buildReportData($request);
        return $this->exportCsv($data);
    }

    // Shared queries for both index() and export()
    private function buildReportData(Request $request): array
    {
        // Date range (defaults to last 30 days)
        $from = Carbon::parse($request->query('from', now()->subDays(30)->toDateString()))->startOfDay();
        $to   = Carbon::parse($request->query('to', now()->toDateString()))->endOfDay();

        // Low stock threshold
        $lowThreshold = (int) $request->query('low', 10);

        // Work orders in range
        $woInRange = WorkOrder::whereBetween('created_at', [$from, $to]);

        // KPI cards
        $kpis = [
            'created_in_range'    => (clone $woInRange)->count(),
            'open_now'            => WorkOrder::where('status', 'Open')->count(),
            'in_progress_now'     => WorkOrder::where('status', 'In Progress')->count(),
            'completed_in_range'  => (clone $woInRange)->where('status', 'Completed')->count(),
            'overdue_open'        => WorkOrder::whereIn('status', ['Open','In Progress'])
                                        ->whereDate('due_date', '<', now()->toDateString())
                                        ->count(),
            'cost_in_range'       => (float) (clone $woInRange)->sum('cost'),
        ];

        // Aggregations
        $woByStatus = (clone $woInRange)
            ->select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')->orderBy('status')->get();

        $woByPriority = (clone $woInRange)
            ->select('priority', DB::raw('COUNT(*) as total'))
            ->groupBy('priority')->orderBy('priority')->get();

        // Top technicians by current workload (Open + In Progress)
        $topTechs = Technician::withCount(['workOrders' => function ($q) {
                            $q->whereIn('status', ['Open','In Progress']);
                        }])
                        ->orderByDesc('work_orders_count')
                        ->take(5)
                        ->get(['id','name','speciality','email','phone_number']);

        // Inventory snapshots
        $inventoryValue = (float) (SparePart::select(DB::raw('SUM(quantity * price) as total'))->value('total') ?? 0);

        $lowStock = SparePart::where('quantity', '<', $lowThreshold)
                    ->orderBy('quantity')
                    ->take(10)
                    ->get(['id','name','category','quantity','price']);

        $partsByCategory = SparePart::select('category', DB::raw('COUNT(*) as total'))
                            ->groupBy('category')
                            ->orderByDesc('total')
                            ->get();

        return compact(
            'from','to','lowThreshold',
            'kpis','woByStatus','woByPriority',
            'topTechs','inventoryValue','lowStock','partsByCategory'
        );
    }

    // CSV exporter
    private function exportCsv(array $d): StreamedResponse
    {
        $filename = 'report_'.now()->format('Ymd_His').'.csv';

        return response()->streamDownload(function () use ($d) {
            $out = fopen('php://output', 'w');
            $w = fn($row) => fputcsv($out, $row);

            $w(['OCP Maintenance - Report']);
            $w(['From', $d['from']->toDateString(), 'To', $d['to']->toDateString()]);
            $w([]);

            $w(['KPIs']);
            foreach ($d['kpis'] as $k => $v) $w([ucwords(str_replace('_',' ', $k)), $v]);
            $w([]);

            $w(['Work Orders by Status']); $w(['Status','Count']);
            foreach ($d['woByStatus'] as $row) $w([$row->status, $row->total]);
            $w([]);

            $w(['Work Orders by Priority']); $w(['Priority','Count']);
            foreach ($d['woByPriority'] as $row) $w([$row->priority, $row->total]);
            $w([]);

            $w(['Top Technicians (Open + In Progress)']); $w(['Name','Speciality','Current Load']);
            foreach ($d['topTechs'] as $t) $w([$t->name, $t->speciality, $t->work_orders_count]);
            $w([]);

            $w(['Inventory Summary']); $w(['Total Inventory Value', number_format($d['inventoryValue'], 2)]);
            $w([]);

            $w(['Parts by Category']); $w(['Category','Count']);
            foreach ($d['partsByCategory'] as $row) $w([$row->category, $row->total]);
            $w([]);

            $w(['Low Stock (< '.$d['lowThreshold'].')']); $w(['Name','Category','Qty','Price']);
            foreach ($d['lowStock'] as $p) $w([$p->name, $p->category, $p->quantity, number_format($p->price, 2)]);

            fclose($out);
        }, $filename, ['Content-Type' => 'text/csv']);
    }
}
