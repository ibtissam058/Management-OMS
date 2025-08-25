@extends('layouts.app')
@section('title', 'Work Order Details')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Work Order #WO-{{ $workorder->id }}</h1>
    <div class="flex gap-3">
        <a href="{{ route('workorders.edit', $workorder) }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit Work Order
        </a>
        <a href="{{ route('workorders.index') }}" class="btn">Back to List</a>
    </div>
</div>

<div class="card p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Work Order ID</label>
                <p class="text-lg font-semibold">#WO-{{ $workorder->id }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Equipment</label>
                <p class="text-lg font-semibold">{{ $workorder->equipment->name ?? 'N/A' }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Description</label>
                <p class="text-lg">{{ $workorder->description }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Priority</label>
                @php
                    $priorityVariant = match($workorder->priority) {
                        'High' => 'danger',
                        'Medium' => 'warning',
                        'Low' => 'success',
                        default => 'default'
                    };
                @endphp
                <x-badge :variant="$priorityVariant">{{ $workorder->priority }}</x-badge>
            </div>
        </div>
        
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Status</label>
                @php
                    $statusVariant = match($workorder->status) {
                        'Completed' => 'success',
                        'In Progress' => 'warning',
                        'Pending' => 'default',
                        default => 'default'
                    };
                @endphp
                <x-badge :variant="$statusVariant">{{ $workorder->status }}</x-badge>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Assigned Technician</label>
                <p class="text-lg">{{ $workorder->technician->name ?? 'Unassigned' }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Due Date</label>
                <p class="text-lg">{{ $workorder->due_date ? \Carbon\Carbon::parse($workorder->due_date)->format('M d, Y') : 'N/A' }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Estimated Cost</label>
                <p class="text-lg font-semibold">${{ number_format($workorder->cost ?? 0, 2) }}</p>
            </div>
        </div>
    </div>
</div>
@endsection