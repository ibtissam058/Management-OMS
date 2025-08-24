@extends('layouts.app')
@section('title', 'Technician')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 text-dark">Technicians Management</h1>
    <a href="{{ route('technicians.create') }}" class="btn btn-ocp-primary">
        <i class="fas fa-plus me-2"></i>Add Technician
    </a>
</div>

<div class="table-container">
    <!-- Speciality Filter -->
    <form method="GET" action="{{ route('technicians.index') }}" id="specialityFilter" class="row mb-3 g-2">
        <div class="col-md-3">    
            <select name="speciality" class="form-select" onchange="document.getElementById('specialityFilter').submit()">
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
            <div class="col-md-2">
                <a href="{{ route('technicians.index') }}" class="btn btn-outline-secondary">Clear Filter</a>
            </div>
        @endif
    </form>

    <!-- Results Info -->
    @if(request('speciality'))
        <div class="alert alert-info">
            Showing {{ $technicians->count() }} technician(s) with speciality: <strong>{{ request('speciality') }}</strong>
        </div>
    @endif

    <!-- Technicians Table -->
    @if($technicians->count() > 0)
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Speciality</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Assigned Orders</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($technicians as $tech)
                <tr>
                    <td>#TECH-{{ $tech->id }}</td>
                    <td>{{ $tech->name }}</td>
                    <td>
                        <span class="badge bg-secondary">{{ $tech->speciality }}</span>
                    </td>
                    <td>{{ $tech->phone_number }}</td>
                    <td>{{ $tech->email }}</td>
                    <td>
                        <span class="badge bg-primary">{{ $tech->workOrders ? $tech->workOrders->count() : 0 }}</span>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('technicians.show', $tech) }}" class="btn btn-sm btn-outline-primary" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('technicians.edit', $tech) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('technicians.destroy', $tech) }}" method="POST" style="display:inline;" 
                                  onsubmit="return confirm('Are you sure you want to delete this technician?')">
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
            <h5>No Technicians Found</h5>
            <p>
                @if(request('speciality'))
                    No technicians found with speciality: <strong>{{ request('speciality') }}</strong>
                    <br>
                    <a href="{{ route('technicians.index') }}" class="btn btn-outline-primary mt-2">View All Technicians</a>
                @else
                    No technicians have been added yet.
                    <br>
                    <a href="{{ route('technicians.create') }}" class="btn btn-ocp-primary mt-2">Add First Technician</a>
                @endif
            </p>
        </div>
    @endif
</div>

<!-- Add Technician Modal -->
<div class="modal fade" id="addTechnicianModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Technician</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('technicians.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Speciality</label>
                        <select name="speciality" class="form-select" required>
                            <option value="" disabled selected>Choose speciality...</option>
                            <option value="Mechanical" {{ old('speciality') === 'Mechanical' ? 'selected' : '' }}>Mechanical</option>
                            <option value="Electrical" {{ old('speciality') === 'Electrical' ? 'selected' : '' }}>Electrical</option>
                            <option value="Hydraulics" {{ old('speciality') === 'Hydraulics' ? 'selected' : '' }}>Hydraulics</option>
                            <option value="Instrumentation" {{ old('speciality') === 'Instrumentation' ? 'selected' : '' }}>Instrumentation</option>
                            <option value="Automation" {{ old('speciality') === 'Automation' ? 'selected' : '' }}>Automation</option>
                            <option value="Welding" {{ old('speciality') === 'Welding' ? 'selected' : '' }}>Welding</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="tel" name="phone_number" value="{{ old('phone_number') }}" class="form-control" 
                               placeholder="0612345678" required>
                        @error('phone_number') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contact Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-ocp-primary w-100">Save Technician</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection