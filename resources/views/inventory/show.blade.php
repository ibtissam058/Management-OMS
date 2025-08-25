@extends('layouts.app')
@section('title', 'Spare Part Details')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Spare Part Details</h1>
    <div class="flex gap-3">
        <a href="{{ route('inventory.edit', $sparepart) }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit
        </a>
        <a href="{{ route('inventory.index') }}" class="btn">Back to List</a>
    </div>
</div>

<div class="card p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Part ID</label>
                <p class="mt-1 text-lg font-semibold">#PART-{{ str_pad($sparepart->id, 4, '0', STR_PAD_LEFT) }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Part Name</label>
                <p class="mt-1 text-lg font-semibold">{{ $sparepart->name }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Category</label>
                <span class="inline-flex items-center mt-1 px-3 py-1 rounded-full text-sm font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300">
                    {{ $sparepart->category }}
                </span>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Stock Quantity</label>
                <div class="mt-1 flex items-center gap-2">
                    <span class="text-2xl font-bold {{ $sparepart->quantity > 10 ? 'text-emerald-600' : ($sparepart->quantity > 0 ? 'text-amber-600' : 'text-red-600') }}">
                        {{ $sparepart->quantity }}
                    </span>
                    <span class="text-sm text-gray-500">units</span>
                </div>
            </div>
        </div>
        
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Unit Price</label>
                <p class="mt-1 text-lg font-semibold">${{ number_format($sparepart->price, 2) }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Total Value</label>
                <p class="mt-1 text-lg font-semibold text-emerald-600">${{ number_format($sparepart->price * $sparepart->quantity, 2) }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Created</label>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $sparepart->created_at?->format('M j, Y \a\t g:i A') }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated</label>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $sparepart->updated_at?->format('M j, Y \a\t g:i A') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
