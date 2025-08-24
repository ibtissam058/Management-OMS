@extends('layouts.app')
@section('title', 'Equipment Details')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 text-dark">Equipment: {{ $equipment->name }}</h1>
</div>
<div class="table-container">
    <p><strong>ID:</strong> #EQ-{{ $equipment->id }}</p>
    <p><strong>Name:</strong> {{ $equipment->name }}</p>
    <p><strong>Type:</strong> {{ $equipment->type }}</p>
    <p><strong>Location:</strong> {{ $equipment->location }}</p>
    <p><strong>Status:</strong> <span class="status-badge status-{{ str_replace(' ', '-', strtolower($equipment->status)) }}">{{ $equipment->status }}</span></p>
    <p><strong>Last Maintenance:</strong> {{ $equipment->last_maintenance ?? 'N/A' }}</p>
    <a href="{{ route('equipment.edit', $equipment) }}" class="btn btn-warning"><i class="fas fa-edit me-1"></i>Edit</a>
    <a href="{{ route('equipment.index', $equipment) }}" class="btn btn-outline-secondary">Back</a>
</div>
@endsection