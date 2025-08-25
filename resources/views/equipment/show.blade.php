@extends('layouts.app')
@section('title', 'Equipment Details')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Equipment: {{ $equipment->name }}</h1>
    <div class="flex gap-3">
        <a href="{{ route('equipment.edit', $equipment) }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit Equipment
        </a>
        <a href="{{ route('equipment.index') }}" class="btn">Back to List</a>
    </div>
</div>

<div class="card p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Equipment ID</label>
                <p class="text-lg font-semibold">#EQ-{{ $equipment->id }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Name</label>
                <p class="text-lg font-semibold">{{ $equipment->name }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Type</label>
                <span class="badge bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 ring-gray-300 dark:ring-gray-600">{{ $equipment->type }}</span>
            </div>
        </div>
        
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Location</label>
                <p class="text-lg">{{ $equipment->location }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Status</label>
                @php
                    $statusVariant = match($equipment->status) {
                        'Operational' => 'success',
                        'Under Maintenance' => 'warning',
                        'Broken' => 'danger',
                        default => 'default'
                    };
                @endphp
                <x-badge :variant="$statusVariant">{{ $equipment->status }}</x-badge>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Last Maintenance</label>
                <p class="text-lg">{{ $equipment->last_maintenance ? \Carbon\Carbon::parse($equipment->last_maintenance)->format('M d, Y') : 'N/A' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection