@extends('layouts.app')
@section('title', 'Work Orders')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 text-dark">Work Orders</h1>
    <a href="{{ route('workorders.create') }}" class="btn btn-ocp-primary">
        <i class="fas fa-plus me-2"></i>Create Work Order
    </a>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card border-0 bg-light">
            <div class="card-body text-center">
                <h3 class="text-primary">{{ $workorders->where('status', 'In Progress')->count() }}</h3>
                <p class="mb-0">Active Orders</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 bg-light">
            <div class="card-body text-center">
                <h3 class="text-success">{{ $workorders->where('status', 'Completed')->count() }}</h3>
                <p class="mb-0">Completed</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 bg-light">
            <div class="card-body text-center">
                <h3 class="text-warning">{{ $workorders->where('due_date', '<', now())->where('status', '!=', 'Completed')->count() }}</h3>
                <p class="mb-0">Overdue</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 bg-light">
            <div class="card-body text-center">
                <h3 class="text-info">{{ $workorders->where('status', 'Pending')->count() }}</h3>
                <p class="mb-0">Scheduled</p>
            </div>
        </div>
    </div>
</div>

<div class="table-container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Equipment</th>
                <th>Description</th>
                <th>Priority</th>
                <th>Technician</th>
                <th>Status</th>
                <th>Due Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($workorders as $wo)
            <tr>
                <td>#WO-{{ $wo->id }}</td>
                <td>{{ $wo->equipment->name ?? 'N/A' }}</td>
                <td>{{ $wo->description }}</td>
                <td><span class="badge bg-{{ $wo->priority == 'High' ? 'danger' : ($wo->priority == 'Medium' ? 'warning' : 'success') }}">{{ $wo->priority }}</span></td>
                <td>{{ $wo->technician->name ?? 'Unassigned' }}</td>
                <td><span class="status-badge status-{{ str_replace(' ', '-', strtolower($wo->status)) }}">{{ $wo->status }}</span></td>
                <td>{{ $wo->due_date }}</td>
                <td>
                    <a href="{{ route('workorders.show', $wo) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('workorders.edit', $wo) }}" class="btn btn-sm btn-outline-warning me-1"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('workorders.destroy', $wo) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection