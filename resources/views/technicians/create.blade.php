@extends('layouts.app')
@section('title','Add Technician')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Add New Technician</h1>
</div>

@if ($errors->any())
  <div class="bg-red-50 dark:bg-red-950/30 border border-red-200 dark:border-red-800 rounded-lg p-4 mb-6">
    <ul class="text-red-800 dark:text-red-200 space-y-1">
      @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
    </ul>
  </div>
@endif

<div class="card p-6">
  <form action="{{ route('technicians.store') }}" method="POST" class="space-y-6">
    @csrf
    
    <div>
      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Full Name</label>
      <input type="text" name="name" value="{{ old('name') }}" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Enter technician's full name" required>
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Speciality</label>
      <select name="speciality" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
        <option value="" disabled {{ old('speciality') ? '' : 'selected' }}>Choose Speciality…</option>
        <option value="Mechanical" {{ old('speciality')==='Mechanical' ? 'selected':'' }}>Mechanical</option>
        <option value="Electrical" {{ old('speciality')==='Electrical' ? 'selected':'' }}>Electrical</option>
        <option value="Hydraulics" {{ old('speciality')==='Hydraulics' ? 'selected' : '' }}>Hydraulics</option>
        <option value="Instrumentation" {{ old('speciality')==='Instrumentation' ? 'selected':'' }}>Instrumentation</option>
        <option value="Automation" {{ old('speciality')==='Automation' ? 'selected':'' }}>Automation</option>
        <option value="Welding" {{ old('speciality')==='Welding' ? 'selected':'' }}>Welding</option>
      </select>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone Number</label>
        <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="e.g., +1 (555) 123-4567" required>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address</label>
        <input type="email" name="email" value="{{ old('email') }}" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="technician@company.com" required>
      </div>
    </div>

    <div class="flex gap-3 pt-4">
      <button type="submit" class="btn-primary">Save Technician</button>
      <a href="{{ route('technicians.index') }}" class="btn">Cancel</a>
    </div>
  </form>
</div>
@endsection
