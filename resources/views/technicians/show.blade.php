@extends('layouts.app')
@section('title', 'Technician Details')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Technician Details</h1>
    <div class="flex gap-3">
        <a href="{{ route('technicians.edit', $technician) }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit
        </a>
        <a href="{{ route('technicians.index') }}" class="btn">Back to List</a>
    </div>
</div>

<div class="card p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Technician ID</label>
                <p class="mt-1 text-lg font-semibold">#TECH-{{ str_pad($technician->id, 4, '0', STR_PAD_LEFT) }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Full Name</label>
                <p class="mt-1 text-lg font-semibold">{{ $technician->name }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Speciality</label>
                <span class="inline-flex items-center mt-1 px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300">
                    {{ $technician->speciality }}
                </span>
            </div>
        </div>
        
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Phone Number</label>
                <p class="mt-1 text-lg">{{ $technician->phone_number }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Email Address</label>
                <p class="mt-1 text-lg">{{ $technician->email }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Assigned Work Orders</label>
                <div class="mt-1 flex items-center gap-2">
                    <span class="text-2xl font-bold text-emerald-600">{{ $technician->workOrders->count() }}</span>
                    <span class="text-sm text-gray-500">active orders</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection