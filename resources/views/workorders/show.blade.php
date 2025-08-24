@extends('layouts.app')
@section('title', 'Work Order Details')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 text-dark">Work Order #WO-{{ $workorder->id }}</h1>
</div>
<div class="table-container">
    <p><strong>Equipment:</strong> {{ $workorder->equipment->name ?? 'N/A' }}</p>
    <p><strong>Description:</strong> {{ $workorder->description }}</p>
    <p><strong>Priority:</strong> <span class="badge bg-{{ $workorder->priority == 'High' ? 'danger' : ($workorder->priority == 'Medium' ? 'warning' : 'success') }}">{{ $workorder->priority }}</span></p>
    <p><strong>Status:</strong> <span class="status-badge status-{{ str_replace(' ', '-', strtolower($workorder->status)) }}">{{ $workorder->status }}</span></p>
    <p><strong>Technician:</strong> {{ $workorder->technician->name ?? 'Unassigned' }}</p>
    <p><strong>Due Date:</strong> {{ $workorder->due_date }}</p>
    <p><strong>Cost:</strong> ${{ number_format($workorder->cost, 2) }}</p>
    <a href="{{ route('workorders.edit', $workorder) }}" class="btn btn-warning"><i class="fas fa-edit me-1"></i>Edit</a>
    <a href="{{ route('workorders.index', $workorder) }}" class="btn btn-outline-secondary">Back</a>
</div>
@endsection