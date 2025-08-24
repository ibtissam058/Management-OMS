@extends('layouts.app')
@section('title', 'Add Spare Part')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 text-dark">Add New Spare Part</h1>
</div>
<div class="table-container">
    <form action="{{ route('inventory.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Part Name</label>
            <input type="text" name="name" class="form-control" required>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Category</label>
            <!--<select name="category" class="form-select">
                <option>Bearings</option>
                <option>Belts</option>
                <option>Motors</option>
            </select>-->
            <select id="category" name="category" class="form-select" required>
                <option value="">Select Category</option>
                <option value="Bearings" {{ old('category') == 'Bearings' ? 'selected' : '' }}>Bearings</option>
                <option value="Belts" {{ old('category') == 'Belts' ? 'selected' : '' }}>Belts</option>
                <option value="Motors" {{ old('category') == 'Motors' ? 'selected' : '' }}>Motors</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" required>
            @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
            @error('price') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-primary">Save</button>
            <a href="{{ route('inventory.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection