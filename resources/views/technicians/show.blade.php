@extends('layouts.app')
@section('title', 'Technician Details')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 text-dark">Technician: {{ $technician->name }}</h1>
</div>
<div class="table-container">
    <p><strong>ID:</strong> #TECH-{{ $technician->id }}</p>
    <p><strong>Name:</strong> {{ $technician->name }}</p>
    <p><strong>Speciality:</strong> {{ $technician->speciality }}</p>
    <p><strong>Phone Number:</strong> {{ $technician->phone_number }}</p>
    <p><strong>Email:</strong> {{ $technician->email }}</p>
    <p><strong>Assigned Orders:</strong> {{ $technician->workOrders->count() }}</p>
    <a href="{{ route('technicians.edit', $technician) }}" class="btn btn-warning"><i class="fas fa-edit me-1"></i>Edit</a>
    <a href="{{ route('technicians.index', $technician) }}" class="btn btn-outline-secondary">Back</a>
</div>
@endsection