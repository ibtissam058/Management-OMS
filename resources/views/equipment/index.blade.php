@extends('layouts.app')
@section('title', 'Equipment')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Equipment Management</h1>
    <a href="{{ route('equipment.create') }}" class="btn-primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Add Equipment
    </a>
</div>

<div class="card p-6">
    <!-- Filters Form -->
    <form method="GET" action="{{ route('equipment.index') }}" id="equipmentFilter" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div>
            <input type="text" name="search" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" 
                   placeholder="Search equipment..." value="{{ request('search') }}">
        </div>
        <div>
            <select name="location" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" onchange="this.form.submit()">
                <option value="">All Locations</option>
                <option value="Mine Site A" {{ request('location') === 'Mine Site A' ? 'selected' : '' }}>Mine Site A</option>
                <option value="Processing Plant" {{ request('location') === 'Processing Plant' ? 'selected' : '' }}>Processing Plant</option>
                <option value="Chemical Unit" {{ request('location') === 'Chemical Unit' ? 'selected' : '' }}>Chemical Unit</option>
            </select>
        </div>
        <div>
            <select name="status" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" onchange="this.form.submit()">
                <option value="">All Status</option>
                <option value="Operational" {{ request('status') === 'Operational' ? 'selected' : '' }}>Operational</option>
                <option value="Under Maintenance" {{ request('status') === 'Under Maintenance' ? 'selected' : '' }}>Under Maintenance</option>
                <option value="Broken" {{ request('status') === 'Broken' ? 'selected' : '' }}>Broken</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="btn">Search</button>
            @if(request('search') || request('location') || request('status'))
                <a href="{{ route('equipment.index') }}" class="btn">Clear</a>
            @endif
        </div>
    </form>

    <!-- Results Info -->
    @if(request('search') || request('location') || request('status'))
        <div class="bg-blue-50 dark:bg-blue-950/30 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-6">
            <div class="text-blue-800 dark:text-blue-200">
                Showing {{ $equipment->count() }} equipment(s) 
                @if(request('search'))
                    matching "<strong>{{ request('search') }}</strong>"
                @endif
                @if(request('location'))
                    in location: <strong>{{ request('location') }}</strong>
                @endif
                @if(request('status'))
                    with status: <strong>{{ request('status') }}</strong>
                @endif
            </div>
        </div>
    @endif

    <!-- Equipment Table -->
    @if($equipment->count() > 0)
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th class="th">ID</th>
                        <th class="th">Name</th>
                        <th class="th">Type</th>
                        <th class="th">Location</th>
                        <th class="th">Status</th>
                        <th class="th">Last Maintenance</th>
                        <th class="th">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @foreach($equipment as $eq)
                    <tr class="hover:bg-gray-800/50">
                        <td class="td">#EQ-{{ $eq->id }}</td>
                        <td class="td font-medium">{{ $eq->name }}</td>
                        <td class="td">
                            <span class="badge bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 ring-gray-300 dark:ring-gray-600">{{ $eq->type }}</span>
                        </td>
                        <td class="td">{{ $eq->location }}</td>
                        <td class="td">
                            @php
                                $statusVariant = match($eq->status) {
                                    'Operational' => 'success',
                                    'Under Maintenance' => 'warning',
                                    'Broken' => 'danger',
                                    default => 'default'
                                };
                            @endphp
                            <x-badge :variant="$statusVariant">{{ $eq->status }}</x-badge>
                        </td>
                        <td class="td">{{ $eq->last_maintenance ?? 'N/A' }}</td>
                        <td class="td">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('equipment.show', $eq) }}" class="icon-btn text-blue-600 hover:text-blue-500" title="View">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('equipment.edit', $eq) }}" class="icon-btn text-amber-600 hover:text-amber-500" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('equipment.destroy', $eq) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Are you sure you want to delete this equipment?')">
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No Equipment Found</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-4">
                @if(request('search') || request('location') || request('status'))
                    No equipment found matching your search criteria.
                @else
                    No equipment has been added yet.
                @endif
            </p>
            @if(request('search') || request('location') || request('status'))
                <a href="{{ route('equipment.index') }}" class="btn">View All Equipment</a>
            @else
                <a href="{{ route('equipment.create') }}" class="btn-primary">Add First Equipment</a>
            @endif
        </div>
    @endif
</div>
@endsection