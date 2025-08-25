@extends('layouts.app')
@section('title', 'Technicians')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Technicians Management</h1>
    <a href="{{ route('technicians.create') }}" class="btn-primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Add Technician
    </a>
</div>

<div class="card p-6">
    <!-- Speciality Filter -->
    <form method="GET" action="{{ route('technicians.index') }}" id="specialityFilter" class="flex gap-4 mb-6">
        <div class="flex-1 max-w-xs">
            <select name="speciality" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" onchange="document.getElementById('specialityFilter').submit()">
                <option value="">All Specialties</option>
                <option value="Mechanical" {{ request('speciality') === 'Mechanical' ? 'selected' : '' }}>Mechanical</option>
                <option value="Electrical" {{ request('speciality') === 'Electrical' ? 'selected' : '' }}>Electrical</option>
                <option value="Hydraulics" {{ request('speciality') === 'Hydraulics' ? 'selected' : '' }}>Hydraulics</option>
                <option value="Instrumentation" {{ request('speciality') === 'Instrumentation' ? 'selected' : '' }}>Instrumentation</option>
                <option value="Automation" {{ request('speciality') === 'Automation' ? 'selected' : '' }}>Automation</option>
                <option value="Welding" {{ request('speciality') === 'Welding' ? 'selected' : '' }}>Welding</option>
            </select>
        </div>
        @if(request('speciality'))
            <a href="{{ route('technicians.index') }}" class="btn">Clear Filter</a>
        @endif
    </form>

    <!-- Results Info -->
    @if(request('speciality'))
        <div class="bg-blue-50 dark:bg-blue-950/30 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-6">
            <div class="text-blue-800 dark:text-blue-200">
                Showing {{ $technicians->count() }} technician(s) with speciality: <strong>{{ request('speciality') }}</strong>
            </div>
        </div>
    @endif

    <!-- Technicians Table -->
    @if($technicians->count() > 0)
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th class="th">ID</th>
                        <th class="th">Name</th>
                        <th class="th">Speciality</th>
                        <th class="th">Phone Number</th>
                        <th class="th">Email</th>
                        <th class="th">Assigned Orders</th>
                        <th class="th">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @foreach($technicians as $tech)
                    <tr class="hover:bg-gray-800/50">
                        <td class="td">#TECH-{{ $tech->id }}</td>
                        <td class="td font-medium">{{ $tech->name }}</td>
                        <td class="td">
                            <span class="badge bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 ring-gray-300 dark:ring-gray-600">{{ $tech->speciality }}</span>
                        </td>
                        <td class="td">{{ $tech->phone_number }}</td>
                        <td class="td">{{ $tech->email }}</td>
                        <td class="td">
                            <span class="badge bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200 ring-blue-300 dark:ring-blue-700">{{ $tech->workOrders ? $tech->workOrders->count() : 0 }}</span>
                        </td>
                        <td class="td">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('technicians.show', $tech) }}" class="icon-btn text-blue-600 hover:text-blue-500" title="View">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('technicians.edit', $tech) }}" class="icon-btn text-amber-600 hover:text-amber-500" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('technicians.destroy', $tech) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Are you sure you want to delete this technician?')">
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No Technicians Found</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-4">
                @if(request('speciality'))
                    No technicians found with speciality: <strong>{{ request('speciality') }}</strong>
                @else
                    No technicians have been added yet.
                @endif
            </p>
            @if(request('speciality'))
                <a href="{{ route('technicians.index') }}" class="btn">View All Technicians</a>
            @else
                <a href="{{ route('technicians.create') }}" class="btn-primary">Add First Technician</a>
            @endif
        </div>
    @endif
</div>
@endsection