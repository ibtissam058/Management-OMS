@extends('layouts.app')
@section('title', 'Reports')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h2 text-dark">Reports</h1>
</div>
<a
  href="{{ route('reports.export', [
      'from' => request('from', $from->toDateString()),
      'to'   => request('to',   $to->toDateString()),
      'low'  => request('low',  $lowThreshold),
  ]) }}"
  class="btn btn-outline-light"
>
  <i class="bi bi-download"></i> Export Report
</a>

{{-- Filters --}}
<form method="GET" action="{{ route('reports') }}" class="row g-2 mb-4">
  <div class="col-md-3">
    <label class="form-label">From</label>
    <input type="date" name="from" value="{{ request('from', $from->toDateString()) }}" class="form-control">
  </div>
  <div class="col-md-3">
    <label class="form-label">To</label>
    <input type="date" name="to" value="{{ request('to', $to->toDateString()) }}" class="form-control">
  </div>
  <div class="col-md-3">
    <label class="form-label">Low stock threshold</label>
    <input type="number" name="low" value="{{ request('low', $lowThreshold) }}" min="0" class="form-control">
  </div>
  <div class="col-md-3 d-flex align-items-end">
    <button class="btn btn-primary w-100">Apply</button>
  </div>
</form>

{{-- KPI cards --}}
<div class="row g-3 mb-4">
  <div class="col-md-2"><div class="card p-3"><div class="text-muted">WO created</div><div class="fs-4">{{ $kpis['created_in_range'] }}</div></div></div>
  <div class="col-md-2"><div class="card p-3"><div class="text-muted">Open now</div><div class="fs-4">{{ $kpis['open_now'] }}</div></div></div>
  <div class="col-md-2"><div class="card p-3"><div class="text-muted">In progress</div><div class="fs-4">{{ $kpis['in_progress_now'] }}</div></div></div>
  <div class="col-md-2"><div class="card p-3"><div class="text-muted">Completed</div><div class="fs-4">{{ $kpis['completed_in_range'] }}</div></div></div>
  <div class="col-md-2"><div class="card p-3"><div class="text-muted">Overdue</div><div class="fs-4">{{ $kpis['overdue_open'] }}</div></div></div>
  <div class="col-md-2"><div class="card p-3"><div class="text-muted">Cost (range)</div><div class="fs-5">${{ number_format($kpis['cost_in_range'], 2) }}</div></div></div>
</div>

<div class="row g-4">
  <div class="col-lg-6">
    <div class="card p-3 h-100">
      <h5 class="mb-3">Work Orders by Status (range)</h5>
      <table class="table table-dark table-striped mb-0">
        <thead><tr><th>Status</th><th class="text-end">Count</th></tr></thead>
        <tbody>
        @forelse($woByStatus as $row)
          <tr><td>{{ $row->status ?? '—' }}</td><td class="text-end">{{ $row->total }}</td></tr>
        @empty
          <tr><td colspan="2">No data</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card p-3 h-100">
      <h5 class="mb-3">Work Orders by Priority (range)</h5>
      <table class="table table-dark table-striped mb-0">
        <thead><tr><th>Priority</th><th class="text-end">Count</th></tr></thead>
        <tbody>
        @forelse($woByPriority as $row)
          <tr><td>{{ $row->priority ?? '—' }}</td><td class="text-end">{{ $row->total }}</td></tr>
        @empty
          <tr><td colspan="2">No data</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card p-3 h-100">
      <h5 class="mb-3">Top Technicians (current workload)</h5>
      <table class="table table-dark table-striped mb-0">
        <thead><tr><th>Name</th><th>Speciality</th><th class="text-end">Open + In Progress</th></tr></thead>
        <tbody>
        @forelse($topTechs as $t)
          <tr>
            <td>{{ $t->name }}</td>
            <td>{{ $t->speciality }}</td>
            <td class="text-end">{{ $t->work_orders_count }}</td>
          </tr>
        @empty
          <tr><td colspan="3">No technicians</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card p-3 h-100">
      <h5 class="mb-2">Inventory Summary</h5>
      <div class="mb-3">Total inventory value: <strong>${{ number_format($inventoryValue, 2) }}</strong></div>

      <h6>Parts by Category</h6>
      <table class="table table-dark table-striped mb-3">
        <thead><tr><th>Category</th><th class="text-end">Count</th></tr></thead>
        <tbody>
        @forelse($partsByCategory as $row)
          <tr><td>{{ $row->category ?? '—' }}</td><td class="text-end">{{ $row->total }}</td></tr>
        @empty
          <tr><td colspan="2">No parts</td></tr>
        @endforelse
        </tbody>
      </table>

      <h6>Low Stock (&lt; {{ $lowThreshold }})</h6>
      <table class="table table-dark table-striped mb-0">
        <thead><tr><th>Name</th><th>Category</th><th class="text-end">Qty</th><th class="text-end">Price</th></tr></thead>
        <tbody>
        @forelse($lowStock as $p)
          <tr>
            <td>{{ $p->name }}</td>
            <td>{{ $p->category }}</td>
            <td class="text-end">{{ $p->quantity }}</td>
            <td class="text-end">${{ number_format($p->price, 2) }}</td>
          </tr>
        @empty
          <tr><td colspan="4">No low stock items 🎉</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
