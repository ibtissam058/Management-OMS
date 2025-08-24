@extends('layouts.app')
@section('title', 'Add Equipment')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 text-dark">Add New Equipment</h1>
</div>
<div class="table-container">
    <form action="{{ route('equipment.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Equipment Name</label>
            <input type="text" name="name" class="form-control" required>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Type</label>
            <select name="type" class="form-select">
                <option>Crusher</option>
                <option>Conveyor</option>
                <option>Pump</option>
                <option>Motor</option>
                <option>Other</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Location</label>
            <select name="location" class="form-select" required>
                <option>Mine Site A</option>
                <option>Processing Plant</option>
                <option>Chemical Unit</option>
            </select>
            @error('location') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option>Operational</option>
                <option>Under Maintenance</option>
                <option>Broken</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Last Maintenance</label>
            <input type="date" name="last_maintenance" class="form-control">
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-primary">Save</button>
            <a href="{{ route('equipment.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection