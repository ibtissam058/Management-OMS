@extends('layouts.app')
@section('title', 'Spare Parts')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 text-dark">Spare Parts Inventory</h1>
    <a href="{{ route('inventory.create') }}" class="btn btn-ocp-primary">
        <i class="fas fa-plus me-2"></i>Add Part
    </a>
</div>

<div class="table-container">
    <!-- Category Filter -->
    <form method="GET" action="{{ route('inventory.index') }}" id="categoryFilter" class="row mb-3 g-2">
        <div class="col-md-3">
            <select name="category" class="form-select" onchange="this.form.submit()">
                <option value="">All Categories</option>
                <option value="Bearings" {{ request('category') === 'Bearings' ? 'selected' : '' }}>Bearings</option>
                <option value="Belts" {{ request('category') === 'Belts' ? 'selected' : '' }}>Belts</option>
                <option value="Motors" {{ request('category') === 'Motors' ? 'selected' : '' }}>Motors</option>
            </select>
        </div>
        @if(request('category'))
            <div class="col-md-2">
                <a href="{{ route('inventory.index') }}" class="btn btn-outline-secondary">Clear Filter</a>
            </div>
        @endif
    </form>

    <!-- Results Info -->
    @if(request('category'))
        <div class="alert alert-info">
            Showing {{ $sparepart->count() }} spare part(s) in category: <strong>{{ request('category') }}</strong>
        </div>
    @endif

    <!-- Spare Parts Table -->
    @if($sparepart->count() > 0)
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sparepart as $part)
                <tr>
                    <td>#PART-{{ $part->id }}</td>
                    <td>{{ $part->name }}</td>
                    <td>
                        <span class="badge bg-secondary">{{ $part->category }}</span>
                    </td>
                    <td>
                        <span class="badge {{ $part->quantity > 10 ? 'bg-success' : ($part->quantity > 5 ? 'bg-warning' : 'bg-danger') }}">
                            {{ $part->quantity }}
                        </span>
                    </td>
                    <td>${{ number_format($part->price, 2) }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('inventory.show', $part) }}" class="btn btn-sm btn-outline-primary" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('inventory.edit', $part) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('inventory.destroy', $part) }}" method="POST" style="display:inline;"
                                  onsubmit="return confirm('Are you sure you want to delete this spare part?')">
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
            <h5>No Spare Parts Found</h5>
            <p>
                @if(request('category'))
                    No spare parts found in category: <strong>{{ request('category') }}</strong>
                    <br>
                    <a href="{{ route('inventory.index') }}" class="btn btn-outline-primary mt-2">View All Parts</a>
                @else
                    No spare parts have been added yet.
                    <br>
                    <a href="{{ route('inventory.create') }}" class="btn btn-ocp-primary mt-2">Add First Part</a>
                @endif
            </p>
        </div>
    @endif
</div>

<!-- Add Part Modal -->
<div class="modal fade" id="addPartModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Spare Part</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('inventory.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Part Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select" required>
                            <option value="" disabled selected>Choose category...</option>
                            <option value="Bearings" {{ old('category') === 'Bearings' ? 'selected' : '' }}>Bearings</option>
                            <option value="Belts" {{ old('category') === 'Belts' ? 'selected' : '' }}>Belts</option>
                            <option value="Motors" {{ old('category') === 'Motors' ? 'selected' : '' }}>Motors</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}" min="0" required>
                        @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}" min="0" required>
                        </div>
                        @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-ocp-primary w-100">Save Part</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection