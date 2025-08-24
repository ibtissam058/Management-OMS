@extends('layouts.app')
@section('title', 'Edit Work Order')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 text-dark">Edit Work Order</h1>
</div>
<div class="table-container">
    <form action="{{ route('workorders.update', $workorder) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Equipment</label>
            <select name="equipment_id" class="form-select" required>
                @foreach($equipments as $eq)
                <option value="{{ $eq->id }}" {{ $workorder->equipment_id == $eq->id ? 'selected' : '' }}>{{ $eq->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required>{{ $workorder->description }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Priority</label>
            <select name="priority" class="form-select">
                <option {{ $workorder->priority == 'High' ? 'selected' : '' }}>High</option>
                <option {{ $workorder->priority == 'Medium' ? 'selected' : '' }}>Medium</option>
                <option {{ $workorder->priority == 'Low' ? 'selected' : '' }}>Low</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option {{ $workorder->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option {{ $workorder->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                <option {{ $workorder->status == 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Technician</label>
            <select name="technician_id" class="form-select">
                <option value="" {{ !$workorder->technician_id ? 'selected' : '' }}>Unassigned</option>
                @foreach($technicians as $tech)
                <option value="{{ $tech->id }}" {{ $workorder->technician_id == $tech->id ? 'selected' : '' }}>{{ $tech->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Due Date</label>
            <input type="date" name="due_date" class="form-control" value="{{ $workorder->due_date }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Cost ($)</label>
            <input type="number" step="0.01" name="cost" class="form-control" value="{{ $workorder->cost }}">
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-primary">Save changes</button>
            <a href="{{ route('workorders.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection