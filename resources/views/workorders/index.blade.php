@extends('layouts.app')
@section('title', 'Work Orders')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Work Orders</h1>
    <a href="{{ route('workorders.create') }}" class="btn-primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Create Work Order
    </a>
</div>

<!-- KPI Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="kpi">
        <div class="kpi-label">Active Orders</div>
        <div class="kpi-value text-blue-500">{{ $workorders->where('status', 'In Progress')->count() }}</div>
    </div>
    <div class="kpi">
        <div class="kpi-label">Completed</div>
        <div class="kpi-value text-emerald-500">{{ $workorders->where('status', 'Completed')->count() }}</div>
    </div>
    <div class="kpi">
        <div class="kpi-label">Overdue</div>
        <div class="kpi-value text-amber-500">{{ $workorders->where('due_date', '<', now())->where('status', '!=', 'Completed')->count() }}</div>
    </div>
    <div class="kpi">
        <div class="kpi-label">Scheduled</div>
        <div class="kpi-value text-cyan-500">{{ $workorders->where('status', 'Pending')->count() }}</div>
    </div>
</div>

<div class="card p-6">
    <div class="overflow-x-auto">
        <table class="table">
            <thead>
                <tr>
                    <th class="th">Order ID</th>
                    <th class="th">Equipment</th>
                    <th class="th">Description</th>
                    <th class="th">Priority</th>
                    <th class="th">Technician</th>
                    <th class="th">Status</th>
                    <th class="th">Due Date</th>
                    <th class="th">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                @foreach($workorders as $wo)
                <tr class="hover:bg-gray-800/50">
                    <td class="td">#WO-{{ $wo->id }}</td>
                    <td class="td font-medium">{{ $wo->equipment->name ?? 'N/A' }}</td>
                    <td class="td">{{ \Illuminate\Support\Str::limit($wo->description, 50) }}</td>
                    <td class="td">
                        @php
                            $priorityVariant = match($wo->priority) {
                                'High' => 'danger',
                                'Medium' => 'warning',
                                'Low' => 'success',
                                default => 'default'
                            };
                        @endphp
                        <x-badge :variant="$priorityVariant">{{ $wo->priority }}</x-badge>
                    </td>
                    <td class="td">{{ $wo->technician->name ?? 'Unassigned' }}</td>
                    <td class="td">
                        @php
                            $statusVariant = match($wo->status) {
                                'Completed' => 'success',
                                'In Progress' => 'warning',
                                'Pending' => 'default',
                                default => 'default'
                            };
                        @endphp
                        <x-badge :variant="$statusVariant">{{ $wo->status }}</x-badge>
                    </td>
                    <td class="td">{{ $wo->due_date ? \Carbon\Carbon::parse($wo->due_date)->format('M d, Y') : 'N/A' }}</td>
                    <td class="td">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('workorders.show', $wo) }}" class="icon-btn text-blue-600 hover:text-blue-500" title="View">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                            <a href="{{ route('workorders.edit', $wo) }}" class="icon-btn text-amber-600 hover:text-amber-500" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <form action="{{ route('workorders.destroy', $wo) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Are you sure you want to delete this work order?')">
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
</div>
@endsection