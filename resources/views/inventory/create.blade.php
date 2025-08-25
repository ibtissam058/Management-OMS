@extends('layouts.app')
@section('title', 'Add Spare Part')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Add New Spare Part</h1>
</div>

<div class="card p-6">
    <form action="{{ route('inventory.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Part Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Enter part name" required>
            @error('name') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category</label>
            <select id="category" name="category" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                <option value="">Select Category</option>
                <option value="Bearings" {{ old('category') == 'Bearings' ? 'selected' : '' }}>Bearings</option>
                <option value="Belts" {{ old('category') == 'Belts' ? 'selected' : '' }}>Belts</option>
                <option value="Motors" {{ old('category') == 'Motors' ? 'selected' : '' }}>Motors</option>
                <option value="Filters" {{ old('category') == 'Filters' ? 'selected' : '' }}>Filters</option>
                <option value="Seals" {{ old('category') == 'Seals' ? 'selected' : '' }}>Seals</option>
                <option value="Valves" {{ old('category') == 'Valves' ? 'selected' : '' }}>Valves</option>
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Quantity</label>
                <input type="number" name="quantity" value="{{ old('quantity') }}" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" min="0" step="1" placeholder="0" required>
                @error('quantity') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Price (USD)</label>
                <div class="relative">
                    <span class="absolute left-3 top-2 text-gray-500 dark:text-gray-400">$</span>
                    <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="w-full pl-8 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" min="0" placeholder="0.00" required>
                </div>
                @error('price') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="btn-primary">Save Part</button>
            <a href="{{ route('inventory.index') }}" class="btn">Cancel</a>
        </div>
    </form>
</div>
@endsection