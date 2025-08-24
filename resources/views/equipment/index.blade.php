@extends('layouts.app')
@section('title', 'Equipment')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 text-dark">Equipment Management</h1>
    <a href="{{ route('equipment.create') }}" class="btn btn-ocp-primary">
        <i class="fas fa-plus me-2"></i>Add Equipment
    </a>
</div>

<div class="table-container">
    <!-- Filters Form -->
    <form method="GET" action="{{ route('equipment.index') }}" id="equipmentFilter" class="row mb-3 g-2">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search equipment..." 
                   value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="location" class="form-select" onchange="this.form.submit()">
                <option value="">All Locations</option>
                <option value="Mine Site A" {{ request('location') === 'Mine Site A' ? 'selected' : '' }}>Mine Site A</option>
                <option value="Processing Plant" {{ request('location') === 'Processing Plant' ? 'selected' : '' }}>Processing Plant</option>
                <option value="Chemical Unit" {{ request('location') === 'Chemical Unit' ? 'selected' : '' }}>Chemical Unit</option>
            </select>
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select" onchange="this.form.submit()">
                <option value="">All Status</option>
                <option value="Operational" {{ request('status') === 'Operational' ? 'selected' : '' }}>Operational</option>
                <option value="Under Maintenance" {{ request('status') === 'Under Maintenance' ? 'selected' : '' }}>Under Maintenance</option>
                <option value="Broken" {{ request('status') === 'Broken' ? 'selected' : '' }}>Broken</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-primary">Search</button>
            @if(request('search') || request('location') || request('status'))
                <a href="{{ route('equipment.index') }}" class="btn btn-outline-secondary">Clear</a>
            @endif
        </div>
    </form>

    <!-- Results Info -->
    @if(request('search') || request('location') || request('status'))
        <div class="alert alert-info">
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
    @endif

    <!-- Equipment Table -->
    @if($equipment->count() > 0)
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Last Maintenance</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($equipment as $eq)
                <tr>
                    <td>#EQ-{{ $eq->id }}</td>
                    <td>{{ $eq->name }}</td>
                    <td>
                        <span class="badge bg-secondary">{{ $eq->type }}</span>
                    </td>
                    <td>{{ $eq->location }}</td>
                    <td>
                        <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $eq->status)) }}">
                            {{ $eq->status }}
                        </span>
                    </td>
                    <td>{{ $eq->last_maintenance ?? 'N/A' }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('equipment.show', $eq) }}" class="btn btn-sm btn-outline-primary" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('equipment.edit', $eq) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('equipment.destroy', $eq) }}" method="POST" style="display:inline;"
                                  onsubmit="return confirm('Are you sure you want to delete this equipment?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning text-center">
            <h5>No Equipment Found</h5>
            <p>
                @if(request('search') || request('location') || request('status'))
                    No equipment found matching your search criteria.
                    <br>
                    <a href="{{ route('equipment.index') }}" class="btn btn-outline-primary mt-2">View All Equipment</a>
                @else
                    No equipment has been added yet.
                    <br>
                    <a href="{{ route('equipment.create') }}" class="btn btn-ocp-primary mt-2">Add First Equipment</a>
                @endif
            </p>
        </div>
    @endif
</div>

<!-- Add Equipment Modal -->
<div class="modal fade" id="addEquipmentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Equipment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('equipment.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Equipment Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-select" required>
                            <option value="" disabled selected>Choose type...</option>
                            <option value="Crusher" {{ old('type') === 'Crusher' ? 'selected' : '' }}>Crusher</option>
                            <option value="Conveyor" {{ old('type') === 'Conveyor' ? 'selected' : '' }}>Conveyor</option>
                            <option value="Pump" {{ old('type') === 'Pump' ? 'selected' : '' }}>Pump</option>
                            <option value="Motor" {{ old('type') === 'Motor' ? 'selected' : '' }}>Motor</option>
                            <option value="Other" {{ old('type') === 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Location</label>
                        <select name="location" class="form-select" required>
                            <option value="" disabled selected>Choose location...</option>
                            <option value="Mine Site A" {{ old('location') === 'Mine Site A' ? 'selected' : '' }}>Mine Site A</option>
                            <option value="Processing Plant" {{ old('location') === 'Processing Plant' ? 'selected' : '' }}>Processing Plant</option>
                            <option value="Chemical Unit" {{ old('location') === 'Chemical Unit' ? 'selected' : '' }}>Chemical Unit</option>
                        </select>
                        @error('location') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="" disabled selected>Choose status...</option>
                            <option value="Operational" {{ old('status') === 'Operational' ? 'selected' : '' }}>Operational</option>
                            <option value="Under Maintenance" {{ old('status') === 'Under Maintenance' ? 'selected' : '' }}>Under Maintenance</option>
                            <option value="Broken" {{ old('status') === 'Broken' ? 'selected' : '' }}>Broken</option>
                        </select>
                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Last Maintenance</label>
                        <input type="date" name="last_maintenance" class="form-control" value="{{ old('last_maintenance') }}">
                        @error('last_maintenance') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-ocp-primary w-100">Save Equipment</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection