@extends('layouts.app')
@section('title', 'Edit Work Order')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Edit Work Order</h1>
</div>

<div class="card p-6">
    <form action="{{ route('workorders.update', $workorder) }}" method="POST" class="space-y-6">
        @csrf @method('PUT')
        
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Equipment</label>
            <select name="equipment_id" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                @foreach($equipments as $eq)
                <option value="{{ $eq->id }}" {{ $workorder->equipment_id == $eq->id ? 'selected' : '' }}>{{ $eq->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
            <textarea name="description" rows="4" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>{{ $workorder->description }}</textarea>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Priority</label>
                <select name="priority" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="High" {{ $workorder->priority == 'High' ? 'selected' : '' }}>High</option>
                    <option value="Medium" {{ $workorder->priority == 'Medium' ? 'selected' : '' }}>Medium</option>
                    <option value="Low" {{ $workorder->priority == 'Low' ? 'selected' : '' }}>Low</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                <select name="status" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="Pending" {{ $workorder->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="In Progress" {{ $workorder->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="Completed" {{ $workorder->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Technician</label>
                <select name="technician_id" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="" {{ !$workorder->technician_id ? 'selected' : '' }}>Unassigned</option>
                    @foreach($technicians as $tech)
                    <option value="{{ $tech->id }}" {{ $workorder->technician_id == $tech->id ? 'selected' : '' }}>{{ $tech->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Due Date</label>
                <input type="date" name="due_date" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" value="{{ $workorder->due_date }}" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Cost ($)</label>
                <input type="number" step="0.01" name="cost" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" value="{{ $workorder->cost }}">
            </div>
        </div>
        
        <div class="flex gap-3 pt-4">
            <button type="submit" class="btn-primary">Save Changes</button>
            <a href="{{ route('workorders.index') }}" class="btn">Cancel</a>
        </div>
    </form>
</div>
@endsection