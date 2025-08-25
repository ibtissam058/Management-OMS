@extends('layouts.app')
@section('title', 'Add Equipment')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Add New Equipment</h1>
</div>

<div class="card p-6">
    <form action="{{ route('equipment.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Equipment Name</label>
            <input type="text" name="name" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Type</label>
            <select name="type" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                <option>Crusher</option>
                <option>Conveyor</option>
                <option>Pump</option>
                <option>Motor</option>
                <option>Other</option>
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Location</label>
            <select name="location" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                <option>Mine Site A</option>
                <option>Processing Plant</option>
                <option>Chemical Unit</option>
            </select>
            @error('location') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
            <select name="status" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                <option>Operational</option>
                <option>Under Maintenance</option>
                <option>Broken</option>
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Last Maintenance</label>
            <input type="date" name="last_maintenance" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
        </div>
        
        <div class="flex gap-3 pt-4">
            <button type="submit" class="btn-primary">Save Equipment</button>
            <a href="{{ route('equipment.index') }}" class="btn">Cancel</a>
        </div>
    </form>
</div>
@endsection