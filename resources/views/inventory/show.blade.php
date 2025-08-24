@extends('layouts.app')
@section('title', 'Spare Part Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 text-dark">Spare Part Details</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('inventory.edit', $sparepart) }}" class="btn btn-warning">
            <i class="fas fa-edit me-1"></i> Edit
        </a>
        <a href="{{ route('inventory.index') }}" class="btn btn-outline-secondary">
            Back
        </a>
    </div>
</div>

<div class="card p-3">
    <dl class="row mb-0">
        <dt class="col-sm-3">ID</dt>
        <dd class="col-sm-9">#PART-{{ $sparepart->id }}</dd>

        <dt class="col-sm-3">Name</dt>
        <dd class="col-sm-9">{{ $sparepart->name }}</dd>

        <dt class="col-sm-3">Category</dt>
        <dd class="col-sm-9">{{ $sparepart->category }}</dd>

        <dt class="col-sm-3">Quantity</dt>
        <dd class="col-sm-9">{{ $sparepart->quantity }}</dd>

        <dt class="col-sm-3">Price</dt>
        <dd class="col-sm-9">{{ number_format($sparepart->price, 2) }}</dd>

        <dt class="col-sm-3">Created</dt>
        <dd class="col-sm-9">{{ $sparepart->created_at?->format('Y-m-d H:i') }}</dd>

        <dt class="col-sm-3">Updated</dt>
        <dd class="col-sm-9">{{ $sparepart->updated_at?->format('Y-m-d H:i') }}</dd>
    </dl>
</div>
@endsection
