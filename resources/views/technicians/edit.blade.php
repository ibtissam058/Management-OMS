@extends('layouts.app')
@section('title','Edit Technician')
@section('content')
<h1 class="h2 mb-4">Edit Technician</h1>

@if ($errors->any())
  <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
@endif

<form action="{{ route('technicians.update', $technician) }}" method="POST" class="card p-3">
  @csrf @method('PUT')

  <div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" value="{{ old('name', $technician->name) }}" class="form-control" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Speciality</label>
    <select name="speciality" class="form-select" required>
      @foreach (['Mechanical','Electrical','Instrumentation','Automation','Welding'] as $opt)
        <option value="{{ $opt }}" {{ old('speciality', $technician->speciality) === $opt ? 'selected' : '' }}>{{ $opt }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Phone</label>
    <input type="text" name="phone_number" value="{{ old('phone_number', $technician->phone_number) }}" class="form-control" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" value="{{ old('email', $technician->email) }}" class="form-control" required>
  </div>

  <div class="d-flex gap-2">
    <button class="btn btn-primary">Save changes</button>
    <a href="{{ route('technicians.index') }}" class="btn btn-outline-secondary">Cancel</a>
  </div>
</form>
@endsection
