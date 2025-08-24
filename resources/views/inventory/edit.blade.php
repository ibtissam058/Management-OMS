@extends('layouts.app')
@section('title', 'Edit Spare Part')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 text-dark">Edit Spare Part</h1>
</div>

<div class="table-container">
    <form action="{{ route('inventory.update', $sparepart) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Part Name</label>
            <input id="name" type="text" name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $sparepart->name) }}" required maxlength="255">
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input id="category" type="text" name="category"
                   class="form-control @error('category') is-invalid @enderror"
                   value="{{ old('category', $sparepart->category) }}" required maxlength="255">
            @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input id="quantity" type="number" name="quantity"
                       class="form-control @error('quantity') is-invalid @enderror"
                       value="{{ old('quantity', $sparepart->quantity) }}" required min="0" step="1">
                @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="price" class="form-label">Price</label>
                <div class="input-group">
                    <input id="price" type="number" name="price"
                           class="form-control @error('price') is-invalid @enderror"
                           value="{{ old('price', $sparepart->price) }}" required min="0" step="0.01">
                    <span class="input-group-text">USD</span>
                </div>
                @error('price') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary">Save changes</button>
            <a href="{{ route('inventory.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
