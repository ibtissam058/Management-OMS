@extends('layouts.app')
@section('title', 'Edit Spare Part')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Edit Spare Part</h1>
</div>

<div class="card p-6">
    <form action="{{ route('inventory.update', $sparepart) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Part Name</label>
            <input id="name" type="text" name="name"
                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('name') border-red-500 @enderror"
                   value="{{ old('name', $sparepart->name) }}" required maxlength="255">
            @error('name') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category</label>
            <input id="category" type="text" name="category"
                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('category') border-red-500 @enderror"
                   value="{{ old('category', $sparepart->category) }}" required maxlength="255">
            @error('category') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Quantity</label>
                <input id="quantity" type="number" name="quantity"
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('quantity') border-red-500 @enderror"
                       value="{{ old('quantity', $sparepart->quantity) }}" required min="0" step="1">
                @error('quantity') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Price (USD)</label>
                <div class="relative">
                    <span class="absolute left-3 top-2 text-gray-500 dark:text-gray-400">$</span>
                    <input id="price" type="number" name="price"
                           class="w-full pl-8 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('price') border-red-500 @enderror"
                           value="{{ old('price', $sparepart->price) }}" required min="0" step="0.01">
                </div>
                @error('price') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="btn-primary">Save Changes</button>
            <a href="{{ route('inventory.index') }}" class="btn">Cancel</a>
        </div>
    </form>
</div>
@endsection
