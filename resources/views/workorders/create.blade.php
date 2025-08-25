@extends('layouts.app')
@section('title', 'Create Work Order')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Create Work Order</h1>
</div>

@if ($errors->any())
  <div class="bg-red-50 dark:bg-red-950/30 border border-red-200 dark:border-red-800 rounded-lg p-4 mb-6">
    <ul class="text-red-800 dark:text-red-200 space-y-1">
      @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
    </ul>
  </div>
@endif

<div class="card p-6">
  <form action="{{ route('workorders.store') }}" method="POST" class="space-y-6">
    @csrf

    <div>
      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Equipment</label>
      <select name="equipment_id" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
        <option value="" disabled {{ old('equipment_id') ? '' : 'selected' }}>Choose Equipment…</option>
        @foreach(($equipments ?? []) as $eq)
          <option value="{{ $eq->id }}" {{ (string)old('equipment_id') === (string)$eq->id ? 'selected' : '' }}>
            {{ $eq->name }}
          </option>
        @endforeach
      </select>
      @error('equipment_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
      <textarea name="description" rows="4" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Describe the work to be performed..." required>{{ old('description') }}</textarea>
      @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Priority</label>
        <select name="priority" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
          @foreach(['Low','Medium','High'] as $p)
            <option value="{{ $p }}" {{ old('priority')===$p ? 'selected' : '' }}>{{ $p }}</option>
          @endforeach
        </select>
        @error('priority') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
        <select name="status" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
          @foreach(['Open','In Progress','Completed'] as $s)
            <option value="{{ $s }}" {{ old('status')===$s ? 'selected' : '' }}>{{ $s }}</option>
          @endforeach
        </select>
        @error('status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Technician</label>
        <select name="technician_id" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
          <option value="">Unassigned</option>
          @foreach(($technicians ?? []) as $t)
            <option value="{{ $t->id }}" {{ (string)old('technician_id') === (string)$t->id ? 'selected' : '' }}>
              {{ $t->name }}
            </option>
          @endforeach
        </select>
        @error('technician_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Due Date</label>
        <input type="date" name="due_date" value="{{ old('due_date') }}" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
        @error('due_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
      </div>
      
      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Estimated Cost ($)</label>
        <input type="number" step="0.01" min="0" name="cost" value="{{ old('cost') }}" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="0.00">
        @error('cost') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
      </div>
    </div>

    <div class="flex gap-3 pt-4">
      <button type="submit" class="btn-primary">Create Work Order</button>
      <a href="{{ route('workorders.index') }}" class="btn">Cancel</a>
    </div>
  </form>
</div>
@endsection
