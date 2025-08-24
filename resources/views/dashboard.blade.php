@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 text-dark">Dashboard Overview</h1>
    <button class="btn btn-ocp-primary">
        <i class="fas fa-download me-2"></i>Export Report
    </button>
</div>
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card">
            <div class="d-flex justify-content-between">
                <div>
                    <div class="stat-number">{{ $totalEquipment }}</div>
                    <div class="text-muted">Total Equipment</div>
                </div>
                <div class="stat-icon text-primary">
                    <i class="fas fa-cogs"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- Add other stat cards similarly -->
</div>
<div class="row mb-4">
    <div class="col-lg-8">
        <div class="chart-container">
            <h5>Maintenance Costs Trend</h5>
            <canvas id="costsChart" width="400" height="200"></canvas>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="chart-container">
            <h5>Equipment Status</h5>
            <canvas id="statusChart" width="200" height="200"></canvas>
        </div>
    </div>
</div>
<div class="table-container">
    <h5>Recent Work Orders</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Equipment</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Assigned To</th>
                <th>Due Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($workOrders as $wo)
            <tr class="priority-{{ strtolower($wo->priority) }}">
                <td>#WO-{{ $wo->id }}</td>
                <td>{{ $wo->equipment->name ?? 'N/A' }}</td>
                <td><span class="badge bg-{{ $wo->priority == 'High' ? 'danger' : ($wo->priority == 'Medium' ? 'warning' : 'success') }}">{{ $wo->priority }}</span></td>
                <td><span class="status-badge status-{{ strtolower($wo->status) }}">{{ $wo->status }}</span></td>
                <td>{{ $wo->technician->name ?? 'Unassigned' }}</td>
                <td>{{ $wo->due_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('scripts')
<script>
    new Chart(document.getElementById('costsChart'), {
        type: 'line',
        data: {
            labels: @json($chartData['costs']->pluck('month')),
            datasets: [{
                label: 'Costs ($K)',
                data: @json($chartData['costs']->pluck('total')),
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: { responsive: true }
    });
    new Chart(document.getElementById('statusChart'), {
        type: 'doughnut',
        data: {
            labels: @json($chartData['status']->pluck('status')),
            datasets: [{
                data: @json($chartData['status']->pluck('count')),
                backgroundColor: ['#27ae60', '#f39c12', '#e74c3c']
            }]
        },
        options: { responsive: true }
    });
</script>
@endsection
