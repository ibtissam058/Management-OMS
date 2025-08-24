@extends('layouts.app')
@section('title','Add Technician')
@section('content')
<h1 class="h2 mb-4">Add Technician</h1>

@if ($errors->any())
  <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
@endif

<form action="{{ route('technicians.store') }}" method="POST" class="card p-3">
  @csrf
  <div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Speciality</label>
    <select name="speciality" class="form-select" required>
      <option value="" disabled {{ old('speciality') ? '' : 'selected' }}>Choose…</option>
      <option value="Mechanical"      {{ old('speciality')==='Mechanical' ? 'selected':'' }}>Mechanical</option>
      <option value="Electrical"      {{ old('speciality')==='Electrical' ? 'selected':'' }}>Electrical</option>
      <option value="Hydraulics"     {{ request('speciality')==='Hydraulics' ? 'selected' : '' }}>Hydraulics</option>
      <option value="Instrumentation" {{ old('speciality')==='Instrumentation' ? 'selected':'' }}>Instrumentation</option>
      <option value="Automation"      {{ old('speciality')==='Automation' ? 'selected':'' }}>Automation</option>
      <option value="Welding"         {{ old('speciality')==='Welding' ? 'selected':'' }}>Welding</option>
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Phone</label>
    <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
  </div>

  <div class="d-flex gap-2">
    <button class="btn btn-primary">Save</button>
    <a href="{{ route('technicians.index') }}" class="btn btn-outline-secondary">Cancel</a>
  </div>
</form>
@endsection
