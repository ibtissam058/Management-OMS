@extends('layouts.app')
@section('title','Edit Technician')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Edit Technician</h1>
</div>

@if ($errors->any())
  <div class="bg-red-50 dark:bg-red-950/30 border border-red-200 dark:border-red-800 rounded-lg p-4 mb-6">
    <ul class="text-red-800 dark:text-red-200 space-y-1">
      @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
    </ul>
  </div>
@endif

<div class="card p-6">
  <form action="{{ route('technicians.update', $technician) }}" method="POST" class="space-y-6">
    @csrf @method('PUT')

    <div>
      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Full Name</label>
      <input type="text" name="name" value="{{ old('name', $technician->name) }}" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Speciality</label>
      <select name="speciality" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
        @foreach (['Mechanical','Electrical','Hydraulics','Instrumentation','Automation','Welding'] as $opt)
          <option value="{{ $opt }}" {{ old('speciality', $technician->speciality) === $opt ? 'selected' : '' }}>{{ $opt }}</option>
        @endforeach
      </select>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone Number</label>
        <input type="text" name="phone_number" value="{{ old('phone_number', $technician->phone_number) }}" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address</label>
        <input type="email" name="email" value="{{ old('email', $technician->email) }}" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
      </div>
    </div>

    <div class="flex gap-3 pt-4">
      <button type="submit" class="btn-primary">Save Changes</button>
      <a href="{{ route('technicians.index') }}" class="btn">Cancel</a>
    </div>
  </form>
</div>
@endsection
