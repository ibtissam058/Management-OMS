@extends('layouts.app')
@section('title','Edit Equipment')
@section('content')
<h1 class="h2 mb-4">Edit Equipment</h1>

@if ($errors->any())
  <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
@endif

<form action="{{ route('equipment.update', $equipment) }}" method="POST" class="card p-3">
  @csrf @method('PUT')

  <div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" value="{{ old('name', $equipment->name) }}" class="form-control" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Location</label>
    <select name="location" class="form-select" required>
      @foreach (['Mine Site A','Processing Plant','Chemical Unit'] as $opt)
        <option value="{{ $opt }}" {{ old('location', $equipment->location) === $opt ? 'selected' : '' }}>{{ $opt }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Type</label>
    <select name="type" class="form-select" required>
      @foreach (['Crusher','Convoyer','Pump','Motor','Other'] as $opt)
        <option value="{{ $opt }}" {{ old('type', $equipment->type) === $opt ? 'selected' : '' }}>{{ $opt }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status" class="form-select" required>
      @foreach (['Operational','Under Maintenance','Broken'] as $opt)
        <option value="{{ $opt }}" {{ old('status', $equipment->status) === $opt ? 'selected' : '' }}>{{ $opt }}</option>
      @endforeach
    </select>
  </div>

  <div class="d-flex gap-2">
    <button class="btn btn-primary">Save changes</button>
    <a href="{{ route('equipment.index') }}" class="btn btn-outline-secondary">Cancel</a>
  </div>
</form>
@endsection
