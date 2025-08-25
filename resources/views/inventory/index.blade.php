@extends('layouts.app')
@section('title', 'Spare Parts')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Spare Parts Inventory</h1>
    <a href="{{ route('inventory.create') }}" class="btn-primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Add Part
    </a>
</div>

<div class="card p-6">
    <!-- Category Filter -->
    <form method="GET" action="{{ route('inventory.index') }}" id="categoryFilter" class="flex gap-4 mb-6">
        <div class="flex-1 max-w-xs">
            <select name="category" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" onchange="this.form.submit()">
                <option value="">All Categories</option>
                <option value="Bearings" {{ request('category') === 'Bearings' ? 'selected' : '' }}>Bearings</option>
                <option value="Belts" {{ request('category') === 'Belts' ? 'selected' : '' }}>Belts</option>
                <option value="Motors" {{ request('category') === 'Motors' ? 'selected' : '' }}>Motors</option>
            </select>
        </div>
        @if(request('category'))
            <a href="{{ route('inventory.index') }}" class="btn">Clear Filter</a>
        @endif
    </form>

    <!-- Results Info -->
    @if(request('category'))
        <div class="bg-blue-50 dark:bg-blue-950/30 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-6">
            <div class="text-blue-800 dark:text-blue-200">
                Showing {{ $sparepart->count() }} spare part(s) in category: <strong>{{ request('category') }}</strong>
            </div>
        </div>
    @endif

    <!-- Spare Parts Table -->
    @if($sparepart->count() > 0)
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th class="th">ID</th>
                        <th class="th">Name</th>
                        <th class="th">Category</th>
                        <th class="th">Quantity</th>
                        <th class="th">Price</th>
                        <th class="th">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @foreach($sparepart as $part)
                    <tr class="hover:bg-gray-800/50">
                        <td class="td">#PART-{{ $part->id }}</td>
                        <td class="td font-medium">{{ $part->name }}</td>
                        <td class="td">
                            <span class="badge bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 ring-gray-300 dark:ring-gray-600">{{ $part->category }}</span>
                        </td>
                        <td class="td">
                            @php
                                $quantityVariant = $part->quantity > 10 ? 'success' : ($part->quantity > 5 ? 'warning' : 'danger');
                            @endphp
                            <x-badge :variant="$quantityVariant">{{ $part->quantity }}</x-badge>
                        </td>
                        <td class="td font-medium">${{ number_format($part->price, 2) }}</td>
                        <td class="td">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('inventory.show', $part) }}" class="icon-btn text-blue-600 hover:text-blue-500" title="View">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('inventory.edit', $part) }}" class="icon-btn text-amber-600 hover:text-amber-500" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('inventory.destroy', $part) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Are you sure you want to delete this spare part?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="icon-btn text-red-600 hover:text-red-500" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-12">
            <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No Spare Parts Found</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-4">
                @if(request('category'))
                    No spare parts found in category: <strong>{{ request('category') }}</strong>
                @else
                    No spare parts have been added yet.
                @endif
            </p>
            @if(request('category'))
                <a href="{{ route('inventory.index') }}" class="btn">View All Parts</a>
            @else
                <a href="{{ route('inventory.create') }}" class="btn-primary">Add First Part</a>
            @endif
        </div>
    @endif
</div>
@endsection