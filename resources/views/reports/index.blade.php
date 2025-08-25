@extends('layouts.app')
@section('title', 'Reports')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h1 class="text-2xl font-bold">System Reports</h1>
  <a
    href="{{ route('reports.export', [
        'from' => request('from', $from->toDateString()),
        'to'   => request('to',   $to->toDateString()),
        'low'  => request('low',  $lowThreshold),
    ]) }}"
    class="btn-primary"
  >
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
    </svg>
    Export Report
  </a>
</div>

{{-- Filters --}}
<div class="card p-6 mb-6">
  <h3 class="text-lg font-semibold mb-4">Report Filters</h3>
  <form method="GET" action="{{ route('reports') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div>
      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">From Date</label>
      <input type="date" name="from" value="{{ request('from', $from->toDateString()) }}" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">To Date</label>
      <input type="date" name="to" value="{{ request('to', $to->toDateString()) }}" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Low Stock Threshold</label>
      <input type="number" name="low" value="{{ request('low', $lowThreshold) }}" min="0" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
    </div>
    <div class="flex items-end">
      <button type="submit" class="btn-primary w-full">Apply Filters</button>
    </div>
  </form>
</div>

{{-- KPI cards --}}
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
  <div class="kpi">
    <div class="kpi-label">Work Orders Created</div>
    <div class="kpi-value text-blue-600">{{ $kpis['created_in_range'] }}</div>
  </div>
  <div class="kpi">
    <div class="kpi-label">Currently Open</div>
    <div class="kpi-value text-amber-600">{{ $kpis['open_now'] }}</div>
  </div>
  <div class="kpi">
    <div class="kpi-label">In Progress</div>
    <div class="kpi-value text-emerald-600">{{ $kpis['in_progress_now'] }}</div>
  </div>
  <div class="kpi">
    <div class="kpi-label">Completed</div>
    <div class="kpi-value text-green-600">{{ $kpis['completed_in_range'] }}</div>
  </div>
  <div class="kpi">
    <div class="kpi-label">Overdue</div>
    <div class="kpi-value text-red-600">{{ $kpis['overdue_open'] }}</div>
  </div>
  <div class="kpi">
    <div class="kpi-label">Total Cost</div>
    <div class="kpi-value text-emerald-600">${{ number_format($kpis['cost_in_range'], 2) }}</div>
  </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
  <div class="card p-6">
    <h3 class="text-lg font-semibold mb-4">Work Orders by Status</h3>
    <div class="overflow-x-auto">
      <table class="table">
        <thead>
          <tr>
            <th class="th">Status</th>
            <th class="th text-right">Count</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-800">
          @forelse($woByStatus as $row)
            <tr>
              <td class="td">{{ $row->status ?? '—' }}</td>
              <td class="td text-right font-semibold">{{ $row->total }}</td>
            </tr>
          @empty
            <tr><td class="td" colspan="2">No data available</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="card p-6">
    <h3 class="text-lg font-semibold mb-4">Work Orders by Priority</h3>
    <div class="overflow-x-auto">
      <table class="table">
        <thead>
          <tr>
            <th class="th">Priority</th>
            <th class="th text-right">Count</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-800">
          @forelse($woByPriority as $row)
            <tr>
              <td class="td">{{ $row->priority ?? '—' }}</td>
              <td class="td text-right font-semibold">{{ $row->total }}</td>
            </tr>
          @empty
            <tr><td class="td" colspan="2">No data available</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="card p-6">
    <h3 class="text-lg font-semibold mb-4">Top Technicians</h3>
    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Current workload (Open + In Progress)</p>
    <div class="overflow-x-auto">
      <table class="table">
        <thead>
          <tr>
            <th class="th">Name</th>
            <th class="th">Speciality</th>
            <th class="th text-right">Workload</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-800">
          @forelse($topTechs as $t)
            <tr>
              <td class="td font-medium">{{ $t->name }}</td>
              <td class="td">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300">
                  {{ $t->speciality }}
                </span>
              </td>
              <td class="td text-right font-semibold">{{ $t->work_orders_count }}</td>
            </tr>
          @empty
            <tr><td class="td" colspan="3">No technicians found</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="card p-6">
    <h3 class="text-lg font-semibold mb-4">Inventory Summary</h3>
    <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-900/20 rounded-lg">
      <div class="text-sm text-emerald-700 dark:text-emerald-300">Total Inventory Value</div>
      <div class="text-2xl font-bold text-emerald-800 dark:text-emerald-200">${{ number_format($inventoryValue, 2) }}</div>
    </div>

    <div class="mb-6">
      <h4 class="text-base font-medium mb-3">Parts by Category</h4>
      <div class="overflow-x-auto">
        <table class="table">
          <thead>
            <tr>
              <th class="th">Category</th>
              <th class="th text-right">Count</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-800">
            @forelse($partsByCategory as $row)
              <tr>
                <td class="td">{{ $row->category ?? '—' }}</td>
                <td class="td text-right font-semibold">{{ $row->total }}</td>
              </tr>
            @empty
              <tr><td class="td" colspan="2">No parts found</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <div>
      <h4 class="text-base font-medium mb-3">Low Stock Alert (&lt; {{ $lowThreshold }})</h4>
      <div class="overflow-x-auto">
        <table class="table">
          <thead>
            <tr>
              <th class="th">Part Name</th>
              <th class="th">Category</th>
              <th class="th text-right">Qty</th>
              <th class="th text-right">Price</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-800">
            @forelse($lowStock as $p)
              <tr>
                <td class="td font-medium">{{ $p->name }}</td>
                <td class="td">{{ $p->category }}</td>
                <td class="td text-right">
                  <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300">
                    {{ $p->quantity }}
                  </span>
                </td>
                <td class="td text-right font-semibold">${{ number_format($p->price, 2) }}</td>
              </tr>
            @empty
              <tr>
                <td class="td" colspan="4">
                  <div class="flex items-center justify-center py-4">
                    <span class="text-emerald-600 font-medium">🎉 No low stock items!</span>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
