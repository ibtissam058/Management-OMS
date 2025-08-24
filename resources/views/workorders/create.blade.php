@extends('layouts.app')
@section('title', 'Create Work Order')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 text-dark">Create Work Order</h1>
</div>
{{-- SHOW validation errors --}}
@if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
    </ul>
  </div>
@endif

<form action="{{ route('workorders.store') }}" method="POST" class="card p-3">
  @csrf

  <div class="mb-3">
    <label class="form-label">Equipment</label>
    <select name="equipment_id" class="form-select" required>
      <option value="" disabled {{ old('equipment_id') ? '' : 'selected' }}>Choose…</option>
      @foreach(($equipments ?? []) as $eq)
        <option value="{{ $eq->id }}" {{ (string)old('equipment_id') === (string)$eq->id ? 'selected' : '' }}>
          {{ $eq->name }}
        </option>
      @endforeach
    </select>
    @error('equipment_id') <div class="text-danger">{{ $message }}</div> @enderror
  </div>

  <div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
    @error('description') <div class="text-danger">{{ $message }}</div> @enderror
  </div>

  <div class="row">
    <div class="col-md-4 mb-3">
      <label class="form-label">Priority</label>
      <select name="priority" class="form-select" required>
        @foreach(['Low','Medium','High'] as $p)
          <option value="{{ $p }}" {{ old('priority')===$p ? 'selected' : '' }}>{{ $p }}</option>
        @endforeach
      </select>
      @error('priority') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
      <label class="form-label">Status</label>
      <select name="status" class="form-select" required>
        @foreach(['Open','In Progress','Completed'] as $s)
          <option value="{{ $s }}" {{ old('status')===$s ? 'selected' : '' }}>{{ $s }}</option>
        @endforeach
      </select>
      @error('status') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
      <label class="form-label">Technician</label>
      <select name="technician_id" class="form-select">
        <option value="">Unassigned</option>
        @foreach(($technicians ?? []) as $t)
          <option value="{{ $t->id }}" {{ (string)old('technician_id') === (string)$t->id ? 'selected' : '' }}>
            {{ $t->name }}
          </option>
        @endforeach
      </select>
      @error('technician_id') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-3">
      <label class="form-label">Due date</label>
      <input type="date" name="due_date" value="{{ old('due_date') }}" class="form-control">
      @error('due_date') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
      <label class="form-label">Cost</label>
      <input type="number" step="0.01" min="0" name="cost" value="{{ old('cost') }}" class="form-control">
      @error('cost') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
  </div>

  <button type="submit" class="btn btn-primary">Save Work Order</button>
</form>
